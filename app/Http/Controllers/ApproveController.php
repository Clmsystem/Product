<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ApproveController extends Controller
{
    public function index(Request $request)
    {


        $currentYear = DB::table('year')
        ->where('flag', 1)
        ->select('year_id')
        ->get();

        $currentYearShow = DB::table('year')
            ->where('flag', 1)
            ->select('year')
            ->get();

        $currentYearShow = $currentYearShow[0]->year;

        $currentYear = $currentYear[0]->year_id;

        if ($request->mountSelect) {
            $months = $request->mountSelect;
        } else if (session()->get('mountSelect')) {
            $months = session()->get('mountSelect');
        } else {
            $months = Carbon::now()->month;
        }

        $list_item = DB::table('list_item')
            ->join('unit', 'list_item.unit_id_unit', '=', 'unit.id_unit')
            ->select('list_item.id_item', 'list_item.name_item', 'unit.unit_name')
            ->get();

        $search = [];
        $year = DB::table('year')
            ->get();

        $years = 0;
        return view('approve', compact('list_item', 'year', 'years', 'search','currentYear' , 'months'));
    }

    public function sea(Request $request)
    {

        $currentYear = DB::table('year')
        ->where('flag', 1)
        ->select('year_id')
        ->get();

        $currentYearShow = DB::table('year')
            ->where('flag', 1)
            ->select('year')
            ->get();

        $currentYearShow = $currentYearShow[0]->year;

        $currentYear = $currentYear[0]->year_id;



        $years = $request->year;
        $months = $request->month;
        $year = DB::table('year')
            ->get();

        if ($years == 0) {
            $search = [];
            $list_item = [];
            return view('approve', compact('list_item', 'year', 'search'));
        } else {
            if ($months == 0) {
                $search = DB::table('transaction')
                    ->join('priority', 'transaction.id_item', '=', 'priority.id_item')
                    ->join('employee', 'priority.id_employee', '=', 'employee.id_employee')
                    ->join('list_item', 'transaction.id_item', '=', 'list_item.id_item')
                    ->join('unit', 'list_item.unit_id_unit', '=', 'unit.id_unit')
                    ->where('transaction.year_year_id', '=', $years)
                    ->groupBy('transaction.id_item')
                    ->select(DB::raw('list_item.id_item,name_item,sum(count) as count,unit_name,descriptionyear_year_id'),DB::raw('GROUP_CONCAT(name_employee) as name_employee'))
                    ->get();
            } else {
                $search = DB::table('transaction')
                    ->join('priority', 'transaction.id_item', '=', 'priority.id_item')
                    ->join('employee', 'priority.id_employee', '=', 'employee.id_employee')
                    ->join('list_item', 'transaction.id_item', '=', 'list_item.id_item')
                    ->join('unit', 'list_item.unit_id_unit', '=', 'unit.id_unit')
                    ->where([
                        ['transaction.year_year_id', '=', $years],
                        ['transaction.month', '=', $months],
                    ])
                    ->groupBy('transaction.id_item')
                    ->select(DB::raw('list_item.id_item,name_item,count,unit_name,description,year_year_id'),DB::raw('GROUP_CONCAT(name_employee) as name_employee'))
                    ->get();
            }


            $list_item = [];
            return view('approve', compact('list_item', 'year','currentYear' , 'years', 'search', 'months'));
        }
    }
    public function confirm(Request $request)
    {
        $years = $request->year1;
        $months = $request->month1;
        $total = DB::table('transaction')
            ->where('year_year_id', '=', $years)
            ->where('month', '=', $months)
            ->groupBy('id_item')
            ->get();

        $canApproce = true;
        for ($i = 0; $i < count($total); $i++) {
            $result = $total[$i]->count;
            if ($result == 0) {
                $canApproce = false; 
            }
        }

        if ($canApproce) {
            for ($i = 0; $i < count($total); $i++) {
                DB::table('transaction')
                    ->where([
                        ['id_item', '=', $total[$i]->id_item],
                        ['month', '=', $total[$i]->month],
                        ['year_year_id', '=', $total[$i]->year_year_id],
                    ])
                    ->update(['status' => 1]);
            }
            return redirect()->route('approve.index')->with('success', 'created success');
        } else {
            session()->flash('message', 'Cannot be Approve');
            return redirect()->route('approve.index')->with('alert', 'Cannot be Approve');
        }
    }
}
