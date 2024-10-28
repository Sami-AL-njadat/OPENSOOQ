<?php
session_start();

// Initialize the users array in session if not set
if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = [];
}

// Process the form submission to add a user
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_user'])) {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $age = (int)($_POST['age'] ?? 0);

    if ($name && $email && $age) {
        $_SESSION['users'][] = [
            'name' => $name,
            'email' => $email,
            'age' => $age,
        ];
    }
}

// Process the form submission to delete a user
if (isset($_POST['delete_user'])) {
    $deleteIndex = (int)$_POST['delete_index'];
    if (isset($_SESSION['users'][$deleteIndex])) {
        unset($_SESSION['users'][$deleteIndex]);
        $_SESSION['users'] = array_values($_SESSION['users']); // Reindex array
    }
}

// Handle the filtering
$filteredUsers = [];
$filterAge = null;
$filterName = '';

if (isset($_POST['show_users'])) {
    $filterAge = (int)$_POST['filter_age'];
    $filterName = $_POST['filter_name'];

    $filteredUsers = array_filter($_SESSION['users'], function ($user) use ($filterAge, $filterName) {
        $ageCondition = $filterAge ? $user['age'] > $filterAge : true;
        $nameCondition = $filterName ? stripos($user['name'], $filterName) !== false : true;
        return $ageCondition && $nameCondition;
    });

    // Sort the filtered array by name
    usort($filteredUsers, function ($a, $b) {
        return strcmp($a['name'], $b['name']);
    });
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">User Management System</h1>

        <!-- Form to add users -->
        <form method="post" class="mb-4">
            <h2>Add User</h2>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="form-group">
                <label for="age">Age:</label>
                <input type="number" class="form-control" name="age" required min="0" max="100">
            </div>
            <button type="submit" class="btn btn-primary" name="add_user">Add User</button>
        </form>

        <hr>

        <!-- Filter Users Form -->
        <h2>Filter Users</h2>
        <form method="post" class="mb-4">
            <div class="form-group">
                <label for="filter_name">Filter by Name:</label>
                <input type="text" class="form-control" name="filter_name" value="<?= htmlspecialchars($filterName) ?>">
            </div>
            <div class="form-group">
                <label for="filter_age">Filter by Age (over):</label>
                <input type="number" class="form-control" name="filter_age" value="<?= htmlspecialchars($filterAge) ?>" min="0">
            </div>
            <button type="submit" class="btn btn-secondary" name="show_users">Show Users</button>
        </form>

        <!-- Output all users -->
        <h2>All Users</h2>
        <ul class="list-group mb-4">
            <?php foreach ($_SESSION['users'] as $index => $user): ?>
                <li class="list-group-item">
                    Name: <?= htmlspecialchars($user['name']) ?>, Email: <?= htmlspecialchars($user['email']) ?>, Age: <?= htmlspecialchars($user['age']) ?>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="delete_index" value="<?= $index ?>">
                        <button type="submit" class="btn btn-danger btn-sm" name="delete_user">Delete</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>

        <!-- Output the filtered and sorted users -->
        <?php if (!empty($filteredUsers)): ?>
            <h2>Filtered Users</h2>
            <ul class="list-group">
                <?php foreach ($filteredUsers as $index => $user): ?>
                    <li class="list-group-item">
                        Name: <?= htmlspecialchars($user['name']) ?>, Email: <?= htmlspecialchars($user['email']) ?>, Age: <?= htmlspecialchars($user['age']) ?>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="delete_index" value="<?= array_search($user, $_SESSION['users']) ?>">
                            <button type="submit" class="btn btn-danger btn-sm" name="delete_user">Delete</button>
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['show_users'])): ?>
            <h2>No users found based on your criteria.</h2>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html> 