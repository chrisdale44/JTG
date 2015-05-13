<?

// Define Root vars
define('SERVER_ROOT' , '.');
define('SITE_ROOT' , '__DIR__');
// define('SERVER_ROOT' , '/Applications/MAMP/htdocs/jtg');
// define('SITE_ROOT' , 'http://localhost:8888/jtg');

// Connect to the database
require_once (SERVER_ROOT . '/db/connect.php');

// Fetch the router
require_once(SERVER_ROOT . '/router.php');