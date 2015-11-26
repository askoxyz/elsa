<div class="content-list">

	<form method="post">

		<div class="content-list-heading">

			<div class="span span-checkbox">

				<input type="checkbox" id="all">

			</div>

			<div class="span span-title">

				Title

			</div>

			<div class="span span-date">

				Date

			</div>

		</div>

		<ul class="content-list-content">

			<?php foreach(Content::in($type)->get() as $content): ?>

			<li>

				<div class="span span-checkbox">

					<input type="checkbox" value="<?php echo $content->id; ?>">

				</div>

				<div class="span span-title">

					<a href="<?php echo Config::get('url'); ?>/elsa/content/edit/<?php echo $content->type; ?>/<?php echo $content->slug; ?>">
						<?php echo $content->meta->title; ?>
					</a>

				</div>

				<div class="span span-date">

					<?php echo date('d.m.Y', $content->meta->timestamp); ?><br>

				</div>

				<div class="clear"></div>

			</li>

			<?php endforeach; ?>

		</ul>

	</form>

</div>
