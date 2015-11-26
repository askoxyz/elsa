<div class="sidebar-section">

	<h3>Content Meta</h3>

	<div class="content-editor-meta">

		<?php foreach($content->meta as $key => $value): if($key !== 'title'): ?>

			<label for="meta[<?php echo $key; ?>]"><?php echo ucfirst($key); ?></label>

			<?php if($key === 'status'): ?>

				<select data-editor-item="meta[status]" name="meta[status]">

					<?php if($value === 'public'): ?>

						<option value="<?php echo $value; ?>"><?php echo ucfirst($value); ?></option>
						<option value="private">Private</option>

					<?php else: ?>

						<option value="<?php echo $value; ?>"><?php echo ucfirst($value); ?></option>
						<option value="public">Public</option>

					<?php endif; ?>

				</select>

			<?php elseif($key === 'timestamp'): ?>

				<input type="date" name="meta[timestamp]" value="<?php echo $value; ?>">
				
			<?php else: ?>

				<input data-editor-item="meta[<?php echo $key; ?>]" type="text" name="meta[<?php echo $key; ?>]" value="<?php echo $value; ?>">

			<?php endif; ?>

		<?php endif; endforeach; ?>

	</div>

</div>