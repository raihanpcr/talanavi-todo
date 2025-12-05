<?php

namespace App\Services;

use App\Models\Todo;
use Illuminate\Database\Eloquent\Collection;

class TodoService{

      public function create(array $data): Todo
      {      
            return Todo::create($data);
      }

      public function getFilteredTodos(array $filters): Collection
      {
            return Todo::query()
                  ->filter($filters)
                  ->orderBy('due_date')
                  ->get();
      }

      public function getStatusSummary(): array
      {
            $result = Todo::groupBy('status')
            ->select('status')
            ->selectRaw('COUNT(*) as total')
            ->pluck('total', 'status')
            ->toArray();

            return [
                  'pending' => $result['pending'] ?? 0,
                  'open' => $result['open'] ?? 0,
                  'in_progress' => $result['in_progress'] ?? 0,
                  'completed' => $result['completed'] ?? 0,
            ];
      }

      public function getPrioritySummary(): array
      {
            $result = Todo::groupBy('priority')
                  ->select('priority')
                  ->selectRaw('COUNT(*) as total')
                  ->pluck('total', 'priority')
                  ->toArray();

            return [
                  'low' => $result['low'] ?? 0,
                  'medium' => $result['medium'] ?? 0,
                  'high'=> $result['high'] ?? 0,
            ];
      }

      public function getAssigneeSummary(): array
      {
            $assignees = Todo::whereNotNull('assignee')
                  ->pluck('assignee')
                  ->unique()
                  ->toArray();

            $summary = [];

            foreach ($assignees as $assignee) {

                  $summary[$assignee] = [
                        'total_todos' => Todo::where('assignee', $assignee)->count(),

                        'total_pending_todos' => Todo::where('assignee', $assignee)
                        ->where('status', 'pending')
                        ->count(),

                        'total_timetracked_completed_todos' => Todo::where('assignee', $assignee)
                        ->where('status', 'completed')
                        ->sum('time_tracked'),
                  ];
            }

            return $summary;
      }
}