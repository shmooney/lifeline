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
  <title>Hypertension Management | Lifeline Hospital</title>
  <meta charset="UTF-8">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f3f7fb;
      padding: 40px;
      line-height: 1.6;
    }
    h1 {
      color: #2a4365;
    }
    h2 {
      color: #2b6cb0;
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
      color: #2a4365;
    }
    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <h1>Hypertension Management</h1>
  <p>Lifeline Hospital offers comprehensive care for patients with high blood pressure (hypertension). We focus on early detection, lifestyle guidance, regular monitoring, and treatment to prevent complications like stroke and heart disease.</p>

  <h2>Our Hypertension Services Include:</h2>
  <ul>
    <li>Blood pressure screening and diagnosis</li>
    <li>Individualized treatment plans</li>
    <li>Medication management and adherence support</li>
    <li>Nutrition and lifestyle counseling</li>
    <li>Cardiovascular risk assessment</li>
    <li>24-hour ambulatory blood pressure monitoring</li>
    <li>Patient education and wellness programs</li>
  </ul>

  <h2>Why Choose Us:</h2>
  <p>Our cardiologists and general practitioners collaborate to ensure each patient receives tailored care. We promote a proactive approach to blood pressure management through education and continuous support.</p>

  <p>At Lifeline Hospital, managing hypertension is more than treating symptoms—it's about protecting your long-term heart health.</p>

  <a href="home.php">← Back to Home</a>
</body>
</html>