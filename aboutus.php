<?php

// Define the Lawyer and Info classes
class Lawyer {
    public $name;
    public $specialization;

    public function __construct($name, $specialization) {
        $this->name = $name;
        $this->specialization = $specialization;
    }
}

class Info {
    public $type;
    public $description;

    public function __construct($type, $description) {
        $this->type = $type;
        $this->description = $description;
    }
}

// Sample data for lawyers and info
$lawyers = [
    new Lawyer("Mohammed Bin Said", "Criminal Law"),
    new Lawyer("Jasim Bin Abdullah", "Family Law"),
    new Lawyer("Fahad Bin Yousef", "Corporate Law"),
    new Lawyer("Khalid Bin Mohammed", "Labor Law"),
    new Lawyer("Ali Bin Ahmed", "Civil Law"),
    new Lawyer("Yusuf Bin Abdullah", "Immigration Law"),
    new Lawyer("Nasser Bin Said", "Property Law"),
];

$info = [
    new Info("Vision", "Our Aim is to provide services regarding law issues in which anyone with internet connection could get access. Also, we aim to provide full satisfaction to clients using our system. Law rules change from place to another, that's why our system is only in Oman."),
    new Info("Location", "Muscat / Oman"),
    new Info("Lawyers", "Our system includes the most well-known lawyers in Oman, such as: Mohammed Bin Said, Jasim Bin Abdullah, Fahad Bin Yousef, Khalid Bin Mohammed, Ali Bin Ahmed, Yusuf Bin Abdullah, Nasser Bin Said, and many more!"),
    new Info("Phone No", "+968 23242355"),
    new Info("Email", "lawcommunity@gmail.com"),
];

// Handle the search query if any
$searchQuery = isset($_POST['searchInput']) ? strtolower($_POST['searchInput']) : '';

// Filter the lawyers and info based on the search query
if ($searchQuery) {
    $lawyers = array_filter($lawyers, function($lawyer) use ($searchQuery) {
        return stripos($lawyer->name, $searchQuery) !== false || stripos($lawyer->specialization, $searchQuery) !== false;
    });

    $info = array_filter($info, function($item) use ($searchQuery) {
        return stripos($item->type, $searchQuery) !== false || stripos($item->description, $searchQuery) !== false;
    });
}

// Include the HTML output (it will display the filtered results)
include 'aboutus.html';

?>
