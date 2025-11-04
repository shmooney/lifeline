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
  <title>COVID-19 Care & Support | Lifeline Hospital</title>
  <meta charset="UTF-8">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #eef7f9;
      padding: 40px;
      line-height: 1.6;
    }
    h1 {
      color: #1b4965;
    }
    h2 {
      color: #247ba0;
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
      color: #1b4965;
    }
    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <h1>COVID-19 Care & Support</h1>
  <p>At Lifeline Hospital, we provide dedicated COVID-19 services to manage and prevent the spread of the virus while supporting patients throughout recovery. Our multidisciplinary response includes testing, treatment, vaccination, and post-COVID care.</p>

  <h2>Our Services Include:</h2>
  <ul>
    <li>COVID-19 PCR and antigen testing</li>
    <li>Isolation and treatment wards for symptomatic patients</li>
    <li>Vaccination services and booster dose programs</li>
    <li>Post-COVID recovery clinics for long-COVID symptoms</li>
    <li>Oxygen therapy and ICU support for severe cases</li>
    <li>Community awareness and education campaigns</li>
    <li>Workplace safety consultations and screenings</li>
  </ul>

  <h2>Infection Prevention:</h2>
  <p>Our hospital follows strict infection prevention protocols including PPE usage, regular disinfection, and patient triaging at entry points to ensure a safe environment for all visitors and staff.</p>

  <p>We are committed to keeping our community informed, healthy, and safe during the pandemic and beyond.</p>

  <a href="home.php">← Back to Home</a>
</body>
</html>