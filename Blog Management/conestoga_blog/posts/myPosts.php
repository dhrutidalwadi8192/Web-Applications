<?php
// start session
session_start();
// include db file
include_once('../db.php');

// prepare post select query
$query = "SELECT posts.post_id,posts.title,posts.description,posts.total_comments FROM posts  WHERE is_deleted = 0 AND status ='Active' AND created_by = ".$_SESSION['userId']." ORDER BY posts.created_at DESC";
// execute query
$result = mysqli_query($conn,$query);
// fetch all posts
$posts =mysqli_fetch_all($result,MYSQLI_ASSOC);
?>

<!-- include header -->
<?php include '../common/header.php'; ?>

<!-- section for blog list -->
<section class="row justify-content-left section-margin mr-5 ml-5 mb-5">
    <div class="col-md-8 mb-3 d-flex justify-content-between align-items-right">
        <h1>Blogs</h1>
        <!-- button to create new blog -->
        <Button class="btn btn-info btn-lg" onClick="document.location.href='./createPost.php'">Create New
            Blog</Button>
    </div>

    <!-- check if posts found -->
    <?php if(sizeof($posts) > 0){ ?>
    <!-- loop through posts and display details -->
    <?php foreach ($posts as $post) { ?>

    <div class="col-md-8 mb-4">
        <div class="card bg-light border-info">
            <div class="card-body">

                <h4 class="card-title"><?php echo $post['title']; ?></h4>
                <p class="card-text">

                    <!-- display description upto 100 lines in listing page -->
                    <?php 
                    if(strlen($post['description']) > 100){
                        echo substr($post['description'], 0, 100) . "...";
                    }else{
                        echo $post['description'];
                    }?>
                </p>
                <div class="card-footer text-muted d-flex justify-content-between align-items-center">
                    <p class="card-text">
                        <!-- display comment count -->
                        <?php echo ($post['total_comments']) > 0 ? ($post['total_comments'] > 1 ? $post['total_comments'] ." Comments" : "1 Comment") :"No Comments Yet"; ?>
                    </p>
                    <div>
                        <!-- view blog button -->
                        <a href="../posts/postDetail.php?postId=<?php echo $post['post_id']; ?>"
                            class="btn btn-secondary btn-lg">View
                            Blog</a>
                        <!-- edit blog button -->
                        <a href="./createPost.php?postId=<?php echo $post['post_id']; ?>"
                            class="btn btn-secondary btn-lg">
                            Edit</a>
                        <!-- delete blog button -->
                        <a href="./deletePost.php?postId=<?php echo $post['post_id']; ?>"
                            class="btn btn-secondary btn-lg">
                            Delete</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php } 
    }else{ ?>
    <div class="col-md-8 mb-3 d-flex justify-content-between align-items-right">
        <!-- no blog message -->
        <?php echo "No Blogs Yet";?>
    </div>
    <?php }?>

</section>


<!-- include footer -->
<?php include '../common/footer.php'; ?>