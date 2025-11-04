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
  <title>Physiotherapy Services | Lifeline Hospital</title>
  <meta charset="UTF-8">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f9ff;
      padding: 40px;
      line-height: 1.6;
    }
    h1 {
      color: #1a5175;
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
      color: #0056b3;
    }
    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <h1>Physiotherapy Services</h1>
  <p>At Lifeline Hospital, our Physiotherapy Department is dedicated to helping patients regain mobility, reduce pain, and improve quality of life. Our licensed physiotherapists design personalized programs to meet individual needs for recovery and rehabilitation.</p>

  <h2>Our Physiotherapy Services Include:</h2>
  <ul>
    <li>Post-surgical rehabilitation</li>
    <li>Stroke and neurological recovery therapy</li>
    <li>Sports injury treatment and prevention</li>
    <li>Chronic pain management (back, neck, joints)</li>
    <li>Musculoskeletal injury rehabilitation</li>
    <li>Gait and balance training</li>
    <li>Pediatric and geriatric physiotherapy</li>
  </ul>

  <p>We use modern techniques such as manual therapy, therapeutic exercise, ultrasound, electrical stimulation, and hydrotherapy to support healing and functionality.</p>

  <p>Our goal is to empower patients to return to their daily activities safely and confidently. Whether you're recovering from surgery, injury, or managing a chronic condition, we are here to support you every step of the way.</p>

  <a href="home.php">← Back to Home</a>
</body>
</html>
