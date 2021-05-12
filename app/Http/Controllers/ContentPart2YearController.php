<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers;
use Illuminate\Support\Facades\DB;


class ContentPart2YearController extends Controller
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
        $indicator_year = DB::table('employee')
            ->join('assign', 'employee.id_employee', '=', 'assign.Employee_id_employee')
            ->join('indicator', 'assign.indicator_id', '=', 'indicator.indicator_id')
            ->leftJoin('indicator_year', 'indicator.indicator_id', '=', 'indicator_year.indicator_id')
            ->join('year', 'indicator_year.year_id', '=', 'year.year_id')
            ->where('assign.Employee_id_employee', '=', $idUser)
            ->where('year.year_id', '=', $year)
            ->get();
        $status_year = DB::table('employee')
            ->join('assign', 'employee.id_employee', '=', 'assign.Employee_id_employee')
            ->join('indicator', 'assign.indicator_id', '=', 'indicator.indicator_id')
            ->leftJoin('indicator_year', 'indicator.indicator_id', '=', 'indicator_year.indicator_id')
            ->join('year', 'indicator_year.year_id', '=', 'year.year_id')
            ->where('assign.Employee_id_employee', '=', $idUser)
            ->where('year.year_id', '=', $year)
            ->where('indicator_year.status', '=', 0)
            ->get();

        
        return view('contentPart2Year', compact('indicator_year', 'year', 'YearShow', 'status_year'));
    }

    public function update(Request $request)
    {   
        DB::table('indicator_year')
            ->where('indicator_year_id', $request->key)
            ->update([
                'result' => $request->result,
                'percent' => $request->percent,
                'score' => $request->score
            ]);

        
        return redirect()->back()->with('sucess', 'บันทึกข้อมูลเรียบร้อย');
    }



    public function search_year(Request $request)
    {
        $year = $request->input('year');
        $years = $request->year;
        
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

        if ($request->year == 0) {
            $indicator_year = DB::table('employee')
                ->join('assign', 'employee.id_employee', '=', 'assign.Employee_id_employee')
                ->join('indicator', 'assign.indicator_id', '=', 'indicator.indicator_id')
                ->join('indicator_year', 'indicator.indicator_id', '=', 'indicator_year.indicator_id')
                ->where('assign.Employee_id_employee', '=', $idUser)
                ->get();
        } else {
            $indicator_year = DB::table('employee')
                ->join('assign', 'employee.id_employee', '=', 'assign.Employee_id_employee')
                ->join('indicator', 'assign.indicator_id', '=', 'indicator.indicator_id')
                ->leftJoin('indicator_year', 'indicator.indicator_id', '=', 'indicator_year.indicator_id')
                ->join('year', 'indicator_year.year_id', '=', 'year.year_id')
                ->where('assign.Employee_id_employee', '=', $idUser)
                ->where('indicator_year.year_id', '=', $year)
                ->get();

        }

        $status_year = DB::table('employee')
                ->join('assign', 'employee.id_employee', '=', 'assign.Employee_id_employee')
                ->join('indicator', 'assign.indicator_id', '=', 'indicator.indicator_id')
                ->leftJoin('indicator_year', 'indicator.indicator_id', '=', 'indicator_year.indicator_id')
                ->join('year', 'indicator_year.year_id', '=', 'year.year_id')
                ->where('assign.Employee_id_employee', '=', $idUser)
                ->where('year.year_id', '=', $year)
                ->where('indicator_year.status', '=', 0)
                ->get();


        return view('contentPart2Year', compact('indicator_year', 'year', 'Yearshow', 'status_year'));
    }
}