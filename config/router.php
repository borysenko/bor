<?php
use Pecee\SimpleRouter\SimpleRouter;


SimpleRouter::get('/', 'SiteController@index', ['as' => 'home']);
SimpleRouter::get('/index/{page}', 'SiteController@index', ['as' => 'home.page']);
SimpleRouter::get('create', 'SiteController@create', ['as' => 'create']);
SimpleRouter::post('store', 'SiteController@store', ['as' => 'store']);
SimpleRouter::get('update/([0-9]+)', 'SiteController@index', ['as' => 'update']);

SimpleRouter::group(['middleware' => \middleware\AuthMiddleware::class], function() {

    SimpleRouter::get('login', 'SiteController@showLoginForm', ['as' => 'login']);
    SimpleRouter::post('login', 'SiteController@login');
    SimpleRouter::get('signup', 'SiteController@showSignupForm', ['as' => 'signup']);
    SimpleRouter::post('signup', 'SiteController@signup');

});

SimpleRouter::get('logout', 'SiteController@logout', ['as' => 'logout']);

SimpleRouter::get('/not-found', 'SiteController@notFound');
SimpleRouter::get('/forbidden', 'SiteController@forbidden');