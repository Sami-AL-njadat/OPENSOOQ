<?php
$users = [
    ['name' => 'Sami',   'email' => 'Sami@example.com', 'age' => 29, 'phone' => '555-0123', 'city' => 'Ajloun'],
    ['name' => 'Malek',   'email' => 'Malek@example.com', 'age' => 30, 'phone' => '555-0456', 'city' => 'hofa-elwestya'],
    ['name' => 'Ali',   'email' => 'ali@example.com', 'age' => 10, 'phone' => '555-0789', 'city' => 'Amman'],
    ['name' => 'Sara',   'email' => 'sara@example.com', 'age' => 28, 'phone' => '555-1011', 'city' => 'Amman'],
    ['name' => 'Mahmmod',   'email' => 'Mahmmod@example.com', 'age' => 35, 'phone' => '555-1213', 'city' => 'Irbid'],
    ['name' => 'Aisha',   'email' => 'aisha@example.com', 'age' => 32, 'phone' => '555-1415', 'city' => 'Zrqa'],
    ['name' => 'Omar',   'email' => 'omar@example.com', 'age' => 22, 'phone' => '555-1617', 'city' => 'Maan'],
    ['name' => 'Reem',  'email' => 'reem@example.com', 'age' => 27, 'phone' => '555-1819', 'city' => 'karak'],
    ['name' => 'Serren', 'email' => 'Serren@example.com', 'age' => 44, 'phone' => '555-2021', 'city' => 'Aqaba'],
    ['name' => 'Marwa',  'email' => 'Marwa@example.com', 'age' => 50, 'phone' => '555-2223', 'city' => 'Jarash'],
    ['name' => 'Tariq', 'email' => 'tareq@example.com', 'age' => 65, 'phone' => '555-2425', 'city' => 'Houson'],
    ['name' => 'Salam', 'email' => 'Salam@example.com', 'age' => 78, 'phone' => '555-2627', 'city' => 'Ajloun'],
    ['name' => 'Youssef', 'email' => 'youssef@example.com', 'age' => 75, 'phone' => '555-2829', 'city' => 'Zrqa'],
    ['name' => 'Dana', 'email' => 'Dana@example.com', 'age' => 92, 'phone' => '555-2627', 'city' => 'Ajloun'],
    ['name' => 'Taqwa', 'email' => 'Taqwa@example.com', 'age' => 80, 'phone' => '555-2627', 'city' => 'Ajloun'],

];

$filteredUsers = $users;
$filterAge = 18;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['show_users'])) {
    $filterAge = (int)$_POST['filter_age'] ?? $filterAge;

    $filteredUsers = array_filter($users, function ($user) use ($filterAge) {
        return $user['age'] > $filterAge;
    });

    usort($filteredUsers, function ($a, $b) {
        return strcmp($a['name'], $b['name']);
    });

    session_start();
    $_SESSION['filteredUsers'] = $filteredUsers;
    $_SESSION['filterAge'] = $filterAge;

    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

session_start();
$filteredUsers = $_SESSION['filteredUsers'] ?? $users;
$filterAge = $_SESSION['filterAge'] ?? 18;
?>

<?php include_once("../layout/header.php"); ?>

<body class="d-flex flex-column min-vh-100">
    <?php include_once("../layout/nav.php"); ?>
    <div class="container mt-5 form-container" id="manipulation">

        <h1 class="text-center">User Management System</h1>

        <!-- Filter Users Form -->
        <h2>Filter Users by Age</h2>
        <form method="post" class="mb-4 text-center shadow p-4">
            <div class="form-group">
                <label for="filter_age">Show users older than:</label>
                <input type="number" class="form-control w-50 mx-auto shadow" style="text-align: center;   border-radius: 10px;
" name="filter_age" value="<?= htmlspecialchars($filterAge) ?>" min="0" max="99">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-secondary w-40 mx-auto" name="show_users">Filter Users</button>
            </div>
        </form>


        <h2>Users</h2>
        <?php if (!empty($filteredUsers)): ?>
            <div class="user-list">
                <?php foreach ($filteredUsers as $user): ?>
                    <div class="user-item card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Name: <?= htmlspecialchars($user['name']) ?></h5>
                            <p class="card-text">
                                <strong>Email:</strong> <?= htmlspecialchars($user['email']) ?><br>
                                <strong>Age:</strong> <?= htmlspecialchars($user['age']) ?><br>
                                <strong>Phone:</strong> <?= htmlspecialchars($user['phone']) ?><br>
                                <strong>City:</strong> <?= htmlspecialchars($user['city']) ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="alert alert-warning">No users found based on your criteria.</p>
        <?php endif; ?>


    </div>

    <?php include_once("../layout/footer.php"); ?>