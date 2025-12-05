<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'assignee',
        'due_date',
        'time_tracked',
        'status',
        'priority',
    ];

    protected $casts = [
        'due_date'      => 'date',
        'time_tracked'  => 'float',
    ];

    public function scopeFilter($query, array $filters)
    {
        if (!empty($filters['title'])) {
            $query->where('title', 'like', '%' . $filters['title'] . '%');
        }

        if (!empty($filters['assignee'])) {
            $assignees = array_filter(array_map('trim', explode(',', $filters['assignee'])));
            $query->whereIn('assignee', $assignees);
        }

        if (!empty($filters['start'])) {
            $query->whereDate('due_date', '>=', $filters['start']);
        }
        if (!empty($filters['end'])) {
            $query->whereDate('due_date', '<=', $filters['end']);
        }

        if (!empty($filters['min'])) {
            $query->where('time_tracked', '>=', $filters['min']);
        }
        if (!empty($filters['max'])) {
            $query->where('time_tracked', '<=', $filters['max']);
        }

        if (!empty($filters['status'])) {
            $statuses = array_filter(array_map('trim', explode(',', $filters['status'])));
            $query->whereIn('status', $statuses);
        }

        if (!empty($filters['priority'])) {
            $priorities = array_filter(array_map('trim', explode(',', $filters['priority'])));
            $query->whereIn('priority', $priorities);
        }

        return $query;
    }

}
