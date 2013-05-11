<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">

		<title>eClaus - Helper</title>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
<link href="http://netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css" rel="stylesheet">
<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/js/bootstrap.min.js"></script>

<link href="https://google-code-prettify.googlecode.com/svn/loader/prettify.css" rel="stylesheet">
<script src="https://google-code-prettify.googlecode.com/svn/loader/prettify.js"></script>

<script src="http://mozilla.github.io/pdf.js/build/pdf.js"></script>
<script type="text/javascript">
PDFJS.workerSrc = 'http://mozilla.github.io/pdf.js/build/pdf.js';
</script>
<script src="https://github.com/jeresig/jquery.hotkeys/raw/master/jquery.hotkeys.js"></script>
<script src="http://mindmup.github.io/bootstrap-wysiwyg/bootstrap-wysiwyg.js"></script>
		<style type="text/css">
			@import url("css/style.css");
		</style>

		<script src="js/navbar.js"></script>


	</head>
	<body>
		<div class="container">
			<div class="row"><div class="span12">
			<div class="navbar">
				<div class="navbar-inner">
					<form class="navbar-form" id="navform">
						<div class="row">
							<div class="span2"><select id="course" name="course"></select></div>
							<div class="span3"><select id="class" name="class"><select></div>
							<div class="span2"><select id="sheet" name="sheet"></select></div>
							<div class="span2"><select id="exercise" name="exercise"></select></div>
							<div class="span2"><select id="exercise_part" name="exercise_part"></select></div>
						</div>
						<input type="hidden" name="group" id="group">
						<input type="hidden" name="file" id="file">
					</form>
				</div>
			</div>
			</div>
			</div>

			<div class="row">
				<div class="span3">
					<ul class="well nav nav-list" id="groups">
						<li class="nav-header">Gruppen</li>
					</ul>
				</div>
				<div class="span9 tabbable">
					<div class="accordion" id="accordion2">
						<div class="accordion-group">
							<div class="accordion-heading">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
									Korrektur
								</a>
							</div>
							<div id="collapseOne" class="accordion-body collapse">
								<div class="accordion-inner">
									<div class="btn-toolbar form-horizontal" data-role="editor-toolbar" data-target="#editor">
										<div class="btn-group">
											<a class="btn dropdown-toggle" data-toggle="dropdown" title="" data-original-title="Font Size"><i class="icon-text-height"></i>&nbsp;<b class="caret"></b></a>
											<ul class="dropdown-menu">
												<li><a data-edit="fontSize 5"><font size="5">Huge</font></a></li>
												<li><a data-edit="fontSize 3"><font size="3">Normal</font></a></li>
												<li><a data-edit="fontSize 1"><font size="1">Small</font></a></li>
											</ul>
										</div>
										<div class="btn-group">
											<a class="btn" data-edit="bold" title="" data-original-title="Bold (Ctrl/Cmd+B)"><i class="icon-bold"></i></a>
											<a class="btn" data-edit="italic" title="" data-original-title="Italic (Ctrl/Cmd+I)"><i class="icon-italic"></i></a>
											<a class="btn" data-edit="strikethrough" title="" data-original-title="Strikethrough"><i class="icon-strikethrough"></i></a>
											<a class="btn" data-edit="underline" title="" data-original-title="Underline (Ctrl/Cmd+U)"><i class="icon-underline"></i></a>
										</div>
										<div class="btn-group">
											<a class="btn btn-info" data-edit="insertunorderedlist" title="" data-original-title="Bullet list"><i class="icon-list-ul"></i></a>
											<a class="btn" data-edit="insertorderedlist" title="" data-original-title="Number list"><i class="icon-list-ol"></i></a>
										</div>
										<div class="btn-group">
											<input class="input-mini" type="text" id="group_points">
										</div>
										<div class="btn-group">
											<a class="btn" id="correction_submit">Speichern</a>
										</div>
									</div>
									<div id="correction" contenteditable="true" class="well well-small">
									</div>

								</div>
							</div>
						</div>
					</div>
					<ul class="nav nav-tabs" id="files">
					</ul>
					<div class="tab-content" id="files_content">
					</div>
				</div>
			</div>




		</div>
	</body>
</html>
