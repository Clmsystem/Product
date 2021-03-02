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
        $users = DB::table('user')
                ->where('user_email', '=',$email )
                ->where('user_password','=',$pass)
                ->get();

        $result = json_decode($users, true);

        if (count($users)>0){
            
            if ($result[0]['lv']=1){
                return view("header.menu");
            }
            else{
                return view("menu.content");
            }
        }
        else{
            echo "pls check pass or email";
        }
        
        
    }
    



   
}
