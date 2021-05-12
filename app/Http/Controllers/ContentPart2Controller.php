<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers;
use Illuminate\Support\Facades\DB;


class ContentPart2Controller extends Controller
{
    public function index()
    {
        $month = (int)date("m");

        $year = DB::table('year')
            ->where('flag', 1)
            ->select('year_id')
            ->get();

        $YearShow = DB::table('year')
            ->where('flag', 1)
            ->select('year')
            ->get();

        $YearShow = $YearShow[0]->year;
        $year = $year[0]->year_id;
        $idUser = session()->get('user')['id_employee'];

        $indicator_month = DB::table('employee')

            ->join('assign', 'employee.id_employee', '=', 'assign.Employee_id_employee')
            ->join('indicator', 'assign.indicator_id', '=', 'indicator.indicator_id')
            ->join('indicator_month', 'indicator.indicator_id', '=', 'indicator_month.indicator_id')
            ->join('year', 'indicator_month.year_id', '=', 'year.year_id')
            ->where('assign.Employee_id_employee', '=', $idUser)
            ->where('year.year_id', '=', $year)
            ->where('indicator_month.month', '=', $month)
            ->get();

        $status_month = DB::table('employee')

            ->join('assign', 'employee.id_employee', '=', 'assign.Employee_id_employee')
            ->join('indicator', 'assign.indicator_id', '=', 'indicator.indicator_id')
            ->join('indicator_month', 'indicator.indicator_id', '=', 'indicator_month.indicator_id')
            ->join('year', 'indicator_month.year_id', '=', 'year.year_id')
            ->where('assign.Employee_id_employee', '=', $idUser)
            ->where('year.year_id', '=', $year)
            ->where('indicator_month.month', '=', $month)
            ->where('indicator_month.status', '=', 0)
            ->get();

        return view('contentPart2', compact('indicator_month', 'month', 'year', 'YearShow', 'status_month'));
    }

    public function update1(Request $request)
    {
        DB::table('indicator_month')
            ->where('indicator_month_id', $request->key)
            ->update([
                'result' => $request->result,
                'percent' => $request->percent
            ]);

        return redirect()->back()->with('sucess', 'บันทึกข้อมูลเรียบร้อย');
    }

    public function update(Request $request)
    {
        DB::table('indicator_month')
            ->where('indicator_month_id', $request->key)
            ->update([
                'result' => $request->result,
                'percent' => $request->percent,
                'score' => $request->score
            ]);


        return redirect()->back()->with('sucess', 'บันทึกข้อมูลเรียบร้อย');
    }


    public function search_month(Request $request)
    {
        $month = $request->input('month');
        $month = $request->month;

        $year = DB::table('year')
            ->where('flag', 1)
            ->select('year_id')
            ->get();

        $YearShow = DB::table('year')
            ->where('flag', 1)
            ->select('year')
            ->get();

        $YearShow = $YearShow[0]->year;
        $idUser = session()->get('user')['id_employee'];
        $year = $year[0]->year_id;


        if ($request->month == 0) {
            $indicator_month = DB::table('employee')
                ->join('assign', 'employee.id_employee', '=', 'assign.Employee_id_employee')
                ->join('indicator', 'assign.indicator_id', '=', 'indicator.indicator_id')
                ->leftJoin('indicator_year', 'indicator.indicator_id', '=', 'indicator_year.indicator_id')
                ->leftJoin('indicator_month', 'indicator.indicator_id', '=', 'indicator_month.indicator_id')
                ->leftJoin('year', 'indicator_year.year_id', '=', 'year.year_id')
                ->where('assign.Employee_id_employee', '=', $idUser)
                ->get();
        } else {
            $indicator_month = DB::table('employee')
                ->join('assign', 'employee.id_employee', '=', 'assign.Employee_id_employee')
                ->join('indicator', 'assign.indicator_id', '=', 'indicator.indicator_id')
                ->leftJoin('indicator_year', 'indicator.indicator_id', '=', 'indicator_year.indicator_id')
                ->leftJoin('indicator_month', 'indicator.indicator_id', '=', 'indicator_month.indicator_id')
                ->leftJoin('year', 'indicator_year.year_id', '=', 'year.year_id')
                ->where('assign.Employee_id_employee', '=', $idUser)
                ->where('indicator_month.year_id', '=', $year)
                ->where('indicator_month.month', '=', $month)
                ->get();
        }

        $status_month = DB::table('employee')

            ->join('assign', 'employee.id_employee', '=', 'assign.Employee_id_employee')
            ->join('indicator', 'assign.indicator_id', '=', 'indicator.indicator_id')
            ->join('indicator_month', 'indicator.indicator_id', '=', 'indicator_month.indicator_id')
            ->join('year', 'indicator_month.year_id', '=', 'year.year_id')
            ->where('assign.Employee_id_employee', '=', $idUser)
            ->where('year.year_id', '=', $year)
            ->where('indicator_month.month', '=', $month)
            ->where('indicator_month.status', '=', 0)
            ->get();
        return view('contentPart2', compact('indicator_month', 'month', 'year', 'YearShow', 'status_month'));
    }
}