<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers;
use Illuminate\Support\Facades\DB;


class ConfirmPart2YearController extends Controller
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
        // $year = (int)date("Y") + 543;

        // $years = DB::table('year')
        // ->get();

        // dd($indicator_month);
        $indicator_year = DB::table('employee')
            ->join('assign', 'employee.id_employee', '=', 'assign.Employee_id_employee')
            ->join('indicator', 'assign.indicator_id', '=', 'indicator.indicator_id')
            ->leftJoin('indicator_year', 'indicator.indicator_id', '=', 'indicator_year.indicator_id')
            ->join('year', 'indicator_year.year_id', '=', 'year.year_id')
            ->where('year.year_id', '=', $year)
            ->get();
        // dd($indicator_year,$year);

        //$year = 3;

        // dd($indicator_month, $indicator_year, $year, $month);
        return view('confirmPart2Year', compact('indicator_year', 'year', 'YearShow'));


        $year = DB::table('employee')
            ->join('assign', 'employee.id_employee', '=', 'assign.Employee_id_employee')
            ->join('indicator', 'assign.indicator_id', '=', 'indicator.indicator_id')
            ->join('indicator_year', 'indicator.indicator_id', '=', 'indicator_year.indicator_id')
            ->select('employee.*', 'assign.*', 'indicator.*', 'indicator_year.*')
            ->get();

        return view('confirmPart2Year', compact('year'));
    }
    public function confirm_year(Request $request)
    {
        $year = $request->input('year');
        $years = $request->year;
        //$year = $request->year;

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
        // dd($request->year);
        // $years = DB::table('year')
        // ->get();

        if ($request->year == 0) {
            $indicator_year = DB::table('employee')
                ->join('assign', 'employee.id_employee', '=', 'assign.Employee_id_employee')
                ->join('indicator', 'assign.indicator_id', '=', 'indicator.indicator_id')
                ->join('indicator_year', 'indicator.indicator_id', '=', 'indicator_year.indicator_id')
                ->get();
        } else
            $indicator_year = DB::table('employee')
                ->join('assign', 'employee.id_employee', '=', 'assign.Employee_id_employee')
                ->join('indicator', 'assign.indicator_id', '=', 'indicator.indicator_id')
                ->leftJoin('indicator_year', 'indicator.indicator_id', '=', 'indicator_year.indicator_id')
                ->join('year', 'indicator_year.year_id', '=', 'year.year_id')
                //->where('year.year', '=', $year)
                ->where('indicator_year.year_id', '=', $year)
                ->get();
        // dd($indicator_year);


        return view('confirmPart2Year', compact('indicator_year', 'year', 'Yearshow'));
    }

    public function logPart2Year(Request $request)
    {
        $check = DB::table('indicator_year')
            ->join('year', 'indicator_year.year_id', '=', 'year.year_id')
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
            DB::table('indicator_year')
                ->join('year', 'indicator_year.year_id', '=', 'year.year_id')
                ->where('year.flag', 1)
                ->update(['status' => 1]);
            return redirect('/confirmPart2Year');
        } else {
            session()->flash('message', 'Cannot be Confirm');
            return redirect('/confirmPart2Year')->with('alert', 'ไม่สามารถยืนยันข้อมูลได้');
        }

        DB::table('indicator_year')
            ->join('year', 'indicator_year.year_id', '=', 'year.year_id')
            ->where('year.flag', 1)
            ->update(['status' => 1]);
        return redirect('/confirmPart2Year');
    }

    public function unlogPart2Year(Request $request)
    {
        DB::table('indicator_year')
            ->join('year', 'indicator_year.year_id', '=', 'year.year_id')
            ->where('year.flag', 1)
            ->update(['status' => 0]);
        return redirect('/confirmPart2Year');
    }
}