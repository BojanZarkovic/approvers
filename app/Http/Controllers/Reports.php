<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class Reports extends Controller
{
    public function get()
    {

        $report = DB::select("SELECT YEAR(subQuery.date) AS year, MONTH(subQuery.date) AS month, sum(subQuery.total_hours * ifnull(subQuery.professorPayroll, subQuery.traderPayroll)) AS payment
                                                      FROM (SELECT job_id, jobs.date, jobs.total_hours, jobs.employee_id, jobs.employee_type, professors.payroll_per_hour AS professorPayroll, traders.payroll_per_hour AS traderPayroll
                                                      FROM approvals
                                                      LEFT JOIN jobs ON jobs.id=approvals.job_id
                                                      LEFT JOIN professors ON jobs.employee_id=professors.id AND jobs.employee_type='PROFESSOR'
                                                      LEFT JOIN traders ON jobs.employee_id=traders.id AND jobs.employee_type='TRADER'
                                                      GROUP BY job_id
                                                      HAVING SUM(CASE
                                                                 WHEN approvals.status = 'DISSAPROVED' THEN 1
                                                                 ELSE 0
                                                               END)=0) AS subQuery
                                                      GROUP BY YEAR(subQuery.date), MONTH(subQuery.date)");


        return response()->json([
            'success' => true,
            'data' => $report,
        ]);
    }

}
