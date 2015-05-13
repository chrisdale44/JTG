<?php
session_start();

class Login_Controller
{
    public $content_file = 'login';

    public function main($con, array $getVars) {
    	require_once('php/messages.php');
    	
        $loginModel = new Login_Model;

        if (isset($_SESSION['fap'])) {
        	// user is already logged in so redirect to the dashboard
        	header('Location: index.php?admin&p=dash');
        } else {
		    //create a new view and pass it our template
	        $view = new View_Model($this->content_file);

	        //tell the template which page content view file it should include
	        $view->assign('content_file', $this->content_file);

	        if(isset($getVars['success'])) {
            	$view->assign('successMessage', $successMessages[$getVars['success']]);
        	}

	        if(isset($getVars['error'])) {
	        	$view->assign('errorMessage', $errorMessages[$getVars['error']]);
	        }
	    }
    }

	public function login($con, $getVars) {
		if($this->attempt_login($con)) {
			//successful attempt
			header('Location: index.php?admin&p=dash');
		} else {
			//failed attempt
			header('Location: index.php?admin&p=login&error=0');
		}
    }

    public function attempt_login($con) {
    	$loginModel = new Login_Model;

    	// Check username and password have been set
    	if (empty($_POST['username']) && empty($_POST['password'])) {
	    	return false;
	    } else {
	    	$username = $_POST['username']; 
	    	$password = $_POST['password'];
	    }

	    //select password of matching username from database
	    $passwordResult = $loginModel->get_password($con, $username);

	    if ($row = mysqli_fetch_assoc($passwordResult)) {
	    	// username exists, now check if password is correct
	    	$password_db = $row['password'];

	    	//Get the salt from the password (the first 9 characters)
			$salt = substr($password_db, 0, 9);

			//Hash and salt the inputted password
			$hashed_password = $salt . sha1($salt.$password);

			if ($password_db === $hashed_password) {
				// Successful login
				$_SESSION['fap'] = $username;
				return true;
			} else {
				return false;
			}

	    } else {
	    	return false;
	    }
    }
}