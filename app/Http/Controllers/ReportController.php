<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers;
use Illuminate\Support\Facades\DB;


class ReportController extends Controller
{
    public function index()
    {
        // $list_item = DB::table('list_item')->get();
        // return view('Report', compact('list_item'));



        $list_item = DB::table('list_item')
        ->join('unit', 'list_item.unit_id_unit', '=', 'unit.id_unit')
        ->select('list_item.id_item', 'list_item.name_item', 'unit.unit_name')
        ->get();
        return view('Report', compact('list_item'));


    }
}

