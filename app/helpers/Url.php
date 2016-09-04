<?php 

class Url
{
    public static function link($path) {
        echo 'http://localhost/mvc/public/' . $path;
    }

    public static function img($name) {
        echo 'http://localhost/mvc/public/static/img/' . $name;
    }
}