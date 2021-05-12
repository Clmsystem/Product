<?php

namespace App\Http\Controllers;

use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Kr extends Controller
{
    public function index($year, $id)
    {
        $data = Session::put('id', $id);
        $kr = DB::table('kr')
            ->join('krdetail', 'kr.idKR', 'krdetail.KR_idKR')
            ->select('kr.nameKR', 'krdetail.*')->where('kr.object_idobject', '=', $id)->where('krdetail.mount', 1)->paginate(5);
        $objectName = DB::table('object')
            ->select('nameObject')->where('idobject', '=', $id)->get();
        $employee = DB::table('employee')->get();
        $autrority = DB::table('autrority')->get();
        $max = DB::table('autrority')->max('idautrority');
        $flag = DB::table('year')->where('year', $year)->value('flag');
        // dd($autrority, $max);
        return view('section_one.objective', compact('kr', 'employee', 'autrority', 'max', 'objectName', 'flag'));
    }
    public function addKR(Request $request)
    {
        // insert kr id คือ ob id
        $id = Session::get('id');
        $data = array();
        $data["status"] = 1;
        $data["nameKR"] = $request->keyobject;
        $data["object_idobject"] = $id;
        DB::table('kr')->insert($data);

        // ค่า kr ตัวล่าสุด
        $max = DB::table('kr')->max('idKR');
        $yearid = Session::get('year_group1');
        // insert kr detail 12 เดือน
        for ($i = 1; $i <= 12; $i++) {
            $data2 = array();
            $data2["mount"] = $i;
            $data2["year_year_id"] = $yearid;
            $data2["KR_idKR"] = $max;
            $data2["KR_object_idobject"] = $id;
            DB::table('krdetail')->insert($data2);
        }
        return redirect()->back()->with('sucess', 'บันทึกข้อมูลเรียบร้อย');
    }
    public function updateKR(Request $request)
    {
        DB::table('kr')
            ->where('idKR', $request->id)
            ->update(['nameKR' => $request->result]);
        if (!empty($request->employee)) {
            DB::table('autrority')
                ->where('KR_idKR', $request->id)
                ->delete();
            foreach ($request->employee as $emp) {
                $data = array();
                $max = DB::table('autrority')->max('idautrority');
                $data["idautrority"] = intval($max + 1);
                $data["KR_idKR"] = intval($request->id);
                $data["Employee_id_employee"] = intval($emp);
                $data["Employee_id_position"] = 0;
                $data["Employee_id_department"] = 0;
                DB::table('autrority')->insert($data);
            };
        } else {
            DB::table('autrority')
                ->where('KR_idKR', $request->id)
                ->delete();
        }

        return redirect()->back()->with('success', 'บันทึกข้อมูลเรียบร้อย');
    }
    public function deletekr(Request $request)
    {
        DB::table('autrority')->where('KR_idKR', '=', $request->delete_keyobject)->delete();
        DB::table('krdetail')->where('KR_idKR', '=', $request->delete_keyobject)->delete();
        DB::table('kr')->where('idKR', '=', $request->delete_keyobject)->delete();
        return redirect()->back()->with('sucess', 'ลบข้อมูลเรียบร้อย');
    }
    public function logKRdetail(Request $request)
    {
        DB::table('krdetail')
            ->where('year_year_id', $request->yearid)
            ->where('mount', $request->mountid)
            ->update(['status_data' => 1]);
        return redirect('/section_five');
    }
    public function UNlogKRdetail(Request $request)
    {
        DB::table('krdetail')
            ->where('year_year_id', $request->yearid)
            ->where('mount', $request->mountid)
            ->update(['status_data' => 0]);
        return redirect('/section_five');
    }
}
