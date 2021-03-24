<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;



class insertController extends Controller
{
    public function index()
    {
        $list_item = DB::table('list_item')->get();
        return view('insert', compact('list_item'));
    }

    public function test()
    {
        return Carbon::now()->month;
    }
}
