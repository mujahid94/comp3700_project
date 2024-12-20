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
        $action = $_POST['action'];
        $email = trim($_POST['email']);

        // Validate email input
        if (empty($email)) {
            die("Email is required.");
        }

        if ($action === "add") {
            // Add new feedback
            $name = $_POST['name'];
            $satisfaction_rating = $_POST['satisfaction_rating'];
            $comments = $_POST['comments'];
            $consent = $_POST['consent'];

            // Validate inputs
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                die("Invalid email address.");
            }
            if (strlen($comments) > 1000) {
                die("Feedback should not exceed 1000 characters.");
            }

            // Insert feedback into the database
            $stmt = $conn->prepare("INSERT INTO feedback (name, email, satisfaction_rating, comments, consent) 
                                    VALUES (:name, :email, :satisfaction_rating, :comments, :consent)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':satisfaction_rating', $satisfaction_rating);
            $stmt->bindParam(':comments', $comments);
            $stmt->bindParam(':consent', $consent, PDO::PARAM_BOOL);

            if ($stmt->execute()) {
                echo "<div class='alert alert-success'>Feedback submitted successfully!</div>";
            } else {
                echo "<div class='alert alert-danger'>Error: Could not add feedback.</div>";
            }
        } elseif ($action === "manage") {
            // Manage feedback (update or delete)
            if (isset($_POST['delete'])) {
                // Delete feedback logic
                $stmt = $conn->prepare("DELETE FROM feedback WHERE email = :email");
                $stmt->bindParam(':email', $email);

                if ($stmt->execute()) {
                    echo "<div class='alert alert-success'>Feedback deleted successfully!</div>";
                } else {
                    echo "<div class='alert alert-danger'>Error: Could not delete feedback.</div>";
                }
            }

            if (isset($_POST['update'])) {
                // Update feedback logic
                $stmt = $conn->prepare("SELECT * FROM feedback WHERE email = :email");
                $stmt->bindParam(':email', $email);
                $stmt->execute();
                $feedbackData = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($feedbackData) {
                    // If feedback exists, allow updates
                    $satisfaction_rating = $_POST['satisfaction_rating'];
                    $comments = $_POST['comments'];
                    $consent = $_POST['consent'];

                    $stmt = $conn->prepare("UPDATE feedback SET satisfaction_rating = :satisfaction_rating, comments = :comments, consent = :consent WHERE email = :email");
                    $stmt->bindParam(':email', $email);
                    $stmt->bindParam(':satisfaction_rating', $satisfaction_rating);
                    $stmt->bindParam(':comments', $comments);
                    $stmt->bindParam(':consent', $consent, PDO::PARAM_BOOL);

                    if ($stmt->execute()) {
                        echo "<div class='alert alert-success'>Feedback updated successfully!</div>";
                    } else {
                        echo "<div class='alert alert-danger'>Error: Could not update feedback.</div>";
                    }
                } else {
                    echo "<div class='alert alert-warning'>No feedback found for this email.</div>";
                }
            }
        }
    }
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
?>
