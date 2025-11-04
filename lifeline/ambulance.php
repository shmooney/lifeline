<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: loginn.php");
    exit;
}
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html>
<head>
  <title>Ambulance Services | Lifeline Hospital</title>
  <meta charset="UTF-8">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f9ff;
      padding: 40px;
      line-height: 1.6;
    }
    h1 {
      color: #003366;
    }
    p {
      margin-bottom: 20px;
    }
    a {
      display: inline-block;
      margin-top: 20px;
      text-decoration: none;
      color: #0056b3;
    }
    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <h1>Ambulance Services</h1>
  <p>Lifeline Hospital offers 24/7 emergency ambulance services equipped with life-saving equipment and staffed by trained paramedics. Our ambulance fleet is available for both emergency response and non-emergency medical transport.</p>

  <p>Key features of our ambulance service include:</p>
  <ul>
    <li>Advanced Life Support (ALS) and Basic Life Support (BLS) units</li>
    <li>Emergency response for road accidents, cardiac arrest, trauma, and critical illness</li>
    <li>Pre-hospital stabilization and monitoring by trained EMTs and nurses</li>
    <li>Patient transport between medical facilities or for specialist referrals</li>
    <li>24-hour dispatch coordination with GPS tracking</li>
  </ul>

  <p>To request an ambulance, call our emergency hotline: <strong>+254 700 066 999</strong></p>
  <p>Our goal is to provide fast, safe, and efficient transport in critical moments.</p>

  <a href="home.php">← Back to Home</a>
</body>
</html>
