<?php

class Login_Model
{
	public function __construct()
    {
    }

    public function get_password($con, $username) {
        //Sanitize
        $username = mysqli_real_escape_string($con, $username);
        $passwordResult = mysqli_query($con, "
    			SELECT password 
    				FROM admin
    				WHERE username = '$username'
    		");
    	return $passwordResult;
    }
}