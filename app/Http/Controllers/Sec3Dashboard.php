<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers;
use Illuminate\Support\Facades\DB;



class Sec3Dashboard extends Controller
{

    public function index()
    {

        $id = $_GET['id'];
        $year = $_GET['year'];

        $data = DB::table('result')
            ->join('indicator_result', 'result.indicator_result_indicator_result_ID', 'indicator_result.indicator_result_ID')
            ->join('year', 'result.year_year_id', '=', 'year.year_id')
            ->where('result.indicator_result_indicator_result_ID', '=', $id)
            ->where('result.year_year_id', '=', $year)
            ->get();


        $name = $data[0]->indicator_result_name;
        $year = $data[0]->year;

        $n0 = $data[0]->plan;
        $n1 = $data[1]->plan;
        $n2 = $data[2]->plan;
        $n3 = $data[3]->plan;
        $n4 = $data[4]->plan;
        $n5 = $data[5]->plan;
        $n6 = $data[6]->plan;
        $n7 = $data[7]->plan;
        $n8 = $data[8]->plan;
        $n9 = $data[9]->plan;
        $n10 = $data[10]->plan;
        $n11 = $data[11]->plan;

        $m0 = $data[0]->result;
        $m1 = $data[1]->result;
        $m2 = $data[2]->result;
        $m3 = $data[3]->result;
        $m4 = $data[4]->result;
        $m5 = $data[5]->result;
        $m6 = $data[6]->result;
        $m7 = $data[7]->result;
        $m8 = $data[8]->result;
        $m9 = $data[9]->result;
        $m10 = $data[10]->result;
        $m11 = $data[11]->result;
        return view('sec3.sec3dashboard', compact('m0', 'm1', 'm2', 'm3', 'm4', 'm5', 'm6', 'm7', 'm8', 'm9', 'm10', 'm11', 'n0', 'n1', 'n2', 'n3', 'n4', 'n5', 'n6', 'n7', 'n8', 'n9', 'n10', 'n11', 'name', 'year'));
    }
};
