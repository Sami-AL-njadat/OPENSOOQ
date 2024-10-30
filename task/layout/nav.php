<div class="container">
    <div class="navbar navbar-light d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-bottom">
        <a class="navbar-brand d-flex align-items-center" href="../home.php">
            <img src="../image/osLogoSquare.svg" width="60" height="60" class="d-inline-block align-top mr-2" alt="OpenSooq Logo">
            <span style="font-size: 1.5rem; font-weight: bold;">opensooq</span>
        </a>
        <div>
            <?php
            $currentPage = basename($_SERVER['PHP_SELF']);

            if ($currentPage !== 'login.php') {
                if (isset($_SESSION['userlogin'])): ?>
                    <div class="row" style="gap: 5px;">

                        <a href="<?php echo dirname($_SERVER['PHP_SELF']) . '/../home.php'; ?>"
                            class="btn btn-success  btn-custom">Home</a>
                        <a href="<?php echo dirname($_SERVER['PHP_SELF']) . '/../includes/logout.php'; ?>"
                            class="btn btn-danger btn-custom">Logout</a>
                    </div>
                <?php else: ?>
                    <div class="row" style="gap: 5px;">

                        <a href="<?php echo dirname($_SERVER['PHP_SELF']) . '/../home.php'; ?>"
                            class="btn btn-success  btn-custom">Home</a>
                        <a href="<?php echo dirname($_SERVER['PHP_SELF']) . '/../page/login.php'; ?>"
                            class="btn btn-primary btn-custom">Login</a>

                    </div>

            <?php endif;
            }
            ?>

        </div>
    </div>
</div>