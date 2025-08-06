<?php
include("includes/db.php");

$msg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

    // ✅ Check if email already exists
    $check = $conn->prepare("SELECT id FROM voters WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $msg = "❌ Email already exists! Please use a different email.";
    } else {
        $sql = "INSERT INTO voters (name, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $name, $email, $password);
        
        if ($stmt->execute()) {
            $msg = "✅ Registration successful. <a href='login.php'>Login here</a>";
        } else {
            $msg = "❌ Something went wrong. Try again.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Voting System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4">Voter Registration</h2>
    <?php if ($msg) echo "<div class='alert alert-info'>$msg</div>"; ?>
    <form method="post">
        <div class="mb-3">
            <label>Name:</label>
            <input type="text" name="name" required class="form-control">
        </div>
        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" required class="form-control">
        </div>
        <div class="mb-3">
            <label>Password:</label>
            <input type="password" name="password" required class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
        <a href="index.php" class="btn btn-secondary">Back</a>
    </form>
</div>
</body>
</html>
