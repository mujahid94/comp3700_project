<?php
// Predefined static data
$schedules = [
    ["day" => "Monday", "time" => "10:00 AM"],
    ["day" => "Tuesday", "time" => "2:00 PM"],
    ["day" => "Wednesday", "time" => "11:00 AM"],
    ["day" => "Thursday", "time" => "3:00 PM"],
    ["day" => "Friday", "time" => "1:00 PM"],
];

$lawyers = [
    ["name" => "John Doe", "specialty" => "Criminal Law"],
    ["name" => "Jane Smith", "specialty" => "Family Law"],
    ["name" => "Michael Brown", "specialty" => "Corporate Law"],
    ["name" => "Emily Davis", "specialty" => "Civil Rights"],
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchQuery = trim($_POST['query']);

    if (empty($searchQuery)) {
        echo "<h3>Please enter a search term.</h3>";
    } else {
        echo "<h2>Search Results for '" . htmlspecialchars($searchQuery) . "':</h2>";

        // Filter schedules
        $filteredSchedules = array_filter($schedules, function ($schedule) use ($searchQuery) {
            return stripos($schedule['day'], $searchQuery) !== false || stripos($schedule['time'], $searchQuery) !== false;
        });

        // Display filtered schedules
        if (!empty($filteredSchedules)) {
            echo "<h3>Schedules</h3><table border='1'><tr><th>Day</th><th>Time</th></tr>";
            foreach ($filteredSchedules as $schedule) {
                echo "<tr><td>" . htmlspecialchars($schedule['day']) . "</td><td>" . htmlspecialchars($schedule['time']) . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No schedules found matching '$searchQuery'.</p>";
        }

        // Filter lawyers
        $filteredLawyers = array_filter($lawyers, function ($lawyer) use ($searchQuery) {
            return stripos($lawyer['name'], $searchQuery) !== false || stripos($lawyer['specialty'], $searchQuery) !== false;
        });

        // Display filtered lawyers
        if (!empty($filteredLawyers)) {
            echo "<h3>Lawyers</h3><table border='1'><tr><th>Name</th><th>Specialty</th></tr>";
            foreach ($filteredLawyers as $lawyer) {
                echo "<tr><td>" . htmlspecialchars($lawyer['name']) . "</td><td>" . htmlspecialchars($lawyer['specialty']) . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No lawyers found matching '$searchQuery'.</p>";
        }
    }
}
?>
