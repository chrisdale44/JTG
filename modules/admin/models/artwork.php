<?php

class Artwork_Model {
	public function __construct() {
    }

    public function get_artwork($con, $artworkId) {
    	$artworkResult = mysqli_query($con, "
    		SELECT *
	    		FROM art, artists
	    		WHERE artID='$artworkId'
	    		AND artists.artistID=art.artistID
    	");
    	return $artworkResult;
    }

    public function insert_artwork($con, $artistId, $title, $year, $desc, $file_name_ext) {
    	$artworkResult = mysqli_query($con, "
    		INSERT INTO art 
    		SET artistID='$artistId', 
    			title='$title',
    			year='$year', 
    			description='$desc',
    			image='$file_name_ext'
    		");
		return $artworkResult;
    }

    public function update_artwork($con, $artistId, $artworkId, $title, $year, $desc, $file_name_ext = false) {
    	if($file_name_ext) {
	    	$artworkResult = mysqli_query($con, "
	    		UPDATE art 
		    		SET artistID='$artistId', 
		    			title='$title',
		    			year='$year', 
		    			description='$desc',
		    			image='$file_name_ext'
		    		WHERE artID='$artworkId'
	    		");
	    } else {
	    	$artworkResult = mysqli_query($con, "
	    	UPDATE art 
		    		SET artistID='$artistId', 
		    			title='$title',
		    			year='$year', 
		    			description='$desc'
		    		WHERE artID='$artworkId'
	    		");
	    }
		return $artworkResult;
    }

    public function update_live($con, $artworkId, $bool) {
    	$artworkResult = mysqli_query($con, "
	    	UPDATE art 
	    		SET live='$bool'
	    		WHERE artID='$artworkId'
    		");
		return $artworkResult;
    }

    public function get_image_url($con, $artworkId) {
    	$urlResult = mysqli_query($con, "
    		SELECT image
    			FROM art
    			WHERE artID='$artworkId'
    		");
    	return $urlResult;
    }

    public function delete_artwork($con, $artworkId) {
		$deleteResult = mysqli_query($con, "
			DELETE 
				FROM art 
				WHERE artID='$artworkId'
		");
		return $deleteResult;
    }
}