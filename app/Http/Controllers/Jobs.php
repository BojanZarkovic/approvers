<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateJobRequest;
use App\Models\Job;
use App\Models\Professor;
use App\Models\Trader;
use Illuminate\Http\Request;


class Jobs extends Controller
{
    public function index()
    {
        $jobs = Job::all();

        return response()->json([
            'success' => true,
            'data' => $jobs,
        ]);
    }

    public function get(Request $request, $jobId)
    {
        $job = Job::findOrFail($jobId);

        return response()->json([
            'success' => true,
            'data' => $job,
        ]);
    }

    public function create(CreateJobRequest $request)
    {

        $user = $request->user();

        $employee = $request->employee_type === 'professor' ? Professor::findOrFail($user->professor->id) : Trader::findOrFail($user->trader->id);

        // CHECK AVAILABLE HOURS ON DATE
        $sumOfHoursForEmployeeForDate = Job::where('date', $request->date)->where('employee_type', $request->employee_type)->where('employee_id', $employee->id)->sum('total_hours');

        $employeeTotalAvailableHours = $request->employee_type === 'professor' ? $employee->total_available_hours : $employee->working_hours;

        if ($sumOfHoursForEmployeeForDate + $request->hours > $employeeTotalAvailableHours) {
            return response()->json([
                'success' => false,
                'message' => 'Maximum hours for employee exceeded.',
            ], 400);
        }

        $job = new Job();
        $job->date = $request->date;
        $job->total_hours = $request->hours;
        $job->employee_type = $request->employee_type === 'professor' ? 'App\Models\Professor' : 'App\Models\Trader';
        $job->employee_id = $employee->id;
        $job->save();

        return response()->json([
            'success' => true,
            'data' => $job,
        ], 201);
    }

    public function softDelete(Request $request, $jobId)
    {

        $job = Job::findOrFail($jobId);
        $job->delete();

        return response()->json([
            'success' => true,
            'message' => 'Job with ID:' . $jobId . ' has been deleted.',
        ]);
    }

}
