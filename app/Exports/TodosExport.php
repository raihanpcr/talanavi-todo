<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class TodosExport implements FromCollection, WithHeadings
{
    public function __construct(
        private readonly Collection $todos,
        private readonly int $totalTodos,
        private readonly float $totalTimeTracked
    ) {}

    public function headings(): array
    {
        return [
            'Title',
            'Assignee',
            'Due Date',
            'Time Tracked',
            'Status',
            'Priority',
        ];
    }

    public function collection(): Collection
    {
        $rows = collect();

        foreach ($this->todos as $todo) {
            $rows->push([
                $todo->title,
                $todo->assignee,
                optional($todo->due_date)->toDateString(),
                $todo->time_tracked,
                $todo->status,
                $todo->priority,
            ]);
        }

        $rows->push([
            'TOTAL',
            null,
            null,
            $this->totalTimeTracked,
            'Total Todos',
            $this->totalTodos,
        ]);

        return $rows;
    }
}
