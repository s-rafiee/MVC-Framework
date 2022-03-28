<?php

class HomeController extends Controller
{
    /**
     * @param string $name
     * @param string $lastname
     */
    public function index($user = null)
    {
        print_r($user);
        $data = [];
        for ($i = 0; $i < 10; $i++) {
            $data['posts'][] = [
                "title" => "Post Title " . ($i + 1),
                'body' => 'Post Body Text ' . ($i + 1),
            ];
        }
        return self::view('index', $data);
    }

    public function post()
    {
        print_r(Request::all());
    }
}