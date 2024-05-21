<?php
// start session
session_start();

// variable for displaying error messages
$isValid=true;
$validationMessage="";

// edit flag to decide need to perform add or delete operation
$isEdit = false;

// include db file
include_once('../db.php');

// if session has expired then redirect to login page
if(!isset($_SESSION['userId'])){
    header('Location: ../auth/login.php');
}


// check if form submitted
if($_SERVER["REQUEST_METHOD"] == 'POST'){
    // take title and description from form
    $title=$_POST["title"];
    $description = $_POST["description"];

    // if post id is set then update post
    if(isset($_POST['postId'])){
        // take current date time
        $updatedAt = date('Y-m-d H:i:s');
        $postId = $_POST['postId'];

        // prepare update statement
        $stmt = $conn->prepare("UPDATE posts SET title = ?, description = ?, updated_at = ? WHERE post_id = ?");
        // bind variables to statement
        $stmt->bind_param("sssi", $title, $description, $updatedAt, $postId);
        // execute statement
        $stmt->execute();
        
        // if post is updated, navigate user to my blog page
        if($stmt->affected_rows > 0){
            // navigation
            header('Location: ./myPosts.php');}
        else{          
            // set error message  
            $isValid=false;
            $validationMessage="Error while updating post";
        }
        $stmt->close();
    }else{
        // take created by from session variable
        $createdBy = $_SESSION['userId'];
        // insert insert statement
        $stmt = $conn->prepare("INSERT INTO posts (title, description, created_by) VALUES (?, ?, ?)");
        // bind variables with statement
        $stmt->bind_param("sss", $title, $description, $createdBy);
        // execute query
        $stmt->execute();
        // if post is created, navigate user to my blog page
        if($stmt->affected_rows > 0){
            header('Location: ./myPosts.php');
        }else
        {
            // set error message  
            $isValid=false;
            $validationMessage="Error while creating post";
        }
        $stmt->close();
    }
}

// if in params post id is set then this is for edit post
if(isset($_GET['postId'])){
    $postId = $_GET['postId'];
    // prepare select post query
    $query = "SELECT * FROM posts WHERE post_id = $postId";
    // execute query
    $result = mysqli_query($conn,$query);
    // fetch single record
    $post = mysqli_fetch_assoc($result);
    // set is edit flag to true
    $isEdit = true;
}
?>

<!-- include header -->
<?php include '../common/header.php'; ?>
<section div class="section-margin mr-5 ml-5 mb-5">
    <div class="container mb-5">
        <div class="row d-flex justify-content-center align-items-center m-5">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black mb-5" style="border-radius: 25px">
                    <div class="card-body p-md-5 ">
                        <div class="row justify-content-center">
                            <div class="col-md-12 col-lg-12 col-xl-12 order-2 order-lg-1">
                                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">
                                    Create Post
                                </p>
                                <!-- block for error messages -->
                                <?php
                                if (!$isValid) {
                                    ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo $validationMessage; ?>
                                </div>
                                <?php
                                }
                    ?>
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <!-- blog title input -->
                                        <input type="text" id="title" name="title" class="form-control form-control-lg"
                                            required minlength="5" value=<?php if($isEdit){
                                                echo $post['title'];
                                            } ?>>
                                    </div>
                                    <div class="form-group">
                                        <!-- blog description input -->
                                        <label for="description">Description</label>
                                        <textarea type="textarea" id="description" name="description"
                                            class="form-control" rows="20" required minlength="20"><?php if($isEdit){
                                                echo $post['description'];
                                            } ?></textarea>
                                    </div>
                                    <div class="form-group d-flex justify-content-center p-2">
                                        <!-- if edit flag is true then display edit button -->
                                        <?php if($isEdit){ ?>
                                        <input type="submit" value="Edit Blog" class="btn btn-primary" />
                                        <input type="hidden" id="postId" name="postId"
                                            value="<?php echo $post['post_id']; ?>">
                                        <?php }
                                        else{ 
                                            // create blog button
                                            ?><input type="submit" value="Create Blog" class="btn btn-info" />
                                        <?php } ?>
                                        <!-- reset button -->
                                        <input type="reset" value="Clear" class="btn btn-secondary ml-2 mr-2" />
                                        <!-- cancel button - navigate to my blog page -->
                                        <input type="button" value="Cancel" class="btn btn-warning"
                                            onClick="document.location.href='./myPosts.php'" />
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- used ckeditor for displaying editor for description -->
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace('description');
</script>
<!-- include footer -->
<?php include '../common/footer.php'?>