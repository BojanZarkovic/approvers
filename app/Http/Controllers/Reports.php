<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


class Reports extends Controller
{
    public function get(Request $request, $userId)
    {

        $user = User::findOrFail($userId);

        $employee = $user->proffesor ? $user->proffesor : $user->trader;

        $totallyApprovedJobIds = DB::select(DB::raw('SELECT job_id FROM approvals left join jobs on jobs.id=approvals.job_id where jobs.employee_id=' . $employee->id . ' group by job_id HAVING SUM(CASE WHEN approvals.status = "DISSAPROVED" THEN 1 ELSE 0 END)=0;'));


    }

}
