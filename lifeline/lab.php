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
  <title>Lab Testing | Lifeline Hospital</title>
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
  <h1>Lab Testing</h1>
  <p>At Lifeline Hospital, our laboratory is fully equipped with modern diagnostic tools to provide accurate and timely results. We offer a comprehensive menu of tests ranging from routine screenings to complex diagnostics. Our services include:</p>

  <ul>
    <li><strong>Hematology:</strong> Full blood count, ESR, coagulation profiles</li>
    <li><strong>Biochemistry:</strong> Blood glucose, liver function tests, renal function tests, lipid profiles</li>
    <li><strong>Microbiology:</strong> Culture and sensitivity tests, malaria, typhoid, and other pathogen detections</li>
    <li><strong>Serology & Immunology:</strong> HIV, Hepatitis, pregnancy tests, rheumatoid factor</li>
    <li><strong>Hormone Assays:</strong> Thyroid profiles, reproductive hormones</li>
    <li><strong>Tumor Markers:</strong> PSA, CA-125, AFP, and more</li>
  </ul>

  <p>All tests are performed by highly trained laboratory technologists and reviewed by pathologists. Our automated systems ensure efficiency and precision in every result.</p>

  <p>We provide same-day reporting for most routine tests and maintain strict quality control protocols for reliable diagnostics. Patients can also access their results online securely.</p>

  <a href="home.php">← Back to Home</a>
</body>
</html>
