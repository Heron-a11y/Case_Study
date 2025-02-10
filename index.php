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
            <a href="#">Patient’s List</a>
            <a href="#">Update Information</a>
            <a href="#">About / Settings</a>
            <a href="#" class="btn-logout">Log Out</a>
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
                    <label for="sortByName">Sort by ID:</label>
                    <select id="sortByName">
                        <option value="asc">Ascending</option>
                        <option value="desc">Descending</option>
                    </select>
                </div>
                <div>
                    <label for="sortByID">Sort by Name:</label>
                    <select id="sortByID">
                        <option value="nameasc">A To Z</option>
                        <option value="namedesc">Z To A</option>
                    </select>
                </div>
                <div>
                    <label for="sortByStatus">Sort by Status:</label>
                    <select id="sortByStatus">
                    <option value="critical">Critical</option>
                    <option value="undertreatment">Under Treatment</option>
                    <option value="stable">Stable</option>
                    <option value="recovered">Recovered</option>
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
                <th>Client Report</th>
                <th>Observation&Findings</th>
                <th>Clinical Evaluation</th>
                <th>Treatment Strategy</th>
                <th>Status</th>
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
                            <label for="patient_id" class="form-label">Patient ID:</label>
                            <input type="text" class="form-control" id="patient_id" name="patient_id" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Patient Name:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="date_of_service" class="form-label">Date of Service:</label>
                            <input type="date" class="form-control" id="date_of_service" name="date_of_service" required>
                        </div>
                        <div class="mb-3">
                            <label for="subjective" class="form-label">Client Report:</label>
                            <textarea class="form-control" id="subjective" name="subjective" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="objective" class="form-label">Observation & Findings:</label>
                            <textarea class="form-control" id="objective" name="objective" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="assessment" class="form-label">Clinical Evaluation:</label>
                            <textarea class="form-control" id="assessment" name="assessment" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="plan" class="form-label">Treatment Strategy:</label>
                            <textarea class="form-control" id="plan" name="plan" required></textarea>
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
