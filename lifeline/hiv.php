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
  <title>HIV Care & Management | Lifeline Hospital</title>
  <meta charset="UTF-8">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #fff6f6;
      padding: 40px;
      line-height: 1.6;
    }
    h1 {
      color: #b32034;
    }
    h2 {
      color: #c94254;
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
      color: #b32034;
    }
    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <h1>HIV Care & Management</h1>
  <p>Lifeline Hospital provides holistic, compassionate, and evidence-based care for individuals living with HIV. Our goal is to help patients achieve viral suppression, live healthy lives, and prevent transmission to others.</p>

  <h2>Our HIV Services Include:</h2>
  <ul>
    <li>Voluntary Counseling and Testing (VCT)</li>
    <li>Pre-Exposure Prophylaxis (PrEP) and Post-Exposure Prophylaxis (PEP)</li>
    <li>Antiretroviral Therapy (ART) initiation and follow-up</li>
    <li>CD4 count and viral load monitoring</li>
    <li>Psychosocial support and stigma reduction counseling</li>
    <li>Prevention of mother-to-child transmission (PMTCT)</li>
    <li>Sexual and reproductive health services</li>
    <li>Outreach programs for key populations</li>
  </ul>

  <h2>Supportive Environment:</h2>
  <p>We prioritize privacy, dignity, and respect. Our multidisciplinary care team includes physicians, nurses, counselors, pharmacists, and social workers.</p>

  <p>Through education, treatment, and support, Lifeline Hospital stands with individuals and families affected by HIV.</p>

  <a href="home.php">← Back to Home</a>
</body>
</html>
