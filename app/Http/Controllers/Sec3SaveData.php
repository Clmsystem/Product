<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Environment\Console;

class Sec3SaveData extends Controller
{
    public function index()
    {
        $idUser = session()->get('user')['id_employee'];
        $year = DB::table('year')->where('flag', 1)->get();
        $years = $year[0]->year;
        $mount = (int)date('m');
        $ob = DB::table('employee')
            ->join('access_result', 'employee.id_employee', '=', 'access_result.Employee_id_employee')
            ->join('indicator_result', 'access_result.indicator_result_indicator_result_ID', '=', 'indicator_result.indicator_result_ID')
            ->join('result', 'indicator_result.indicator_result_ID', '=', 'result.indicator_result_indicator_result_ID')
            ->join('unit', 'indicator_result.unit', '=', 'unit.id_unit')
            ->join('year', 'indicator_result.year_year_id', '=', 'year.year_id')
            ->where('access_result.Employee_id_employee', '=', $idUser)
            ->where('year.flag', 1)
            ->where('result.mount', '=', $mount)
            ->get();
        // dd($ob);
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
        return view('sec3.savedata', compact('ob', 'mount', 'status', 'years'));
    }
    public function resultShowMount(Request $request)
    {
        $idUser = session()->get('user')['id_employee'];
        $year = DB::table('year')->where('flag', 1)->get();
        $years = $year[0]->year;
        $mount = $request->mount;
        $ob = DB::table('employee')
            ->join('access_result', 'employee.id_employee', '=', 'access_result.Employee_id_employee')
            ->join('indicator_result', 'access_result.indicator_result_indicator_result_ID', '=', 'indicator_result.indicator_result_ID')
            ->join('result', 'indicator_result.indicator_result_ID', '=', 'result.indicator_result_indicator_result_ID')
            ->join('unit', 'indicator_result.unit', '=', 'unit.id_unit')
            ->join('year', 'indicator_result.year_year_id', '=', 'year.year_id')
            ->where('access_result.Employee_id_employee', '=', $idUser)
            ->where('year.flag', 1)
            ->where('result.mount', '=', $mount)
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
        return view('sec3.savedata', compact('ob', 'mount', 'status', 'years'));
    }

    public function updateData(Request $request)
    {
        $mount = $request->mount;
        DB::table('result')
            ->where('result_ID', $request->id)
            ->update([
                'result' => $request->result,
                'performance_result' => $request->performance,
            ]);

        return redirect()->route('sec3savedata')->with('mount', $mount);
    }
}
