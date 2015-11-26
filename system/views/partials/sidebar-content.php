<div class="sidebar-section">

	<h3>Content Types</h3>

	<ul>

		<?php foreach(ContentTypes::get() as $contentType): ?>

			<li<?php if($type === $contentType->slug): ?> class="active"<?php endif; ?>>
				<a href="<?php echo Config::get('url'); ?>/elsa/content/type/<?php echo $contentType->slug; ?>">
					<?php echo $contentType->name; ?>
					<span><?php echo count(Content::in($contentType->slug)->get()); ?></span>
				</a>
			</li>

		<?php endforeach; ?>

	</ul>

</div>
