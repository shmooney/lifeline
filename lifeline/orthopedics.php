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
  <title>Orthopedic Services | Lifeline Hospital</title>
  <meta charset="UTF-8">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f9ff;
      padding: 40px;
      line-height: 1.6;
    }
    h1 {
      color: #0c2f55;
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
  <h1>Orthopedic Services</h1>
  <p>The Orthopedic Unit at Lifeline Hospital provides comprehensive care for patients with musculoskeletal conditions. Our skilled orthopedic specialists diagnose and treat injuries and disorders affecting bones, joints, ligaments, tendons, and muscles.</p>

  <h2>Our Orthopedic Services Include:</h2>
  <ul>
    <li>Fracture treatment and bone realignment</li>
    <li>Joint replacement surgeries (hip, knee, shoulder)</li>
    <li>Sports injuries and rehabilitation</li>
    <li>Arthritis and osteoporosis management</li>
    <li>Back pain and spinal condition care</li>
    <li>Orthopedic trauma care</li>
    <li>Pediatric orthopedic evaluation</li>
  </ul>

  <p>We use a multidisciplinary approach involving physiotherapists, radiologists, and surgeons to ensure a quick recovery and optimal outcomes for all our patients.</p>

  <p>To consult with an orthopedic specialist or for emergency injury treatment, visit Lifeline Hospital or schedule online.</p>

  <a href="home.php">← Back to Home</a>
</body>
</html>
