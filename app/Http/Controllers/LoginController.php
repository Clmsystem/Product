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
            ->where('username', '=', $email)
            ->where('password', '=', $pass)
            ->get();

        $result = json_decode($users, true);

        try {


            if (count($users) > 0) {


                if (session()->has('user')) {
                    return view("index");
                } else {
                    session()->put('user', $result[0]);
                    return view("index");
                }
            } else {
                $request->session()->flash('status', 'โปรดตรวจสอบอีเมลและพาสเวิด');
                return view("login");
            }
        } catch (Exception $e) {
            return redirect('/');
        }
    }
}
