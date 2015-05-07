<?php
/**
 * Handles the view functionality of our MVC framework for both public and admin views
 */
class View_Model
{
    /**
     * Holds variables assigned to template
     */
    private $data = array();
        
    /**
     * Holds render status of view.
     */
    private $render = FALSE;
        
    /**
     * Accept a template to load
     */
    public function __construct($content_file)
    {
        //compose possible file names
        $admin_template_file = SERVER_ROOT . '/modules/admin/views/template.php';
        $admin_content_file = SERVER_ROOT . '/modules/admin/views/' . strtolower($content_file) . '.php';
        $public_template_file = SERVER_ROOT . '/modules/public/views/template.php';
        $public_content_file = SERVER_ROOT . '/modules/public/views/' . strtolower($content_file) . '.php';

        /**
         * Trigger render to include file when this model is destroyed. If we
         * render it now, we wouldn't be able to assign variables to the view!
         */

        if (file_exists($admin_template_file) && file_exists($admin_content_file)) {
            $this->render = $admin_template_file;
        } elseif (file_exists($public_template_file) && file_exists($public_content_file)) {
            $this->render = $public_template_file;
        } else {
            echo 'Cannot find template files.';
        }   
    }
        
    /**
     * Receives assignments from controller and stores in local data array
     * 
     * @param $variable
     * @param $value
     */
    public function assign($variable , $value)
    {
        $this->data[$variable] = $value;
    }
        
    public function __destruct()
    {
        //parse data variables into local variables, so that they render to the view
        $data = $this->data;
            
        //render view
        include($this->render);
    }
}