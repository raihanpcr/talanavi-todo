<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class TodoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'        => ['required', 'string', 'max:255'],
            'assignee'     => ['nullable', 'string', 'max:255'],
            'due_date'     => ['required', 'date', 'after_or_equal:today'],
            'time_tracked' => ['nullable', 'numeric', 'min:0'],
            'status'       => ['nullable', 'in:pending,open,in_progress,completed'],
            'priority'     => ['required', 'in:low,medium,high'],
        ];
    }

    public function prepareForValidation(): void
    {
        if (!$this->has('time_tracked') || $this->input('time_tracked') === null) {
            $this->merge([
                'time_tracked' => 0,
            ]);
        }

        if (!$this->has('status') || $this->input('status') === null) {
            $this->merge([
                'status' => 'pending',
            ]);
        }
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'message' => 'Validation failed',
                'status_code' => 400,
                'errors' => $validator->errors(),
            ], 400)
        );
    }
}
