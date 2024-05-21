<?php 
session_start();
include_once('../db.php');

// if post id is in url param
if(isset($_GET['postId'])){
    $postId = $_GET['postId'];
    // prepare query
    $query = "SELECT posts.*, users.first_name, users.last_name FROM posts JOIN users ON posts.created_by = users.user_id WHERE post_id = $postId";
    // execute query
    $result = mysqli_query($conn,$query);
    // fetch one row of data
    $post = mysqli_fetch_assoc($result);

    // fetch post comments
    $commentQuery = "SELECT post_comments.*, users.first_name, users.last_name,users.user_id FROM post_comments JOIN users ON post_comments.comment_by = users.user_id WHERE post_id = $postId ORDER BY post_comments.created_at DESC";
    $commentResult = mysqli_query($conn,$commentQuery);
    // fetch all comments
    $postComments = mysqli_fetch_all($commentResult,MYSQLI_ASSOC);
}
?>

<!-- include header -->
<?php include '../common/header.php'; ?>

<section class="container mb-5 section-margin">
    <!-- block for displaying message -->
    <div id="alertMessage" style="display:none" role="alert">
        <?php echo $_GET['error']; ?>
    </div>
    <!-- block for displaying post details -->
    <div class="row justify-content-left">
        <!-- display blog title -->
        <h2 class="m-3"><?php echo $post['title']; ?></h2>
        <div class="col-md-12 mb-5">
            <div class="card">

                <div class="card-body">
                    <div class="card-header">

                        <h4 class="card-title d-flex align-items-center">
                            <i class="bx bxs-user-circle" style="font-size: 1.5em; margin-right: 5px;"></i>
                            <!-- display blog author -->
                            <?php echo $post['first_name']. " ".$post['last_name']; ?>
                        </h4>
                    </div>

                    <!-- display blog description -->
                    <p class="card-text p-3 post-desc text-justify"><?php echo $post['description']; ?></p>
                    <div class="card-footer text-muted d-flex justify-content-between align-items-center">
                        <!-- display comment count -->
                        <p class="card-text">
                            <?php echo ($post['total_comments']) > 0 ? ($post['total_comments'] > 1 ? $post['total_comments'] ." Comments" : "1 Comment") :"No Comments Yet"; ?>
                        </p>

                        <!-- display created date of post -->
                        <p class="card-text">Posted On:
                            <?php echo date('F j, Y, g:i a', strtotime($post['created_at'])); ?></p>
                    </div>
                </div>
            </div>

            <!-- section for post comments -->
            <?php 
            if(sizeof($postComments) > 0){ ?>
            <h2 class="mt-4 mr-4">Comments</h2>
            <?php foreach ($postComments as $comment) { ?>
            <div class="card mt-5 p-2">
                <div class="card-body">
                    <h5 class="card-title d-flex align-items-center">
                        <!-- display posted by -->
                        <i class="bx bxs-user-circle" style="font-size: 1.2em; margin-right: 5px;"></i>
                        <?php echo $comment['first_name']. " ".$comment['last_name']; ?>
                    </h5>
                    <!-- display comment -->
                    <p class="post-comment"><?php echo $comment["comment"]; ?></p>
                    <!-- display comment time -->
                    <p class="card-text">Commented On:
                        <?php echo date('F j, Y, g:i a', strtotime($comment['created_at'])); ?></p>

                    <?php 
                    // if session is set and comment is of logged in user then display edit and delete comment option
                    if(isset($_SESSION['userId']) &&  $comment['user_id'] == $_SESSION['userId']){ ?>
                    <div class="card-action mt-4 mb-4">
                        <!-- this form will be enabled when user clicks on edit post button -->
                        <form action="./postComment.php" method="post" style="display: none;"
                            id=<?php echo "commentForm".$comment['post_comment_id'] ?>>
                            <!-- comment text area fill with existing comment -->
                            <textarea id=" comment" name="comment" class="form-control mb-3" placeholder="Comment"
                                row=3><?php echo $comment["comment"]?></textarea>
                            <!-- hidden post id to pass on form submission -->
                            <input type="hidden" id="postId" name="postId" value="<?php echo $post['post_id']; ?>">
                            <!-- hidden comment id to pass on form submission -->
                            <input type="hidden" id="commentId" name="commentId"
                                value="<?php echo $comment['post_comment_id']; ?>">
                            <!-- edit comment button -->
                            <button type="submit" class="btn btn-outline-info"><i class='bx bxs-comment'></i>
                                Edit Comment</button>
                        </form>

                    </div>
                    <!-- post comment - two options delete and edit -->
                    <a href="./deletePostComment.php?commentId=<?php echo $comment['post_comment_id']; ?>&postId=<?php echo $postId; ?>"
                        class="btn btn-danger">Delete</a>
                    <!-- edit button -->
                    <button class="btn btn-info" id="editCommentButton"
                        data-comment-id="<?php echo $comment['post_comment_id']; ?>">Edit</button>

                    <?php } ?>
                </div>
            </div>
            <?php 
                } 
            } 
            ?>

            <!-- if users is logged in then display add comment form -->
            <?php if(isset($_SESSION['userId'])) {?>
            <div class="card-action mt-4 mb-4">
                <form action="./postComment.php" method="post">
                    <!-- comment text area -->
                    <textarea id="comment" name="comment" class="form-control mb-3" placeholder="Comment"
                        row=3></textarea>
                    <!-- hidden post id to pass on form submission -->
                    <input type="hidden" id="postId" name="postId" value="<?php echo $post['post_id']; ?>">
                    <!-- add comment button -->
                    <button type="submit" class="btn btn-outline-info"><i class='bx bxs-comment'></i>
                        Comment</button>
                </form>
            </div>
            <?php
            } ?>
        </div>
    </div>
</section>

<!-- include script file to display edit comment form -->
<script src="../scripts/script.js"></script>

<!-- include footer -->
<?php include '../common/footer.php' ?>