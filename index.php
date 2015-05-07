<?
// Define Root vars
define('SERVER_ROOT' , '/Applications/MAMP/htdocs/fine_art_prints');
define('SITE_ROOT' , 'http://localhost:8888/fine_art_prints');

// Connect to the database
require_once (SERVER_ROOT . '/db/connect.php');

// Fetch the router
require_once(SERVER_ROOT . '/router.php');