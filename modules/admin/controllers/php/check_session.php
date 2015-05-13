<?php
if (!isset($_SESSION['fap'])) {
    header('Location: index.php?admin&p=dash&method=logout');
    // alternatively instantiate Dash_Controller class and call the logout function that way.
}