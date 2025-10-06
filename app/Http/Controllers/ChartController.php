<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ToDoList;
use App\Constants\ResponseType;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function getChartData(Request $request)
    {
        try {
            $type = $request->query('type', 'status');

            switch ($type) {
                case 'assignee':
                    $data = $this->getAssigneeSummary();
                    break;
                case 'priority':
                    $data = $this->getPrioritySummary();
                    break;
                case 'status':
                default:
                    $data = $this->getStatusSummary();
                    break;
            }

            return res(ResponseType::SUCCESS, null, $data);
        } catch (\Throwable $e) {
            return res(ResponseType::FAILED, $e->getMessage());
        }
    }

    private function getStatusSummary()
    {
        $statuses = ['pending', 'open', 'in_progress', 'completed'];

        $counts = ToDoList::select('status', DB::raw('COUNT(*) as total'))
            ->whereIn('status', $statuses)
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        $summary = [];
        foreach ($statuses as $status) {
            $summary[$status] = $counts[$status] ?? 0;
        }

        return [
            'status_summary' => $summary
        ];
    }

    private function getPrioritySummary()
    {
        $priorities = ['low', 'medium', 'high'];

        $counts = ToDoList::select('priority', DB::raw('COUNT(*) as total'))
            ->whereIn('priority', $priorities)
            ->groupBy('priority')
            ->pluck('total', 'priority')
            ->toArray();

        $summary = [];
        foreach ($priorities as $priority) {
            $summary[$priority] = $counts[$priority] ?? 0;
        }

        return [
            'priority_summary' => $summary
        ];
    }

    private function getAssigneeSummary()
    {
        $todos = ToDoList::all()->groupBy('assignee');

        $summary = [];
        foreach ($todos as $assignee => $items) {
            $summary[$assignee] = [
                'total_todos' => $items->count(),
                'total_pending_todos' => $items->where('status', 'pending')->count(),
                'total_timetracked_completed_todos' => $items->where('status', 'completed')->sum('time_tracked'),
            ];
        }

        return [
            'assignee_summary' => $summary
        ];
    }
}