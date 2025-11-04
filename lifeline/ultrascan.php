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
  <title>Ultrasound Services | Lifeline Hospital</title>
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
  <h1>Ultrasound (Ultrascan) Services</h1>
  <p>Our ultrasound department at Lifeline Hospital utilizes cutting-edge technology to produce high-resolution images for diagnostic and monitoring purposes. Ultrasound is a safe, non-invasive imaging method that uses sound waves to visualize internal organs and tissues.</p>

  <p>We offer the following ultrasound services:</p>
  <ul>
    <li><strong>Obstetric Ultrasound:</strong> Monitoring fetal development, pregnancy assessments</li>
    <li><strong>Pelvic Ultrasound:</strong> Evaluating uterus, ovaries, and bladder</li>
    <li><strong>Abdominal Ultrasound:</strong> Liver, kidney, pancreas, spleen, gallbladder scans</li>
    <li><strong>Vascular Ultrasound:</strong> Blood flow studies, detecting clots or blockages</li>
    <li><strong>Thyroid and Neck Ultrasound:</strong> Identifying nodules, cysts, or enlargement</li>
    <li><strong>Soft Tissue Ultrasound:</strong> Assessing lumps, swellings, and trauma</li>
  </ul>

  <p>Our certified sonographers ensure patient comfort and precision during every procedure. Results are interpreted by radiologists and delivered promptly.</p>

  <p>Most ultrasounds are done on appointment, but emergency scans are available on request.</p>

  <a href="home.php">← Back to Home</a>
</body>
</html>
