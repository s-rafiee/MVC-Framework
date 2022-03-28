<?php

class Route
{
    /*
     *
     * HTTP Request
     *
    */
    public static $routes_list = [
        'post' => [],
        'get' => [],
    ];

    /*
     * HTTP GET Request Create.
     */
    public static function get($url, $controller, $array = array())
    {
        /*
         * expload url
        */
        $url = preg_replace("@^/|/$@", "", strtolower($url));
        $url = explode('/', filter_var(trim($url, '/'), FILTER_SANITIZE_URL));

        /*
         * prefix of url
        */
        if (count($array)) {
            if (isset($array['prefix'])) {
                $url = array_merge([$array['prefix']], $url);
            }
        }
        array_push(Route::$routes_list['get'], array("url" => $url, "controller" => $controller));
    }

    /*
     * HTTP POST Request Create.
     */
    public static function post($url, $controller, $array = array())
    {
        /*
         * expload url
        */
        $url = preg_replace("@^/|/$@", "", strtolower($url));
        $url = explode('/', filter_var(trim($url, '/'), FILTER_SANITIZE_URL));

        /*
         * prefix of url
        */
        if (count($array)) {
            if (isset($array['prefix'])) {
                $url = array_merge([$array['prefix']], $url);
            }
        }
        array_push(Route::$routes_list['post'], array("url" => $url, "controller" => $controller));
    }

}
