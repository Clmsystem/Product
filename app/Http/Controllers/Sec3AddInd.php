<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Sec3AddInd extends Controller
{
    public function index()
    {
        $year = DB::table('year')->where('flag', 1)->get();
        $years = $year[0]->year;
        $yearid = $year[0]->year_id;
        $ob = DB::table('employee')
            ->join('access_result', 'employee.id_employee', '=', 'access_result.Employee_id_employee')
            ->join('indicator_result', 'access_result.indicator_result_indicator_result_ID', '=', 'indicator_result.indicator_result_ID')
            // ->join('result', 'indicator_result.indicator_result_ID', '=', 'result.indicator_result_indicator_result_ID')
            ->join('unit', 'indicator_result.unit', '=', 'unit.id_unit')
            ->join('year', 'indicator_result.year_year_id', '=', 'year.year_id')
            ->where('year.flag', 1)
            ->get();
        $ob1 = DB::table('unit')->get();
        $ob2 = DB::table('employee')->get();
        return view('sec3.addind', compact('ob', 'ob1', 'ob2', 'year', 'years', 'yearid'));
    }
    // public function addObject(Request $request)
    // {
    //     $id = DB::table('object')->max('idobject');

    //     $data = array();
    //     $data["nameObject"] = $request->keyobject;
    //     $data["status"] = 1;
    //     $data["year_year_id"] = 2564;
    //     $data["idobject"] = $id + 1;

    //     DB::table('object')->insert($data);
    //     return redirect()->back()->with('sucess', 'บันทึกข้อมูลเรียบร้อย');
    // }

    public function addInd(Request $request)
    {
        // insert kr id คือ ob id
        // $id = Session::get('id');
        $year = DB::table('year')->where('flag', 1)->get();
        $data = array();
        $data["indicator_result_name"] = $request->resultname;
        $data["plan"] = $request->plan;
        $data["unit"] = $request->unit;
        $data["year_year_id"] = $request->year;
        // $y = date("Y");
        // dd($y);
        DB::table('indicator_result')->insert($data);

        // ค่า kr ตัวล่าสุด
        $max = DB::table('indicator_result')->max('indicator_result_ID');

        $access = array();
        // $data["assign_id"] = ;
        $access["indicator_result_indicator_result_ID"] = $max;
        $access["Employee_id_employee"] = $request->employee;
        $access["user_employee_all_idemployee_all"] = 0;
        $access["Employee_id_position"] = 0;
        $access["Employee_id_department"] = 0;
        $access["indicator_result_year_year_id"] = $request->year;
        DB::table('access_result')->insert($access);

        // insert kr detail 12 เดือน
        for ($i = 1; $i <= 12; $i++) {
            $data2 = array();
            $data2["mount"] = $i;
            $data2["year_year_id"] = $request->year;
            $data2["indicator_result_indicator_result_ID"] = $max;
            $data2["status"] = 0;
            DB::table('result')->insert($data2);
        }

        // insert สิทธ์ ซึ่งจะว่างไว้ก่อน
        // $data3 = array();
        // $data3["KR_idKR"] = $max;
        // $data3["Employee_id_employee"] = 0;
        // $data3["Employee_id_position"] = 0;
        // $data3["Employee_id_department"] = 0;
        // DB::table('autrority')->insert($data3);

        return redirect()->back()->with('sucess', 'บันทึกข้อมูลเรียบร้อย');
    }

    public function updateInd(Request $request)
    {
        DB::table('indicator_result')
            ->where('indicator_result_ID', $request->id)
            ->update([
                'indicator_result_name' => $request->newresult,
                'plan' => $request->newplan,
                'unit' => $request->newunit,
            ]);

        DB::table('access_result')
            ->where('indicator_result_indicator_result_ID', $request->id)
            ->update(['Employee_id_employee' => $request->newemployee]);
        return redirect()->back()->with('sucess', 'บันทึกข้อมูลเรียบร้อย');
    }

    public function deleteInd(Request $request)
    {
        $ob = DB::table('result')
            ->where('indicator_result_indicator_result_ID', $request->id)
            ->get();
        $data = 0;
        for ($i = 0; $i < count($ob); $i++) {
            $result = $ob[$i]->result;
            $performance_result = $ob[$i]->performance_result;
            if ($result != NULL || $performance_result != NULL) {
                $data += 1;
            }
        }
        if ($data == 0) {
            DB::table('indicator_result')
                ->where('indicator_result_ID', $request->id)
                ->delete();
            DB::table('result')
                ->where('indicator_result_indicator_result_ID', $request->id)
                ->delete();
            return redirect()->back()->with('sucess', 'ลบข้อมูลเรียบร้อย');
        } else {
            session()->flash('message', 'Cannot be Delete');
            return redirect()->back()->with('alert', 'ไม่สามารถลบข้อมูลได้');
        }
    }

    public function unit()
    {
        $ob1 = DB::table('unit')->get();
        return view('sec3.addind', compact('ob1'));
    }
}
