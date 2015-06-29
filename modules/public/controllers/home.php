<?php

class Home_Controller
{
    public $content_file = 'home';

    public function main($con, array $getVars)
    {
        $homeModel = new Home_Model;
        
        //create a new view and pass it our template
        $view = new View_Model($this->content_file);

        //tell the template which page content view file it should include
        $view->assign('content_file', $this->content_file);

        //get contact details for the header
        $contact = mysqli_fetch_assoc($homeModel->get_contact_details($con));
        $view->assign('contact', $contact);

        //get all live artwork for image grid
        $artwork = $homeModel->get_all_artwork($con);
        $view->assign('artwork', $artwork);

        //get all live artists for the nav bar
        $artists = $homeModel->get_all_artists_names($con);
        $view->assign('artists', $artists);

        //get about paragraph
        $about = mysqli_fetch_assoc($homeModel->get_about_para($con));
        $view->assign('about', $about);
    }
}