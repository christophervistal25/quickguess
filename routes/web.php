<?php


$router->group(['prefix' => 'api'], function () use ($router) {

    // $router->post('ranks','RanksController@ranks');
    $router->get('ranks','RanksController@ranks');
    //require a token to access this routes
    $router->group(['middleware' => 'jwt.auth'],function() use ($router) {
		$router->get('userstat','UserStatusController@index');
        $router->post('userstat','UserStatusController@store');
        $router->post('userhistory','UserHistoryController@store');
    });

    // $router->post('login','UserController@userLogin');
	$router->post('register','UserController@store');
    $router->post('login',['as' => 'login', 'uses' => 'UserController@loginUser']);
    // $router->get('/userstat/{name}','UserController@getStat');
});


$router->get('/','PageController@index');
