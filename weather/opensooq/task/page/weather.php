<?php
session_start();
error_reporting(0);
?>
<?php include_once("../layout/header.php"); ?>

<body class="d-flex flex-column min-vh-100">
    <?php include_once("../layout/nav.php"); ?>

    <div class="container mt-5 form-container weather">
        <h2 class="mt-3">See The Weather Today</h2>


        <form action="../includes/weather_function.php" method="post" class="weather-form mx-auto mt-4 p-4 mb-3  rounded shadow">
            <div class="form-group mb-3">
                <label for="city" class="form-label">City Name</label>
                <input placeholder="Enter a city name (e.g., Amman)" type="text" class="form-control" name="city" id="city">
            </div>
            <button type="submit" class="btn btn-primary w-100" name="weather">
                <i class="fas fa-search"></i> Search
            </button>
        </form>

        <?php
        if (isset($_SESSION['weatherOutput'])) {
            echo $_SESSION['weatherOutput'];
            unset($_SESSION['weatherOutput']);
        }
        ?>
    </div>

    <?php @include_once("../layout/footer.php"); ?>