<?php
session_start();
include("includes/db.php");

$msg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM voters WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($res->num_rows === 1) {
        $voter = $res->fetch_assoc();
        if (password_verify($password, $voter["password"])) {
            $_SESSION["voter_id"] = $voter["id"];
            $_SESSION["name"] = $voter["name"];
            header("Location: dashboard.php");
            exit;
        } else {
            $msg = "Invalid password!";
        }
    } else {
        $msg = "No account found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Voting System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4">Voter Login</h2>
    <?php if ($msg) echo "<div class='alert alert-danger'>$msg</div>"; ?>
    <form method="post">
        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" required class="form-control">
        </div>
        <div class="mb-3">
            <label>Password:</label>
            <input type="password" name="password" required class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Login</button>
        <a href="index.php" class="btn btn-secondary">Back</a>
    </form>
</div>
</body>
</html>
