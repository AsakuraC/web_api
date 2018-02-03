<?php

$app->post('/hhh', function() use($app, $response, $res){
	$res['data'] = 'hhh';
	$response->setJsonContent($res);
	$response->send();
});


$app->notFound(
    function () use ($app, $response, $res) {
    	$request = $app->request;
    	if($request->isPost()){
    		$uri = $request->getURI();
    		$res = BaseController::switchControAction($app, $res, $uri, $request->getPost());
    	}else{
	    	$res['succ'] = 0;
	    	$res['data'] = 'sorry';
    	}
    	$response->setJsonContent($res);
    	$response->send();
    }
);