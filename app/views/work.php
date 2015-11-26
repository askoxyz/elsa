<section class="about">

	<h2><?php echo $about->meta->title; ?></h2>

	<p><?php echo $about->content; ?></p>

</section>

<section class="work">

	<h2>Work</h2>

	<ul>

		<?php foreach($work as $job): ?>

			<li>

				<h3><a href="<?php echo $job->meta->url; ?>"><?php echo $job->meta->title; ?></a></h3>
				<p><?php echo $job->meta->summary; ?></p>
				<p class="meta">
					<span class="client"><a href="<?php echo $job->meta->client_url; ?>"><?php echo $job->meta->client; ?></a></span>
					<span class="tech"><?php echo $job->meta->tech; ?></span>
					<span class="date"><?php echo Time::contextual($job->meta->timestamp); ?></span>
				</p>

			</li>

		<?php endforeach; ?>

	</ul>

</section>
