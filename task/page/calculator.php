 <?php
session_start();
include_once("../layout/header.php");
?>

 <body class="d-flex flex-column min-vh-100">
     <?php
        include_once("../layout/nav.php");
        ?>
     <div class="container form-container">
         <h2 mt-2>Simple Calculator</h2>
         <form action="" method="post">
             <div class="form-row align-items-center mt-3">
                 <div class="col-auto">
                     <input type="number" min="0" class="form-control mb-2" name="number1" id="number1" placeholder="First Number" required>
                 </div>
                 <div class="col-auto">
                     <select class="form-control mb-2" name="operation" id="operation" required>
                         <option value="+">+</option>
                         <option value="-">-</option>
                         <option value="*">*</option>
                         <option value="/">/</option>
                     </select>
                 </div>
                 <div class="col-auto">
                     <input type="number" min="0" class="form-control mb-2" name="number2" id="number2" placeholder="Second Number" required>
                 </div>
                 <div class="col-auto">

                     <button type="submit" class="btn btn-primary mb-2">
                         <i class="fa-solid fa-equals"> </i>

                     </button>
                 </div>
             </div>
         </form>

         <?php

            // Check if form was submitted
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Get the numbers and operation from the form
                $number1 = $_POST['number1'];
                $number2 = $_POST['number2'];
                $operation = $_POST['operation'];
                $result = '';

                // Perform the calculation
                switch ($operation) {
                    case '+':
                        $result = $number1 + $number2;
                        break;
                    case '-':
                        $result = $number1 - $number2;
                        break;
                    case '*':
                        $result = $number1 * $number2;
                        break;
                    case '/':
                        // Handle division by zero
                        if ($number2 == 0) {
                            $result = 'Error: Division by zero is not allowed.';
                        } else {
                            $result = $number1 / $number2;
                        }
                        break;
                    default:
                        $result = 'Invalid operation.';
                        break;
                }

                // Store the result in a session variable
                $_SESSION['result'] = $result;

                // Redirect to the same page to prevent form resubmission
                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
            }

            // Display the result if it exists
            if (isset($_SESSION['result'])) {
                echo '<div class="result-box">Result: <strong>' . htmlspecialchars($_SESSION['result']) . '</strong></div>';
                // Unset the result after displaying it
                unset($_SESSION['result']);
            }
            ?>

     </div>

     <?php
        @include_once("../layout/footer.php")
        ?>