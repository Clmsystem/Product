<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class Sec3Confirm extends Controller
{
    public function index()
    {
        $year = DB::table('year')->where('flag', 1)->get();
        $years = $year[0]->year;
        $mount = (int)date('m');

        $ob = DB::table('employee')
            ->join('access_result', 'employee.id_employee', '=', 'access_result.Employee_id_employee')
            ->join('indicator_result', 'access_result.indicator_result_indicator_result_ID', '=', 'indicator_result.indicator_result_ID')
            ->join('result', 'indicator_result.indicator_result_ID', '=', 'result.indicator_result_indicator_result_ID')
            ->join('unit', 'indicator_result.unit', '=', 'unit.id_unit')
            ->join('year', 'indicator_result.year_year_id', '=', 'year.year_id')
            ->where('result.mount', '=', $mount)
            ->where('year.flag', 1)
            ->get();
        $status = DB::table('employee')
            ->join('access_result', 'employee.id_employee', '=', 'access_result.Employee_id_employee')
            ->join('indicator_result', 'access_result.indicator_result_indicator_result_ID', '=', 'indicator_result.indicator_result_ID')
            ->join('result', 'indicator_result.indicator_result_ID', '=', 'result.indicator_result_indicator_result_ID')
            ->join('unit', 'indicator_result.unit', '=', 'unit.id_unit')
            ->join('year', 'indicator_result.year_year_id', '=', 'year.year_id')
            ->where('result.mount', '=', $mount)
            ->where('year.flag', '=',  1)
            ->where('result.status', '=',  0)
            ->get();

        return view('sec3.sec3confirm', compact('ob', 'mount', 'status', 'years'));
    }

    public function resultShowMount(Request $request)
    {
        $mount = $request->mount;
        $year = DB::table('year')->where('flag', 1)->get();
        $years = $year[0]->year;

        $ob = DB::table('employee')
            ->join('access_result', 'employee.id_employee', '=', 'access_result.Employee_id_employee')
            ->join('indicator_result', 'access_result.indicator_result_indicator_result_ID', '=', 'indicator_result.indicator_result_ID')
            ->join('result', 'indicator_result.indicator_result_ID', '=', 'result.indicator_result_indicator_result_ID')
            ->join('unit', 'indicator_result.unit', '=', 'unit.id_unit')
            ->join('year', 'indicator_result.year_year_id', '=', 'year.year_id')
            ->where('result.mount', '=', $mount)
            ->where('year.flag', 1)
            ->get();

        $status = DB::table('employee')
            ->join('access_result', 'employee.id_employee', '=', 'access_result.Employee_id_employee')
            ->join('indicator_result', 'access_result.indicator_result_indicator_result_ID', '=', 'indicator_result.indicator_result_ID')
            ->join('result', 'indicator_result.indicator_result_ID', '=', 'result.indicator_result_indicator_result_ID')
            ->join('unit', 'indicator_result.unit', '=', 'unit.id_unit')
            ->join('year', 'indicator_result.year_year_id', '=', 'year.year_id')
            ->where('result.mount', '=', $mount)
            ->where('year.flag', '=',  1)
            ->where('result.status', '=',  0)
            ->get();
        return view('sec3.sec3confirm', compact('ob', 'mount', 'status', 'years'));
    }

    public function lockIndicator(Request $request)
    {
        $ob = DB::table('result')
            ->join('year', 'result.year_year_id', '=', 'year.year_id')
            ->where('mount', $request->lockmount)
            ->where('year.flag', 1)
            ->get();
        $blank = 0;
        for ($i = 0; $i < count($ob); $i++) {
            $result = $ob[$i]->result;
            $performance_result = $ob[$i]->performance_result;
            if ($result == NULL || $performance_result == NULL) {
                $blank += 1;
            }
        }
        if ($blank == 0) {
            DB::table('result')
                ->join('year', 'result.year_year_id', '=', 'year.year_id')
                ->where('mount', $request->lockmount)
                ->where('year.flag', 1)
                ->update(['status' => 1]);
            // return redirect()->back()->with('sucess', 'บันทึกข้อมูลเรียบร้อย');
            return redirect()->route('sec3confirm');
        } else {
            session()->flash('message', 'Cannot be Confirm');
            return redirect()->route('sec3confirm')->with('alert', 'ไม่สามารถยืนยันข้อมูลได้');
        }
    }

    public function unlockIndicator(Request $request)
    {

        DB::table('result')
            ->join('year', 'result.year_year_id', '=', 'year.year_id')
            ->where('mount', $request->lockmount)
            ->where('year.flag', 1)
            ->update(['status' => 0]);
        // return redirect()->back()->with('sucess', 'บันทึกข้อมูลเรียบร้อย');
        return redirect()->route('sec3confirm');
    }
}
