<?php
include("../includes/admin_auth.php");
include("../includes/db.php");

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM voters WHERE id = $id");
    header("Location: manage_voters.php");
    exit;
}

$voters = $conn->query("SELECT * FROM voters");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Voters</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Registered Voters</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Has Voted?</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($voter = $voters->fetch_assoc()): ?>
                <tr>
                    <td><?= $voter['name'] ?></td>
                    <td><?= $voter['email'] ?></td>
                    <td><?= $voter['has_voted'] ? 'Yes' : 'No' ?></td>
                    <td>
                        <a href="?delete=<?= $voter['id'] ?>" onclick="return confirm('Delete this voter?')" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <a href="dashboard.php" class="btn btn-secondary">Back</a>
</div>
</body>
</html>
