<?php
session_start();
include("includes/db.php");

if (!isset($_SESSION["voter_id"])) {
    header("Location: login.php");
    exit;
}

$voter_id = $_SESSION["voter_id"];
$check = $conn->query("SELECT has_voted FROM voters WHERE id = $voter_id")->fetch_assoc();
if ($check["has_voted"]) {
    header("Location: dashboard.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $candidate_id = $_POST["candidate"];
    $conn->query("UPDATE candidates SET votes = votes + 1 WHERE id = $candidate_id");
    $conn->query("UPDATE voters SET has_voted = 1 WHERE id = $voter_id");
    header("Location: dashboard.php");
    exit;
}

$candidates = $conn->query("SELECT * FROM candidates");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vote - Voting System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4">Select Your Candidate</h2>
    <form method="post">
        <?php while ($row = $candidates->fetch_assoc()): ?>
            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="candidate" value="<?= $row['id'] ?>" required>
                <label class="form-check-label">
                    <?= $row['name'] ?> (<?= $row['party'] ?>)
                </label>
            </div>
        <?php endwhile; ?>
        <button type="submit" class="btn btn-primary mt-3">Submit Vote</button>
    </form>
</div>
</body>
</html>
