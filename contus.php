<?php
// Ensure that form data has been submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize input to prevent security issues
    $name = htmlspecialchars(trim($_POST['name']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $email = htmlspecialchars(trim($_POST['email']));
    $question = htmlspecialchars(trim($_POST['question']));

    // Validate the required fields (Basic Validation)
    if (empty($name) || empty($phone) || empty($subject) || empty($email) || empty($question)) {
        echo "All fields are required.";
        exit;
    }

    // Email details
    $to = "s137794@student.squ.edu.om"; // my email address
    $headers = "From: $email";
    $body = "Name: $name\n";
    $body .= "Phone: $phone\n";
    $body .= "Subject: $subject\n";
    $body .= "Email: $email\n";
    $body .= "Feedback:\n$question\n";

    // Send the email
    if (mail($to, "Contact Us Form Submission", $body, $headers)) {
        echo "<h2>Thank you for your feedback! We will get back to you soon.</h2>";
    } else {
        echo "<h2>There was an error submitting your feedback. Please try again.</h2>";
    }
}
?>
