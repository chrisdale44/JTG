<!doctype html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

	<title>Prints'n'Photos</title>

	<link href="css/main.css" rel="stylesheet"/>
	
	<script type="text/javascript" src="js/libs/jquery-2.1.3.min.js"></script>
	<script type="text/javascript" src="js/libs/jquery.debouncedresize.js"></script>
	<script type="text/javascript" src="js/libs/imagesloaded.pkgd.min.js"></script>
	<script type="text/javascript" src="js/libs/isotope.pkgd.min.js"></script>
	<script type="text/javascript" src="js/libs/lightcase.js"></script>
	<script type="text/javascript" src="js/public/main.js"></script>
</head>
<body>
	<div class="page-wrap">
		<? include_once('modules/public/views/partials/header.php'); ?>
		<? include_once('modules/public/views/'. $data["content_file"] .'.php'); ?>
	</div>
</body>
</html>