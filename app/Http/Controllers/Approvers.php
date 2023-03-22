<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateApproverRequest;
use App\Http\Requests\EditApproverRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Approvers extends Controller
{
    public function index()
    {
        $approvers = User::where('type', 'APPROVER')->get();

        return response()->json([
            'success' => true,
            'data' => $approvers,
        ]);
    }

    public function get(Request $request, $userId)
    {
        $approver = User::where('type', 'APPROVER')->where('id', $userId)->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => $approver,
        ]);
    }

    public function create(CreateApproverRequest $request)
    {

        $user = new User();
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->type = 'APPROVER';
        $user->save();

        return response()->json([
            'success' => true,
            'data' => $user,
        ], 201);
    }

    public function edit(EditApproverRequest $request, $userId)
    {

        $user = User::where('type', 'APPROVER', 'id', $userId)->firstOrFail();

        $user->email = $request->email ? $request->email : $user->email;
        $user->password = $request->password ? Hash::make($request->password) : $user->password;
        $user->first_name = $request->first_name ? $request->first_name : $user->first_name;
        $user->last_name = $request->last_name ? $request->last_name : $user->last_name;
        $user->save();

        return response()->json([
            'success' => true,
            'data' => $user,
        ]);
    }

    public function softDelete(Request $request, $userId)
    {

        $user = User::where('type', 'APPROVER', 'id', $userId)->firstOrFail();
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'Approver with user ID:' . $userId . ' has been deleted.',
        ]);
    }

}
