<?php
// is logged in flag to display login and logout button
$isLoggedIn = false;
// check if session is set
if(isset($_SESSION['userId'])){
    // enable is login flag
    $isLoggedIn = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 shrink-to-fit=no">
    <title>Conestoga Blog</title>
    <!-- import external css -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- import bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />
    <!-- import box icon css -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
</head>

<body>
    <!-- navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-info fixed-top">
        <!-- website name -->
        <a class="navbar-brand nav-text text-white" href="#">Conestoga Blog</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <!-- home page navigation -->
                    <a class="nav-link text-white" href="../home/index.php">Home <span
                            class="sr-only">(current)</span></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">

                <!-- if user is logged in then display my blog and logout button -->
                <?php if($isLoggedIn){ ?>

                <li class="nav-item">
                    <a class="nav-link text-white" href="../posts/myPosts.php">My Blogs</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white" href="../auth/logout.php">Logout</a>
                </li>
                <?php } ?>
                <!-- if user is not logged in then display login button -->
                <?php if(!$isLoggedIn){ ?>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../auth/login.php">Login</a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </nav>