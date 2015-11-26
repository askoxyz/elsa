<ol class="posts">

	<li class="post post-id-<?php echo $page->id; ?>">

		<h2 class="post-title">
			<a href="<?php echo Config::get('url'); ?>/<?php echo $page->slug; ?>">
				<?php echo $page->meta->title; ?>
			</a>
		</h2>

		<div class="post-content">
			<?php echo $page->content; ?>
		</div>

	</li>

</ol>
