<?php

require_once 'route/Route.php';

class Core
{
    public function __construct()
    {
        $request = $this->parseRequest();
        /*
        * switch
        */
        $sw = FALSE; // Default is false and is not found Route for this Request


        $param = array(); //list parameters send to method of the controller

        /*
         *
         * selected Routes lists of type Requests
         *
        */

        $selected_route = array();

        $route_list = Route::$routes_list[strtolower($request['type'])];

        if (strtolower($request['type']) == 'post') {
            /*
             * if invalid csrf
            */
            if (!(isset($_POST['csrf']) and isset($_SESSION['csrf']) and $_POST['csrf'] == $_SESSION['csrf'])) {
                echo "CSRF Is Invalid.";
                exit();
            }
        }
        /*
         * set new csrf token
        */
        if (!isset($_SESSION ['csrf'])) {
            $_SESSION['csrf'] = password_hash(substr(md5(rand(1, 1000000000)), rand(0, 10), 15), PASSWORD_BCRYPT);
        }

        /*
         *
         * selcet on Request from Route Lists
         *
        */
        foreach ($route_list as $route_url) {
            if (count($route_url['url']) == count($request['url'])) {

                $sw = TRUE;//true for this Route

                for ($i = 0; $i < count($route_url['url']); $i++) {

                    /*
                     *
                     *  if is example {id} => add to parameters
                     *
                    */

                    if (preg_match("@^{.*}$@", $route_url['url'][$i])) {
                        /*
                         *
                         * it`s a parameters and add to $param array
                         *
                        */
                        array_push($param, $request['url'][$i]);

                    } else if (strtolower($route_url['url'][$i]) != strtolower($request['url'][$i])) {
                        /*
                         *
                         * if object $i isnot match => this Route is invalid for the url
                         *
                        */
                        $sw = FALSE;
                        /*
                         * go to next Route
                        */
                        break;
                    }
                }
                if ($sw == TRUE) {
                    $selected_route = $route_url;
                    break;
                } else {
                    $param = array();
                }
            }
        }
        /*
         * if finded Route
         */
        if ($sw) {
            /*
            * expload $selected_route['controller'] to fiind controller calss and this function
            *
            */
            $controller = explode('@', $selected_route['controller']);

            /*
            *
            * set controller class
            */
            if (count($controller) == 2) {
                /*
                * expload and find controller class and folders
                */
                $controller[0] = explode('/', trim($controller[0], '/'));
                /*
                 * find controller class name
                 */
                $controller_class = $controller[0][count($controller[0]) - 1];
                /*
                 * implode and make class folder address
                 */
                $controller[0] = implode('/', $controller[0]);

                /*
                 * if exists controller file
                 */
                if (file_exists('App/controllers/' . $controller[0] . '.php')) {
                    /*
                     * requere controller file
                    */
                    require_once 'App/controllers/' . $controller[0] . '.php';

                    /*
                     * create object from this controller
                    */
                    $controller_obj = new $controller_class();
                    /*
                     * if exists method in controller class
                    */
                    if (method_exists($controller_obj, $controller[1])) {
                        /*
                         *
                         * set methode
                         *
                        */
                        $Methode = $controller[1];
                        /*
                         * call Middleware
                        */

                        /*
                         * call Request
                        */
//                        Request::Run();
                        $r = new Request();
                        unset($r);
                        /*
                         * call methode and send parameter
                         */
                        $response = call_user_func_array([$controller_obj, $Methode], $param);
                        print_r($response);

                    } else {
                        //error not found controller method
                        Erorr::alert("function_exists");
                    }
                } else {
                    //error not found controller file
                    Erorr::alert("Controller_exists");
                }
            } else {
                //error invalid Route
                Erorr::alert("Route_invalid");
            }
        } else {
            /*
             * not found Route
            */
            Erorr::alert("Route_No_Exists");
        }
    }

    protected function parseRequest()
    {
        /*
         * get url request
        */
        $url = preg_replace("@^/|/$@", "", strtolower($_SERVER['REDIRECT_URL']));
        /*
        * explode by /
        */
        $Request['url'] = explode('/', filter_var(trim($url, '/'), FILTER_SANITIZE_URL));


        /*
         * get request type
        */
        $Request['type'] = $_SERVER['REQUEST_METHOD'];

        return $Request;
    }
}