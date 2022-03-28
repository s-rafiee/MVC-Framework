<?php

class Controller
{
    protected static function view($view, $data = array())
    {
        $view = str_replace('.', '/', $view);
        require_once 'App/views/' . $view . '.blade.php';
    }
}