<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Sec4Confirm extends Controller
{
    public function index()
    {
        $mount = (int)date('m');
        $year = DB::table('year')->where('flag', 1)->get();
        $years = $year[0]->year;
        $ob = DB::table('employee')
            ->join('access_stratetegic', 'employee.id_employee', '=', 'access_stratetegic.Employee_id_employee')
            ->join('indicator_stratetegic', 'access_stratetegic.indicator_stratetegic_indicator_stratetegic_id', '=', 'indicator_stratetegic.indicator_stratetegic_ID')
            ->join('stratetegic', 'indicator_stratetegic.indicator_stratetegic_ID', '=', 'stratetegic.indicator_stratetegic_indicator_stratetegic_id')
            ->join('year', 'indicator_stratetegic.year_year_id', '=', 'year.year_id')
            ->where('year.flag', 1)
            ->where('stratetegic.mount', '=', $mount)

            ->get();

        $status = DB::table('employee')
            ->join('access_stratetegic', 'employee.id_employee', '=', 'access_stratetegic.Employee_id_employee')
            ->join('indicator_stratetegic', 'access_stratetegic.indicator_stratetegic_indicator_stratetegic_id', '=', 'indicator_stratetegic.indicator_stratetegic_ID')
            ->join('stratetegic', 'indicator_stratetegic.indicator_stratetegic_ID', '=', 'stratetegic.indicator_stratetegic_indicator_stratetegic_id')
            ->join('year', 'indicator_stratetegic.year_year_id', '=', 'year.year_id')
            ->where('year.flag', 1)
            ->where('stratetegic.mount', '=', $mount)
            ->where('stratetegic.status', '=',  0)
            ->get();
        return view('sec4.sec4confirm', compact('ob', 'mount', 'status', 'years'));
    }

    public function resultShowMount(Request $request)
    {
        $mount = $request->mount;
        $year = DB::table('year')->where('flag', 1)->get();
        $years = $year[0]->year;
        $ob = DB::table('employee')
            ->join('access_stratetegic', 'employee.id_employee', '=', 'access_stratetegic.Employee_id_employee')
            ->join('indicator_stratetegic', 'access_stratetegic.indicator_stratetegic_indicator_stratetegic_id', '=', 'indicator_stratetegic.indicator_stratetegic_ID')
            ->join('stratetegic', 'indicator_stratetegic.indicator_stratetegic_ID', '=', 'stratetegic.indicator_stratetegic_indicator_stratetegic_id')
            ->join('year', 'indicator_stratetegic.year_year_id', '=', 'year.year_id')
            ->where('year.flag', 1)
            ->where('stratetegic.mount', '=', $mount)
            ->get();

        $status = DB::table('employee')
            ->join('access_stratetegic', 'employee.id_employee', '=', 'access_stratetegic.Employee_id_employee')
            ->join('indicator_stratetegic', 'access_stratetegic.indicator_stratetegic_indicator_stratetegic_id', '=', 'indicator_stratetegic.indicator_stratetegic_ID')
            ->join('stratetegic', 'indicator_stratetegic.indicator_stratetegic_ID', '=', 'stratetegic.indicator_stratetegic_indicator_stratetegic_id')
            ->join('year', 'indicator_stratetegic.year_year_id', '=', 'year.year_id')
            ->where('year.flag', 1)
            ->where('stratetegic.mount', '=', $mount)
            ->where('stratetegic.status', '=',  0)
            ->get();
        return view('sec4.sec4confirm', compact('ob', 'mount', 'status', 'years'));
    }

    public function lockIndicator(Request $request)
    {
        $ob = DB::table('stratetegic')
            ->join('year', 'stratetegic.year_year_id', '=', 'year.year_id')
            ->where('mount', $request->lockmount)
            ->where('year.flag', 1)
            ->get();
        $blank = 0;
        for ($i = 0; $i < count($ob); $i++) {
            $result = $ob[$i]->result;
            $percent = $ob[$i]->percent;
            $job = $ob[$i]->job;
            if ($result == NULL || $percent == NULL || $job == NULL) {
                $blank += 1;
            }
        }
        if ($blank == 0) {
            DB::table('stratetegic')
                ->join('year', 'stratetegic.year_year_id', '=', 'year.year_id')
                ->where('mount', $request->lockmount)
                ->where('year.flag', 1)
                ->update(['status' => 1]);
            // return redirect()->back()->with('sucess', 'บันทึกข้อมูลเรียบร้อย');
            return redirect()->route('sec4confirm');
        } else {
            session()->flash('message', 'Cannot be Confirm');
            return redirect()->route('sec4confirm')->with('alert', 'ไม่สามารถยืนยันข้อมูลได้');
        }
    }

    public function unlockIndicator(Request $request)
    {

        DB::table('stratetegic')
            ->join('year', 'stratetegic.year_year_id', '=', 'year.year_id')
            ->where('mount', $request->lockmount)
            ->where('year.flag', 1)
            ->update(['status' => 0]);
        // return redirect()->back()->with('sucess', 'บันทึกข้อมูลเรียบร้อย');
        return redirect()->route('sec4confirm');
    }
}
