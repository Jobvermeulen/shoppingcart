<?php
//Get error messages
error_reporting(E_ALL); 
ini_set('display_errors', 1);

//Require routes file
require_once('routes.php');

//require debugger
//include('Debugger.php');


//Autoload for loading all files
function __autoload($className) {
    if (file_exists('./model/'.$className.'.php')) {
        require_once './model/'.$className.'.php';
    } else if(file_exists('./controller/'.$className.'.php')) {
        require_once './controller/'.$className.'.php';
    } else if(file_exists('./modules/'.$className.'.php')){
        require_once './modules/'.$className.'.php';
    } else if(file_exists('./'.$className.'.php')) {
        require_once './'.$className.'.php';
    }
}

