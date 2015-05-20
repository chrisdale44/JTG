<?php

class Artwork_Model {
	public function __construct() {
    }

    public function get_artwork($con, $artworkId) {
    	$artworkResult = mysqli_query($con, "
    		SELECT *
	    		FROM art, artists
	    		WHERE artId='$artworkId'
	    		AND artists.artistId=art.artistId
    	");
    	return $artworkResult;
    }

    public function insert_artwork($con, $artistId, $title, $year, $medium, $desc, $file_name_ext) {
    	$artworkResult = mysqli_query($con, "
    		INSERT INTO art 
    		SET artistId='$artistId', 
    			title='$title',
    			year='$year',
    			medium='$medium',
    			description='$desc',
    			image='$file_name_ext'
    		");
		return $artworkResult;
    }

    public function update_artwork($con, $artistId, $artworkId, $title, $year, $medium, $desc, $file_name_ext = false) {
    	if($file_name_ext) {
	    	$artworkResult = mysqli_query($con, "
	    		UPDATE art 
		    		SET artistId='$artistId', 
		    			title='$title',
		    			year='$year',
		    			medium='$medium',
		    			description='$desc',
		    			image='$file_name_ext'
		    		WHERE artId='$artworkId'
	    		");
	    } else {
	    	$artworkResult = mysqli_query($con, "
	    	UPDATE art 
		    		SET artistId='$artistId', 
		    			title='$title',
		    			year='$year',
		    			medium='$medium',
		    			description='$desc'
		    		WHERE artId='$artworkId'
	    		");
	    }
		return $artworkResult;
    }

    public function update_live($con, $artworkId, $bool) {
    	$artworkResult = mysqli_query($con, "
	    	UPDATE art 
	    		SET live='$bool'
	    		WHERE artId='$artworkId'
    		");
		return $artworkResult;
    }

    public function get_image_url($con, $artworkId) {
    	$urlResult = mysqli_query($con, "
    		SELECT image
    			FROM art
    			WHERE artId='$artworkId'
    		");
    	return $urlResult;
    }

    public function delete_artwork($con, $artworkId) {
		$deleteResult = mysqli_query($con, "
			DELETE 
				FROM art 
				WHERE artId='$artworkId'
		");
		return $deleteResult;
    }
}