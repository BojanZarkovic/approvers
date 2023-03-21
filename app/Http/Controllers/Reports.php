<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class Reports extends Controller
{
    public function get(Request $request)
    {

        $totallyApprovedJobIds = DB::select(DB::raw('SELECT job_id FROM approvals group by job_id HAVING SUM(CASE WHEN approvals.status = "DISSAPROVED" THEN 1 ELSE 0 END)=0'));


    }

}
