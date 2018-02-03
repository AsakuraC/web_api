<?php
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;

$loader = new Phalcon\Loader();
$loader->registerDirs(array(
    './controllers/',
    './models/'
))->register();

$di = new Phalcon\Di\FactoryDefault();

$config = new Phalcon\Config\Adapter\Ini('./config.ini');

$di->set('db', function() use($config) {
	$mysql = $config->get('database')->toArray();
	return new DbAdapter($mysql);
});

$di->set('user', function(){
	return new UserController();
});

$response = new \Phalcon\Http\Response();
$res = [
	"succ" => 1,
	"data" => null
];

try {
    $app = new Phalcon\Mvc\Micro();
    $app->setDI($di);

    require_once("./api/api.php");

    $app->handle();
} catch (\Exception $e) {
	$res['succ'] = 0;
	$res['data'] = $e->getMessage();
}