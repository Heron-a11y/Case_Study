<?php
include 'db.php';

// Set response header for JSON
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate that required fields exist
    $required_fields = ['Patient_name', 'Date_of_Service', 'Client_Report', 'Observation_Findings', 'Clinical_Evaluation', 'Treatment_Strategy', 'status'];
    foreach ($required_fields as $field) {
        if (!isset($_POST[$field]) || trim($_POST[$field]) === '') {
            echo json_encode(["status" => "error", "message" => "All fields are required."]);
            exit;
        }
    }

    // Get sanitized input
    $Patient_name = trim($_POST['Patient_name']);
    $Date_of_Service = trim($_POST['Date_of_Service']);
    $Client_Report = trim($_POST['Client_Report']);
    $Observation_Findings = trim($_POST['Observation_Findings']);
    $Clinical_Evaluation = trim($_POST['Clinical_Evaluation']);
    $Treatment_Strategy = trim($_POST['Treatment_Strategy']);
    $status = trim($_POST['status']);

    // Prepare SQL statement
    $sql = "INSERT INTO patients (Patient_name, Date_of_Service, Client_Report, Observation_Findings, Clinical_Evaluation, Treatment_Strategy, status) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sssssss", $Patient_name, $Date_of_Service, $Client_Report, $Observation_Findings, $Clinical_Evaluation, $Treatment_Strategy, $status);
        
        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Patient added successfully."]);
        } else {
            echo json_encode(["status" => "error", "message" => "Database error: " . $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Query preparation failed: " . $conn->error]);
    }

    $conn->close();
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request."]);
}
?>
