<?php 
// start session
session_start();

// include db file
include_once('../db.php');

// declare variables to display error messages 
$isValid = true; 
$validationMessage = ""; 

// if form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") { 
    // take email and password from form
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // prepare query to select user
    $query = "SELECT * FROM users WHERE email_id='$email'";
    
    // execute query
    $result = mysqli_query($conn,$query);
    // take single record
    $user = mysqli_fetch_assoc($result);
    
    // if user found
    if($user)
    {
        // verify user password with password hash in database
        $verify = password_verify($password, $user['password']);
        // if incorrect password then set error message
        if(!$verify){
            $isValid = false;
            $validationMessage = "Invalid username or password";
        }else{
            // if correct password then create session and store user data in session
            $_SESSION['userId']=$user['user_id'];
            $_SESSION['userName']=$user['first_name']." ".$user['last_name'];
            // redirect user to home page
            header('Location: ../home/index.php');
        }
    // set error message if password is incorrect
    }else{
      $isValid = false;
      $validationMessage = "Invalid username or password";
    }
}
?>

<!-- include header -->
<?php include '../common/header.php'; ?>
<section class="section-margin mr-5 ml-5 mb-5">
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center mt-5">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px">
                    <div class="card-body p-md-12">
                        <div class="row justify-content-center">
                            <div class="col-md-8 col-lg-8 col-xl-8 order-2 order-lg-1">
                                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-6 mt-4">
                                    Login
                                </p>
                                <!-- display block message -->
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
                                        <!-- email input -->
                                        <label for="email">Email ID</label>
                                        <input type="email" id="email" name="email" class="form-control form-control-lg"
                                            required />
                                    </div>
                                    <div class="form-group">
                                        <!-- password input -->
                                        <label for="password">Password</label>
                                        <input type="password" id="password" name="password"
                                            class="form-control form-control-lg" required />
                                    </div>
                                    <!-- login button -->
                                    <div class="form-group d-flex justify-content-center p-2">
                                        <input type="submit" value="Login" class="btn btn-info btn-lg" />
                                    </div>
                                </form>
                                <!-- ask user if don't have an account -->
                                <div class="mt-3 text-center">
                                    Don't have an account?
                                    <a href="../auth/registration.php">Signup here</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- include footer -->
<?php include '../common/footer.php'; ?>