<?php include("../includes/admin_auth.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Welcome Admin</h2>
    <a href="add_candidate.php" class="btn btn-primary my-2">Add Candidate</a>
    <a href="view_votes.php" class="btn btn-info my-2">View Votes</a>
    <a href="manage_voters.php" class="btn btn-warning my-2">Manage Voters</a>
    <a href="logout.php" class="btn btn-danger my-2">Logout</a>
</div>
</body>
</html>
