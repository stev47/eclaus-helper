var clear_files = function () {
	$('#files li').remove();
	$('#files_content .tab-pane').each(function () {
		var pdf;
		if (pdf = $(this).data('pdf'))
			pdf.destroy();
	});
	$('#files_content').empty();
};

var fn_group_click = function () {
	$('#groups li').removeClass('active');
	$(this).parent().addClass('active');

	$('#group').val($(this).val());

	$.getJSON("ajax/get_files.php", $('#navform').serializeArray()).done(function(data) {
		clear_files();
		var i = 0;
		$('#files').append($('<li class="active">').append($('<a href="#tab-' + i + '" data-toggle="tab">').data('file', 'Abgabe').html('Abgabe')));
		var pane = $('<div class="tab-pane fade active in" id="tab-' + i + '">').appendTo($('#files_content'));
		var codeel = $('<pre>').appendTo(pane);
		codeel.load('ajax/get_return.php?' + $('#navform').serialize());

		var correctel = $('div#correction');
		correctel.load('ajax/get_correction.php?' + $('#navform').serialize());
		var pointsel = $('#group_points');
		$.get('ajax/get_points.php?' + $('#navform').serialize(), function (data) {
			pointsel.val(data);
		});

		i++;

		$.each(data, function(file, info) {
			// Tab-buttons
			$('#files').append($('<li>').append($('<a href="#tab-' + i + '" data-toggle="tab">').data('file', file).html(file)));
			// Tab-panes
			var pane = $('<div class="tab-pane fade" id="tab-' + i + '">').appendTo($('#files_content'));

			$('<a class="btn">').attr('href', escape(info.path)).html(file).appendTo(pane);

			switch (info.type) {
				case 'source':
					var codeel = $('<pre class="prettyprint linenums">').appendTo(pane);
					if (info.lang == 'txt') {
						codeel.addClass('nocode');
					} else {
						codeel.addClass('lang-' + info.lang);
					}
					$('#file').val(file);
					codeel.load('ajax/get_content.php?' + $('#navform').serialize(), function () {
						$(this).removeClass('prettyprinted');
						prettyPrint();
					});
					break;
				case 'image':
					$('<img class="img-rounded">').appendTo(pane).attr('src', escape(info.path));
					break;
				case 'pdf':

					PDFJS.getDocument(escape(info.path)).then(function(pdf) {
						
						pane.data('pdf', pdf);

						var top = 0;
						for (var i = 1; i <= pdf.numPages; i++) {
							
							var canvas = $('<canvas class="pdf-canvas" id="page-' + i + '">').appendTo(pane).get(0);
							var context = canvas.getContext('2d');

							// preserve scope variables for callback function to use
							(function (canvas, context, pdf) {
								pdf.getPage(i).then(function(page) {
									/*
									 * Scale to fit width
									 */
									var origViewport = page.getViewport(1);
									scale = $('#files_content').width() / origViewport.width;
									var scaledViewport = page.getViewport(scale);

									canvas.height = scaledViewport.height;
									canvas.width = scaledViewport.width;

									var renderContext = {
										canvasContext: context,
										viewport: scaledViewport
									};
									(function (page) {
										page.render(renderContext).onData(function () {
											page.destroy();
										});
									}(page));
								});
							}(canvas, context, pdf));
						}
					});
					break;
				default:
					$('<a>').attr('href', escape(info.path)).html(file).appendTo(pane);
			}

			i++;
		});
	});

	$('#file').val('');
}

$(function () {
	$.getJSON("ajax/get_dirs.php", $('#navform').serializeArray() ).done(function(data) {
		clear_files();
		$.each(data, function(key, val) {
			$('#course').append($('<option>').val(key).html(val));
		});
		$('#course').change();
	});

	$('#course').change(function() {
		clear_files();
		$('#class, #sheet, #exercise, #exercise_part, #group, #file').empty().val('');
		$.getJSON("ajax/get_dirs.php", $('#navform').serializeArray()).done(function(data) {
			$.each(data, function(key, val) {
				$('#class').append($('<option>').val(key).html(val));
			});
			$('#class').change();
		});
	});

	$('#class').change(function() {
		clear_files();
		$('#sheet, #exercise, #exercise_part, #group, #file').empty().val('');
		$.getJSON("ajax/get_dirs.php", $('#navform').serializeArray()).done(function(data) {
			$.each(data, function(key, val) {
				$('#sheet').append($('<option>').val(key).html(val));
			});
			$('#sheet').change();
		});
	});

	$('#sheet').change(function() {
		clear_files();
		$('#exercise, #exercise_part, #group, #file').empty().val('');
		$.getJSON("ajax/get_dirs.php", $('#navform').serializeArray()).done(function(data) {
			$.each(data, function(key, val) {
				$('#exercise').append($('<option>').val(key).html(val));
			});
			$('#exercise').change();
		});
	});

	$('#exercise').change(function() {
		clear_files();
		$('#exercise_part, #group, #file').empty().val('');
		$.getJSON("ajax/get_dirs.php", $('#navform').serializeArray()).done(function(data) {
			$.each(data, function(key, val) {
				$('#exercise_part').append($('<option>').val(key).html(val));
			});
			$('#exercise_part').change();
		});
	});

	$('#exercise_part').change(function() {
		$('#groups li').remove();
		$('#group, #file').empty().val('');
		clear_files();
		$.getJSON("ajax/get_groups.php", $('#navform').serializeArray()).done(function(data) {
			$.each(data, function(key, val) {
				$('#groups').append(
					$('<li>').append(
						$('<a href="#">').val(key).html(val).on('click', fn_group_click)
					)
				);
			});
		});
	});


	$('#correction_submit').click(function() {
		$.post('ajax/set_correction.php?' + $('#navform').serialize(), 
			   {   correction: $('#correction').html(),
				   group_points: $('#group_points').val()  });
	})


	$('#correction').wysiwyg({
		hotKeys: {
			'return': 'insertparagraph',
			   'ctrl+b meta+b': 'insertparagraph',
    'ctrl+i meta+i': 'italic'
		}
	});
})
