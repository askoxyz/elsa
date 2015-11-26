<?php

// elsa
$route->get('/elsa', 'ElsaController@index');

// sign in
$route->get('/elsa/signin', 'ElsaController@signIn');
$route->post('/elsa/signin', 'ElsaController@signIn');

// sign out
$route->get('/elsa/signout', 'ElsaController@signOut');

// content
$route->get('/elsa/content', 'ElsaController@content');
$route->get('/elsa/content/create', 'ElsaController@createContent');
$route->get('/elsa/content/type/[:type]', 'ElsaController@content');
$route->get('/elsa/content/edit/[:type]/[:slug]', 'ElsaController@editContent');
$route->get('/elsa/content/delete/[:type]/[:slug]', 'ElsaController@deleteContent');

// content types
$route->post('/elsa/content-type/create', 'ElsaController@createContentType');
$route->post('/elsa/content-type/edit/[:type]', 'ElsaController@editContentType');
$route->post('/elsa/content-type/delete/[:type]', 'ElsaController@deleteContentType');

// stats
$route->get('/elsa/stats', 'ElsaController@stats');

// users
$route->get('/elsa/users', 'ElsaController@users');

// settings
$route->get('/elsa/settings', 'ElsaController@settings');