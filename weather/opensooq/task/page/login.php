<?php
include_once("../includes/function.php");
?>
 <?php
include_once("../layout/header.php");
?>
<body>
<?php
include_once("../layout/nav.php");
?>
<div class="container mt-5 form-container">
    <h2 class="mt-3">Welcome</h2>
    
    <form action="" method="post"> <!-- Submit to the same page -->
        <div class="form-group">
            <label for="city">City Name</label>
            <input col="5" placeholder="Enter a city name (e.g., Amman)" type="text" class="form-control" name="city" id="city" required>
        </div>

        <div class="form-group">
            <label for="city">City Name</label>
            <input  placeholder="Enter a city name (e.g., Amman)" type="text" class="form-control" name="city" id="city" required>
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