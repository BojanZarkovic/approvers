<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateApprovalRequest;
use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\EditApprovalRequest;
use App\Http\Requests\EditEmployeeRequest;
use App\Models\Approval;
use App\Models\Job;
use App\Models\Professor;
use App\Models\Trader;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Approvals extends Controller
{
    public function index()
    {
        $approvals = Approval::all();

        return response()->json([
            'success' => true,
            'data' => $approvals,
        ]);
    }

    public function get(Request $request, $approvalId)
    {
        $approval = Approval::findOrFail($approvalId);

        return response()->json([
            'success' => true,
            'data' => $approval,
        ]);
    }

    public function create(CreateApprovalRequest $request)
    {

        $user = $request->user();

        $job = Job::findOrFail($request->job_id);

        $approval = new Approval();
        $approval->user_id = $user->id;
        $approval->job_id = $job->id;
        $approval->status = $request->status;
        $approval->save();

        return response()->json([
            'success' => true,
            'data' => $approval,
        ], 201);
    }

    public function edit(EditApprovalRequest $request, $approvalId)
    {
        $user = $request->user();

        $approval = Approval::where('user_id', $user->id)->where('id', $approvalId)->firstOrFail();

        $approval->status = $request->status;
        $approval->save();

        return response()->json([
            'success' => true,
            'data' => $approval,
        ]);

    }

    public function softDelete(Request $request, $approvalId)
    {

        $user = $request->user();

        $approval = Approval::where('user_id', $user->id)->where('id', $approvalId)->firstOrFail();

        $approval->delete();

        return response()->json([
            'success' => true,
            'message' => 'Approval with ID:' . $approvalId . ' has been deleted.',
        ]);
    }

}
