<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TodoService;
use Illuminate\Http\JsonResponse;

class ChartController extends Controller
{
    public function __construct(
        private readonly TodoService $todoService
    ) {}

    public function index(Request $request): JsonResponse
    {
        $type = $request->query('type');

        return match ($type) {
            'status'   => $this->statusSummary(),
            'priority' => $this->prioritySummary(),
            'assignee' => $this->assigneeSummary(),
            default    => response()->json([
                'message' => 'Invalid chart type. Allowed: status, priority, assignee',
                'status_code' => 422
            ], 422),
        };
    }

    private function statusSummary(): JsonResponse
    {
        $summary = $this->todoService->getStatusSummary();

        return response()->json([
            'message' => 'Status get successfully',
            'status_code' => 200,
            'status_summary' => $summary,
        ], 200);
    }

    private function prioritySummary(): JsonResponse
    {
        $summary = $this->todoService->getPrioritySummary();

        return response()->json([
            'message' => 'Priority get successfully',
            'status_code' => 200,
            'status_summary' => $summary,
        ], 200);
    }

    private function assigneeSummary(): JsonResponse
    {
        $summary = $this->todoService->getAssigneeSummary();

        return response()->json([
            'message' => 'assignee get successfully',
            'status_code' => 200,
            'status_summary' => $summary,
        ], 200);
    }
}
