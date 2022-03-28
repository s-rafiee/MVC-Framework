<?php

class Request
{
    private static $instance;

    private static $type = ''; # post, get, files
    /*
     * list post and get parameters
    */
    private static $params;

    public function __construct()
    {
        /*
         * The default value for all is an empty array.
        */

        Request::$params = [
            'post' => [],
            'get' => [],
            'files' => [],
        ];
    }

    public static function POST()
    {
        /*
         * Create an instance if is not created.
         */
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        /*
         * set This type => post
         */
        self::$type = 'post';

        /*
         * join all POST params to params
        */

        foreach ($_POST as $key => $value) {
            Request::$params[self::$type][$key] = $value;
        }

        return self::$instance;
    }

    public static function GET()
    {
        /*
         * Create an instance if is not created.
         */
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        /*
         * set This type => get
         */
        self::$type = 'get';

        /*
         * join all GET params to params
        */

        foreach ($_GET as $key => $value) {
            Request::$params[self::$type][$key] = $value;
        }

        return self::$instance;
    }

    public static function FILES()
    {
        /*
         * Create an instance if is not created.
         */
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        /*
         * set This type => files
         */
        self::$type = 'files';

        /*
         * join all FILE uploded to params
        */
        foreach ($_FILES as $key => $value) {
            if (is_array($value)) {
                Request::$params[self::$type][$key][0]['name'] = $value['name'];
                Request::$params[self::$type][$key][0]['type'] = $value['type'];
                Request::$params[self::$type][$key][0]['tmp_name'] = $value['tmp_name'];
                Request::$params[self::$type][$key][0]['error'] = $value['error'];
            } else {
                for ($i = 0; $i < count($value['name']); $i++) {
                    Request::$params[self::$type][$key][$i]['name'] = $value['name'][$i];
                    Request::$params[self::$type][$key][$i]['type'] = $value['type'][$i];
                    Request::$params[self::$type][$key][$i]['tmp_name'] = $value['tmp_name'][$i];
                    Request::$params[self::$type][$key][$i]['error'] = $value['error'][$i];
                }
            }
        }

        return self::$instance;
    }

    public static function find($name, $default = '')
    {
        /*
         * if isset this key in params return this, else return default value
         */
        if (isset(Request::$params[self::$type][$name])) {
            return Request::$params[self::$type][$name];
        } else {
            echo $default;
        }
    }

    public static function all()
    {
        /*
         * return all params for this type request
         */
        return Request::$params[self::$type];
    }
}
