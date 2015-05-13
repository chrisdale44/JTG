<?php
session_start();

class Dash_Controller
{
    public $content_file = 'dash';

    public function main($con, array $getVars) {
        // check if user is logged in
    	require_once('php/check_session.php');
        require_once('php/messages.php');

        // dash model
        $dashModel = new Dash_Model;
        
        // view model
        $view = new View_Model($this->content_file);

        // content file
        $view->assign('content_file', $this->content_file);

        // Success messages
        if(isset($getVars['success'])) {
            $view->assign('successMessage', $successMessages[$getVars['success']]);
        }

        // Error messages
        if(isset($getVars['error'])) {
            $view->assign('errorMessage', $errorMessages[$getVars['error']]);
        }

        // Artists tab
        $artists = $dashModel->get_all_artists($con);
        $view->assign('artists', $artists);
        
        // Artwork tab
        $bool[0] = 'No'; 
        $bool[1] = 'Yes';
        $view->assign('bool', $bool);
        $artwork = $dashModel->get_all_artwork($con);
        $view->assign('artwork', $artwork);

        // About tab
        $about = mysqli_fetch_assoc($dashModel->get_about($con));
        $view->assign('about', $about);

        // Contact tab
        $contact = mysqli_fetch_assoc($dashModel->get_contact($con));
        $view->assign('contact', $contact);

        // Change password tab

    }

    public function logout($con, array $getVars) {
        session_destroy();
        header('Location: index.php?admin');
    }

    public function toggle($con, array $getVars) {
        $artworkModel = new Artwork_Model;

        if(isset($getVars['id']) && isset($getVars['bool'])) {
            $artworkId = $getVars['id'];
            $bool = $this->flip_flop($getVars['bool']);
            if($artworkModel->update_live($con, $artworkId, $bool)) {
                $successNo = $bool+8;
                header('Location: index.php?admin&p=dash&success='.$successNo.'#tab-artwork');
            } else {
                header('Location: index.php?admin&p=dash&error=15#tab-artwork');
            }
        }
    }

    public function delartist($con, array $getVars) {
        $artistModel = new Artist_Model;
        if(isset($getVars['id'])) {
            $artistId = $getVars['id'];
            if($artistModel->delete_artist($con, $artistId)) {
                header('Location: index.php?admin&p=dash&success=6#tab-artists');
            } else {
                header('Location: index.php?admin&p=dash&error=15#tab-artists');
            }
        }
    }

    public function delart($con, array $getVars) {
        $artworkModel = new Artwork_Model;      

    	if(isset($getVars['id'])) {
            $artworkId = $getVars['id'];
            // get url of the image file
            $imageUrl = mysqli_fetch_assoc($artworkModel->get_image_url($con, $artworkId));
            if(!$imageUrl) {
                header('Location: index.php?admin&p=dash&error=15');
            } 
            $image_path = SERVER_ROOT . '/images/artwork/' . $imageUrl['image'];

            // delete image file
            if(!unlink($image_path)) {
                header('Location: index.php?admin&p=dash&error=16');
            }

            // delete artwork record from database
            if($artworkModel->delete_artwork($con, $artworkId)) {
                header('Location: index.php?admin&p=dash&success=7');
            } else {
                header('Location: index.php?admin&p=dash&error=15');
            }
        }
    }

    public function about($con, array $getVars) {
        $dashModel = new Dash_Model;

        if (!empty($_POST['about'])) {
            $about = $_POST['about'];
        } else {
            header('Location: index.php?admin&p=dash&error=2#tab-about');
            return false;
        }
        if($dashModel->update_about($con, $about)) {
            // Success
            header('Location: index.php?admin&p=dash&success=4#tab-about');
        } else {
            // Fail
            header('Location: index.php?admin&p=dash&error=3#tab-about');
        }
    }

    public function contact($con, array $getVars) {
        $dashModel = new Dash_Model;

        if (!empty($_POST['email'])) {
            $email = $_POST['email'];
        } else {
            header('Location: index.php?admin&p=dash&error=2#tab-contact');
            return false;
        }
        if (!empty($_POST['telephone'])) {
            $telephone = $_POST['telephone'];
        } else {
            header('Location: index.php?admin&p=dash&error=2#tab-contact');
            return false;
        }
        
        if($dashModel->update_contact($con, $email, $telephone)) {
            // Success
            header('Location: index.php?admin&p=dash&success=5#tab-contact');
        } else {
            // Fail
            header('Location: index.php?admin&p=dash&error=3#tab-contact');
        }
    }

    public function flip_flop($bool) {
        if($bool==1) {
            return 0;
        } else if ($bool==0) {
            return 1;
        }
    }
}