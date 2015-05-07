<h2>
	Admin Dashboard
</h2>

<div class='tabbed-content'>
	<!-- the tabs -->
	<ul class="tabs-nav">
		<li><a href="#tab-artwork">Artwork</a></li>
		<li><a href="#tab-artists">Artists</a></li>
		<li><a href="#tab-about">About</a></li>
		<li><a href="#tab-contact">Contact</a></li>
		<li><a href="#tab-password">Change Password</a></li>
	</ul>

	<!-- tab panes -->
	<div id='tab-artwork' class='tab'>
		<? require_once('partials/tab-artwork.php'); ?>
	</div>
	<div id='tab-artists' class='tab'>
		<? require_once('partials/tab-artists.php'); ?>
	</div>
	<div id='tab-about' class='tab'>
		<? require_once('partials/tab-about.php'); ?>
	</div>
	<div id='tab-contact' class='tab'>
		<? require_once('partials/tab-contact.php'); ?>
	</div>
	<div id='tab-password' class='tab'>
		<? require_once('partials/tab-password.php'); ?>
	</div>
</div>

<script type="text/javascript" src="js/admin/dash.js"></script>