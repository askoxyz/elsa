<ol class="posts">

	<?php foreach($posts as $post): if($post->meta->status === 'public'): ?>

		<li class="post post-id-<?php echo $post->id; ?>">

			<?php if(empty($post->meta->link)): ?>

				<h2 class="post-title">
					<a href="<?php echo Config::get('url'); ?>/blog/<?php echo $post->slug; ?>">
						<?php echo $post->meta->title; ?>
					</a>
				</h2>

			<?php else: ?>

				<h3 class="post-title">
					<a href="<?php echo $post->meta->link; ?>">
						<?php echo $post->meta->title; ?>
					</a>
				</h3>

			<?php endif; ?>

			<time class="post-time">
				<a href="<?php echo Config::get('url'); ?>/blog/<?php echo $post->slug; ?>">
					<?php echo Time::contextual($post->meta->timestamp); ?>
				</a>
			</time>

			<div class="post-content hyphenate">
				<?php echo $post->content; ?>
			</div>

		</li>

	<?php endif; endforeach; ?>

</ol>
