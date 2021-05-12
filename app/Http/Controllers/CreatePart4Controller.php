<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers;
use Illuminate\Support\Facades\DB;



class CreatePart4Controller extends Controller
{

    public function index()
    {
        if (session()->get('user')) {
            $currentYear = DB::table('year')
            ->where('flag',1)
            ->select('year_id')
            ->get();
        $currentYear= $currentYear[0]->year_id;    
            $list_item = DB::table('list_item')
                ->leftjoin('unit', 'list_item.unit_id_unit', '=', 'unit.id_unit')
                ->leftjoin('priority', 'list_item.id_item', '=', 'priority.id_item')
                ->leftjoin('employee', 'priority.id_employee', '=', 'employee.id_employee')
                ->where('year_id',$currentYear)
                ->select('list_item.id_item', 'list_item.name_item', 'unit.unit_name', DB::raw('GROUP_CONCAT(name_employee) as name_employee'))
                ->orderBy('list_item.id_item')
                ->groupBy('list_item.name_item')
                ->get();
            $units = DB::table('unit')
                ->get();
            $employee = DB::table('employee')
                ->where('id_department', '=', 2)
                ->get();
            return view('CreatePart4', compact('list_item', 'units', 'employee'));
        } else {
            return redirect('login');
        }
    }
    public function testr()
    {
        return view('login');
    }
    public function showResponsiblePerson()
    {
        $ResponsiblePerson = DB::table('employee')
            ->where('id_department', '=', 2)
            ->get();
    }
    public function delete_row(Request $request)
    {
        $count = DB::table('transaction')
        ->where('id_item' , $request->del)
        ->select(DB::raw('sum(count) as count'))
        ->get();       
        $result = $count[0]->count;
        if ($result == 0 ){
            DB::table('list_item')
            ->where('id_item' , $request->del)
            ->delete();
            DB::table('transaction')
                ->where('id_item' , $request->del)
                ->delete();
            return redirect()->route('createpart4.index')->with('success', 'created success');
        }else {
            session()->flash('message' , 'Cannot be deleted');
            return redirect()->route('createpart4.index')->with('alert', 'Cannot be Delete');
        }
    }
    public function update(Request $request)
    {
        // print_r($request);
        DB::transaction(function () use ($request) {
            DB::table('list_item')
                ->where('id_item', $request->value_of_item)
                ->update(['name_item' => $request->indicator_list, 'unit_id_unit' => $request->unit]);
            if (!empty($request->employee)) {
                DB::table('priority')
                    ->where('id_item', $request->value_of_item)
                    ->delete();
                foreach ($request->employee as $key => $value) {
                    $dataI[$key]['id_item'] = $request->value_of_item;
                    $dataI[$key]['id_employee'] = $value;
                }
                DB::table('priority')
                    ->insert($dataI);
            } else {
                DB::table('priority')
                    ->where('id_item', $request->value_of_item)
                    ->delete();
            }
        });
        return redirect()->route('createpart4.index');
    }

    public function destoyy(Request $request)
    {
        echo $request->indicator_list;
        echo "emp " . $request->employee;
        echo "count " . $request->count;
        echo "unit " . $request->unit;
        echo "id " . $request->id_item;
    }

    public function store(Request $request)
    {    
        DB::transaction(function () use ($request) {
            $currentYear = DB::table('year')
                ->where('flag',1)
                ->select('year_id')
                ->get();
            $currentYear= $currentYear[0]->year_id;    
            $values = array('name_item' => $request->indicator_list, 'unit_id_unit' => $request->unit, 'year_id' => $currentYear);
        DB::table('list_item')->insert($values);
            $listItem = DB::table('list_item')
                ->where('name_item', '=', $request->indicator_list)
                ->get();
            foreach (range(1, 12) as $number) {
                $datatoinsert[$number]['id_item'] = $listItem[0]->id_item; 
                $datatoinsert[$number]['count'] = "0";
                $datatoinsert[$number]['description'] = "-";
                $datatoinsert[$number]['month'] = $number;
                $datatoinsert[$number]['year_year_id'] = $currentYear;
            }
            DB::table('transaction')
                ->insert($datatoinsert);
        });
        return redirect()->route('createpart4.index')->with('success', 'created success');
    }
};
