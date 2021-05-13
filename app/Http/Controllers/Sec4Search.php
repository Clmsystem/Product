<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class Sec4Search extends Controller
{
    public function index()
    {
        $mount = (int)date('m');
        $yearselect = DB::table('year')->get();
        $yearnow = DB::table('year')->select('year')->where('year.flag', 1)->get();
        $year = $yearnow[0]->year;
        $ob = DB::table('employee')
            ->join('access_stratetegic', 'employee.id_employee', '=', 'access_stratetegic.Employee_id_employee')
            ->join('indicator_stratetegic', 'access_stratetegic.indicator_stratetegic_indicator_stratetegic_id', '=', 'indicator_stratetegic.indicator_stratetegic_ID')
            ->join('stratetegic', 'indicator_stratetegic.indicator_stratetegic_ID', '=', 'stratetegic.indicator_stratetegic_indicator_stratetegic_id')
            ->join('year', 'indicator_stratetegic.year_year_id', '=', 'year.year_id')
            ->where('year.flag', 1)
            ->where('stratetegic.mount', '=', $mount)

            ->get();
        return view('sec4.sec4search', compact('ob', 'mount', 'year', 'yearselect'));
    }
    public function resultShowMount(Request $request)
    {
        $mount = $request->mount;
        $year = $request->year;
        $yearselect = DB::table('year')->get();
        $ob = DB::table('employee')
            ->join('access_stratetegic', 'employee.id_employee', '=', 'access_stratetegic.Employee_id_employee')
            ->join('indicator_stratetegic', 'access_stratetegic.indicator_stratetegic_indicator_stratetegic_id', '=', 'indicator_stratetegic.indicator_stratetegic_ID')
            ->join('stratetegic', 'indicator_stratetegic.indicator_stratetegic_ID', '=', 'stratetegic.indicator_stratetegic_indicator_stratetegic_id')
            ->join('year', 'indicator_stratetegic.year_year_id', '=', 'year.year_id')
            ->where('stratetegic.mount', '=', $mount)
            ->where('year.year', '=', $year)
            ->get();
        return view('sec4.sec4search', compact('ob', 'mount',  'year', 'yearselect'));
    }

    public function download(Request $request)
    {
        $year = $request->year;
        $mount = $request->mount;
        $ob = DB::table('employee')
            ->join('access_stratetegic', 'employee.id_employee', '=', 'access_stratetegic.Employee_id_employee')
            ->join('indicator_stratetegic', 'access_stratetegic.indicator_stratetegic_indicator_stratetegic_id', '=', 'indicator_stratetegic.indicator_stratetegic_ID')
            ->join('stratetegic', 'indicator_stratetegic.indicator_stratetegic_ID', '=', 'stratetegic.indicator_stratetegic_indicator_stratetegic_id')
            ->join('year', 'indicator_stratetegic.year_year_id', '=', 'year.year_id')
            ->where('stratetegic.mount', '=', $mount)
            ->where('year.year', '=', $year)
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
            $columns = array('ตัวชี้วัดตามคำรับรอง', 'เป้าหมายตามคำรับรอง', 'ผู้รับผิดชอบ', 'ผล', 'ร้อยละผลสำเร็จ', 'งานที่สำเร็จแล้ว/งานที่จะดำเนินการในอนาคต', 'เดือน', 'ปีงบประมาณ');
            $callback = function () use ($ob, $columns, $months_th, $mount) {
                $file = fopen("php://output", "w");
                fputs($file, $bom = chr(0xEF) . chr(0xBB) . chr(0xBF));

                fputcsv($file, $columns);
                foreach ($ob as $task) {
                    $row['indicator_stratetegic_name']  = $task->indicator_stratetegic_name;
                    $row['goal']    = $task->goal;
                    $row['name_employee']  = $task->name_employee;
                    $row['result']    = $task->result;
                    $row['percent']  = $task->percent;
                    $row['job']  = $task->job;
                    $row['monthName']  = $months_th[$mount - 1];
                    $row['year']  = $task->year;
                    fputcsv($file, array($row['indicator_stratetegic_name'], $row['goal'], $row['name_employee'], $row['result'], $row['percent'], $row['job'], $row['monthName'], $row['year']));
                }
                fclose($file);
            };
            return response()->stream($callback, 200, $headers);
        } else {
            return redirect("/sec4search")->with('alert', 'ไม่มีข้อมูล');
        }
    }
}
