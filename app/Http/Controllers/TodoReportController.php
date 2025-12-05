<?php

namespace App\Http\Controllers;

use App\Exports\TodosExport;
use Illuminate\Http\Request;
use App\Services\TodoService;
use Maatwebsite\Excel\Facades\Excel;

class TodoReportController extends Controller
{
    public function __construct(
        private readonly TodoService $todoService
    ) {}

    public function export(Request $request)
    {
        $filters = $request->only([
            'title',
            'assignee',
            'start',
            'end',
            'min',
            'max',
            'status',
            'priority',
        ]);

        $todos = $this->todoService->getFilteredTodos($filters);
        // dd($todos);

        $totalTodos        = $todos->count();
        $totalTimeTracked  = (float) $todos->sum('time_tracked');

        $export = new TodosExport($todos, $totalTodos, $totalTimeTracked);

        return Excel::download($export, 'todos_report.xlsx');
    }
}
