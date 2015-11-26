<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" sizes="any" mask href="<?php echo Config::get('url'); ?>/_app/assets/images/logo.png">
	<meta name="theme-color" content="#4f5892">
	<title><?php if(!empty($title)): echo $title . ' | '; endif; echo Config::get('title'); ?></title>
	<link rel="stylesheet" href="<?php echo Config::get('url'); ?>/app/assets/css/style.css">
</head>
<body>

	<div class="wrap">

		<header class="top-header">

			<ul class="top-header-nav">
				<li class="top-header-logo"><a href="<?php echo Config::get('url'); ?>/"></a></li>
				<li <?php if($active === 'work'): ?>class="active"<?php endif; ?>><a href="<?php echo Config::get('url'); ?>/">Work</a></li>
				<li <?php if($active === 'blog'): ?>class="active"<?php endif; ?>><a href="<?php echo Config::get('url'); ?>/blog">Blog</a></li>
				<li <?php if($active === 'contact'): ?>class="active"<?php endif; ?>><a href="<?php echo Config::get('url'); ?>/contact">Contact</a></li>
			</ul>

		</header>
