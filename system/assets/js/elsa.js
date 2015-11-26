$(function() {
	
	var wh = $(window).height();
	var ww = $(window).width();

	// editor
	if(is_editor) {

		autosize(document.querySelector('textarea'));

		var metaBtn = $('li[data-action="content-meta"]');
		var saveBtn = $('li[data-action="content-save"]');

		// editor meta
		metaBtn.on('click', function() {

			alert('Content meta');

		});

		// save content
		saveBtn.on('click', function() {

			alert('save');

		});

	}	

});
