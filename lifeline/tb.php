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
  <title>Tuberculosis (TB) Care | Lifeline Hospital</title>
  <meta charset="UTF-8">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #fefcf6;
      padding: 40px;
      line-height: 1.6;
    }
    h1 {
      color: #3b3b0b;
    }
    h2 {
      color: #736c0e;
    }
    p {
      margin-bottom: 20px;
    }
    ul {
      margin-bottom: 20px;
    }
    a {
      display: inline-block;
      margin-top: 20px;
      text-decoration: none;
      color: #3b3b0b;
    }
    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <h1>Tuberculosis (TB) Care</h1>
  <p>Lifeline Hospital is dedicated to the early detection, treatment, and prevention of tuberculosis (TB), a curable but potentially serious infectious disease that primarily affects the lungs.</p>

  <h2>Our TB Services Include:</h2>
  <ul>
    <li>TB screening and diagnosis (sputum test, chest X-ray, GeneXpert)</li>
    <li>Directly Observed Treatment Short-course (DOTS)</li>
    <li>Multi-drug resistant TB (MDR-TB) management</li>
    <li>Contact tracing and preventive treatment for family members</li>
    <li>Follow-up and adherence monitoring</li>
    <li>Nutrition support and counseling</li>
    <li>Patient and community education</li>
  </ul>

  <h2>Public Health Commitment:</h2>
  <p>We work closely with government and non-government partners to help eliminate TB through quality healthcare delivery, outreach, and public education campaigns.</p>

  <p>Early treatment saves lives—Lifeline Hospital is your trusted partner in TB prevention and care.</p>

  <a href="home.php">← Back to Home</a>
</body>
</html>
