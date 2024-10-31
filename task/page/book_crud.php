<?php
session_start();
error_reporting(0); 

include_once("../includes/config.php");
include_once("../includes/function.php");
include_once("../includes/auth.php");
?>

<?php include_once("../layout/header.php"); ?>

<body class="d-flex flex-column min-vh-100">
    <?php include_once("../layout/nav.php"); ?>
    <div class="container mt-5 form-container books">
        <h2>Book Manager</h2>

        <?php
        if (isset($_SESSION['message'])) {
            echo '<div class="alert ' . $_SESSION['message_type'] . '">' . $_SESSION['message'] . '</div>';
            unset($_SESSION['message']);
        }
        ?>
 

        <form class="shadow p-4" action="../includes/function.php" method="POST">
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

        <h2 class="mt-4">Books List</h2>
        <table class="table table-bordered shadow p-4">
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
    <?php include_once("../layout/footer.php"); ?>