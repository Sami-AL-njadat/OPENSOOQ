<?php
session_start();
error_reporting(0);

include_once("../includes/config.php");
include_once("../includes/function.php");
?>

<!doctype html>
<html lang="en">

<head>
    <title>Book Manager</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">

</head>

<body>
    <div class="container mt-5">
        <h2>Book Manager</h2>

        <?php
        if (isset($_SESSION['message'])) {
            echo '<div class="alert ' . $_SESSION['message_type'] . '">' . $_SESSION['message'] . '</div>';
            unset($_SESSION['message']);
        }
        ?>

        <form action="../includes/function.php" method="POST">
            <input type="hidden" name="id" id="bookId">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" required>
            </div>
            <div class="form-group">
                <label for="author">Author</label>
                <input type="text" class="form-control" name="author" required>
            </div>
            <div class="form-group">
                <label for="published_date">Published Date</label>
                <input type="date" class="form-control" name="published_date" required>
            </div>
            <button type="submit" class="btn btn-primary" name="add_book">Add Book</button>
            <button type="submit" class="btn btn-warning" name="update_book" style="display:none;">Update Book</button>
        </form>

        <h3 class="mt-4">Books List</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Published Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($books)): ?>
                    <tr>
                        <td colspan="5" class="text-center">No books found.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($books as $index => $book): ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo $book['title']; ?></td>
                            <td><?php echo $book['author']; ?></td>
                            <td><?php echo $book['published_date']; ?></td>
                            <td>
                                <a href="#" class="btn btn-info" onclick="editBook(<?php echo $book['id']; ?>, '<?php echo $book['title']; ?>', '<?php echo $book['author']; ?>', '<?php echo $book['published_date']; ?>')">Edit</a>
                                <a href="book_crud.php?delete=<?php echo $book['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                <?php endif; ?>
            </tbody>
        </table>

    </div>

    <script>
        function editBook(id, title, author, published_date) {
            document.getElementById('bookId').value = id;
            document.querySelector('input[name="title"]').value = title;
            document.querySelector('input[name="author"]').value = author;
            document.querySelector('input[name="published_date"]').value = published_date;

            document.querySelector('button[name="add_book"]').style.display = 'none';
            document.querySelector('button[name="update_book"]').style.display = 'block';
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>