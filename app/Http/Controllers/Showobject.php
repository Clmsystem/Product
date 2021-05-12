<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Showobject extends Controller
{
    public function show()
    {
        $year = DB::table('year')->get();
        $search = DB::table('object')->where('year_year_id', '=', 0)->get();
        $y =  0;
        $m = 0;
        $check = 0;
        return view('section_five.addAdmin', compact('year', 'search', 'y', 'm', 'check'));
    }
    public function showlog(Request $request)
    {
        $year = DB::table('year')->get();
        $y =  $request->year;
        $m = $request->month;
        $id = DB::table('krdetail')->where('year_year_id', $y)->where('mount', $m)->max('idKRdetail');
        $check = DB::table('krdetail')->where('year_year_id', $y)->where('mount', $m)->where('idKRdetail', $id)->value('status_data');
        $search = DB::table('object')
            ->leftJoin('kr', 'object.idobject', '=', 'kr.object_idobject')
            ->leftJoin('krdetail', 'kr.idKR', '=', 'krdetail.KR_idKR')
            ->leftJoin('autrority', 'kr.idKR', '=', 'autrority.KR_idKR')
            ->where('krdetail.year_year_id', '=', $y)
            ->where('krdetail.mount', '=', $m)
            ->get();
        return view('section_five.addAdmin', compact('year', 'search', 'y', 'm', 'check'));
    }
}
