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
  <title>Vaccination & Immunization | Lifeline Hospital</title>
  <meta charset="UTF-8">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f0f8ff;
      padding: 40px;
      line-height: 1.6;
    }
    h1 {
      color: #1c3f60;
    }
    h2 {
      color: #2a678e;
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
      color: #004080;
    }
    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <h1>Vaccination & Immunization Services</h1>
  <p>At Lifeline Hospital, we provide a comprehensive immunization program designed to protect patients of all ages from infectious diseases. Our vaccination services follow the national and international immunization guidelines to ensure community-wide protection.</p>

  <h2>Available Vaccinations:</h2>
  <ul>
    <li>BCG (Tuberculosis)</li>
    <li>Hepatitis B</li>
    <li>Polio (OPV/IPV)</li>
    <li>DTP (Diphtheria, Tetanus, Pertussis)</li>
    <li>Rotavirus</li>
    <li>Measles, Mumps & Rubella (MMR)</li>
    <li>Pneumococcal & Hib vaccines</li>
    <li>HPV (Human Papillomavirus) vaccine</li>
    <li>COVID-19 vaccines & boosters</li>
    <li>Influenza (Flu) shot</li>
    <li>Yellow Fever</li>
  </ul>

  <h2>Our Services Include:</h2>
  <ul>
    <li>Childhood immunization schedules</li>
    <li>Travel-related vaccinations</li>
    <li>Routine adult immunizations</li>
    <li>Vaccination record tracking and certification</li>
    <li>School and workplace vaccination programs</li>
  </ul>

  <p>Our qualified nurses and doctors provide safe, efficient, and friendly vaccination services. We emphasize public awareness and encourage all families to stay updated with recommended vaccines.</p>

  <a href="home.php">← Back to Home</a>
</body>
</html>
