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
  <title>General Surgery Services | Lifeline Hospital</title>
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
  <h1>General Surgery</h1>
  <p>Lifeline Hospital provides comprehensive general surgical care using the latest technologies and minimally invasive techniques. Our surgical team is composed of board-certified general surgeons, anesthesiologists, and experienced support staff to ensure safe and effective procedures.</p>

  <p>Common general surgeries performed at our hospital include:</p>
  <ul>
    <li>Appendectomy (removal of appendix)</li>
    <li>Hernia repair (inguinal, umbilical, incisional)</li>
    <li>Gallbladder removal (cholecystectomy)</li>
    <li>Hemorrhoidectomy and anal surgeries</li>
    <li>Thyroid and breast lump removal</li>
    <li>Wound care and abscess drainage</li>
  </ul>

  <p>We utilize laparoscopic (keyhole) techniques whenever possible, which result in smaller scars, less pain, and faster recovery times. Our surgical units follow strict infection control and post-operative protocols to ensure patient safety and comfort.</p>

  <p>Consultations are available in our outpatient surgery clinic. Emergency surgical cases are prioritized 24/7.</p>

  <a href="home.php">← Back to Home</a>
</body>
</html>
