<?php
// start session
session_start();
// include db file
include_once('../db.php');

// prepare query to select post
$query = "SELECT posts.post_id,posts.title,posts.description,posts.total_comments,users.first_name,users.last_name FROM posts LEFT JOIN users ON users.user_id = posts.created_by WHERE is_deleted = 0 AND status ='Active' ORDER BY posts.created_at DESC";
// execute query
$result = mysqli_query($conn,$query);
// fetch all posts
$posts =mysqli_fetch_all($result,MYSQLI_ASSOC);
?>

<!-- include header -->
<?php include '../common/header.php'; ?>

<section class="row justify-content-left section-margin mr-5 ml-5 mb-5">
    <!-- check if posts found -->
    <?php if(sizeof($posts) > 0){ ?>
    <div class="col-md-8 mb-3">
        <!-- if username is set in session display user name  -->
        <?php if(isset($_SESSION['userName'])){ ?>
        <h4>Welcome <?php echo $_SESSION['userName']; ?></h4>
        <?php } ?>
        <h1 class="mt-3">Blogs</h1>
    </div>
    <!-- loop through all posts and display details -->
    <?php foreach ($posts as $post) { ?>

    <div class="col-md-8 mb-4">
        <div class="card bg-light border-info">
            <div class="card-body">
                <h5 class="card-title d-flex align-items-center">
                    <!-- author name -->
                    <i class="bx bxs-user-circle" style="font-size: 1.5em; margin-right: 5px;"></i>
                    <?php echo $post['first_name']. " ".$post['last_name']; ?>
                </h5>
                <!-- title -->
                <h4 class="card-title"><?php echo $post['title']; ?></h4>
                <p class="card-text">
                    <!-- in listing page display only 100 lines of description -->
                    <?php 
                    if(strlen($post['description']) > 100){
                        echo substr($post['description'], 0, 100) . "...";
                    }else{
                        echo $post['description'];
                    }?>
                </p>
                <div class="card-footer text-muted d-flex justify-content-between align-items-center">
                    <p class="card-text">
                        <!-- comment count -->
                        <?php echo ($post['total_comments']) > 0 ? ($post['total_comments'] > 1 ? $post['total_comments'] ." Comments" : "1 Comment") :"No Comments Yet"; ?>
                    </p>
                    <!-- view blog button -->
                    <a href="../posts/postDetail.php?postId=<?php echo $post['post_id']; ?>"
                        class="btn btn-secondary btn-lg">View
                        Blog</a>
                </div>

            </div>
        </div>
    </div>
    <?php } 
    }else{ 
        echo "No Blogs Yet";
    }
    ?>
</section>

<!-- include footer -->
<?php include '../common/footer.php'; ?>