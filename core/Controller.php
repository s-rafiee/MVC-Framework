<?php

class Controller
{
    protected static function view($view, $data = array())
    {
        $view = str_replace('.', '/', $view);

        ob_start();

        require_once 'App/views/' . $view . '.blade.php';

        $result = ob_get_contents();
        ob_end_clean();

        return $result;
    }
}