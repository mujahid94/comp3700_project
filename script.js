// Object constructors for the two tables
function Schedule(day, time) {
    this.day = day;
    this.time = time;
}

function Lawyer(name, specialty) {
    this.name = name;
    this.specialty = specialty;
}

// Arrays for storing information
const scheduleArray = [
    new Schedule("Sunday", "10:00 AM - 12:00 PM"),
    new Schedule("Monday", "1:00 PM - 2:00 PM"),
    new Schedule("Tuesday", "9:00 AM - 11:00 AM"),
    new Schedule("Wednesday", "9:00 AM - 11:00 AM"),
    new Schedule("Thursday", "11:00 AM - 1:00 PM"),
    new Schedule("Friday", "Off"),
    new Schedule("Saturday", "Off")
];

const lawyerArray = [
    new Lawyer("John Doe", "Criminal Law"),
    new Lawyer("Jane Smith", "Family Law"),
    new Lawyer("Ahmed Al-Shehri", "Corporate Law"),
    new Lawyer("Fatima Al-Lawati", "Property Law")
];

// Function to populate the schedule table
function populateScheduleTable() {
    const scheduleTableBody = document.getElementById("scheduleTableBody");
    scheduleArray.forEach(schedule => {
        const row = document.createElement("tr");
        row.innerHTML = `
            <td>${schedule.day}</td>
            <td>${schedule.time}</td>
        `;
        scheduleTableBody.appendChild(row);
    });
}

// Function to populate the lawyer table
function populateLawyerTable() {
    const lawyerTableBody = document.getElementById("lawyerTableBody");
    lawyerArray.forEach(lawyer => {
        const row = document.createElement("tr");
        row.innerHTML = `
            <td>${lawyer.name}</td>
            <td>${lawyer.specialty}</td>
        `;
        lawyerTableBody.appendChild(row);
    });
}

// Search function
function searchInTables() {
    const searchQuery = document.getElementById("searchInput").value.toLowerCase();
    const scheduleResults = scheduleArray.filter(schedule =>
        schedule.day.toLowerCase().includes(searchQuery) || schedule.time.toLowerCase().includes(searchQuery)
    );
    const lawyerResults = lawyerArray.filter(lawyer =>
        lawyer.name.toLowerCase().includes(searchQuery) || lawyer.specialty.toLowerCase().includes(searchQuery)
    );

    // Clear existing results
    document.getElementById("scheduleTableBody").innerHTML = "";
    document.getElementById("lawyerTableBody").innerHTML = "";

    // Display results
    scheduleResults.forEach(schedule => {
        const row = document.createElement("tr");
        row.innerHTML = `
            <td>${schedule.day}</td>
            <td>${schedule.time}</td>
        `;
        document.getElementById("scheduleTableBody").appendChild(row);
    });

    lawyerResults.forEach(lawyer => {
        const row = document.createElement("tr");
        row.innerHTML = `
            <td>${lawyer.name}</td>
            <td>${lawyer.specialty}</td>
        `;
        document.getElementById("lawyerTableBody").appendChild(row);
    });
}

// Event listener for search button
document.getElementById("searchButton").addEventListener("click", searchInTables);

// Populate tables on page load
populateScheduleTable();
populateLawyerTable();
