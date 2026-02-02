<?php 

include '../db-connect.php';
session_start();


if (!isset($_SESSION['UserID'])) {
    header("Location: ../sign-home/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin-dashboard</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #fffbf0; 
            margin: 0;
            padding: 0;
            color: #004d40; 
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .header {
            background-color: #004d40;
            color: #ffffff;
            padding: 10px 20px; 
            position: relative;
            display: flex;
            align-items: center;
        }

        .header h1 {
            flex-grow: 1;
            text-align: center;
            margin: 0;
            font-size: 1.5em; 
        }

        .container {
            flex: 1;
            display: flex;
        }

        .sidebar {
            background-color: #004d40;
            color: #ffffff;
            padding: 20px;
            width: 250px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            display: flex;
            flex-direction: column;
            overflow-y: auto; 
        }

        .sidebar .logo {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .sidebar .profile-section button {
            width: 100%;
            background-color: #ffffff;
            color: #004d40;
            padding: 10px;
            border: none;
            border-radius: 3px;
            margin: 10px 0;
            cursor: pointer;
            text-align: left;
            font-size: 14px;
            font-weight: bold;
        }

        .sidebar .profile-section button:hover {
            background-color: #fffbf0;
        }

        .main-content {
            margin-left: 270px;
            flex-grow: 1;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .dashboard-widgets {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .chart-container {
            background-color: #fffbf0;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            flex: 1 1 300px;
            text-align: center;
            color: #004d40;
        }

        .chart-container img {
            max-width: 100%;
            height: auto;
            border-radius: 3px;
        }

        /* Footer Styles */
        footer {
            background-color: #004d40;
            color: white;
            text-align: center;
            position: relative; 
            margin-top: auto; 
            width: 100%;
        }
    </style>
</head>
<body>
    <header class="header">
        <h1>Admin Dashboard</h1>
    </header>
    
    <div class="container">
        <aside class="sidebar">
            <div class="logo">Hotels Booking</div>
            <div class="profile-section">
                <button onclick="location.href='admin-profile.php'">Profile</button>
                <button onclick="location.href='admin-dashboard.php'">Reports</button>
                <button onclick="location.href='manage-users.php'">Managing Users</button>
                <button onclick="location.href='manage-hotels.php'">Managing Hotels and APIs</button>
                <button onclick="location.href='manage-bookings.php'">Managing Bookings</button>
                <button onclick="location.href='manage-reviews.php'">Managing Reviews</button>
                <button onclick="location.href='manage-content.php'">Managing App Content</button>
                <button onclick="location.href='manage-settings.php'">Managing App Settings</button>
                <button onclick="location.href='manage-privacy.php'">Managing Privacy and Policy</button>
                <button onclick="location.href='Start-(HB).php'">Log Out</button>
            </div>
        </aside>

        <main class="main-content">
            <div class="dashboard-widgets">
                <div class="chart-container">
                    <h3>Total Users</h3>
                    <p>
                        <?php
                        $result = $conn->query("SELECT COUNT(*) AS total_users FROM users");
                        $row = $result->fetch_assoc();
                        echo $row['total_users'];
                        ?>
                    </p>
                </div>

                <div class="chart-container">
                    <h3>Total Bookings</h3>
                    <p>
                        <?php
                        $result = $conn->query("SELECT COUNT(*) AS total_bookings FROM bookings");
                        $row = $result->fetch_assoc();
                        echo $row['total_bookings'];
                        ?>
                    </p>
                </div>

                <div class="chart-container">
                    <h3>Total Reviews</h3>
                    <p>
                        <?php
                        $result = $conn->query("SELECT COUNT(*) AS total_reviews FROM reviews");
                        $row = $result->fetch_assoc();
                        echo $row['total_reviews'];
                        ?>
                    </p>
                </div>

                <div class="chart-container">
                    <h3>Total Revenue</h3>
                    <p>
                        <?php
                        $result = $conn->query("SELECT SUM(amount) AS total_revenue FROM reports");
                        $row = $result->fetch_assoc();
                        echo "$" . number_format($row['total_revenue'], 2);
                        ?>
                    </p>
                </div>
            </div>

            <div class="dashboard-widgets">
                <div class="chart-container">
                    <h3>Booking Analytics and Trends</h3>
                    <p>Analysis of booking trends and patterns over time.</p>
                    <img src="booking analysis.png" alt="Booking Trends Chart">
                </div>

                <div class="chart-container">
                    <h3>Revenue Reports</h3>
                    <p>Summary of revenue generated over different periods.</p>
                    <img src="placeholder_chart.png" alt="Revenue Reports Chart">
                </div>

                <div class="chart-container">
                    <h3>Customer Behavior Analysis</h3>
                    <p>Insights into customer preferences and behavior.</p>
                    <img src="placeholder_chart.png" alt="Customer Behavior Chart">
                </div>

                <div class="chart-container">
                    <h3>Occupancy Reports</h3>
                    <p>Details on room occupancy rates and trends.</p>
                    <img src="placeholder_chart.png" alt="Occupancy Reports Chart">
                </div>

                <div class="chart-container">
                    <h3>Performance Metrics</h3>
                    <p>Key performance indicators and metrics for the system.</p>
                    <img src="placeholder_chart.png" alt="Performance Metrics Chart">
                </div>
            </div>
        </main>
    </div>   
     
    <footer class="footer">
        <p>&copy; 2025 Hotels Booking. All rights reserved.</p>
    </footer>
</body>
</html>
