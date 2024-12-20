<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Fetch input values from the form
    $numServices = (int)$_POST['numServices'];
    $costPerService = (float)$_POST['costPerService'];
    $age = (int)$_POST['age'];
    $membership = $_POST['membership'];

    // Calculate total cost
    $totalCost = $numServices * $costPerService;

    // Apply discount for elderly customers (age > 60)
    $discount = 0;
    if ($age > 60) {
        // 10% discount from the total cost
        $discount = $totalCost * 0.1;
    }

    // Apply additional discount for members
    if ($membership === "yes") {
        // Additional 5% discount for members
        $discount += $totalCost * 0.05;
    }

    // Final cost after discounts
    $finalCost = $totalCost - $discount;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Bill Calculation Result</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Bill Calculation Result</h2>
        <div class="alert alert-info mt-4">
            <h4>Bill Summary</h4>
            <p>Number of Services: <?php echo $numServices; ?></p>
            <p>Cost per Service: <?php echo number_format($costPerService, 2); ?> OMR</p>
            <p>Total Cost: <?php echo number_format($totalCost, 2); ?> OMR</p>
            <p>Discount Applied: <?php echo number_format($discount, 2); ?> OMR</p>
            <p><strong>Final Cost: <?php echo number_format($finalCost, 2); ?> OMR</strong></p>
        </div>
    </div>
</body>
</html>
