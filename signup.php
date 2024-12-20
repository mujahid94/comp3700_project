<?php
// Database connection parameters
$host = 'localhost';
$dbname = 'law_management_system';
$username = 'root'; // Adjust as needed
$password = ''; // Adjust as needed

try {
    // Create a new database connection
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $repassword = trim($_POST['repassword']);

        // Validate input
        if (empty($username) || empty($email) || empty($password) || empty($repassword)) {
            die("All fields are required.");
        }
        if ($password !== $repassword) {
            die("Passwords do not match.");
        }
        if (strlen($password) < 8 || strlen($password) > 15) {
            die("Password must be between 8 and 15 characters.");
        }

        // Insert data into the database
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password); // Store plain text password

        if ($stmt->execute()) {
            echo "<h2>Signup Successful! Welcome, $username!</h2>";
        } else {
            echo "<h2>Error: Could not complete the signup process.</h2>";
        }
    }
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
?>
