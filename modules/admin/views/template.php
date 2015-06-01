<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Prints'n'Photos</title>

	<link href="css/main.css" rel="stylesheet"/>
	
	<script type="text/javascript" src="js/libs/jquery-2.1.3.min.js"></script>
	<script type="text/javascript" src="js/libs/jquery-ui.js"></script>
	<script type="text/javascript" src="js/admin/main.js"></script>
</head>
<body>
	<div class="page-wrap">
		<? include_once('modules/admin/views/partials/header.php'); ?>
		<div class="page-content">
			<? if (isset($data['successMessage'])): ?>
			<div class="success-banner animated slideInDown">
				<?= $data['successMessage'] ?>
			</div>
			<? endif;
			if (isset($data['errorMessage'])): ?>
			<div class="error-banner animated slideInDown">
				<?= $data['errorMessage'] ?>
			</div>
			<? endif;
			include_once('modules/admin/views/'. $data["content_file"].'.php'); ?>
		</div>
	</div>
</body>
</html>