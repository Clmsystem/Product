<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers;
use Illuminate\Support\Facades\DB;


class ConfirmPart2Controller extends Controller
{
    public function index()
    {
        $month = (int)date("m");
        // $year = (int)date("Y") + 543;

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

        $indicator_month = DB::table('employee')

            ->join('assign', 'employee.id_employee', '=', 'assign.Employee_id_employee')
            ->join('indicator', 'assign.indicator_id', '=', 'indicator.indicator_id')
            ->join('indicator_month', 'indicator.indicator_id', '=', 'indicator_month.indicator_id')
            ->join('year', 'indicator_month.year_id', '=', 'year.year_id')
            ->where('year.year_id', '=', $year)
            ->where('indicator_month.month', '=', $month)
            ->get();

        return view('confirmPart2', compact('indicator_month', 'month', 'year', 'YearShow'));
    }
    public function confirm_month(Request $request)
    {
        // $year = (int)date("Y") + 543;
        $month = $request->input('month');
        $month = $request->month;
        //  $year= $request->year;

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

        // $year = (int)date("Y") + 543;
        //  dd($request->month);

        if ($request->month == 0) {
            $indicator_month = DB::table('employee')
                ->join('assign', 'employee.id_employee', '=', 'assign.Employee_id_employee')
                ->join('indicator', 'assign.indicator_id', '=', 'indicator.indicator_id')
                ->leftJoin('indicator_year', 'indicator.indicator_id', '=', 'indicator_year.indicator_id')
                ->leftJoin('indicator_month', 'indicator.indicator_id', '=', 'indicator_month.indicator_id')
                ->leftJoin('year', 'indicator_year.year_id', '=', 'year.year_id')
                ->get();
        } else
            $indicator_month = DB::table('employee')
                ->join('assign', 'employee.id_employee', '=', 'assign.Employee_id_employee')
                ->join('indicator', 'assign.indicator_id', '=', 'indicator.indicator_id')
                ->leftJoin('indicator_year', 'indicator.indicator_id', '=', 'indicator_year.indicator_id')
                ->leftJoin('indicator_month', 'indicator.indicator_id', '=', 'indicator_month.indicator_id')
                ->leftJoin('year', 'indicator_year.year_id', '=', 'year.year_id')
                ->where('indicator_month.year_id', '=', $year)
                ->where('indicator_month.month', '=', $month)
                ->get();

        return view('confirmPart2', compact('indicator_month', 'month', 'year', 'YearShow'));
    }

    public function logPart2(Request $request)
    {

        $check = DB::table('indicator_month')
            ->join('year', 'indicator_month.year_id', '=', 'year.year_id')
            ->where('month', $request->monthselect)
            ->where('year.flag', 1)
            ->get();
        $checkdata = 0;
        for ($i = 0; $i < count($check); $i++) {
            $result = $check[$i]->result;
            $percent = $check[$i]->percent;
            $score = $check[$i]->score;
            if ($result == NULL || $percent == NULL || $score == NULL) {
                $checkdata += 1;
            }
        }
        if ($checkdata == 0) {
            DB::table('indicator_month')
                ->join('year', 'indicator_month.year_id', '=', 'year.year_id')
                ->where('year.flag', 1)
                ->where('month', $request->monthselect)
                ->update(['status' => 1]);
            return redirect('/confirmPart2');
        } else {
            session()->flash('message', 'Cannot be Confirm');
            return redirect('/confirmPart2')->with('alert', 'ไม่สามารถยืนยันข้อมูลได้');
        }

        DB::table('indicator_month')
            ->join('year', 'indicator_month.year_id', '=', 'year.year_id')
            ->where('year.flag', 1)
            ->where('month', $request->monthselect)
            ->update(['status' => 1]);
        return redirect('/confirmPart2');
    }

    public function unlogPart2(Request $request)
    {
        DB::table('indicator_month')
            ->join('year', 'indicator_month.year_id', '=', 'year.year_id')
            ->where('year.flag', 1)
            ->where('month', $request->monthselect)
            ->update(['status' => 0]);
        return redirect('/confirmPart2');
    }
}