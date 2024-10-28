<!doctype html>
<html lang="en">

<head>
    <title>Basic Calculator</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/simple_form.css">

    <style>
        .result-box {
            padding: 10px;
            border: 1px solid #007bff;
            background-color: #f8f9fa;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <div class="container form-container">
        <h2>Simple Calculator</h2>
        <form action="" method="post">
            <div class="form-row align-items-center">
                <div class="col-auto">
                    <input type="number" min="0"  class="form-control mb-2" name="number1" id="number1" placeholder="First Number" required>
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
                    <button type="submit" class="btn btn-primary mb-2">Calculate</button>
                </div>
            </div>
        </form>

        <?php
        session_start();

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

    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>