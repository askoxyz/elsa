
		</div> <!-- end of content -->

		<div class="clear"></div>

	</div> <!-- end of content-container -->

	<script src="<?php echo Config::get('url'); ?>/system/assets/js/jquery.js"></script>
	<script src="<?php echo Config::get('url'); ?>/system/assets/js/autosize.js"></script>
	<script>
	<?php if($sidebar === 'edit-content'): ?>
		var is_editor = true;
	<?php else: ?>
		var is_editor = false;
	<?php endif; ?>
	</script>
	<script src="<?php echo Config::get('url'); ?>/system/assets/js/elsa.js"></script>

</body>
</html>
