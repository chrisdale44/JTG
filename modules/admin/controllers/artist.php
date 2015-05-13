<?php
session_start();

class Artist_Controller
{
    public $content_file = 'artist';

    public function main($con, array $getVars) {
        // check if user is logged in
    	require_once('php/check_session.php');
        require_once('php/messages.php');

        $artistModel = new Artist_Model;
          
        //create a new view and pass it our template
        $view = new View_Model($this->content_file);

        //tell the template which page content view file it should include
        $view->assign('content_file', $this->content_file);

        // Error messages
        if(isset($getVars['error'])) {
            $view->assign('errorMessage', $errorMessages[$getVars['error']]);
        }

        // Are we adding a new or editing an existing artist
        if(isset($getVars['id'])) {
        	$view->assign('id', $getVars['id']);
            $artist = mysqli_fetch_assoc($artistModel->get_artist($con, $getVars['id']));
            $view->assign('artist', $artist);
        }
    }

    public function submit($con, array $getVars) {
        $artistModel = new Artist_Model;

        // Get posted variables
    	if (!empty($_POST['surname'])) {
	    	$surname = $_POST['surname'];
	    } else {
            header('Location: index.php?admin&p=artist&error=2#tab-artists');
            return false;
	    }
	    if (!empty($_POST['forename'])) {
	    	$forename = $_POST['forename'];
    	}
    	if (!empty($_POST['bio'])) {
    		$bio = $_POST['bio'];
    	}

    	if (isset($getVars['id'])) {
            // update existing artist
            if($artistModel->update_artist($con, $getVars['id'], $forename, $surname, $bio)) {
                // Success
                header('Location: index.php?admin&p=dash&success=2#tab-artists');
            } else {
                // Fail
                header('Location: index.php?admin&p=artist&error=3#tab-artists');
            }
        } else {
            // insert new artist
    		if($artistModel->insert_artist($con, $forename, $surname, $bio)) {
                // Success
                header('Location: index.php?admin&p=dash&success=3#tab-artists');
            } else {
                // Fail
                header('Location: index.php?admin&p=artist&error=3#tab-artists');
            }
        }
    }
}