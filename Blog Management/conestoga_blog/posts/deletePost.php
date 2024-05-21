<?php
// start session
session_start();
// include db file
include_once('../db.php');

// check if post id is set in url params
if(isset($_GET['postId'])){
    $postId = $_GET['postId'];
    // prepare delete query
    $query = "DELETE FROM posts WHERE post_id = $postId";
    // execute query
    if(mysqli_query($conn, $query)){
        // navigate to my blog page
        header("Location: ./myPosts.php");
    }else{
        // navigate to my blog page
        header("Location: ./myPosts.php");
    }
}
?>