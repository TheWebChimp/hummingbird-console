jQuery(document).ready(function($) {

	$('.codemirror').each(function() {
		var el = $(this),
			mode = el.data('mode'),
			readOnly = el.data('readonly') || false,
			textarea = el.find('textarea');
		var editor = CodeMirror.fromTextArea(textarea[0], {
			styleActiveLine: true,
			autoCloseBrackets: true,
			matchTags: { bothTags: true },
			matchBrackets: true,
			// lineWrapping: true,
			readOnly: readOnly,
			lineNumbers: true,
			theme: 'monokai',
			mode: mode
		});
		el.data('editor', editor);
	});

	$('#form-code').ajaxForm({
		success: function(response) {
			$('.console-output').html(response);
		}
	});

	var adjustSize = function() {
		var header = $('.console-header'),
			footer = $('.console-footer'),
			height = $(window).height(),
			borders = header.outerHeight() + footer.outerHeight() + 65,
			isResponsive = $('.form-code').css('margin-bottom') == '15px';
		if (isResponsive) {
			$('.box-output').removeAttr('style');
			$('.CodeMirror').removeAttr('style');
		} else {
			$('.box-output').height(height - borders);
			$('.CodeMirror').height(height - (borders + 10));
		}
	};

	$(window).on('resize', function() {
		adjustSize();
	});

	adjustSize();

});