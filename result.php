<?php
include("includes/db.php");
$candidates = $conn->query("SELECT * FROM candidates ORDER BY votes DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Results - Voting System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4">Voting Results</h2>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Candidate</th>
                <th>Party</th>
                <th>Votes</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $candidates->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['party'] ?></td>
                    <td><?= $row['votes'] ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
</div>
</body>
</html>
