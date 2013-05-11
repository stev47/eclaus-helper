var clear_files = function () {
	$('#files li').remove();
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
		var pane = $('<div class="tab-pane active" id="tab-' + i + '">').appendTo($('#files_content'));
		var codeel = $('<pre>').appendTo(pane);
		codeel.load('ajax/get_return.php?' + $('#navform').serialize(), function () {
		});
		i++;

		$.each(data, function(file, info) {
			// Tab-buttons
			$('#files').append($('<li>').append($('<a href="#tab-' + i + '" data-toggle="tab">').data('file', file).html(file)));
			// Tab-panes
			var pane = $('<div class="tab-pane" id="tab-' + i + '">').appendTo($('#files_content'));

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
					$('<canvas id="pdf-canvas">').appendTo(pane);

					PDFJS.getDocument(escape(info.path)).then(function(pdf) {
						pdf.getPage(1).then(function(page) {
							var scale = 1.1;
							var viewport = page.getViewport(scale);

							var canvas = document.getElementById('pdf-canvas');
							var context = canvas.getContext('2d');
							canvas.height = viewport.height;
							canvas.width = viewport.width;

							var renderContext = {
								canvasContext: context,
								viewport: viewport
							};
							page.render(renderContext);
						});
					});
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

})
