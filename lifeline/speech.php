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
  <title>Speech Therapy | Lifeline Hospital</title>
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
  <h1>Speech Therapy</h1>
  <p>Our Speech and Language Therapy Department at Lifeline Hospital offers comprehensive services for patients facing communication, speech, language, voice, and swallowing difficulties. We treat both children and adults through individualized care plans.</p>

  <h2>We Help Treat:</h2>
  <ul>
    <li>Speech articulation and fluency disorders (e.g., stuttering)</li>
    <li>Delayed language development in children</li>
    <li>Autism spectrum and social communication disorders</li>
    <li>Aphasia following stroke or brain injury</li>
    <li>Voice disorders and vocal strain</li>
    <li>Swallowing (dysphagia) therapy</li>
  </ul>

  <h2>Services Offered:</h2>
  <ul>
    <li>Comprehensive speech and language evaluations</li>
    <li>Individual and group therapy sessions</li>
    <li>Family training and support for home-based care</li>
    <li>Use of assistive communication devices where needed</li>
    <li>Therapeutic feeding programs for infants and children</li>
  </ul>

  <p>Our speech therapists work closely with other professionals, including ENT specialists, occupational therapists, and psychologists, to deliver coordinated care that meets each patient’s needs.</p>

  <a href="home.php">← Back to Home</a>
</body>
</html>
