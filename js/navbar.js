var fn_group_click = function () {
	$('#groups li').removeClass('active');
	$(this).parent().addClass('active');

	$('#group').val($(this).val());

	$.getJSON("ajax/get_files.php", $('#navform').serializeArray()).done(function(data) {
		$('#files li').remove();
		$('#files_content').empty();
		var i = 1;
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
		$.each(data, function(key, val) {
			$('#course').append($('<option>').val(key).html(val));
		});
		$('#course').change();
	});

	$('#course').change(function() {
		$('#class, #sheet, #exercise, #exercise_part, #group, #file').empty().val('');
		$.getJSON("ajax/get_dirs.php", $('#navform').serializeArray()).done(function(data) {
			$.each(data, function(key, val) {
				$('#class').append($('<option>').val(key).html(val));
			});
			$('#class').change();
		});
	});

	$('#class').change(function() {
		$('#sheet, #exercise, #exercise_part, #group, #file').empty().val('');
		$.getJSON("ajax/get_dirs.php", $('#navform').serializeArray()).done(function(data) {
			$.each(data, function(key, val) {
				$('#sheet').append($('<option>').val(key).html(val));
			});
			$('#sheet').change();
		});
	});

	$('#sheet').change(function() {
		$('#exercise, #exercise_part, #group, #file').empty().val('');
		$.getJSON("ajax/get_dirs.php", $('#navform').serializeArray()).done(function(data) {
			$.each(data, function(key, val) {
				$('#exercise').append($('<option>').val(key).html(val));
			});
			$('#exercise').change();
		});
	});

	$('#exercise').change(function() {
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
