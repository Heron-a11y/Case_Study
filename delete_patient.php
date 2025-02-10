<!-- Gab Jardin -->
<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM patients WHERE Patient_id='$id'";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Patient deleted successfully!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error deleting patient!');</script>";
    }
}
?>
