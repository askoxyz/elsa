<?php

// home
$route->get('/', 'SiteController@work');

// blog
$route->get('/blog', 'SiteController@blog');

// blog post
$route->get('/blog/[:slug]', 'SiteController@blogPost');

// page
$route->get('/[:slug]', 'SiteController@page');
