<?php 

class Token 
{
    public static function generate($prefix = "") {
        if(!empty($prefix)) {
            $prefix = $prefix . "_";
        }
        $prefix = $prefix;
        return Session::put(Config::get("session/{$prefix}token"), md5(uniqid()));
    }

    public static function check($prefix = "", $token) {
        if(!empty($prefix)) {
            $prefix = $prefix . "_";
        }
        $prefix = $prefix;
        $token_name = Config::get("session/{$prefix}token");
        if(Session::exists($token_name) && $token === Session::get($token_name)) {
            Session::delete($token_name);
            return true;
        }
        return false;
    }
}