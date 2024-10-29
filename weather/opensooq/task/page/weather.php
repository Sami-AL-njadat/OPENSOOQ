<?php
include_once("../includes/weather_function.php");
?>
 <?php
include_once("../layout/header.php");
?>
<body class="d-flex flex-column min-vh-100">
<?php
include_once("../layout/nav.php");
?>
<div class="container mt-5 form-container">
    <h2 class="mt-3">Get the Weather Today</h2>
    <p class="mt-3">
        Enter your city name here and get the weather for a today .
    </p>

    <form action="" method="post"> <!-- Submit to the same page -->
        <div class="form-group">
            <label for="city">City Name</label>
            <input  placeholder="Enter a city name (e.g., Amman)" type="text" class="form-control" name="city" id="city" >
        </div>
        <button type="submit" class="btn btn-primary" name="weather">Submit</button>
    </form>

    <?php
     echo $weatherOutput; 
    ?>
</div>
<?php 
@include_once("../layout/footer.php")
?>