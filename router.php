<?php
/**
 * This controller routes all incoming requests to the appropriate controller
 */

//Automatically includes files containing classes that are called.
// Basically, this 'magic function' allows us to intercept the action that PHP 
// takes when we try to instantiate a class that does not exist. By using the 
// __autoload function in our router, we can tell PHP where to find the file 
// containing the class we are looking for. Assuming that you follow the class 
// and file naming convention set forth in this article, everytime you need to 
// instantiate a class, you can safely do so without having to manually include 
// the file!

function __autoload($className) {
    //parse out filename where class should be located
    list($filename , $suffix) = split('_' , $className);
            
    //compose posible file paths
    $adminPath = SERVER_ROOT . '/modules/admin/models/' . strtolower($filename) . '.php';
    $publicPath = SERVER_ROOT . '/modules/public/models/' . strtolower($filename) . '.php';

    //fetch file
    if (file_exists($adminPath)) {
        include_once($adminPath);    
    } elseif (file_exists($publicPath)) {
        include_once($publicPath);  
    } else {
        //file does not exist!
        die("File '$filename' containing class '$className' not found.");    
    }
}

//fetch the passed request
$request = $_SERVER['QUERY_STRING'];

//parse the page request and other GET variables
$parsed = explode('&' , $request);

//the module is the first element
$module = array_shift($parsed);

if(empty($module)) {
	$module = 'public';
}
                    
//the rest of the array are get statements, parse them out.
$getVars = array();
foreach ($parsed as $argument) {
    //split GET vars along '=' symbol to separate variable, values
    list($variable , $value) = split('=' , $argument);
    $getVars[$variable] = $value;
}

if(empty($getVars['p'])) {
    if ($module=='admin') {
        $page = 'login';
    } else {
        $page = 'home';
    }
} else {
    $page = $getVars['p'];
}

if(empty($getVars['method'])) {
    $method = 'main';
} else {
    $method = $getVars['method'];
}

//compute the path to the file
$target = SERVER_ROOT . '/modules/' . $module . '/controllers/' . $page . '.php';
                 
//get target
if (file_exists($target)) {
    include_once($target);

    //modify page to fit naming convention
    $class = ucfirst($page) . '_Controller';

    //instantiate the appropriate class
    if (class_exists($class)) {
        $controller = new $class;
    } else {
        //did we name our class correctly?
        die('class does not exist!');
    }
} else {
    //can't find the file in 'controllers'! 
    die('controller does not exist!');
}

//once we have the controller instantiated, execute the default function
//pass any GET varaibles to the main method
$controller->$method($con, $getVars);