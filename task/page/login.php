<?php
session_start();
error_reporting(0);

 include_once("../includes/login_function.php");

 if (isset($_SESSION['userlogin']) && $_SESSION['userlogin'] === true) {
    header('Location: ../home.php'); 
    exit();
}

 $errorMessage = isset($_SESSION['errorMessage']) ? $_SESSION['errorMessage'] : '';
unset($_SESSION['errorMessage']);  

include_once("../layout/header.php");
?>
<body>
<?php include_once("../layout/nav.php"); ?>
<div class="container mt-5 form-container login">
    <h2 class="text-center mb-4 text-primary">Welcome Back</h2>
    
    <?php if (!empty($errorMessage)): ?>
        <div class="alert alert-danger error-message"><i class='fas fa-exclamation-triangle'></i>  <?= $errorMessage; ?></div>
    <?php endif; ?> 

    <form method="post">  
        <div class="form-group mb-4">
            <label for="email" class="form-label fw-bold">UserName</label>
            <div class="input-group">
                <span class="input-group-text bg-primary text-white"><i class="fas fa-user"></i></span>
                <input type="text" class="form-control" name="email" id="email" placeholder="Enter your UserName"  >
            </div>
        </div>

        <div class="form-group mb-4">
            <label for="password" class="form-label fw-bold">Password</label>
            <div class="input-group">
                <span class="input-group-text bg-primary text-white"><i class="fas fa-lock"></i></span>
                <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password"  >
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary btn-lg w-100 mt-3" name="login">Login</button>
    </form>
</div>

<?php include_once("../layout/footer.php"); ?>
