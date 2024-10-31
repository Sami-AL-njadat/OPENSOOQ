    <?php
    session_start();
    $Username = "opensooq";
    $Passwords = "123123";
    $nameofUser = "Sami";

    if (isset($_POST['login'])) {
        $email = htmlspecialchars(trim($_POST['email']));
        $password = htmlspecialchars(trim($_POST['password']));
        $names = htmlspecialchars(trim('john'));
    
        if ($email === $Username && $password === $Passwords) {
            $_SESSION['userlogin'] = true; 
            $_SESSION['username'] = $email; 
            $_SESSION['names'] = $nameofUser; 

            header('Location: ../home.php');
            exit();
        } else {
            $_SESSION['errorMessage'] = "Invalid username or password."; 
            header('Location: ../page/login.php');  
            exit();
        }
    }
    ?>
