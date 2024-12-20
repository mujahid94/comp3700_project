<?php
// Database connection parameters
$host = 'localhost';
$dbname = 'law_management_system';
$username = 'root'; // Adjust as needed
$password = ''; // Adjust as needed

try {
    // Create a new PDO instance for database connection
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $full_name = trim($_POST['full_name']);
        $email = trim($_POST['email']);
        $amount = trim($_POST['amount']);

        // Validate input
        if (empty($full_name) || empty($email) || empty($amount)) {
            die("All fields are required.");
        }

        // Check if the email already exists in the payments table
        $stmt = $conn->prepare("SELECT * FROM payments WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Email exists, update the existing record by adding the new amount
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $new_amount = $row['amount'] + $amount;  // Add the old amount to the new amount

            // Update the existing record with the new total amount
            $updateStmt = $conn->prepare("UPDATE payments SET amount = :new_amount WHERE email = :email");
            $updateStmt->bindParam(':new_amount', $new_amount);
            $updateStmt->bindParam(':email', $email);

            if ($updateStmt->execute()) {
                echo "<h2>Payment Updated! Your total payment is OMR $new_amount</h2>";
            } else {
                echo "<h2>Error: Could not update the payment.</h2>";
            }
        } else {
            // Email does not exist, insert a new record
            $insertStmt = $conn->prepare("INSERT INTO payments (full_name, email, amount) VALUES (:full_name, :email, :amount)");
            $insertStmt->bindParam(':full_name', $full_name);
            $insertStmt->bindParam(':email', $email);
            $insertStmt->bindParam(':amount', $amount);

            if ($insertStmt->execute()) {
                echo "<h2>Payment Successful! Your total payment is OMR $amount</h2>";
            } else {
                echo "<h2>Error: Could not complete the payment.</h2>";
            }
        }
    }
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
?>
