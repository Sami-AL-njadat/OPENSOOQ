 <?php
    session_start();
    include_once("../layout/header.php");
    ?>

 <body class="d-flex flex-column min-vh-100">
     <?php
        include_once("../layout/nav.php");
        ?>
     <div class="container mb-5 mt-5 form-container">
         <h2 mt-2>Simple Calculator</h2>
         <form class="p-2" action="" method="post">
             <div class="form align-items-center mt-3">
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

             if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                 $number1 = $_POST['number1'];
                $number2 = $_POST['number2'];
                $operation = $_POST['operation'];
                $result = '';

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

                 $_SESSION['result'] = $result;

                 header("Location: " . $_SERVER['PHP_SELF']);
                exit();
            }

             if (isset($_SESSION['result'])) {
                echo '<div class="result-box">Result: <strong>' . htmlspecialchars($_SESSION['result']) . '</strong></div>';
                 unset($_SESSION['result']);
            }
            ?>

     </div>

     <?php
        include_once("../layout/footer.php")
        ?>