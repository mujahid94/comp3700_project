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
        // Check if 'username' and 'password' keys exist in $_POST
        if (isset($_POST['username']) && isset($_POST['password'])) {
            // Retrieve form data
            $inputUsernameOrEmail = trim($_POST['username']);
            $inputPassword = trim($_POST['password']);

            // Check if the user exists by username or email
            $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username OR email = :email");
            $stmt->bindParam(':username', $inputUsernameOrEmail);
            $stmt->bindParam(':email', $inputUsernameOrEmail);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // Compare the entered password with the stored password
                if ($user['password'] === $inputPassword) {
                    // Password is correct, redirect to index.html
                    header("Location: index.html");
                    exit;
                } else {
                    echo "Invalid password.";
                }
            } else {
                echo "No user found with that username or email.";
            }
        } else {
            echo "Please enter both username (or email) and password.";
        }
    }
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
?>
