<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Environment\Console;

class Sec3Search extends Controller
{
    public function index()
    {
        $mount = (int)date('m');
        $yearselect = DB::table('year')->get();
        $yearnow = DB::table('year')->select('year')->where('year.flag', 1)->get();
        $year =  $yearnow[0]->year;
        $ob = DB::table('employee')
            ->join('access_result', 'employee.id_employee', '=', 'access_result.Employee_id_employee')
            ->join('indicator_result', 'access_result.indicator_result_indicator_result_ID', '=', 'indicator_result.indicator_result_ID')
            ->join('result', 'indicator_result.indicator_result_ID', '=', 'result.indicator_result_indicator_result_ID')
            ->join('unit', 'indicator_result.unit', '=', 'unit.id_unit')
            ->join('year', 'indicator_result.year_year_id', '=', 'year.year_id')
            ->where('year.flag', 1)
            ->where('result.mount', '=', $mount)
            ->get();
        return view('sec3.sec3search', compact('ob', 'mount', 'year', 'yearselect'));
    }
    public function resultShowMount(Request $request)
    {
        $mount = $request->mount;
        $year = $request->year;
        $yearselect = DB::table('year')->get();
        $ob = DB::table('employee')
            ->join('access_result', 'employee.id_employee', '=', 'access_result.Employee_id_employee')
            ->join('indicator_result', 'access_result.indicator_result_indicator_result_ID', '=', 'indicator_result.indicator_result_ID')
            ->join('result', 'indicator_result.indicator_result_ID', '=', 'result.indicator_result_indicator_result_ID')
            ->join('unit', 'indicator_result.unit', '=', 'unit.id_unit')
            ->join('year', 'indicator_result.year_year_id', '=', 'year.year_id')
            ->where('year.year', $year)
            ->where('result.mount', '=', $mount)
            ->get();
        return view('sec3.sec3search', compact('ob', 'mount', 'year', 'yearselect'));
    }
    public function download(Request $request)
    {
        $year = $request->year;
        $mount = $request->mount;
        $ob = DB::table('employee')
            ->join('access_result', 'employee.id_employee', '=', 'access_result.Employee_id_employee')
            ->join('indicator_result', 'access_result.indicator_result_indicator_result_ID', '=', 'indicator_result.indicator_result_ID')
            ->join('result', 'indicator_result.indicator_result_ID', '=', 'result.indicator_result_indicator_result_ID')
            ->join('unit', 'indicator_result.unit', '=', 'unit.id_unit')
            ->join('year', 'indicator_result.year_year_id', '=', 'year.year_id')
            ->where('year.year', $year)
            ->where('result.mount', '=', $mount)
            ->get();

        if (count($ob) > 0) {
            $months_th = array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
            $headers = array(
                "Content-type"        => "text/csv",
                "Content-Disposition" => "attachment; filename=รายงาน_" . $months_th[$mount - 1] . "_" . $ob[0]->year . ".csv",
                "Pragma"              => "no-cache",
                "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                "Expires"             => "0"
            );
            $columns = array('ตัวชี้วัด', 'หน่วยนับ', 'ผู้รับผิดชอบ', 'แผน', 'ผล', 'ผลการดำเนินงาน', 'เดือน', 'ปีงบประมาณ');
            $callback = function () use ($ob, $columns, $months_th, $mount) {
                $file = fopen("php://output", "w");
                fputs($file, $bom = chr(0xEF) . chr(0xBB) . chr(0xBF));

                fputcsv($file, $columns);
                foreach ($ob as $task) {
                    $row['indicator_result_name']  = $task->indicator_result_name;
                    $row['unit_name']    = $task->unit_name;
                    $row['name_employee']  = $task->name_employee;
                    $row['plan']    = $task->plan;
                    $row['result']  = $task->result;
                    $row['performance_result']  = $task->performance_result;
                    $row['monthName']  = $months_th[$mount - 1];
                    $row['year']  = $task->year;
                    fputcsv($file, array($row['indicator_result_name'], $row['unit_name'], $row['name_employee'], $row['plan'], $row['result'], $row['performance_result'], $row['monthName'], $row['year']));
                }
                fclose($file);
            };
            return response()->stream($callback, 200, $headers);
        } else {
            return redirect("/sec3search")->with('alert', 'ไม่มีข้อมูล');
        }
    }
}
