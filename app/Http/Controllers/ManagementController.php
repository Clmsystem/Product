<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManagementController extends Controller
{
  public function index()
  {
    $currentYear = DB::table('year')
      ->get();

    $year = DB::table('year')
      ->select(DB::raw('*,MAX(year) as year'))
      ->get();

    $emp = DB::table('employee')
      ->join('position_list', 'position_list.id_position', '=', 'employee.id_position')
      ->join('department', 'department.id_department', '=', 'employee.id_department')
      ->join('status_code', 'status_code.id_status', '=', 'employee.status')
      ->orderBy('employee.status', 'desc')
      ->get();

    $years = 0;
    $yearSelected = $year[0]->year;
    return view('Management', compact('currentYear', 'yearSelected', 'year', 'years', 'emp'));
  }
  public function manageted(Request $request)
  {
    // echo "<pre>";
    // print_r($_POST);
    // echo "</br>";

    $mss = '';
    if (isset($_POST["btn_add"])) {
      $Addyear = $request->Addyear;
      $values = array('year' => $Addyear, 'flag' => 0);
      DB::table('year')->insert($values);
      $mss = 'เพิ่มปีงบประมาณ ' . $Addyear . ' เรียบร้อย';
    } else {
      $idyear = $request->Flagyear;
      $currentF = DB::table('year')
        ->where('flag', 1)
        ->get();


      DB::transaction(function () use ($currentF, $idyear) {
        DB::table('year')
          ->where('year_id', $currentF[0]->year_id)
          ->update(['flag' => 0]);

        DB::table('year')
          ->where('year_id', $idyear)
          ->update(['flag' => 1]);
      });
      $mss = 'เลือกปีงบประมาณเรียบร้อย';
    }

    return redirect('/management')->with('alert', $mss);
  }

  public function delete_row(Request $request)
  {
    DB::table('employee')
      ->where('id_employee', $request->del)
      ->delete();
  }

  public function update(Request $request)
  {
    DB::table('employee')
      ->where('id_employee', $request->id_employee)
      ->update(['name_employee' => $request->name_employee, 'id_position' => $request->id_position, 'id_department' => $request->id_department, 'password' => $request->password, 'status' => $request->status]);
    return redirect('/management')->with('alert', 'อัพเดทเรียบร้อยแล้ว');
  }
}
