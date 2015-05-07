<?php
$con = mysqli_connect("localhost", "root", "root", "jt_gallery"); // host, user, password, db, port, socket

if(!$con)
{ // creation of the connection object failed
    die("connection object not created: ".mysqli_error($con));
}

// Check connection
if (mysqli_connect_errno()) {
	die("Connect failed: ".mysqli_connect_errno()." : ". mysqli_connect_error());
}