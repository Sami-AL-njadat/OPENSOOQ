<?php
session_start();
include_once("./config.php");

if (isset($_POST['add_user'])) {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);

    // Validate email format using regex
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = "Invalid email format.";
        $_SESSION['message_type'] = "alert-danger";
        header("Location: ../page/simple_form.php");
        exit();
    }

    // Check if email is unique
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

    // Prepare to insert into the database
    $sql = "INSERT INTO simple_form (name, email) VALUES (:name, :email)";
    $query = $dbh->prepare($sql);

    // Bind parameters
    $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);

    // Execute query and check for success
    if ($query->execute()) {
        $_SESSION['message'] = "User '$name' added successfully."; // Use name instead of ID
        $_SESSION['message_type'] = "alert-success";
    } else {
        $_SESSION['message'] = "Error adding user.";
        $_SESSION['message_type'] = "alert-danger";
    }

    // Redirect back to the form page
    header("Location: ../page/simple_form.php");
    exit();
}




// Fetch books from the database function
function fetchBooks($dbh)
{
    $sql = "SELECT * FROM books";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fetch the books list at the start
$books = []; // Initialize the variable to an empty array
try {
    $books = fetchBooks($dbh);
} catch (PDOException $e) {
    $_SESSION['message'] = "Error fetching books: " . $e->getMessage();
    $_SESSION['message_type'] = "alert-danger";
}

// Add a new book
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
        // Fetch updated book list after addition
        $books = fetchBooks($dbh);
    } else {
        $_SESSION['message'] = "Error adding book.";
        $_SESSION['message_type'] = "alert-danger";
    }
    header("Location: ../page/book_crud.php");
    exit();
}

// Update a book
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
        // Fetch updated book list after update
        $books = fetchBooks($dbh);
    } else {
        $_SESSION['message'] = "Error updating book.";
        $_SESSION['message_type'] = "alert-danger";
    }
    header("Location: ../page/book_crud.php");
    exit();
}

// Delete a book
if (isset($_GET['delete'])) {
    $id = htmlspecialchars($_GET['delete']);
    $sql = "DELETE FROM books WHERE id = :id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_INT);

    if ($query->execute()) {
        $_SESSION['message'] = "Book deleted successfully.";
        $_SESSION['message_type'] = "alert-success";
        // Fetch updated book list after deletion
        $books = fetchBooks($dbh);
    } else {
        $_SESSION['message'] = "Error deleting book.";
        $_SESSION['message_type'] = "alert-danger";
    }
    header("Location: ../page/book_crud.php");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contactUs'])) {
    // Get form data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    // Initialize validation variables
    $errors = [];

    // Server-side validation
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

    // If there are errors, set them in session and redirect back to the form
    if (!empty($errors)) {
        $_SESSION['message'] = implode('<br>', $errors);
        $_SESSION['message_type'] = 'alert alert-danger';
        header("Location: ../page/contact_form.php"); // Update with your form page path
        exit();
    }

    // If validation passes, set success message and redirect
    $_SESSION['message'] = "Your message has been sent successfully!";
    $_SESSION['message_type'] = 'alert alert-success';

    // Redirect to form page
    header("Location: ../page/contact_form.php"); // Update with your form page path
    exit();
}

 
?>
 