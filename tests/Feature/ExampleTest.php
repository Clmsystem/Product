<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }



    // public function testLogin()
    // {
    //     $response = $this->call('POST', '/Valid', ['email' => 'a','password'=>'a']);

    //     $response->assertSessionHas('user');
    // }


    // public function testCreatPart4()
    // {
    //     $users = DB::table('employee')
    //     ->join('position_list', 'position_list.id_position', '=', 'employee.id_position')
    //     ->join('department', 'department.id_department', '=', 'employee.id_department')
    //     ->where('username', '=',$email)
    //     ->where('password','=',$pass)
    //     ->get();

    //     $result = json_decode($users, true);
    //     session()->put('user', $result[0]);
    //     $response = $this->withSession(['user' => true])->get('/createpart4');
    //     $response->assertOk();
    // }
}
