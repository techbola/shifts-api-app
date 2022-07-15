<?php

namespace App\Lib;

class Router
{
    public static function get($route, $callback)
    {
        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'GET') !== 0) {
            return;
        }

        self::on($route, $callback);
    }

    public static function post($route, $callback)
    {
        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') !== 0) {
            return;
        }

        self::on($route, $callback);
    }

    public static function delete($route, $callback)
    {
        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'DELETE') !== 0) {
            return;
        }

        self::on($route, $callback);
    }

    public static function on($regex, $cb)
    {
        
        $ru = $_SERVER['REQUEST_URI'];
        $ur = explode("?", $ru)[0];

        if ($regex == $ur) {
            $query_params = [];
            $url_components = parse_url($_SERVER['REQUEST_URI']);
            if (isset($url_components['query'])) {
                parse_str($url_components['query'], $query_params);
            }
            $cb(new Request([], $query_params), new Response());

        } else {
            $params = $_SERVER['REQUEST_URI'];
            $params = (stripos($params, "/") !== 0) ? "/" . $params : $params;
            $regex = str_replace('/', '\/', $regex);
            $is_match = preg_match('/^' . ($regex) . '$/', $params, $matches, PREG_OFFSET_CAPTURE);

            if ($is_match) {
                // first value is normally the route, lets remove it
                array_shift($matches);
                // Get the matches as parameters
                $params = array_map(function ($param) {
                    return $param[0];
                }, $matches);

                $cb(new Request($params, []), new Response());
            }
        }
    }
}