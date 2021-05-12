<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers;
use Hamcrest\Core\HasToString;
use Illuminate\Support\Facades\DB;



class GraphPart2YearController extends Controller
{

    public function index()
    {
        // $indicator_id = $_GET['id'];
        $year = $_GET['years'];
        $data = DB::table('indicator_year')

            ->join('year', 'indicator_year.year_id', '=', 'year.year_id')
            ->join('indicator', 'indicator_year.indicator_id', '=', 'indicator.indicator_id')
            ->where('indicator_year.year_id', '=', $year)
            ->select('year.year', 'indicator.full_score', 'indicator_year.score', 'indicator.indicator_name')

            // ->where('indicator_year.indicator_id', '=', $indicator_id)
            ->get();

        $temp = [];
        $score = [];
        $full_score = [];
        $years = $data[0]->year;
        for ($i = 0; $i < count($data); $i++) {
            $temp[$i] = "'".$data[$i]->indicator_name."'";

            $score[$i] = $data[$i]->score;
            $full_score[$i] = $data[$i]->full_score;
        }
        $string = implode(",",$temp);
        $stringscore = implode(",",$score);
        $stringfull_score = implode(",",$full_score);


        // dd($data,$stringscore,$years) ;


        return view('graphPart2Year', compact('temp', 'string' ,'years', 'stringscore', 'stringfull_score'));
    }
};