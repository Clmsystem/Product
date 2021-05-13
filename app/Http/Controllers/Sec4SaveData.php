<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class Sec4SaveData extends Controller
{
    public function index()
    {
        $idUser = session()->get('user')['id_employee'];
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
            ->where('access_stratetegic.Employee_id_employee', '=', $idUser)
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
        return view('sec4.savedata', compact('ob', 'mount', 'status', 'years'));
    }
    public function resultShowMount(Request $request)
    {
        $idUser = session()->get('user')['id_employee'];
        $year = DB::table('year')->where('flag', 1)->get();
        $years = $year[0]->year;
        $mount = $request->mount;
        $ob = DB::table('employee')
            ->join('access_stratetegic', 'employee.id_employee', '=', 'access_stratetegic.Employee_id_employee')
            ->join('indicator_stratetegic', 'access_stratetegic.indicator_stratetegic_indicator_stratetegic_id', '=', 'indicator_stratetegic.indicator_stratetegic_ID')
            ->join('stratetegic', 'indicator_stratetegic.indicator_stratetegic_ID', '=', 'stratetegic.indicator_stratetegic_indicator_stratetegic_id')
            ->join('year', 'indicator_stratetegic.year_year_id', '=', 'year.year_id')
            ->where('year.flag', 1)
            ->where('stratetegic.mount', '=', $mount)
            ->where('access_stratetegic.Employee_id_employee', '=', $idUser)
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
        return view('sec4.savedata', compact('ob', 'mount', 'status', 'years'));
    }

    public function updateData(Request $request)
    {
        $mount = $request->mount;
        DB::table('stratetegic')
            ->where('stratetegic_ID', $request->id)
            ->update([
                'result' => $request->result,
                'percent' => $request->percent,
                'job' => $request->job,
            ]);
        // return redirect()->back()->with('sucess', 'บันทึกข้อมูลเรียบร้อย');
        return redirect()->route('sec4savedata')->with('mount', $mount);
    }
}
