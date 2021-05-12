<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\File;
use Illuminate\Support\Facades\Session;

class UserOKR extends Controller
{
    public function index($idUser)
    {
        $userObject = DB::table('object')
            ->join('kr', 'object.idobject', '=', 'kr.object_idobject')
            // ->leftJoin('krdetail', 'kr.idKR', '=', 'krdetail.KR_idKR')
            ->join('autrority', 'kr.idKR', '=', 'autrority.KR_idKR')
            ->where('autrority.Employee_id_employee', '=', $idUser)
            ->get();
        $uniqueObject = $userObject->groupBy("idobject");
        $mount = (int)date('m');
        return view('userGroup1.object', compact('userObject', 'mount', 'uniqueObject'));
    }
    public function userKR($Object, $mount)
    {
        $idUser = session()->get('user')['id_employee'];
        $userKR = DB::table('object')
            ->leftJoin('kr', 'object.idobject', '=', 'kr.object_idobject')
            ->leftJoin('krdetail', 'kr.idKR', '=', 'krdetail.KR_idKR')
            ->leftJoin('autrority', 'kr.idKR', '=', 'autrority.KR_idKR')
            ->where('autrority.Employee_id_employee', '=', $idUser)
            ->where('krdetail.KR_object_idobject', '=', $Object)
            ->where('krdetail.mount', '=', $mount)
            ->get();
        return view('userGroup1.kr', compact('userKR', 'mount', 'Object','idUser'));
    }
    public function updateKRdetail(Request $request)
    {
        $idUser = session()->get('user')['id_employee'];
        $name_emp = DB::table('employee')->where('id_employee', '=', $idUser)->value('name_employee');
        // if ($file = $request->file('file')) {
        //     $request->validate([
        //         'file' => 'required|file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip',
        //     ]);
        //     $name = $file->getClientOriginalName();
        //     $evidence = 'evidences/' . $request->id;
        //     $file->move($evidence, $name);
        // }
        date_default_timezone_set('Asia/Bangkok');
        DB::table('krdetail')
            ->where('idKRdetail', $request->id)
            ->update(['result' => $request->result, 'percent' => $request->percent, 'future_result' => $request->future_result, 'nameUser' => $name_emp, 'time' => date("Y-m-d")]);
        return redirect()->back()->with('sucess', 'บันทึกข้อมูลเรียบร้อย');
    }

    public function userKRdetail(Request $request)
    {
        $Object = $request->Object;
        $mount = $request->mount;
        Session::put('object', $Object);
        Session::put('mount', $mount);
        $idUser = session()->get('user')['id_employee'];
        $userKR = DB::table('object')
            ->leftJoin('kr', 'object.idobject', '=', 'kr.object_idobject')
            ->leftJoin('krdetail', 'kr.idKR', '=', 'krdetail.KR_idKR')
            ->leftJoin('autrority', 'kr.idKR', '=', 'autrority.KR_idKR')
            ->where('autrority.Employee_id_employee', '=', $idUser)
            ->where('krdetail.KR_object_idobject', '=', $Object)
            ->where('krdetail.mount', '=', $mount)
            ->get();
        return view('userGroup1.kr', compact('userKR', 'mount', 'Object'));
    }
    public function usermount()
    {
        $Object = Session::get('object');
        $mount = Session::get('mount');
        $idUser = session()->get('user')['id_employee'];
        $userKR = DB::table('object')
            ->leftJoin('kr', 'object.idobject', '=', 'kr.object_idobject')
            ->leftJoin('krdetail', 'kr.idKR', '=', 'krdetail.KR_idKR')
            ->leftJoin('autrority', 'kr.idKR', '=', 'autrority.KR_idKR')
            ->where('autrority.Employee_id_employee', '=', $idUser)
            ->where('krdetail.KR_object_idobject', '=', $Object)
            ->where('krdetail.mount', '=', $mount)
            ->get();
        return view('userGroup1.kr', compact('userKR', 'mount', 'Object'));
    }
    public function search()
    {
        $year = DB::table('year')->get();
        $search = DB::table('object')->where('year_year_id', '=', 0)->get();
        $yy = 0;
        $mm = 0;
        return view('reportGroup1.search', compact('year', 'search', 'yy', 'mm'));
    }
    public function searchyear(Request $request)
    {
        $year = DB::table('year')->get();
        $search = DB::table('object')
            ->leftJoin('kr', 'object.idobject', '=', 'kr.object_idobject')
            ->leftJoin('krdetail', 'kr.idKR', '=', 'krdetail.KR_idKR')
            ->leftJoin('autrority', 'kr.idKR', '=', 'autrority.KR_idKR')
            ->where('krdetail.year_year_id', '=', $request->year)
            ->where('krdetail.mount', '=', $request->month)
            ->get();
        // dd($search);
        Session::put('yeardownload', $request->year);
        Session::put('mountdownload', $request->month);
        $yy = Session::get('yeardownload');
        $mm = Session::get('mountdownload');
        return view('reportGroup1.search', compact('year', 'search', 'yy', 'mm'));
    }
    // public function searchKR($id)
    // {
    //     $mount = (int)date('m');
    //     $userKR = DB::table('object')
    //         ->leftJoin('kr', 'object.idobject', '=', 'kr.object_idobject')
    //         ->leftJoin('krdetail', 'kr.idKR', '=', 'krdetail.KR_idKR')
    //         ->leftJoin('autrority', 'kr.idKR', '=', 'autrority.KR_idKR')
    //         ->where('krdetail.KR_object_idobject', '=', $id)
    //         ->where('krdetail.mount', '=', $mount)
    //         ->get();
    //     $Object = $id;
    //     return view('reportGroup1.searchKR', compact('userKR', 'mount', 'Object'));
    // }
    // public function searchKRdetail(Request $request)
    // {

    //     $userKR = DB::table('object')
    //         ->leftJoin('kr', 'object.idobject', '=', 'kr.object_idobject')
    //         ->leftJoin('krdetail', 'kr.idKR', '=', 'krdetail.KR_idKR')
    //         ->leftJoin('autrority', 'kr.idKR', '=', 'autrority.KR_idKR')
    //         ->where('krdetail.KR_object_idobject', '=', $request->Object)
    //         ->where('krdetail.mount', '=', $request->mount)
    //         ->get();
    //     $Object = $request->object;
    //     $mount = $request->mount;
    //     return view('reportGroup1.searchKR', compact('userKR', 'mount', 'Object'));
    // }
    public function dashbord($id)
    {
        $dataKR = DB::table('krdetail')
            ->where('KR_idKR', '=', $id)
            ->select('percent', 'mount')
            ->get();

        return view('userGroup1.dashbord', compact('dataKR'));
    }
    public function downloadGroubOne()
    {

        $year = DB::table('year')->get();
        $Object = Session::get('yeardownload');
        $mount = Session::get('mountdownload');
        $yy = Session::get('yeardownload');
        $mm = Session::get('mountdownload');
        $search = DB::table('object')
            ->leftJoin('kr', 'object.idobject', '=', 'kr.object_idobject')
            ->leftJoin('krdetail', 'kr.idKR', '=', 'krdetail.KR_idKR')
            ->leftJoin('autrority', 'kr.idKR', '=', 'autrority.KR_idKR')
            ->where('krdetail.year_year_id', '=', $Object)
            ->where('krdetail.mount', '=', $mount)
            ->get();

        if (count($search) > 0) {
            $months_th = array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
            $headers = array(
                "Content-type"        => "text/csv",
                "Content-Disposition" => "attachment; filename=รายงาน_" . $months_th[$mount - 1] . ".csv",
                "Pragma"              => "no-cache",
                "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                "Expires"             => "0"
            );

            $callback = function () use ($year, $search, $yy, $mm) {
                $columns = array(
                    'ตัวชี้วัดตามคำรับรอง',
                    'เป้าหมายตามคำรับรอง',
                    'ผล',
                    'ร้อยละผลสำเร็จ',
                    'งานที่สำเร็จแล้ว/งานที่จะดำเนินการในอนาคต'
                );
                $file = fopen("php://output", "w");
                fputs($file, $bom = chr(0xEF) . chr(0xBB) . chr(0xBF));

                fputcsv($file, $columns);
                foreach ($search as $data) {
                    $row['name_item']  = $data->nameObject;
                    $row['count']    = $data->nameKR;
                    $row['unit_name']    = $data->result;
                    $row['description']  = $data->percent;
                    $row['name_employee']  = $data->future_result;

                    fputcsv($file, array($row['name_item'], $row['count'], $row['unit_name'], $row['description'], $row['name_employee']));
                }
                fclose($file);
            };
            return response()->stream($callback, 200, $headers);
        } else {
        }
    }
}
