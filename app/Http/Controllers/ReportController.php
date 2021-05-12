<?php

namespace App\Http\Controllers;

use App\File;
use Illuminate\Http\Request;
use App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isEmpty;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $currentYear = DB::table('year')
        ->where('flag', 1)
        ->select('year_id')
        ->get();

        $currentYearShow = DB::table('year')
            ->where('flag', 1)
            ->select('year')
            ->get();

        $currentYearShow = $currentYearShow[0]->year;

        $currentYear = $currentYear[0]->year_id;


        if ($request->mountSelect) {
            $months = $request->mountSelect;
        } else if (session()->get('mountSelect')) {
            $months = session()->get('mountSelect');
        } else {
            $months = Carbon::now()->month;
        }

        $list_item = DB::table('list_item')
            ->join('unit', 'list_item.unit_id_unit', '=', 'unit.id_unit')
            ->select('list_item.id_item', 'list_item.name_item', 'unit.unit_name')
            ->get();

        $search = [];
        $year = DB::table('year')
            ->get();

        $years = 0;
        // $months = 0;
        return view('Report', compact('list_item', 'year', 'years','currentYear', 'search', 'months'));
        // return view('Report', compact('year'));
    }

    public function sea(Request $request)
    {
        $years = $request->year;
        $quater = $request->quater;
        $months = $request->month;
        $currentYear = DB::table('year')
        ->where('flag', 1)
        ->select('year_id')
        ->get();
        // Start Search 
        if (isset($_POST["btn_search"])) {
            $year = DB::table('year')
                ->get();
            if ($years == 0) {
                $search = [];
                $list_item = [];
                return view('Report', compact('list_item', 'year', 'search'));
            } else {
                if ($months == 0) {
                    $search = DB::table('transaction')
                        ->join('priority', 'transaction.id_item', '=', 'priority.id_item')
                        ->join('employee', 'priority.id_employee', '=', 'employee.id_employee')
                        ->join('list_item', 'transaction.id_item', '=', 'list_item.id_item')
                        ->join('unit', 'list_item.unit_id_unit', '=', 'unit.id_unit')
                        ->where('transaction.year_year_id', '=', $years)
                        ->groupBy('transaction.id_item')
                        ->select(DB::raw('list_item.id_item,name_item,sum(count) as count,unit_name,description,year_year_id'), DB::raw('GROUP_CONCAT(name_employee) as name_employee'))
                        ->get();
                } else {
                    $search = DB::table('transaction')
                        ->join('priority', 'transaction.id_item', '=', 'priority.id_item')
                        ->join('employee', 'priority.id_employee', '=', 'employee.id_employee')
                        ->join('list_item', 'transaction.id_item', '=', 'list_item.id_item')
                        ->join('unit', 'list_item.unit_id_unit', '=', 'unit.id_unit')
                        ->where('transaction.year_year_id', '=', $years)
                        ->where('transaction.month', '=', $months)
                        ->groupBy('transaction.id_item')
                        ->select(DB::raw('list_item.id_item,name_item,count,unit_name,description,year_year_id'), DB::raw('GROUP_CONCAT(name_employee) as name_employee'))
                        ->get();
                }
                $list_item = [];
                return view('Report', compact('list_item', 'year', 'years','currentYear', 'search', 'months'));
            }
        // End Search

        // Start Download
        } else {
            $tasks = DB::table('transaction')
                ->join('priority', 'transaction.id_item', '=', 'priority.id_item')
                ->join('year', 'year.year_id', '=', 'transaction.year_year_id')
                ->join('employee', 'priority.id_employee', '=', 'employee.id_employee')
                ->join('list_item', 'transaction.id_item', '=', 'list_item.id_item')
                ->join('unit', 'list_item.unit_id_unit', '=', 'unit.id_unit')
                ->where('transaction.year_year_id', '=', $years)
                ->where('transaction.month', '=', $months)
                ->groupBy('transaction.id_item')
                ->select(DB::raw('list_item.id_item,name_item,count,unit_name,description,year_year_id,year.year'),DB::raw('GROUP_CONCAT(name_employee) as name_employee'))
                ->get();

            if (count($tasks) > 0) {
                $months_th = array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
                $headers = array(
                    "Content-type"        => "text/csv",
                    "Content-Disposition" => "attachment; filename=รายงาน_" . $months_th[$months - 1] . "_" . $tasks[0]->year . ".csv",
                    "Pragma"              => "no-cache",
                    "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                    "Expires"             => "0"
                );
                $columns = array('ตัวชี้วัด', 'จำนวน', 'หน่วย', 'หมายเหตุ', 'ผู้รับผิดชอบ', 'เดือน', 'ปีงบประมาณ');
                $callback = function () use ($tasks, $columns, $months_th, $months) {
                    $file = fopen("php://output", "w");
                    fputs($file, $bom = chr(0xEF) . chr(0xBB) . chr(0xBF));

                    fputcsv($file, $columns);
                    foreach ($tasks as $task) {
                        $row['name_item']  = $task->name_item;
                        $row['count']    = $task->count;
                        $row['unit_name']    = $task->unit_name;
                        $row['description']  = $task->description;
                        $row['name_employee']  = $task->name_employee;
                        $row['monthName']  = $months_th[$months - 1];
                        $row['year']  = $task->year;
                        fputcsv($file, array($row['name_item'], $row['count'], $row['unit_name'], $row['description'], $row['name_employee'], $row['monthName'], $row['year']));
                    }
                    fclose($file);
                };
                return response()->stream($callback, 200, $headers);
            } else {
                return redirect("/report")->with('alert', 'ไม่มีข้อมูล');
            }
        }
        // End Download
    }
};
