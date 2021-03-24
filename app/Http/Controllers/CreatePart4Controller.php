<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers;
use Illuminate\Support\Facades\DB;



class CreatePart4Controller extends Controller
{

    // public function index()
    // {
    //     $list_item = DB::table('list_item')->get();
    //     return view('CreatePart4', compact('list_item'));
    // }

    public function index()
    {
       if (session()->get('user')) {
        $list_item = DB::table('list_item')
        ->join('unit', 'list_item.unit_id_unit', '=', 'unit.id_unit')
        ->select('list_item.id_item', 'list_item.name_item', 'unit.unit_name')
        ->get();
        return view('CreatePart4', compact('list_item'));
       } else {
        return redirect('login');
       }
       
    }


    public function update(Request $request)
    {
        // echo $request->indicator_list;
        // echo "<br>emp " . $request->employee;
        // echo "<br>count " . $request->count;
        // echo "<br>unit " . $request->unit;
        // echo "<br>id " . $request->value_of_item;
        //
        // $request->validate([
        //     'title' => 'required',
        //     'description' => 'required'
        // ]);

        DB::table('list_item')
            ->where('id_item', $request->value_of_item)
            ->update(['name_item' => $request->indicator_list]);

        return redirect()->route('createpart4.index');
    }

    public function destoyy(Request $request)
    {
        echo $request->indicator_list;
        echo "emp " . $request->employee;
        echo "count " . $request->count;
        echo "unit " . $request->unit;
        echo "id " . $request->id_item;
        //
        // $request->validate([
        //     'title' => 'required',
        //     'description' => 'required'
        // ]);

        // DB::table('post')
        //     ->where('id', 3)
        //     ->update(['title' => "Updated Title"]);

        // return redirect()->route('createpart4.index');
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'title' => 'required',
        //     'description' => 'required'
        // ]);

        // Post::create($request->all());
        $values = array('name_item' => $request->indicator_list, 'unit_id_unit' => $request->unit, 'year_id' => '1');

        DB::table('list_item')->insert($values);

        return redirect()->route('createpart4.index')->with('success', 'created success');

        //  insert
        // $values = array('id' => 1, 'name' => 'Dayle');
        // DB::table('users')->insert($values);
    }

    // public function delete(Request $request)
    // {
    //     DB::table('list_item')->where('id_item', '=', $request->del)->delete();

    //     return redirect()->route('createpart4.index')->with('success', 'Delete success');
    // }



};
