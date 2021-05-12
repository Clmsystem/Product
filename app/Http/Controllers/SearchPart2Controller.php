<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers;
use Illuminate\Support\Facades\DB;



class SearchPart2Controller extends Controller
{
  public function index()
  {

    $year = (int)date('Y') + 543;
    $month = (int)date('m');

    $showindicator = DB::table('employee')
      ->join('assign', 'employee.id_employee', '=', 'assign.Employee_id_employee')
      ->join('indicator', 'assign.indicator_id', '=', 'indicator.indicator_id')
      ->leftJoin('indicator_year', 'indicator.indicator_id', '=', 'indicator_year.indicator_id')
      ->leftJoin('indicator_month', 'indicator.indicator_id', '=', 'indicator_month.indicator_id')
      ->join('year', 'indicator.year_id', '=', 'year.year_id')
      ->where('year.year', '=', $year)
      ->where('indicator_month.month', '=', $month)
      ->get();

    $showyear = DB::table('employee')
      ->join('assign', 'employee.id_employee', '=', 'assign.Employee_id_employee')
      ->join('indicator', 'assign.indicator_id', '=', 'indicator.indicator_id')
      ->leftJoin('indicator_year', 'indicator.indicator_id', '=', 'indicator_year.indicator_id')
      ->join('year', 'indicator_year.year_id', '=', 'year.year_id')
      ->where('year.year', '=', $year)
      ->get();

    $years = DB::table('year')
      ->get();


    return view('searchPart2', compact('showindicator', 'month', 'year', 'showyear', 'years'));
  }
  public function search(Request $request)
  {
    $month = $request->month;
    $year = $request->year;
    if (isset($_POST['search'])) {
      $years = DB::table('year')
        ->get();

      $showindicator = DB::table('employee')
        ->join('assign', 'employee.id_employee', '=', 'assign.Employee_id_employee')
        ->join('indicator', 'assign.indicator_id', '=', 'indicator.indicator_id')
        ->leftJoin('indicator_year', 'indicator.indicator_id', '=', 'indicator_year.indicator_id')
        ->leftJoin('indicator_month', 'indicator.indicator_id', '=', 'indicator_month.indicator_id')
        ->join('year', 'indicator.year_id', '=', 'year.year_id')
        ->where('indicator_month.year_id', '=', $year)
        ->where('indicator_month.month', '=', $month)
        ->get();

      $showyear = DB::table('employee')
        ->join('assign', 'employee.id_employee', '=', 'assign.Employee_id_employee')
        ->join('indicator', 'assign.indicator_id', '=', 'indicator.indicator_id')
        ->leftJoin('indicator_year', 'indicator.indicator_id', '=', 'indicator_year.indicator_id')
        ->join('year', 'indicator_year.year_id', '=', 'year.year_id')
        ->where('indicator_year.year_id', '=', $year)
        ->get();

      return view('searchPart2', compact('showindicator', 'month', 'year', 'showyear', 'years'));
    } elseif (isset($_POST['download'])) {

      $showindicator = DB::table('employee')
        ->join('assign', 'employee.id_employee', '=', 'assign.Employee_id_employee')
        ->join('indicator', 'assign.indicator_id', '=', 'indicator.indicator_id')
        ->leftJoin('indicator_year', 'indicator.indicator_id', '=', 'indicator_year.indicator_id')
        ->leftJoin('indicator_month', 'indicator.indicator_id', '=', 'indicator_month.indicator_id')
        ->join('year', 'indicator.year_id', '=', 'year.year_id')
        ->where('indicator_month.year_id', '=', $year)
        ->where('indicator_month.month', '=', $month)
        ->get();

      if (count($showindicator) > 0) {
        $headers = array(
          "Content-type"        => "text/csv",
          "Content-Disposition" => "attachment; filename=รายงาน_.csv",
          "Pragma"              => "no-cache",
          "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
          "Expires"             => "0"
        );
        $columns = array('ตัวชี้วัดตามเกณฑ์การประเมินหน่วยงาน จาก ทมอ.','ผู้รับผิดชอบ','คะแนนเต็ม','ผล','ร้อยละผลสำเร็จ','คะแนนที่ได้เทียบกับคะแนนเต็ม ');
        $callback = function () use ($showindicator, $columns) {
          $file = fopen("php://output", "w");
          fputs($file, $bom = chr(0xEF) . chr(0xBB) . chr(0xBF));

          fputcsv($file, $columns);
          foreach ($showindicator as $task) {
            $row['indicator_name']  = $task->indicator_name;
            $row['name_employee']    = $task->name_employee;
            $row['full_score']  = $task->full_score;
            $row['result']  = $task->result;
            $row['percent']  = $task->percent;
            $row['score']  = $task->score;
            fputcsv($file, array($row['indicator_name'], $row['name_employee'], $row['full_score'], $row['result'], $row['percent'], $row['score']));
          }
          fclose($file);
        };
        return response()->stream($callback, 200, $headers);
      } else {
        return redirect("/searchPart2")->with('alert', 'ไม่มีข้อมูล');
      }
    }
    else {
      $showyear = DB::table('employee')
        ->join('assign', 'employee.id_employee', '=', 'assign.Employee_id_employee')
        ->join('indicator', 'assign.indicator_id', '=', 'indicator.indicator_id')
        ->leftJoin('indicator_year', 'indicator.indicator_id', '=', 'indicator_year.indicator_id')
        ->join('year', 'indicator_year.year_id', '=', 'year.year_id')
        ->where('indicator_year.year_id', '=', $year)
        ->get();


      if (count($showyear) > 0) {
        $headers = array(
          "Content-type"        => "text/csv",
          "Content-Disposition" => "attachment; filename=รายงานตัวชี้วัดตามเกณฑ์การประเมินหน่วยงาน จาก ทมอ.(รายปี).csv",
          "Pragma"              => "no-cache",
          "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
          "Expires"             => "0"
        );
        $columns = array('ตัวชี้วัดตามเกณฑ์การประเมินหน่วยงาน จาก ทมอ.','ผู้รับผิดชอบ','คะแนนเต็ม','ผล','ร้อยละผลสำเร็จ','คะแนนที่ได้เทียบกับคะแนนเต็ม');
        $callback = function () use ($showyear, $columns) {
          $file = fopen("php://output", "w");
          fputs($file, $bom = chr(0xEF) . chr(0xBB) . chr(0xBF));

          fputcsv($file, $columns);
          foreach ($showyear as $task) {
            $row['indicator_name']  = $task->indicator_name;
            $row['name_employee']    = $task->name_employee;
            $row['full_score']  = $task->full_score;
            $row['result']  = $task->result;
            $row['percent']  = $task->percent;
            $row['score']  = $task->score;
            fputcsv($file, array($row['indicator_name'], $row['name_employee'], $row['full_score'], $row['result'], $row['percent'], $row['score']));
          }
          fclose($file);
        };
        return response()->stream($callback, 200, $headers);
      } else {
        return redirect("/searchPart2")->with('alert', 'ไม่มีข้อมูล');
      }
    }
  }
}

//   public function search2(Request $request)
//   {
//     $month = $request->month;
//     $year = $request->year;
//     if (isset($_POST['search2'])) {
//       $years = DB::table('year')
//         ->get();

//       $showindicator = DB::table('employee')
//         ->join('assign', 'employee.id_employee', '=', 'assign.Employee_id_employee')
//         ->join('indicator', 'assign.indicator_id', '=', 'indicator.indicator_id')
//         ->leftJoin('indicator_year', 'indicator.indicator_id', '=', 'indicator_year.indicator_id')
//         ->leftJoin('indicator_month', 'indicator.indicator_id', '=', 'indicator_month.indicator_id')
//         ->join('year', 'indicator.year_id', '=', 'year.year_id')
//         ->where('indicator_month.year_id', '=', $year)
//         ->where('indicator_month.month', '=', $month)
//         ->get();

//       $showyear = DB::table('employee')
//         ->join('assign', 'employee.id_employee', '=', 'assign.Employee_id_employee')
//         ->join('indicator', 'assign.indicator_id', '=', 'indicator.indicator_id')
//         ->leftJoin('indicator_year', 'indicator.indicator_id', '=', 'indicator_year.indicator_id')
//         ->join('year', 'indicator_year.year_id', '=', 'year.year_id')
//         ->where('indicator_year.year_id', '=', $year)
//         ->get();

//       return view('searchPart2', compact('showyear', 'month', 'year', 'showyear', 'years'));
//     } else {

//       $showyear = DB::table('employee')
//         ->join('assign', 'employee.id_employee', '=', 'assign.Employee_id_employee')
//         ->join('indicator', 'assign.indicator_id', '=', 'indicator.indicator_id')
//         ->leftJoin('indicator_year', 'indicator.indicator_id', '=', 'indicator_year.indicator_id')
//         ->join('year', 'indicator_year.year_id', '=', 'year.year_id')
//         ->where('indicator_year.year_id', '=', $year)
//         ->get();


//       if (count($showyear) > 0) {
//         $headers = array(
//           "Content-type"        => "text/csv",
//           "Content-Disposition" => "attachment; filename=รายงานตัวชี้วัดตามเกณฑ์การประเมินหน่วยงาน จาก ทมอ.(รายปี).csv",
//           "Pragma"              => "no-cache",
//           "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
//           "Expires"             => "0"
//         );
//         $columns = array('ตัวชี้วัดตามเกณฑ์การประเมินหน่วยงาน จาก ทมอ.','ผู้รับผิดชอบ','คะแนนเต็ม','ผล','ร้อยละผลสำเร็จ','คะแนนที่ได้เทียบกับคะแนนเต็ม');
//         $callback = function () use ($showyear, $columns) {
//           $file = fopen("php://output", "w");
//           fputs($file, $bom = chr(0xEF) . chr(0xBB) . chr(0xBF));

//           fputcsv($file, $columns);
//           foreach ($showyear as $task) {
//             $row['indicator_name']  = $task->indicator_name;
//             $row['name_employee']    = $task->name_employee;
//             $row['full_score']  = $task->full_score;
//             $row['result']  = $task->result;
//             $row['percent']  = $task->percent;
//             $row['score']  = $task->score;
//             fputcsv($file, array($row['indicator_name'], $row['name_employee'], $row['full_score'], $row['result'], $row['percent'], $row['score']));
//           }
//           fclose($file);
//         };
//         return response()->stream($callback, 200, $headers);
//       } else {
//         return redirect("/searchPart2")->with('alert', 'ไม่มีข้อมูล');
//       }
//     }
    
//   }
// }
