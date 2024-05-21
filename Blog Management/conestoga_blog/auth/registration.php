<?php 

// variables to display error messages
$isValid = true; 
$validationMessage = ""; 

// include db file
include_once('../db.php');

// check if form submitted
if($_SERVER["REQUEST_METHOD"] == "POST") { 

    // take data from form
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // check if confirm password does not match with the password
    if($password != $_POST['confirmPassword']){
        // set valiation error message
        $isValid = false;
        $validationMessage = "Password and Confirm Password do not match";
    }else{
        // fetch user by email, to chek if user already exists with given email
        $query = "SELECT * FROM users WHERE email_id='$email'";
    
        // execute query
        $result = mysqli_query($conn,$query);

        // get user from query result
        $userWithEmail = mysqli_num_rows($result);
        // if user already exists with same email address then set error message
        if($userWithEmail > 0){
            $isValid = false;
            $validationMessage = "User already exists with this email";
        
        }else{
            // encrupt password with default algorithm
            $passwordHash = password_hash($password, PASSWORD_DEFAULT); 
            // prepare query to insert user data
                $query = "INSERT INTO users (first_name,last_name,email_id,password) VALUES ('$firstName','$lastName','$email','$passwordHash')";
                // execute query
                    $result = mysqli_query($conn,$query);
                    // if user created successfully, redirect user to login page
                    if($result)
                        {
                            header('Location: ../auth/login.php');
                
                        }else{
                            // set error message
                            $isValid = false;
                            $validationMessage = "User with this email already exists";
                
                    }   
            }
    }
}
?>


<!-- include header -->
<?php include '../common/header.php'; ?>
<section class="section-margin mr-5 ml-5 mb-5">
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center m-5">
            <div class="col-lg-12 col-xl-11">
                <!-- card with corner border -->
                <div class="card text-black" style="border-radius: 25px">
                    <div class="card-body p-md-5">
                        <div class="row justify-content-center">
                            <div class="col-md-12 col-lg-12 col-xl-12 order-2 order-lg-1">
                                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">
                                    Sign up
                                </p>
                                <!-- block to display error message -->
                                <?php
                                if (!$isValid) {
                                    ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo $validationMessage; ?>
                                </div>
                                <?php
                                }
                                ?>
                                <!-- registration form -->
                                <form action="" method="post">
                                    <div class="form-group">
                                        <!-- first name input -->
                                        <label for="firstName">First Name</label>
                                        <input type="text" id="firstName" name="firstName"
                                            class="form-control form-control-lg" required minlength="3" />
                                    </div>
                                    <div class="form-group">
                                        <!-- last name input -->
                                        <label for="lastName">Last Name</label>
                                        <input type="test" id="lastName" name="lastName"
                                            class="form-control form-control-lg" required minlength="3" />
                                    </div>
                                    <div class="form-group">
                                        <!-- email id input -->
                                        <label for="email">Email ID</label>
                                        <input type="email" id="email" name="email" class="form-control form-control-lg"
                                            required />
                                    </div>


                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <!-- password input with regex-->
                                        <input type="password" id="password" name="password"
                                            class="form-control form-control-lg" required minlength="6"
                                            pattern="^(?=.*\d)(?=.*[^\w\d\s])(?=.*[a-zA-Z]).{6,12}$" />
                                        <!-- password help text -->
                                        <small id="passwordHelp" class="form-text text-muted">Password should be between
                                            6 to 12 characters with atleast one digit and one special characters</small>
                                    </div>
                                    <div class="form-group">
                                        <!-- confirm password input -->
                                        <label for="confirmPassword">Confirm Password</label>
                                        <input type="password" id="confirmPassword" name="confirmPassword"
                                            class="form-control form-control-lg" required minlength="6" />
                                    </div>

                                    <div class="form-group d-flex justify-content-center p-2">
                                        <!-- submit button -->
                                        <input type="submit" value="Register" class="btn btn-info btn-lg " />
                                        <!-- cancel button - redirect to home page -->
                                        <input type="button" value="Cancel" class="btn btn-warning btn-lg ml-2"
                                            onClick="document.location.href='../home/index.php'" />
                                    </div>
                                </form>
                                <!-- ask for already have an account -->
                                <div class="mt-3 text-center">
                                    Already have an account?
                                    <a href="../auth/login.php">Login here</a>
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