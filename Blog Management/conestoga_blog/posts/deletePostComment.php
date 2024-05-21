<?php
// include db file
include_once('../db.php');
// start session
session_start();

// check if comment id and post id is set
if(isset($_GET['commentId'],$_GET['postId'])){
    $commentId = $_GET['commentId'];
    $postId = $_GET['postId'];
    // prepare delete query
    $sql = "DELETE FROM post_comments WHERE post_comment_id = $commentId AND post_id = $postId";
    // execute query
    if(mysqli_query($conn, $sql)){
        // redirect to post detail page
        header("Location: ./postDetail.php?postId=$postId");
    }else{
        // redirect to post detail page
        header("Location: ./postDetail.php?postId=$postId&error=Error while deleting comment");
    }
}
?>