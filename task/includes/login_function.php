    <?php
    session_start();
    $Username = "user@opensooq.com";
    $Passwords = "123123";
    $nameofUser = "john";

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
