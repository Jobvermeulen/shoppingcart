<?php

class router
{
    //Set route found to 0
    static $found = 0;
    //Array for valid routes 
    public static $validRoutes = array();
    //Function that sets route
    public static function set($route, $function) 
    {
        //Set route in array
        self::$validRoutes[] = $route;
        //Check if route exists
        if ($_GET['url'] == $route) {
            $function->__invoke();
        }
    }
}