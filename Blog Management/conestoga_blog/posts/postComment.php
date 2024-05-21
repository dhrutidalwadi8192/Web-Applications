<?php
// start session
session_start();
// include db file 
include_once('../db.php');

// check if form has submitted
if($_SERVER["REQUEST_METHOD"] == 'POST'){
    // id comment Id is set the perform edit commentoperation
        if(isset($_POST['comment'],$_POST['postId'],$_POST['commentId'])){
            // if comment is empty then do not do anything
            if(empty($_POST['commentId'])){
                header("Location: ./postDetail.php?postId=$postId");
            }
            $commentId = $_POST['commentId'];
            $postId = $_POST['postId'];
            // get current date
            $updated_at = date('Y-m-d H:i:s');
            // prepare statement
            $stmt = $conn->prepare("UPDATE post_comments SET comment = ?, updated_at = ? WHERE post_comment_id = ? AND post_id = ?");
             // bind params with statement
            $stmt->bind_param("ssii", $_POST['comment'], $updated_at, $commentId, $postId);
            // execute parameterized query
            $stmt->execute();
            // check if data updated or not
            if($stmt->affected_rows > 0){
                // redirect to post detail page with success message
                header("Location: ./postDetail.php?postId=$postId&success=Comment updated successfully");
            }else{  
                // redirect to post detail page with error message
                header("Location: ./postDetail.php?postId=$postId&error=Error while updating comment");
            }
            $stmt->close();
    
        }else{
            
            $comment = $_POST['comment'];
            $postId = $_POST['postId'];
            $commentBy = $_SESSION['userId'];

            // prepare insert statement
            $stmt = $conn->prepare("INSERT INTO post_comments (post_id,comment,comment_by) VALUES (?,?,?)");
            // bind variables to statement
            $stmt->bind_param("isi", $postId, $comment, $commentBy);
            // execute query
            $stmt->execute();
            if($stmt->affected_rows > 0){
                // redirect to post detail page
                header("Location: ./postDetail.php?postId=$postId&success=Comment added successfully");
            }else{  
                // redirect to post detail page
                header("Location: ./postDetail.php?postId=$postId?error=Error while adding comment");
            }
            $stmt->close();
        }   
}
?>