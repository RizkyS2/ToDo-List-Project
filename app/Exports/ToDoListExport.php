<?php

namespace App\Exports;

use App\Models\ToDoList;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Http\Request;

class ToDoListExport implements FromView
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function view(): View
    {
        $query = ToDoList::query();

        // Filter berdasarkan judul
        if ($this->request->filled('title')) {
            $query->where('title', 'like', '%' . $this->request->title . '%');
        }

        // Filter berdasarkan user assign
        if ($this->request->filled('assignee')) {
            $query->whereIn('assignee', explode(',', $this->request->assignee));
        }

        // Filter berdasarkan due_date
        if ($this->request->filled('start') && $this->request->filled('end')) {
            
            // Jika keduanya diisi
            $query->whereBetween('due_date', [$this->request->start, $this->request->end]);

        } elseif ($this->request->filled('start')) {
            
            // Hanya start diisi → semua due_date setelah atau sama dengan start
            $query->where('due_date', '>=', $this->request->due_date_start);

        } elseif ($this->request->filled('end')) {

            // Hanya end diisi → semua due_date sebelum atau sama dengan end
            $query->where('due_date', '<=', $this->request->end);
            
        }

        // Filter berdasarkan catatan waktu
        if ($this->request->filled('min') && $this->request->filled('max')) {
            $query->whereBetween('time_tracked', [$this->request->min, $this->request->max]);
        }

        // Filter berdasarkan status
        if ($this->request->filled('status')) {
            $query->whereIn('status', explode(',', $this->request->status));
        }

        // Filter berdasarkan prioritas
        if ($this->request->filled('priority')) {
            $query->whereIn('priority', explode(',', $this->request->priority));
        }

        $todos = $query->get();

        $summary = [
            'total_todos' => $todos->count(),
            'total_time_tracked' => $todos->sum('time_tracked')
        ];

        return view('exports.todo_list', compact('todos', 'summary'));
    }
}