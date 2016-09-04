<?php 

class Validate 
{
    private $_passed = false,
            $_errors = array(),
            $_db = null;

    public function __construct() {
        $this->_db = new Model();
    }

    public function check() {

    }
}