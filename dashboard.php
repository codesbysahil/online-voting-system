<?php
session_start();
include("includes/db.php");

if (!isset($_SESSION["voter_id"])) {
    header("Location: login.php");
    exit;
}

$voter_id = $_SESSION["voter_id"];
$result = $conn->query("SELECT has_voted FROM voters WHERE id = $voter_id");
$row = $result->fetch_assoc();
$has_voted = $row["has_voted"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Voting System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4">Hello, <?= $_SESSION["name"] ?></h2>
    
    <?php if ($has_voted): ?>
        <div class="alert alert-success">You have already voted. Thank you!</div>
        <a href="result.php" class="btn btn-info">View Results</a>
    <?php else: ?>
        <div class="alert alert-warning">You have not voted yet.</div>
        <a href="vote.php" class="btn btn-primary">Cast Your Vote</a>
    <?php endif; ?>

    <a href="logout.php" class="btn btn-danger mt-3">Logout</a>
</div>
</body>
</html>
