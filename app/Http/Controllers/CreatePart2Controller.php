<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers;
use Illuminate\Support\Facades\DB;


class CreatePart2Controller extends Controller
{
    public function index()
    {
        $year = DB::table('year')->where('flag', 1)->get();
        $YearShow = DB::table('year')
            ->where('flag', 1)
            ->select('year')
            ->get();
        $YearShow = $YearShow[0]->year;
        $shindicator_year = DB::table('employee')
            ->join('assign', 'employee.id_employee', '=', 'assign.Employee_id_employee')
            ->join('indicator', 'assign.indicator_id', '=', 'indicator.indicator_id')
            ->join('year', 'year.year_id', '=', 'indicator.year_id')
            ->where('flag', 1)
            ->select('employee.*', 'assign.*', 'indicator.*')
            ->get();

        $shindicator_month = DB::table('employee')
            ->join('assign', 'employee.id_employee', '=', 'assign.Employee_id_employee')
            ->join('indicator', 'assign.indicator_id', '=', 'indicator.indicator_id')
            ->join('year', 'year.year_id', '=', 'indicator.year_id')
            ->where('flag', 1)
            ->select('employee.*', 'assign.*', 'indicator.*')
            ->get();


        $getEmployee = DB::table('employee')
            ->select('employee.*')
            ->where('id_department', '!=', 1)
            ->where('id_department', '!=', 2)
            ->get();
        return view('createPart2', compact('shindicator_year', 'shindicator_month', 'getEmployee', 'year', 'YearShow'));
    }
    public function insert_indicator(Request $request)
    {

        $checktype =  $request->input('type');
        $data = array();
        $data["indicator_name"] = $request->indtcator_name;
        $data["year_id"] = $request->year;
        $data["indicator_type"] = $request->type;
        $data["full_score"] = $request->fullscore;
        DB::table('indicator')->insert($data);
        $max = DB::table('indicator')->max('indicator_id');

        $asign = array();
        // $data["assign_id"] = ;
        $asign["indicator_id"] = $max;
        $asign["Employee_id_employee"] = $request->input('employ');;
        DB::table('assign')->insert($asign);

        if ($checktype == 1) {
            $data = array();
            $max = DB::table('indicator')->max('indicator_id');
            for ($i = 1; $i <= 12; $i++) {
                $data["result"] = null;
                $data["score"] = null;
                $data["percent"] = null;
                $data["indicator_id"] = $max;
                $data["year_id"] = $request->year;
                $data["month"] = $i;
                $data["status"] = 0;
                DB::table('indicator_month')->insert($data);
            }
        } else if ($checktype == 0) {
            $data = array();
            $max = DB::table('indicator')->max('indicator_id');
            $data["indicator_id"] = $max;
            $data["year_id"] = $request->year;
            $data["result"] = null;
            $data["score"] = null;
            $data["percent"] = null;
            $data["status"] = 0;

            DB::table('indicator_year')->insert($data);
        }
        return redirect()->back()->with('sucess', 'บันทึกข้อมูลเรียบร้อย');
    }

    public function updateCreate(Request $request)
    {

        DB::table('assign')
            ->where('indicator_id', $request->edit_indicator_id)
            ->update(['Employee_id_employee' => $request->input('edit_employ')]);


        DB::table('indicator')
            ->where('indicator_id', $request->edit_indicator_id)
            ->update([
                'indicator_name' => $request->edit_indicator_name,
                'indicator_type' => $request->input('edit_indicator_type'),
                'full_score' => $request->edit_fullscore,
            ]);
        return redirect()->back()->with('sucess', 'บันทึกข้อมูลเรียบร้อย');
    }
}