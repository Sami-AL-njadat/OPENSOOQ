<?php
session_start();
error_reporting(0);

?>
<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">


</head>

<body>
    <div class="container">
        <div class="navbar navbar-light d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-bottom">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="./image/osLogoSquare.svg" width="60" height="60" class="d-inline-block align-top mr-2" alt="OpenSooq Logo">
                <span style="font-size: 1.5rem; font-weight: bold;">opensooq</span>
            </a>
            <div>
                <?php if (isset($_SESSION['userlogin'])): ?>
                    <a href="./includes/logout.php" class="btn btn-danger btn-custom">Logout</a>
                <?php else: ?>
                    <a href="./page/login.php" class="btn btn-primary btn-custom ">Login</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php if (isset($_SESSION['userlogin'])): ?>

        <div class="container mt-5">
            <h2>Welcome, <?= htmlspecialchars($_SESSION['names']); ?>!</h2>
        </div>
    <?php endif; ?>


    <div class="container mt-5 main-container">
        <div class="row">
            <!-- Book Card -->
            <div class="col-sm-4 mb-4">
                <div class="card">
                    <img src="./image/book.png" class="card-img-top" alt="Book Image">
                    <div class="card-body">
                        <h5 class="card-title">

                            <?php if (isset($_SESSION['userlogin'])): ?>
                                <i class="fa-solid fa-lock-open"></i>
                            <?php else: ?>
                                <i class="fa-solid fa-lock"></i>
                            <?php endif; ?>
                            Book
                        </h5>

                        <p class="card-text">Manage your books.</p>
                        <a href="./page/book_crud.php" class="btn btn-primary">

                            Click here</a>
                    </div>
                </div>
            </div>

            <!-- Weather Card -->
            <div class="col-sm-4 mb-4">
                <div class="card">
                    <img src="./image/weather2.png" class="card-img-top" alt="Weather Image">
                    <div class="card-body">
                        <h5 class="card-title">Weather</h5>
                        <p class="card-text">Check today's weather!</p>
                        <a href="./page/weather.php" class="btn btn-primary">Click here</a>
                    </div>
                </div>
            </div>

            <!-- Calculator Card -->
            <div class="col-sm-4 mb-4">
                <div class="card">
                    <img src="./image/calculatoer.png" class="card-img-top" alt="Calculator Image">
                    <div class="card-body">
                        <h5 class="card-title">Calculator</h5>
                        <p class="card-text">Let's do some math.</p>
                        <a href="./page/calculator.php" class="btn btn-primary">Click here</a>
                    </div>
                </div>
            </div>

            <!-- Add User Card -->
            <div class="col-sm-4 mb-4">
                <div class="card">
                    <img src="./image/add.jpg" class="card-img-top" alt="Add User Image">
                    <div class="card-body">
                        <h5 class="card-title">Add User</h5>
                        <p class="card-text">Add a new user.</p>
                        <a href="./page/simple_form.php" class="btn btn-primary">Click here</a>
                    </div>
                </div>
            </div>

            <!-- Contact Us Card -->
            <div class="col-sm-4 mb-4">
                <div class="card">
                    <img src="./image/contact.jpg" class="card-img-top" alt="Contact Us Image">
                    <div class="card-body">
                        <h5 class="card-title">Contact Us</h5>
                        <p class="card-text">Keep in touch with us</p>
                        <a href="./page/contact_form.php" class="btn btn-primary">Click here</a>
                    </div>
                </div>
            </div>

            <!-- Manipulation Card -->
            <div class="col-sm-4 mb-4">
                <div class="card">
                    <img src="./image/manipulation.jpg" class="card-img-top" alt="Manipulation Image">
                    <div class="card-body">
                        <h5 class="card-title">Manipulation</h5>
                        <p class="card-text">Learn array manipulation.</p>
                        <a href="./page/manipulation.php" class="btn btn-primary">Click here</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include_once("./layout/footer.php") ?>
</body>

</html>