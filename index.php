<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">

		<title>EClaus Korrektur</title>

		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.min.css" rel="stylesheet">
		<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/js/bootstrap.min.js"></script>

		<link href="https://google-code-prettify.googlecode.com/svn/loader/prettify.css" rel="stylesheet">
		<script src="https://google-code-prettify.googlecode.com/svn/loader/prettify.js"></script>
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
					<ul class="nav nav-tabs" id="files">
					</ul>
					<div class="tab-content" id="files_content">
					</div>
				</div>
			</div>

			


		</div>
	</body>
</html>
