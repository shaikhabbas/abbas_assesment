<?php
namespace App\Http\Controllers;

use App\Models\Timesheet;
use Illuminate\Http\Request;

class TimesheetController extends Controller
{
    public function index()
    {
        return response()->json(Timesheet::all());
    }

    public function show($id)
    {
        return response()->json(Timesheet::findOrFail($id));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'task_name' => 'required|string',
            'date' => 'required|date',
            'hours' => 'required|integer|min:1',
            'user_id' => 'required|exists:users,id',
            'project_id' => 'required|exists:projects,id',
        ]);

        $timesheet = Timesheet::create($request->all());

        return response()->json($timesheet, 201);
    }

    public function update(Request $request, $id)
    {
        $timesheet = Timesheet::findOrFail($id);
        $timesheet->update($request->all());
        return response()->json($timesheet);
    }

    public function destroy($id)
    {
        Timesheet::destroy($id);
        return response()->json(['message' => 'Timesheet deleted']);
    }
}
