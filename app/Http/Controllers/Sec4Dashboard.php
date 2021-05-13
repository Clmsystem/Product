<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers;
use Illuminate\Support\Facades\DB;



class Sec4Dashboard extends Controller
{

    public function index()
    {

        $id = $_GET['id'];
        $year = $_GET['year'];

        $data = DB::table('stratetegic')
            ->join('indicator_stratetegic', 'stratetegic.indicator_stratetegic_indicator_stratetegic_id', 'indicator_stratetegic.indicator_stratetegic_id')
            ->join('year', 'stratetegic.year_year_id', '=', 'year.year_id')
            ->where('stratetegic.indicator_stratetegic_indicator_stratetegic_id', '=', $id)
            ->where('stratetegic.year_year_id', '=', $year)
            ->get();


        $name = $data[0]->indicator_stratetegic_name;
        $year = $data[0]->year;

        $n0 = $data[0]->result;
        $n1 = $data[1]->result;
        $n2 = $data[2]->result;
        $n3 = $data[3]->result;
        $n4 = $data[4]->result;
        $n5 = $data[5]->result;
        $n6 = $data[6]->result;
        $n7 = $data[7]->result;
        $n8 = $data[8]->result;
        $n9 = $data[9]->result;
        $n10 = $data[10]->result;
        $n11 = $data[11]->result;

        $m0 = $data[0]->percent;
        $m1 = $data[1]->percent;
        $m2 = $data[2]->percent;
        $m3 = $data[3]->percent;
        $m4 = $data[4]->percent;
        $m5 = $data[5]->percent;
        $m6 = $data[6]->percent;
        $m7 = $data[7]->percent;
        $m8 = $data[8]->percent;
        $m9 = $data[9]->percent;
        $m10 = $data[10]->percent;
        $m11 = $data[11]->percent;
        return view('sec4.sec4dashboard', compact('m0', 'm1', 'm2', 'm3', 'm4', 'm5', 'm6', 'm7', 'm8', 'm9', 'm10', 'm11', 'n0', 'n1', 'n2', 'n3', 'n4', 'n5', 'n6', 'n7', 'n8', 'n9', 'n10', 'n11', 'name', 'year'));
    }
};
