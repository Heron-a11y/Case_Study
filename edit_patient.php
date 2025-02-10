<?php
include 'db.php';

// Check if the update button was clicked
if (isset($_POST['update'])) {
    $Patient_id = $_POST['Patient_id'];
    $Patient_name = mysqli_real_escape_string($conn, $_POST['Patient_name']);
    $Date_of_Service = $_POST['Date_of_Service'];
    $Client_Report = mysqli_real_escape_string($conn, $_POST['Client_Report']);
    $Observation_Findings = mysqli_real_escape_string($conn, $_POST['Observation_Findings']);
    $Clinical_Evaluation = mysqli_real_escape_string($conn, $_POST['Clinical_Evaluation']);
    $Treatment_Strategy = mysqli_real_escape_string($conn, $_POST['Treatment_Strategy']);
    $status = $_POST['status'];

    // Update query
    $query = "UPDATE patients SET 
              Patient_name='$Patient_name', 
              Date_of_Service='$Date_of_Service', 
              Client_Report='$Client_Report',
              Observation_Findings='$Observation_Findings',
              Clinical_Evaluation='$Clinical_Evaluation',
              Treatment_Strategy='$Treatment_Strategy',
              status='$status' 
              WHERE Patient_id='$Patient_id'";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Patient updated successfully!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error updating patient!');</script>";
    }
}

// Fetch patient data for the edit form
if (isset($_GET['id'])) {
    $Patient_id = $_GET['id'];
    $query = "SELECT * FROM patients WHERE Patient_id='$Patient_id'";
    $result = mysqli_query($conn, $query);
    $patient = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Patient</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0 text-center">Edit Patient Case</h2>
            </div>
            <div class="card-body">
                <form method="POST" action="edit_patient.php">
                    <input type="hidden" name="Patient_id" value="<?php echo $patient['Patient_id']; ?>">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="Patient_name" class="form-label fw-bold">Patient Name:</label>
                            <input type="text" class="form-control" id="Patient_name" name="Patient_name" value="<?php echo htmlspecialchars($patient['Patient_name']); ?>" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="Date_of_Service" class="form-label fw-bold">Date of Service:</label>
                            <input type="date" class="form-control" id="Date_of_Service" name="Date_of_Service" value="<?php echo $patient['Date_of_Service']; ?>" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="Client_Report" class="form-label fw-bold">Client Report:</label>
                        <textarea class="form-control" id="Client_Report" name="Client_Report" rows="3" required><?php echo htmlspecialchars($patient['Client_Report']); ?></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="Observation_Findings" class="form-label fw-bold">Observation & Findings:</label>
                            <textarea class="form-control" id="Observation_Findings" name="Observation_Findings" rows="3" required><?php echo htmlspecialchars($patient['Observation_Findings']); ?></textarea>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="Clinical_Evaluation" class="form-label fw-bold">Clinical Evaluation:</label>
                            <textarea class="form-control" id="Clinical_Evaluation" name="Clinical_Evaluation" rows="3" required><?php echo htmlspecialchars($patient['Clinical_Evaluation']); ?></textarea>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="Treatment_Strategy" class="form-label fw-bold">Treatment Strategy:</label>
                        <textarea class="form-control" id="Treatment_Strategy" name="Treatment_Strategy" rows="3" required><?php echo htmlspecialchars($patient['Treatment_Strategy']); ?></textarea>
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select" id="status" name="status" required>
                            <option value="Critical" <?php if ($patient['status'] == 'Critical') echo 'selected'; ?>>Critical</option>
                            <option value="Under Treatment" <?php if ($patient['status'] == 'Under Treatment') echo 'selected'; ?>>Under Treatment</option>
                            <option value="Stable" <?php if ($patient['status'] == 'Stable') echo 'selected'; ?>>Stable</option>
                            <option value="Recovered" <?php if ($patient['status'] == 'Recovered') echo 'selected'; ?>>Recovered</option>
                        </select>
                        <label for="status">Status</label>
                    </div>

                    <div class="text-center">
                        <button type="submit" name="update" class="btn btn-success px-4">Save</button>
                        <a href="index.php" class="btn btn-secondary px-4">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
