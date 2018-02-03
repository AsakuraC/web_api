<?php

use Phalcon\Mvc\Controller;

class BaseController extends Controller
{
    public static function switchControAction($app, $res, $uri, $params)
    {
    	$rs = explode('/', $uri);
    	$class = ucfirst($rs[1]) . 'Controller';
    	if(count($rs) && class_exists($class) && method_exists($class, $rs[2])){
    		return $app->$rs[1]->$rs[2]($app, $res, $params);
    	}
    	$res['succ'] = 0;
    	return $res;
    }

    public static function initRedis()
    {
    	$redis = new Redis();
    	$redis->connect('127.0.0.1', 6379);
    	return $redis;
    }
}