<?php 
// DB Connection..

// connect to database
$conn = mysqli_connect("localhost","root","","conestoga_blog");

// check connection
if(!$conn){
    die("Error connecting to db".mysqli_connect_error());
}

?>