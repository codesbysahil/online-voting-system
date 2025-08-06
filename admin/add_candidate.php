<?php
include("../includes/admin_auth.php");
include("../includes/db.php");

$msg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $party = $_POST["party"];

    $stmt = $conn->prepare("INSERT INTO candidates (name, party) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $party);

    if ($stmt->execute()) {
        $msg = "Candidate added successfully!";
    } else {
        $msg = "Error adding candidate!";
    }
}

// Delete candidate
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    // Check if the candidate has votes
    $check = $conn->prepare("SELECT COUNT(*) as vote_count FROM votes WHERE candidate_id = ?");
    $check->bind_param("i", $id);
    $check->execute();
    $res = $check->get_result()->fetch_assoc();

    if ($res['vote_count'] > 0) {
        echo "<div class='alert alert-danger'>Cannot delete. This candidate has received votes.</div>";
    } else {
        $stmt = $conn->prepare("DELETE FROM candidates WHERE id = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>Candidate deleted successfully.</div>";
        } else {
            echo "<div class='alert alert-danger'>Error deleting candidate.</div>";
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Candidate</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Add New Candidate</h2>
    <?php if ($msg) echo "<div class='alert alert-info'>$msg</div>"; ?>
    <div class="card">
        <form method="post">
        <div class="mb-3">
            <label>Candidate Name:</label>
            <input type="text" name="name" required class="form-control">
        </div>
        <div class="mb-3">
            <label>Party:</label>
            <input type="text" name="party" required class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Add Candidate</button>
        <a href="dashboard.php" class="btn btn-secondary">Back</a>
    </form>
    </div>

    <h4 class="mt-5">Existing Candidates</h4>
    <div class="card">
        
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Party</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $conn->query("SELECT * FROM candidates");
            while ($row = $result->fetch_assoc()):
            ?>
                <tr>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['party']) ?></td>
                    <td>
                        <a href="add_candidate.php?delete=<?= $row['id'] ?>" 
                        onclick="return confirm('Are you sure you want to delete this candidate?')" 
                        class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    </div>
</div>
</body>
</html>
