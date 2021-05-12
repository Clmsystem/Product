<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;



class GraphPart2Controller extends Controller
{

    public function index()
    {
        $indicator_id = $_GET['id'];
        $year = $_GET['years'];
        $data = DB::table('indicator_month')
            ->join('indicator', 'indicator_month.indicator_id', 'indicator.indicator_id')
            ->join('year', 'indicator_month.year_id', '=', 'year.year_id')
            ->where('indicator_month.indicator_id', '=', $indicator_id)
            ->where('indicator_month.year_id', '=', $year)
            ->get();


        $name = $data[0]->indicator_name;

        $year = $data[0]->year;

        $m0 = $data[9]->full_score;
        $m1 = $data[10]->full_score;
        $m2 = $data[11]->full_score;
        $m3 = $data[0]->full_score;
        $m4 = $data[1]->full_score;
        $m5 = $data[2]->full_score;
        $m6 = $data[3]->full_score;
        $m7 = $data[4]->full_score;
        $m8 = $data[5]->full_score;
        $m9 = $data[6]->full_score;
        $m10 = $data[7]->full_score;
        $m11 = $data[8]->full_score;

        $s0 = $data[9]->score;
        $s1 = $data[10]->score;
        $s2 = $data[11]->score;
        $s3 = $data[0]->score;
        $s4 = $data[1]->score;
        $s5 = $data[2]->score;
        $s6 = $data[3]->score;
        $s7 = $data[4]->score;
        $s8 = $data[5]->score;
        $s9 = $data[6]->score;
        $s10 = $data[7]->score;
        $s11 = $data[8]->score;



        return view('graphPart2', compact('m0', 'm1', 'm2', 'm3', 'm4', 'm5', 'm6', 'm7', 'm8', 'm9', 'm10', 'm11', 'name', 'year', 's0', 's1', 's2', 's3', 's4', 's5', 's6', 's7', 's8', 's9', 's10', 's11'));
    }
};
