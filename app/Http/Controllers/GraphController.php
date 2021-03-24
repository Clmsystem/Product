<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers;
use Illuminate\Support\Facades\DB;



class GraphController extends Controller
{

    public function index()
    {
        $list_item = DB::table('list_item')->get();
        return view('Graph', compact('list_item'));
    }

   
};
