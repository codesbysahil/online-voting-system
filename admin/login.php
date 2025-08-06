<?php
session_start();
include("../includes/db.php");

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows === 1) {
        $admin = $res->fetch_assoc();
        // NO HASHING
        if ($password === $admin["password"]) {
            $_SESSION["admin_logged_in"] = true;
            $_SESSION["admin_username"] = $admin["username"];
            header("Location: dashboard.php");
            exit;
        } else {
            $msg = "❌ Incorrect password!";
        }
    } else {
        $msg = "❌ Admin not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login - Voting System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5" style="max-width: 500px;">
    <h2 class="mb-4 text-center">🔐 Admin Login</h2>
    
    <?php if ($msg): ?>
        <div class="alert alert-danger text-center"><?= $msg ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label for="username" class="form-label">Username:</label>
            <input type="text" name="username" id="username" required class="form-control">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" name="password" id="password" required class="form-control">
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-success">Login</button>
            <a href="../index.php" class="btn btn-secondary mt-2">Back</a>
        </div>
    </form>
</div>
</body>
</html>
