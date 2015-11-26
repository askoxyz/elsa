<!DOCTYPE html>
<head>
<html>
	<meta charset="utf-8">
	<title>Elsa</title>
	<link rel="stylesheet" href="<?php echo Config::get('url'); ?>/system/assets/css/style.css">
</head>
<body>

	<div class="top-header">

		<div class="wrap">

			<div class="left">

				<h1>
					<a href="<?php echo Config::get('url'); ?>/"><?php echo Config::get('title'); ?></a>
				</h1>

			</div>

			<div class="right">

				<ul>
					<li><a href="<?php echo Config::get('url'); ?>/elsa/signout">Sign Out</a></li>
				</ul>

			</div>

		</div>

	</div> <!-- end of top-header -->

	<div class="content-container wrap">

		<div class="content-container-heading">

			<h2 class="left">

				<?php echo $title; ?>

			</h2>

			<div class="right">

				...

			</div>

		</div>

		<div class="sidebar">

			<ul>

				<li<?php if($active === 'content'): ?> class="active"<?php endif; ?>>
					<a href="<?php echo Config::get('url'); ?>/elsa/content">
						<i class="fa fa-list"></i>
						<span>Content</span>
					</a>
				</li>

				<li<?php if($active === 'stats'): ?> class="active"<?php endif; ?>>
					<a href="<?php echo Config::get('url'); ?>/elsa/stats">
						<i class="fa fa-pie-chart"></i>
						<span>Stats</span>
					</a>
				</li>

				<li<?php if($active === 'users'): ?> class="active"<?php endif; ?>>
					<a href="<?php echo Config::get('url'); ?>/elsa/users">
						<i class="fa fa-users"></i>
						<span>Users</span>
					</a>
				</li>

				<li<?php if($active === 'settings'): ?> class="active"<?php endif; ?>>
					<a href="<?php echo Config::get('url'); ?>/elsa/settings">
						<i class="fa fa-cogs"></i>
						<span>Settings</span>
					</a>
				</li>

			</ul>

		</div> <!-- end of sidebar -->

		<?php if(!empty($sidebar)): ?>

			<div class="sub-sidebar">

				<?php require ELSA . '/system/views/partials/sidebar-' . $sidebar . '.php'; ?>

			</div> <!-- end of sub-sidebar -->

		<?php endif; ?>

		<div class="content">
