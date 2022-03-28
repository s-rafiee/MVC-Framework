<?php

class SampleMiddleware
{
    public static function run($Request, $controller_obj, $Methode, $param)
    {
        /*
         * can do Before and After Middleware
         */

        $response = call_user_func_array([$controller_obj, $Methode], $param);

        return $response;
    }
}