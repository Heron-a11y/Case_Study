<!-- Gab Jardin -->
<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <div class="sidebar">
        <div class="admin-profile">
            <i class="fas fa-user icon"></i>
            <span>Admin Profile</span>
        </div>
        <div class="sidebar-links">
            <a href="patient_details.php">Patient’s Details</a>
            <a href="logout.php" class="btn-logout">Log Out</a>
        </div>
    </div>

    <div class="main-content">
        <header>
            <div class="menu-toggle">
                <i class="fas fa-bars"></i>
            </div>
            Admin Dashboard
        </header>

                <div class="filter-section">
            <div class="filter-options">
                <div>
                    <label for="sortByName">Sort by Name:</label>
                    <select id="sortByName">
                        <option value="asc">A to Z</option>
                        <option value="desc">Z to A</option>
                    </select>
                </div>
                <div>
                    <label for="sortByStatus">Sort by Status:</label>
                    <select id="sortByStatus">
                        <option value="">All Status</option> <!-- ✅ Added to show all patients -->
                        <option value="Critical">Critical</option>
                        <option value="Under Treatment">Under Treatment</option>
                        <option value="Stable">Stable</option>
                        <option value="Recovered">Recovered</option>
                    </select>
                </div>
            </div>

            <div class="btn-container">
                <button class="btn btn-primary" id="addPatientBtn">Add Patient Case</button>
            </div>
        </div>

        <table id="patientTable">
            <tr>
                <th>Patient's ID</th>
                <th>Patient's Name</th>
                <th>Date of Service</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <tbody id="patientList">
                <?php include 'fetch_patients.php'; ?>
            </tbody>
        </table>
    </div>

    <!-- Add Patient Modal -->
    <div class="modal fade" id="addPatientModal" tabindex="-1" aria-labelledby="addPatientModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Patient Case</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addPatientForm">
                        <div class="mb-3">
                            <label for="Patient_name" class="form-label">Patient Name:</label>
                            <input type="text" class="form-control" id="Patient_name" name="Patient_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="Date_of_Service" class="form-label">Date of Service:</label>
                            <input type="date" class="form-control" id="Date_of_Service" name="Date_of_Service" required>
                        </div>
                        <div class="mb-3">
                            <label for="Client_Report" class="form-label">Client Report:</label>
                            <textarea class="form-control" id="Client_Report" name="Client_Report" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="Observation_Findings" class="form-label">Observation & Findings:</label>
                            <textarea class="form-control" id="Observation_Findings" name="Observation_Findings" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="Clinical_Evaluation" class="form-label">Clinical Evaluation:</label>
                            <textarea class="form-control" id="Clinical_Evaluation" name="Clinical_Evaluation" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="Treatment_Strategy" class="form-label">Treatment Strategy:</label>
                            <textarea class="form-control" id="Treatment_Strategy" name="Treatment_Strategy" required></textarea>
                        </div>
                        <div class="form-floating mb-3">
                        <select class="form-select" id="status" name="status" required>
                            <option value="Critical">Critical</option>
                            <option value="Under Treatment">Under Treatment</option>
                            <option value="Stable">Stable</option>
                            <option value="Recovered">Recovered</option>
                        </select>
                        <label for="status">Status</label>
                    </div>
                        <button type="submit" class="btn btn-success">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
