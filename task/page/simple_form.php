<?php
session_start();
error_reporting(0);

include_once("../includes/config.php");
include_once("../includes/function.php");
?>
<?php
include_once("../layout/header.php");
?>

<body class="d-flex flex-column min-vh-100">

<?php
include_once("../layout/nav.php");
?>
    <div class="container mt-5 mb-5 form-container simple">
            <h2>Add User</h2>

        <?php
        session_start();
        if (isset($_SESSION['message'])) {
            echo '<div class="alert ' . $_SESSION['message_type'] . '">' . $_SESSION['message'] . '</div>';
            unset($_SESSION['message']);
            unset($_SESSION['message_type']);
        }
        ?>


        <form action="../includes/function.php" method="post" id="add_user">
            <div class="form-group">
                <label  for="name">Name</label>
                <input placeholder="Enter name"  type="text" class="form-control" name="name" id="name">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input  type="email" placeholder="Enter email" class="form-control h-100" name="email" id="email">
            </div>
            
            <button type="submit" class="btn btn-primary w-100" name="add_user"><i class="fa-solid fa-plus"></i> Add</button>
        </form>
    </div>

    <?php 
@include_once("../layout/footer.php")
?>