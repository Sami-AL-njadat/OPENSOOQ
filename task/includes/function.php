<?php
session_start();
include_once("./config.php");

if (isset($_POST['add_user'])) {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);

     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = "Invalid email format.";
        $_SESSION['message_type'] = "alert-danger";
        header("Location: ../page/simple_form.php");
        exit();
    }

     $checkEmailQuery = "SELECT COUNT(*) FROM simple_form WHERE email = :email";
    $checkEmailStmt = $dbh->prepare($checkEmailQuery);
    $checkEmailStmt->bindParam(':email', $email, PDO::PARAM_STR);
    $checkEmailStmt->execute();
    $emailExists = $checkEmailStmt->fetchColumn();

    if ($emailExists > 0) {
        $_SESSION['message'] = "Email '$email' already exists.";
        $_SESSION['message_type'] = "alert-danger";
        header("Location: ../page/simple_form.php");
        exit();
    }

     $sql = "INSERT INTO simple_form (name, email) VALUES (:name, :email)";
    $query = $dbh->prepare($sql);

     $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);

     if ($query->execute()) {
        $_SESSION['message'] = "User '$name' added successfully.";
        $_SESSION['message_type'] = "alert-success";
    } else {
        $_SESSION['message'] = "Error adding user.";
        $_SESSION['message_type'] = "alert-danger";
    }

     header("Location: ../page/simple_form.php");
    exit();
}




 function fetchBooks($dbh)
{
    $sql = "SELECT * FROM books";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

 $books = [];  
try {
    $books = fetchBooks($dbh);
} catch (PDOException $e) {
    $_SESSION['message'] = "Error fetching books: " . $e->getMessage();
    $_SESSION['message_type'] = "alert-danger";
}

 if (isset($_POST['add_book'])) {
    $title = htmlspecialchars($_POST['title']);
    $author = htmlspecialchars($_POST['author']);
    $published_date = htmlspecialchars($_POST['published_date']);

    $sql = "INSERT INTO books (title, author, published_date) VALUES (:title, :author, :published_date)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':title', $title, PDO::PARAM_STR);
    $query->bindParam(':author', $author, PDO::PARAM_STR);
    $query->bindParam(':published_date', $published_date, PDO::PARAM_STR);

    if ($query->execute()) {
        $_SESSION['message'] = "Book '$title' added successfully.";
        $_SESSION['message_type'] = "alert-success";
         $books = fetchBooks($dbh);
    } else {
        $_SESSION['message'] = "Error adding book.";
        $_SESSION['message_type'] = "alert-danger";
    }
    header("Location: ../page/book_crud.php");
    exit();
}

 if (isset($_POST['update_book'])) {
    $id = htmlspecialchars($_POST['id']);
    $title = htmlspecialchars($_POST['title']);
    $author = htmlspecialchars($_POST['author']);
    $published_date = htmlspecialchars($_POST['published_date']);

    $sql = "UPDATE books SET title = :title, author = :author, published_date = :published_date WHERE id = :id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':title', $title, PDO::PARAM_STR);
    $query->bindParam(':author', $author, PDO::PARAM_STR);
    $query->bindParam(':published_date', $published_date, PDO::PARAM_STR);
    $query->bindParam(':id', $id, PDO::PARAM_INT);

    if ($query->execute()) {
        $_SESSION['message'] = "Book '$title' updated successfully.";
        $_SESSION['message_type'] = "alert-success";
         $books = fetchBooks($dbh);
    } else {
        $_SESSION['message'] = "Error updating book.";
        $_SESSION['message_type'] = "alert-danger";
    }
    header("Location: ../page/book_crud.php");
    exit();
}

 if (isset($_GET['delete'])) {
    $id = htmlspecialchars($_GET['delete']);
    $sql = "DELETE FROM books WHERE id = :id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_INT);

    if ($query->execute()) {
        $_SESSION['message'] = "Book deleted successfully.";
        $_SESSION['message_type'] = "alert-success";
         $books = fetchBooks($dbh);
    } else {
        $_SESSION['message'] = "Error deleting book.";
        $_SESSION['message_type'] = "alert-danger";
    }
    header("Location: ../page/book_crud.php");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contactUs'])) {
     $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

     $errors = [];

     if (empty($name)) {
        $errors[] = "Name is required.";
    }

    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (empty($message)) {
        $errors[] = "Message is required.";
    } elseif (strlen($message) < 10) {
        $errors[] = "Message must be at least 10 characters long.";
    }

     if (!empty($errors)) {
        $_SESSION['message'] = implode('<br>', $errors);
        $_SESSION['message_type'] = 'alert alert-danger';
        header("Location: ../page/contact_form.php");  
        exit();
    }

     $_SESSION['message'] = "Your message has been sent successfully!";
    $_SESSION['message_type'] = 'alert alert-success';
 
    header("Location: ../page/contact_form.php");  
    exit();
}

 
?>
 