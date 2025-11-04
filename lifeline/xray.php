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
  <title>X-Ray Services | Lifeline Hospital</title>
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
  <h1>X-Ray Services</h1>
  <p>Lifeline Hospital offers advanced digital X-ray imaging that is fast, safe, and highly effective for diagnosing a wide range of conditions. Our radiology department is staffed with experienced radiographers and radiologists who ensure high-quality imaging and accurate interpretations.</p>

  <p>We provide the following X-ray services:</p>
  <ul>
    <li>Chest X-rays for diagnosing respiratory conditions and infections</li>
    <li>Bone and joint imaging for fractures, arthritis, and dislocations</li>
    <li>Spinal X-rays for back and neck pain evaluations</li>
    <li>Dental and facial imaging</li>
    <li>Pre-surgical imaging and follow-up studies</li>
  </ul>

  <p>Our digital systems reduce radiation exposure while providing sharper images. All X-rays are reviewed by board-certified radiologists, and reports are available within a few hours for routine imaging.</p>

  <p>Emergency and outpatient X-ray services are available 24/7. No prior booking is required for most scans.</p>

  <a href="home.php">← Back to Home</a>
</body>
</html>
