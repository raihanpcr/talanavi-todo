<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Services\TodoService;
use App\Http\Resources\TodoResource;
use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\TodoRequest;
use App\Http\Requests\UpdateTodoRequest;

class TodoController extends Controller
{
    public function __construct(
        private readonly TodoService $todoService
    ) {}

    public function store(TodoRequest $request)
    {
        $todo = $this->todoService->create($request->validated());

        return response()->json([
            'message' => 'Todo created successfully',
            'status_code' => 201,
            'data'    => new TodoResource($todo),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTodoRequest $request, Todo $todo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        //
    }
}
