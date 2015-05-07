<?php

class Dash_Model {
	public function __construct() {
    }

    public function get_all_artists($con) {
    	$artistsResult = mysqli_query($con, "
    		SELECT *
    			FROM artists
    			ORDER BY surname ASC
    	");
    	return $artistsResult;
    }

    public function get_all_artwork($con) {
    	$artworkResult = mysqli_query($con, "
			SELECT * 
				FROM art, artists
			WHERE artists.artistID = art.artistID 
			ORDER BY 
				surname ASC, 
				title ASC
		");
		return $artworkResult;
    }

    public function get_about($con) {
    	$aboutResult = mysqli_query($con, "
			SELECT about
				FROM about
		");
		return $aboutResult;
    }

    public function update_about($con, $about) {
    	$updateResult = mysqli_query($con, "
    		UPDATE about 
    			SET about='$about'
    	");
    	return $updateResult;
    }

    public function get_contact($con) {
    	$contactResult = mysqli_query($con, "
			SELECT email, telephone
				FROM contact
		");
		return $contactResult;
    }

    public function update_contact($con, $email, $telephone) {
    	$updateResult = mysqli_query($con, "
    		UPDATE contact 
    			SET email='$email', 
    				telephone='$telephone'
    	");
    	return $updateResult;
    }

    public function update_password($con) {

    }
}