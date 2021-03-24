<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class LoginController extends Controller
{
    public function index(Request $request)
    {
  
        $email = $request->input('email');
        $pass = $request->input('password');
        $users = DB::table('employee')
                ->join('position_list', 'position_list.id_position', '=', 'employee.id_position')
                ->join('department', 'department.id_department', '=', 'employee.id_department')
                ->where('username', '=',$email)
                ->where('password','=',$pass)
                ->get();
        
        $result = json_decode($users, true);
        session()->put('user', $result[0]);
       

        if (count($users)>0){
            
            // print_r(session()->get('user'));
                return view("index");
                // print_r($result);
         
        }
        else{
            echo "pls check pass or email";
            // // return view('index');
            print_r($result);
        }
        
        
    }
    



   
}
