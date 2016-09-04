<?php 

class Redirect
{
    public static function index() {
        header("Location: http://localhost/mvc/public/home/index");
        exit();
    }
}