 <?php
    include_once("../layout/header.php");
    ?>

 <body class="d-flex flex-column min-vh-100">
     <?php
        include_once("../layout/nav.php");
        ?>

     <div class="container form-container contact">
         <h2>Contact Us</h2>

         <?php
            session_start();
            if (isset($_SESSION['message'])) {
                echo '<div class="alert error-message' . $_SESSION['message_type'] . '">' . $_SESSION['message'] . '</div>';
                unset($_SESSION['message']);
                unset($_SESSION['message_type']);
            }
            ?>


         <form action="../includes/function.php" method="post">
             <div class="form-group">
                 <label for="name">Name</label>
                 <input type="text" class="form-control" name="name" placeholder="Enter your name (e.g., john)" id="name">
             </div>
             <div class="form-group">
                 <label for="email">Email</label>
                 <input placeholder="Enter your Email (e.g., john@example.com)" type="email" class="form-control" name="email" id="email" required  >
             </div>
             <div class="form-group">
                 <label for="message">Message</label>
                 <textarea placeholder="Type your message here" class="form-control" name="message" id="message"></textarea>
             </div>
             <button type="submit" class="btn btn-primary w-100" name="contactUs"><i class="fa-regular fa-paper-plane"></i> Send</button>
         </form>
     </div>


     <?php
        @include_once("../layout/footer.php")
        ?>