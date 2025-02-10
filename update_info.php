<?php
include 'patient_management.php';
include 'db_connection.php'; // Ensure database connection is included

// Fetch patient data for editing
if (isset($_GET['id'])) {
    $patient_id = $_GET['id'];
    $query = "SELECT * FROM patients WHERE patient_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $patient_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $patient = $result->fetch_assoc();
}

// Update patient information
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_id = $_POST['patient_id'];
    $name = $_POST['name'];
    $date_of_service = $_POST['date_of_service'];
    $subjective = $_POST['subjective'];
    $objective = $_POST['objective'];
    $assessment = $_POST['assessment'];
    $plan = $_POST['plan'];
    $status = $_POST['status'];

    $updateQuery = "UPDATE patients SET name=?, date_of_service=?, subjective=?, objective=?, assessment=?, plan=?, status=? WHERE patient_id=?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("sssssssi", $name, $date_of_service, $subjective, $objective, $assessment, $plan, $status, $patient_id);
    if ($stmt->execute()) {
        echo "<script>alert('Patient information updated successfully.'); window.location.href='admin_dashboard.php';</script>";
    } else {
        echo "<script>alert('Error updating patient information.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Patient Information</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Update Patient Information</h2>
        <form method="POST">
            <input type="hidden" name="patient_id" value="<?php echo $patient['patient_id']; ?>">
            <div class="mb-3">
                <label class="form-label">Patient Name:</label>
                <input type="text" class="form-control" name="name" value="<?php echo $patient['name']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Date of Service:</label>
                <input type="date" class="form-control" name="date_of_service" value="<?php echo $patient['date_of_service']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Client Report:</label>
                <textarea class="form-control" name="subjective" required><?php echo $patient['subjective']; ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Observation & Findings:</label>
                <textarea class="form-control" name="objective" required><?php echo $patient['objective']; ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Clinical Evaluation:</label>
                <textarea class="form-control" name="assessment" required><?php echo $patient['assessment']; ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Treatment Strategy:</label>
                <textarea class="form-control" name="plan" required><?php echo $patient['plan']; ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Status:</label>
                <select class="form-control" name="status" required>
                    <option value="critical" <?php if ($patient['status'] == 'critical') echo 'selected'; ?>>Critical</option>
                    <option value="undertreatment" <?php if ($patient['status'] == 'undertreatment') echo 'selected'; ?>>Under Treatment</option>
                    <option value="stable" <?php if ($patient['status'] == 'stable') echo 'selected'; ?>>Stable</option>
                    <option value="recovered" <?php if ($patient['status'] == 'recovered') echo 'selected'; ?>>Recovered</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Information</button>
            <a href="admin_dashboard.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
