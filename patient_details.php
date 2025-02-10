<!-- Gab Jardin -->
<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0">Select Patient ID</h2>
            </div>
            <div class="card-body">
                <form method="GET" action="">
                    <div class="mb-3">
                        <label for="Patient_id" class="form-label fw-bold">Patient ID:</label>
                        <select name="Patient_id" id="Patient_id" class="form-select" required>
                            <option value="">Select Patient</option>
                            <?php
                            $query = "SELECT Patient_id, Patient_name FROM patients";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='{$row['Patient_id']}'>{$row['Patient_id']} - {$row['Patient_name']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">Generate Report</button>
                        <a href="index.php" class="btn btn-secondary">Back</a>
                    </div>
                </form>
            </div>
        </div>

        <?php
        if (isset($_GET['Patient_id'])) {
            $Patient_id = $_GET['Patient_id'];
            $query = "SELECT * FROM patients WHERE Patient_id = '$Patient_id'";
            $result = mysqli_query($conn, $query);
            
            if ($patient = mysqli_fetch_assoc($result)) {
                echo "<div class='card mt-4 shadow-lg'>";
                echo "<div class='card-header bg-success text-white'><h3 class='mb-0'>Patient Summary</h3></div>";
                echo "<div class='card-body'>";
                echo "<p><strong>Patient ID:</strong> {$patient['Patient_id']}</p>";
                echo "<p><strong>Patient Name:</strong> {$patient['Patient_name']}</p>";
                echo "<p><strong>Date of Service:</strong> {$patient['Date_of_Service']}</p>";
                echo "<p><strong>Client Report:</strong> {$patient['Client_Report']}</p>";
                echo "<p><strong>Observation & Findings:</strong> {$patient['Observation_Findings']}</p>";
                echo "<p><strong>Clinical Evaluation:</strong> {$patient['Clinical_Evaluation']}</p>";
                echo "<p><strong>Treatment Strategy:</strong> {$patient['Treatment_Strategy']}</p>";
                echo "<p><strong>Status:</strong> {$patient['status']}</p>";
                echo "</div></div>";
            } else {
                echo "<div class='alert alert-danger mt-4'>No patient found with this ID.</div>";
            }
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
