<?php

namespace App\Http\Controllers;

use App\Constants\ResponseType;
use App\Exports\ToDoListExport;
use Illuminate\Http\Request;
use App\Models\ToDoList;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ToDoListController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'due_date' => 'required|date|after_or_equal:today',
            'status' => 'in:pending,open,in_progress,completed',
            'priority' => 'required|in:low,medium,high',
        ]);

        if ($validator->fails()) {
            return res(ResponseType::VALIDATION_ERROR, $validator->errors()->first(), $validator->errors());
        }

        $data = $request->all();

        $data['time_tracked'] = $data['time_tracked'] ?? 0;
        $data['status'] = $data['status'] ?? 'pending';

        DB::beginTransaction();
        try {
            
            ToDoList::create($data);
        
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return res(ResponseType::FAILED_CREATE, null, null);
        }
        
        return res(ResponseType::CREATED, null, null);
    }

    public function exportExcel(Request $request)
    {
        try {
            
            $fileName = 'todo_list_' . Carbon::now()->format('Ymd_His') . '.xlsx';
            return Excel::download(new ToDoListExport($request), $fileName);

        } catch (\Throwable $e) {
            return res(ResponseType::FAILED, $e->getMessage());
        }
    }
}