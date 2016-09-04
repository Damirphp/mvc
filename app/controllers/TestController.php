<?php

class TestController extends Controller 
{
    public function get() {
        
        $user = $this->model('User')->get("users", array('first_name', '=', 'Damir'));
        if($user->count()) {
            print_r($user->first());
            echo $user->first()->email;
        } else {
            echo "count: " . $user->count() . "<br>";
            foreach($user->results() as $user) {
                echo $user->email;
            }
        }
    }

    public function insert() {
        $user = $this->model('User')->insert("users", array(
            'email' => 'pera@kovacevic.com',
            'password' => 'pera',
            'first_name' => 'Pera',
            'last_name' => 'Kovacevic'
        ));
    }

    public function update() {
        $update = $this->model('User')->update('users', 10, array(
            'password' => 'newpassword',
            'first_name' => 'Peraaaa',
        ));
        if($update) {
            echo "user is update";
        } else {
            echo "error";
        }
    }

     public function delete() {
        $user = $this->model('User')->delete('users', array('first_name', '=', 'Pera'));
        if($user) {
            echo "user has by deleted";
        } else {
            echo "error";
        }
    }
}