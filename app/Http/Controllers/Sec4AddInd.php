<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Sec4AddInd extends Controller
{
    public function index()
    {
        $year = DB::table('year')->where('flag', 1)->get();
        $years = $year[0]->year;
        $yearid = $year[0]->year_id;
        // $ob = DB::table('indicator_stratetegic')
        //     ->orderBy('indicator_stratetegic_id')
        //     ->get();
        // return view('sec4.addind', compact('ob'));
        $year = DB::table('year')->where('flag', 1)->get();
        $ob = DB::table('employee')
            ->join('access_stratetegic', 'employee.id_employee', '=', 'access_stratetegic.Employee_id_employee')
            ->join('indicator_stratetegic', 'access_stratetegic.indicator_stratetegic_indicator_stratetegic_id', '=', 'indicator_stratetegic.indicator_stratetegic_id')
            // ->leftJoin('result', 'indicator_result.indicator_result_ID', '=', 'result.indicator_result_indicator_result_ID')
            // ->join('unit', 'indicator_stratetegic.unit', '=', 'unit.id_unit')
            // ->select('indicator_result_ID', 'indicator_result_name', 'plan', 'unit', 'unit_name', 'name_employee')
            ->join('year', 'indicator_stratetegic.year_year_id', '=', 'year.year_id')
            ->where('year.flag', 1)
            ->get();
        // $ob1 = DB::table('unit')->get();
        $ob1 = DB::table('employee')->get();
        return view('sec4.addind', compact('ob', 'ob1', 'year', 'years', 'yearid'));
    }

    public function addInd(Request $request)
    {

        $data = array();
        $data["indicator_stratetegic_name"] = $request->resultname;
        $data["goal"] = $request->resultgoal;
        $data["year_year_id"] = $request->year;

        DB::table('indicator_stratetegic')->insert($data);

        // ค่า kr ตัวล่าสุด
        $max = DB::table('indicator_stratetegic')->max('indicator_stratetegic_id');

        $access = array();
        // $data["assign_id"] = ;
        $access["indicator_stratetegic_indicator_stratetegic_ID"] = $max;
        $access["Employee_id_employee"] = $request->employee;
        // $access["user_employee_all_idemployee_all"] = 0;
        $access["Employee_id_position"] = 0;
        $access["Employee_id_department"] = 0;
        $access["indicator_stratetegic_year_year_id"] = $request->year;
        DB::table('access_stratetegic')->insert($access);

        // insert kr detail 12 เดือน
        for ($i = 1; $i <= 12; $i++) {
            $data2 = array();
            $data2["mount"] = $i;

            $data2["year_year_id"] = $request->year;
            $data2["indicator_stratetegic_indicator_stratetegic_id"] = $max;
            $data2["status"] = 0;
            DB::table('stratetegic')->insert($data2);
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

        DB::table('indicator_stratetegic')
            ->where('indicator_stratetegic_id', $request->id)
            ->update([
                'indicator_stratetegic_name' => $request->newstratetegic,
                'goal' => $request->newgoal
            ]);

        DB::table('access_stratetegic')
            ->where('indicator_stratetegic_indicator_stratetegic_id', $request->id)
            ->update(['Employee_id_employee' => $request->newemployee]);

        return redirect()->back()->with('sucess', 'บันทึกข้อมูลเรียบร้อย');
    }

    public function deleteInd(Request $request)
    {
        $ob = DB::table('stratetegic')
            ->where('indicator_stratetegic_indicator_stratetegic_id', $request->id)
            ->get();
        $data = 0;
        for ($i = 0; $i < count($ob); $i++) {
            $result = $ob[$i]->result;
            $percent = $ob[$i]->percent;
            $job = $ob[$i]->job;
            if ($result != NULL || $percent != NULL || $job != NULL) {
                $data += 1;
            }
        }
        if ($data == 0) {
            DB::table('indicator_stratetegic')
                ->where('indicator_stratetegic_id', $request->id)
                ->delete();
            DB::table('stratetegic')
                ->where('indicator_stratetegic_indicator_stratetegic_id', $request->id)
                ->delete();
            return redirect()->back()->with('sucess', 'ลบข้อมูลเรียบร้อย');
        } else {
            session()->flash('message', 'Cannot be Delete');
            return redirect()->back()->with('alert', 'ไม่สามารถลบข้อมูลได้');
        }
    }
}
