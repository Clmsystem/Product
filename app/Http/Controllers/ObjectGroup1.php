<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ObjectGroup1 extends Controller
{
    public function index()
    {
        $allyear = DB::table('year')->get();
        $currentyear = DB::table('year')->max('year');
        $currentyearid = DB::table('year')->max('year_id');
        $flag = DB::table('year')->where('year_id', $currentyearid)->value('flag');
        $ob = DB::table('year')
            ->join('object', 'year.year_id', '=', 'object.year_year_id')
            ->where('year', '=', $currentyear)->get();
        $obkr = DB::table('kr')->get();
        $max = DB::table('kr')->max('idKR');
        return view('section_one.content', compact('ob', 'obkr', 'max', 'currentyearid', 'allyear', 'currentyear', 'flag'));
    }
    public function addObject(Request $request)
    {
        $id = DB::table('object')->max('idobject');

        $data = array();
        $data["nameObject"] = $request->keyobject;
        $data["status"] = 1;
        $data["year_year_id"] = $request->yearobject;
        $data["idobject"] = $id + 1;

        DB::table('object')->insert($data);
        return redirect()->back()->with('sucess', 'บันทึกข้อมูลเรียบร้อย');
    }
    public function deleteObject(Request $request)
    {
        DB::table('object')->where('idobject', '=', $request->delete_keyobject)->where('year_year_id', '=', $request->year_object)->delete();
        return redirect()->back()->with('sucess', 'ลบข้อมูลเรียบร้อย');
    }
    public function editObject(Request $request)
    {
        DB::table('object')->where('idobject', $request->keyobject)->where('year_year_id', $request->yearobject)->update(['nameObject' => $request->nameobject]);
        return redirect()->back()->with('sucess', 'แก้ไขข้อมูลเรียบร้อย');
    }
    public function year($year)
    {
        $allyear = DB::table('year')->get();
        $currentyear = $year;
        $currentyearid = DB::table('year')->where('year', $currentyear)->value('year_id');
        $ob = DB::table('year')
            ->join('object', 'year.year_id', '=', 'object.year_year_id')
            ->where('year', '=', $currentyear)->get();
        $obkr = DB::table('kr')->get();
        $max = DB::table('kr')->max('idKR');
        $flag = DB::table('year')->where('year_id', $currentyearid)->value('flag');
        $data = Session::put('year_group1', $currentyearid);
        return view('section_one.content', compact('ob', 'obkr', 'max', 'currentyearid', 'allyear', 'currentyear', 'flag'));
    }
}
