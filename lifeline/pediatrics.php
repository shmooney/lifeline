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
  <title>Pediatrics | Lifeline Hospital</title>
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
  <h1>Pediatric Services</h1>
  <p>At Lifeline Hospital, we are committed to the health and wellness of children from birth through adolescence. Our pediatricians offer compassionate and expert care in a child-friendly environment designed to make young patients feel safe and comfortable.</p>

  <h2>Our Pediatric Services Include:</h2>
  <ul>
    <li>Newborn assessments and routine child check-ups</li>
    <li>Immunizations and vaccination programs</li>
    <li>Treatment for common childhood illnesses (flu, fever, asthma, etc.)</li>
    <li>Growth and developmental monitoring</li>
    <li>Nutrition and feeding consultations</li>
    <li>Chronic condition management (e.g. diabetes, epilepsy)</li>
    <li>Pediatric emergency services</li>
  </ul>

  <p>Our pediatric unit is equipped with advanced diagnostic tools and child-specific facilities. We work closely with parents to ensure every child receives individualized care.</p>

  <p>Book an appointment with our pediatric specialists through the Patient Portal or call our front desk for assistance.</p>

  <a href="home.php">← Back to Home</a>
</body>
</html>
