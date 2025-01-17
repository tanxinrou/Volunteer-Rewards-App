<?php
// Include the database connection script
include 'db_connect.php';

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve only activities from the database, filtering out any non-activity data
$sql = "SELECT ActivitiesID, ActivitiesName, Description, PointsRewarded, ActivitiesDate FROM activities"; // Modify this based on your table structure, only retrieving user-related data
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joint Event</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #E6E6DC;
        }
        .navbar {
            background-color: #002060;
            color: white;
        }
        .navbar a {
            color: white;
            text-decoration: none;
        }
        .header {
            font-size: 40px;
            font-weight: bold;
            color: #102042;
            text-align: center;
            margin-bottom: 5px;
            padding: 25px;
        }
        .container {
            max-width: 1200px;
            margin: auto;
        }
        .lg-container {
            display: flex;
        }
        .dropdown {
            margin: 10px;
        }
        #searchBtn {
            margin: 10px;
        }
        #bar {
            background-color: #003d99;
        }
        .calendar-container {
            width: 100%;
            max-width: 500px;
            background-color: #003d99;
            margin: 10px;
        }
        h1 {
            text-align: center;
            font-size: 1.5em;
            color: #E6E6DC;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            color: #002060;
        }
        th, td {
            padding: 10px;
            text-align: center;
            font-size: 0.9em;
        }
        th {
            background-color: #003d99;
            color: #E6E6DC;
        }
        td:hover {
            background-color: #E9AF31;
            color: #002060;
            cursor: pointer;
        }
        .today {
            background-color: #E8C766;
            color: #002060;
        }
        .navigation {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
        }
        .navigation button {
            background: none;
            border: none;
            color: #E6E6DC;
            font-size: 1.5em;
            cursor: pointer;
        }
        .navigation button:hover {
            color: #E6E6DC;
        }
        article {
            width: 330px;
            height: 270px;
            background-color: #003d99;
            margin-top: 15px;
        }
        h3 {
            color: #E8C766;
            text-align: left;
            margin-left: 20px;
            font-size: 20px;
            font-weight: bold;
            margin-top: 75px;
        }
        p {
            color: #E8C766;
            text-align: left;
            margin-left: 20px;
            font-size: 13px;
        }
        section {
            display: flex;
            gap: 20px;
        }
        main {
            margin-left: 45px;
            margin-top: 33px;
            display: flex;
        }
        main button {
            background-color: #E8C766;
            margin-left: 111px;
            width: 100px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg p-3">
    <div class="container-fluid">
        <div class="navbar-brand">
            <div style="display: flex; align-items: center;">
                <div style="width: 50px; height: 50px; background-color: #102042; border-radius: 50%;"></div>
            </div>
        </div>
        <div>
            <a class="btn me-2" style="background-color: #E8C766;" href="MyPoint.php">My Points</a>
            <a class="btn me-2" style="background-color: #E8C766;" href="View_Events.php">Events</a>
            <a class="btn" style="background-color: #E8C766;" href="myProfile (Volunteer).html">My Profile</a>
        </div>
    </div>
  </nav>
<div class="header">View Events</div>
<div class="navbar" id="bar">
    <div class="container">
            <div class="dropdown" style="float:left;">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownCauseButton" data-bs-toggle="dropdown" aria-expanded="false">
                    Course 
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Link 1</a>
                    <a class="dropdown-item" href="#">Link 2</a>
                    <a class="dropdown-item" href="#">Link 3</a>
                </div>
            </div>
            <div class="dropdown" style="float:left;">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownCauseButton" data-bs-toggle="dropdown" aria-expanded="false">
                    Skills
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Link 1</a>
                    <a class="dropdown-item" href="#">Link 2</a>
                    <a class="dropdown-item" href="#">Link 3</a>
                </div>
            </div>
            <div class="dropdown" style="float:left;">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownCauseButton" data-bs-toggle="dropdown" aria-expanded="false">
                    Date
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Link 1</a>
                    <a class="dropdown-item" href="#">Link 2</a>
                    <a class="dropdown-item" href="#">Link 3</a>
                </div>
            </div>
            <div class="dropdown" style="float:left;">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownCauseButton" data-bs-toggle="dropdown" aria-expanded="false">
                    Scheme/Agency
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Link 1</a>
                    <a class="dropdown-item" href="#">Link 2</a>
                    <a class="dropdown-item" href="#">Link 3</a>
                </div>
            </div>
    </div>
</div>
<input type="text" id="searchBtn" placeholder="Search">
<div class="lg-container">
<div class="calendar-container">
    <div class="navigation">
        <button id="prevMonth">&#9664;</button>
        <h1 id="monthYear"></h1>
        <button id="nextMonth">&#9654;</button>
    </div>
    <table id="calendar">
        <thead>
            <tr>
                <th>Sun</th>
                <th>Mon</th>
                <th>Tue</th>
                <th>Wed</th>
                <th>Thu</th>
                <th>Fri</th>
                <th>Sat</th>
            </tr>
        </thead>
        <tbody>
            <!-- Calendar rows will be inserted here by JavaScript -->
        </tbody>
    </table>
</div>

<main>
    <section>
            <?php
                if ($result->num_rows > 0) {
                // Output user data
                while ($row = $result->fetch_assoc()) {
                    echo "<article>";
                    echo "<h3>" . $row['ActivitiesName'] . "</h3>";
                    echo "<p>" . $row['Description'] . "</p>";
                    echo "<p>" . $row['ActivitiesDate'] . "</p>";
                    echo "<td><button><a href='explore_Event.php?ActivitiesID=" . $row['ActivitiesID'] . "'>Explore</a></button></td>";
                    echo "</article>";
                }
                } else {
                    echo "<tr><td colspan='4'>No events found</td></tr>";
                }
            ?>
    </section>
</main>
</div>
</div>

<script>
    let currentMonth = new Date().getMonth();
    let currentYear = new Date().getFullYear();

    function generateCalendar(month, year) {
        const calendar = document.getElementById('calendar').getElementsByTagName('tbody')[0];
        calendar.innerHTML = ''; // Clear previous cells
        const today = new Date();
        const firstDay = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();

        document.getElementById('monthYear').innerText = `${new Date(year, month).toLocaleString('default', { month: 'long' })} ${year}`;

        let date = 1;
        for (let i = 0; i < 6; i++) {
            const row = document.createElement('tr');
            for (let j = 0; j < 7; j++) {
                const cell = document.createElement('td');
                if (i === 0 && j < firstDay) {
                    cell.appendChild(document.createTextNode(''));
                } else if (date > daysInMonth) {
                    break;
                } else {
                    cell.appendChild(document.createTextNode(date));
                    if (date === today.getDate() && month === today.getMonth() && year === today.getFullYear()) {
                        cell.classList.add('today');
                    }
                    date++;
                }
                row.appendChild(cell);
            }
            calendar.appendChild(row);
        }
    }

    document.getElementById('prevMonth').addEventListener('click', () => {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        generateCalendar(currentMonth, currentYear);
    });

    document.getElementById('nextMonth').addEventListener('click', () => {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        generateCalendar(currentMonth, currentYear);
    });

    generateCalendar(currentMonth, currentYear);
</script>
</body>
</html>  