<?php

class Artist_Model {
	public function __construct() {
    }

    public function get_artist($con, $artistId) {
    	$artistResult = mysqli_query($con, "
    		SELECT
    			forename,
    			surname,
    			bio
    		FROM artists
    		WHERE artistID='$artistId'
    	");
    	return $artistResult;
    }

    public function insert_artist($con, $forename, $surname, $bio) {
    	$insertResult = mysqli_query($con, "
    		INSERT INTO artists 
	    		SET forename='$forename', 
	    			surname='$surname', 
	    			bio='$bio'
    	");
    	return $insertResult;
    }

    public function update_artist($con, $artistId, $forename, $surname, $bio) {
    	$updateResult = mysqli_query($con, "
    		UPDATE artists 
        		SET forename='$forename', 
        			surname='$surname', 
        			bio='$bio' 
        		WHERE artistID='$artistId'
    	");
    	return $updateResult;
    }

    public function delete_artist($con, $artistId) {
        $deleteResult = mysqli_query($con, "
            DELETE 
                FROM artists
                WHERE artistID='$artistId'
        ");
        return $deleteResult;
    }
}