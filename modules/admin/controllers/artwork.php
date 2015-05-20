<?php
session_start();

class Artwork_Controller
{
    public $content_file = 'artwork';
    public $file_name_ext;

    public function main($con, array $getVars) {
        // check if user is logged in
    	require_once('php/check_session.php');
    	require_once('php/messages.php');

        $artworkModel = new Artwork_Model;
        //$dashModel = new Dash_Model;
          
        //create a new view and pass it our template
        $view = new View_Model($this->content_file);

        //tell the template which page content view file it should include
        $view->assign('content_file', $this->content_file);

        // Error messages
        if(isset($getVars['error'])) {
            $view->assign('errorMessage', $errorMessages[$getVars['error']]);
        }

        // If we are updating an existing artwork...
        if(isset($getVars['id'])) {
            $view->assign('artworkId', $getVars['id']);
            // ...Go get its' existing details 
            $artwork = mysqli_fetch_assoc($artworkModel->get_artwork($con, $getVars['id']));
            $view->assign('artwork', $artwork);
        }

        // get artist names for drop down
        $artists = Dash_Model::get_all_artists($con);
        $view->assign('artists', $artists);
    }

    public function submit($con, array $getVars) {
        $artworkModel = new Artwork_Model;

        // Get posted variables
        $artistId = $_POST['artist']; 
        
        if (!empty($_POST['title'])) {
            $title = $_POST['title'];
        } else {
            header('Location: index.php?admin&p=artwork&error=2');
            return false;
        }
        if (!empty($_POST['year'])) {
            $year = $_POST['year'];
        }
        if (!empty($_POST['medium'])) {
            $medium = $_POST['medium'];
        }
        if (!empty($_POST['desc'])) {
            $desc = $_POST['desc'];
        }

        // Add new artwork
        if (!isset($getVars['id'])) {
            // File exists
            if(!$_FILES['image']['name']) {
                header('Location: index.php?admin&p=artwork&error=2');
                return false;
            }

            $return = $this->upload_image($_FILES['image']);
            if($return != 1) {
                header('Location: index.php?admin&p=artwork&error='.$return);
                return false;
            }
            if($artworkModel->insert_artwork($con, $artistId, $title, $year, $medium, $desc, $this->file_name_ext)) {
                // Success
                header('Location: index.php?admin&p=dash&success=0');
            } else {
                // Fail
                header('Location: index.php?admin&p=artist&error=3');
            }
        } else {
            // update existing artwork
            $artworkId = $getVars['id'];

            // If user is uploading new image, we must delete the existing image and then upload new image
            if($_FILES['image']['name']) {
                // get url of the old image file
                $imageUrl = mysqli_fetch_assoc($artworkModel->get_image_url($con, $artworkId));
                if(!$imageUrl) {
                    header('Location: index.php?admin&p=dash&error=15');
                } 
                $image_path = SERVER_ROOT . '/images/artwork/' . $imageUrl['image'];

                // delete old image file
                if(!unlink($image_path)) {
                    header('Location: index.php?admin&p=artwork&error=16');
                    return false;
                }

                // upload new image
                $return = $this->upload_image($_FILES['image']);
                if($return != 1) {
                    header('Location: index.php?admin&p=artwork&error='.$return);
                    return false;
                }

                // Update the database record for this artwork
                if($artworkModel->update_artwork($con, $artistId, $artworkId, $title, $year, $medium, $desc, $this->file_name_ext)) {
                    // Success
                    header('Location: index.php?admin&p=dash&success=1');
                } else {
                    // Fail
                    header('Location: index.php?admin&p=artwork&id='.$artworkId.'&error=3');
                }
            } else {
                // Update the database record for this artwork (excluding image filename)
                if($artworkModel->update_artwork($con, $artistId, $artworkId, $title, $year, $medium, $desc)) {
                    // Success
                    header('Location: index.php?admin&p=dash&success=1');
                } else {
                    // Fail
                    header('Location: index.php?admin&p=artwork&id='.$artworkId.'&error=3');
                }
            }

            
        }
    }

    public function upload_image($uploadedFile) {
        // File size must not exceed 5Mb
        if ($uploadedFile['size']>5000000) {
            return '4';
        // File must be an image (jpg or png)
        } else if(!($uploadedFile["type"] == "image/jpeg" || $uploadedFile["type"] == "image/png")) {
            return '5';
        // PHP errors
        } else if($uploadedFile['error']>0) {
            $errorNo = 5+$_FILES['uploadedFile']['error']; // plus 5 to get correct error message
            return $errorNo;
        }

        // Get name and file extension of uploaded file
        $noext = $this->findname($uploadedFile['name']);
        $ext = $this->findexts($uploadedFile['name']);
        
        // Set paths
        $target_path = SERVER_ROOT . '/images/artwork/';
        $file_path = $target_path . $noext . "." . $ext;
        $this->file_name_ext = $noext . "." . $ext;

        // Ensure unique filename by adding a counter on the end
        $counter = 0;
        while(file_exists($file_path)){
            $counter++;
            // Loop until we have a unique name
            $file_path = $target_path . $noext . "_" . $counter . "." . $ext;
            $this->file_name_ext = $noext . "_" . $counter . "." . $ext;
        }

        // Move file to destination folder
        if(move_uploaded_file($uploadedFile['tmp_name'], $file_path)) {
            return true;
        } else {
            return '13';
        }
    }

    public function findexts($filename) { 
        $filename = strtolower($filename); 
        $exts = split("[/\\.]", $filename); 
        $n = count($exts)-1; $exts = $exts[$n]; 
        return $exts; 
    }

    public function findname($filename) {
         $filename = substr($filename, 0, strpos($filename, '.')); 
         return $filename;
    }
}