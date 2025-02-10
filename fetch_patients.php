<!-- Carl Manuel Gonzales -->
<?php
include 'db.php';

// Default sorting values
$orderColumn = 'Patient_name';
$orderDirection = 'ASC'; // Default sorting order

// Check for sorting input
if (isset($_GET['order']) && ($_GET['order'] === 'asc' || $_GET['order'] === 'desc')) {
    $orderDirection = ($_GET['order'] === 'desc') ? 'DESC' : 'ASC';
}

// Filtering by status
$statusFilter = "";
if (!empty($_GET['status']) && $_GET['status'] !== "All Status") {
    $status = mysqli_real_escape_string($conn, $_GET['status']);
    $statusFilter = "WHERE status = '$status'";
}

// Fetch patients sorted by name
$query = "SELECT Patient_id, Patient_name, Date_of_Service, status FROM patients $statusFilter ORDER BY $orderColumn $orderDirection";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$row['Patient_id']}</td>
                <td>{$row['Patient_name']}</td>
                <td>{$row['Date_of_Service']}</td>
                <td>{$row['status']}</td>
                <td>
                    <a href='edit_patient.php?id={$row['Patient_id']}' class='btn btn-primary'>Edit</a>
                    <a href='delete_patient.php?id={$row['Patient_id']}' class='btn btn-danger' onclick=\"return confirm('Are you sure you want to delete this record?')\">Delete</a>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='5'>No patients found.</td></tr>";
}

mysqli_close($conn);
?>
