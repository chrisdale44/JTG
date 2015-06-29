<?php

class Home_Model
{          
    public function __construct()
    {
    }

    public function get_all_artists_names($con) {
        $artistsResult = mysqli_query($con, "
            SELECT artists.artistId, artists.forename, artists.surname, artists.bio 
                FROM artists 
                WHERE artistId IN (
                    SELECT DISTINCT art.artistId 
                        FROM art 
                        WHERE live=1) 
                ORDER BY artists.surname ASC
            ");
        return $artistsResult;
    }

    public function get_all_artwork($con) {
        $artworkResult = mysqli_query($con, "
            SELECT * 
                FROM art, artists
                WHERE art.live = 1
                AND art.artistId = artists.artistId
            ORDER BY artists.surname ASC, art.title ASC
            ");
        return $artworkResult;
    }

    public function get_contact_details($con) {
        $contactResult = mysqli_query($con, "
            SELECT email, telephone
                FROM contact
            ");
        return $contactResult;
    }

    public function get_about_para($con) {
        $aboutResult = mysqli_query($con, "
            SELECT about
                FROM about
                WHERE id = '1'
            ");
        return $aboutResult;
    }
}