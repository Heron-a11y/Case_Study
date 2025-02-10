<?php
session_start();
$servername = "localhost";
$db_username = "root"; 
$db_password = ""; 
$dbname = "medical_system"; 

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background: #50aa92;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0;
}

.container {
    display: flex;
    justify-content: center;
    align-items: center;
}

.form-box {
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 400px;
}

h2 {
    text-align: center;
}

.input-group {
    margin-bottom: 15px;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.input-group label {
    display: block;
    margin-bottom: 5px;
    text-align: center;
}

.input-group input {
    width: 80%; 
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    text-align: center;
}

button {
    width: 100%;
    padding: 10px;
    background: #4facfe;
    border: none;
    border-radius: 5px;
    color: white;
    font-size: 16px;
    cursor: pointer;
}

button:hover {
    background: #00f2fe;
}

p {
    text-align: center;
}
    </style>
</head>
<body>
    <div class="container">
        <div class="form-box">
            <h2>Admin Login</h2>
            <form action="index.php" method="POST">
                <div class="input-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" required>
                </div>
                <button type="submit" name="login">Login</button>
                
    <script>
        function showSignup() {
            document.querySelector('.form-box').style.display = 'none';
            document.getElementById('signup-form').style.display = 'block';
        }
        function showLogin() {
            document.querySelector('.form-box').style.display = 'block';
            document.getElementById('signup-form').style.display = 'none';
        }
    </script>
</body>
</html>