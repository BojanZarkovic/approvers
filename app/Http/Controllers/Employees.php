<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\EditEmployeeRequest;
use App\Models\Professor;
use App\Models\Trader;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Employees extends Controller
{
    public function index()
    {
        $employees = User::where('type', 'NON_APPROVER')->get();

        return response()->json([
            'success' => true,
            'data' => $employees,
        ]);
    }

    public function get(Request $request, $userId)
    {
        $employee = User::where('type', 'NON_APPROVER')->where('id', $userId)->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => $employee,
        ]);
    }

    public function create(CreateEmployeeRequest $request)
    {

        $user = new User();
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->type = 'NON_APPROVER';
        $user->save();


        $employee =  $request->employee_type === 'professor' ? $this->createProfessor($user->id, $request) : $this->createTrader($user->id, $request);

        return response()->json([
            'success' => true,
            'data' => $employee,
        ], 201);
    }

    private function createProfessor($userId, $request) {

        $professor = new Professor();
        $professor->user_id = $userId;
        $professor->total_available_hours = $request->hours;
        $professor->payroll_per_hour = $request->payroll_per_hour;
        $professor->save();

        return $professor;
    }

    private function createTrader($userId, $request) {

        $trader = new Trader();
        $trader->user_id = $userId;
        $trader->working_hours = $request->hours;
        $trader->payroll_per_hour = $request->payroll_per_hour;
        $trader->save();

        return $trader;
    }

    public function edit(EditEmployeeRequest $request, $userId)
    {

        $user = User::where('type', 'NON_APPROVER')->where('id', $userId)->firstOrFail();

        $user->email = $request->email ? $request->email : $user->email;
        $user->password = $request->password ? Hash::make($request->password) : $user->password;
        $user->first_name = $request->first_name ? $request->first_name : $user->first_name;
        $user->last_name = $request->last_name ? $request->last_name : $user->last_name;
        $user->save();

        $employee =  $user->professor ? $this->editProfessor($user->professor, $request) : $this->editTrader($user->trader, $request);

        return response()->json([
            'success' => true,
            'data' => $employee,
        ]);
    }

    private function editProfessor($professor, $request) {

        $professor->total_available_hours = $request->hours;
        $professor->payroll_per_hour = $request->payroll_per_hour;
        $professor->save();

        return $professor;
    }

    private function editTrader($trader, $request) {

        $trader->working_hours = $request->hours;
        $trader->payroll_per_hour = $request->payroll_per_hour;
        $trader->save();

        return $trader;
    }

    public function softDelete(Request $request, $userId)
    {

        $user = User::where('type', 'NON_APPROVER')->where('id', $userId)->firstOrFail();
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'Employee with user ID:' . $userId . ' has been deleted.',
        ]);
    }

}
