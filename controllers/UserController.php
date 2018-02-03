<?php

use Phalcon\Mvc\Controller;

class UserController extends Controller
{
    public function index()
    {
        return "1";
    }

    public function getRedis()
    {
    	$redis = BaseController::initRedis();
    	return $redis->get('e');
    }
}