<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers;
use Illuminate\Support\Facades\DB;



class GraphPart2Controller extends Controller
{

    public function index()
    {
        $indicator_id = $_GET['id'];
        $year_item = $_GET['years'];
        $data = DB::table('employee')
            ->join('assign', 'employee.id_employee', '=', 'assign.Employee_id_employee')
            ->join('indicator', 'assign.indicator_id', '=', 'indicator.indicator_id')
            ->join('indicator_month', 'indicator.indicator_id', '=', 'indicator_month.indicator_id')
            ->join('year', 'indicator_month.year_id', '=', 'year.year_id')
            ->where('employee.indicator_id', '=', $indicator_id)
            ->where('employee.year_id', '=', $year_item)
            ->select('employee.indicator_name', 'employee.month','indicator.fullscore','indicator.score')
            ->get();


    
            $name = $data[0]->indicator_name;
            $year = $data[0]->year;

            $m0 = $data[0]->count;
            $m1 = $data[1]->count;
            $m2 = $data[2]->count;
            $m3 = $data[3]->count;
            $m4 = $data[4]->count;
            $m5 = $data[5]->count;
            $m6 = $data[6]->count;
            $m7 = $data[7]->count;
            $m8 = $data[8]->count;
            $m9 = $data[9]->count;
            $m10 = $data[10]->count;
            $m11 = $data[11]->count;
        return view('Graph', compact('m0', 'm1', 'm2', 'm3', 'm4', 'm5', 'm6', 'm7', 'm8', 'm9', 'm10', 'm11','name','year'));
    }
};
