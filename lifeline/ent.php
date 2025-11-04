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
  <title>ENT Services | Lifeline Hospital</title>
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
  <h1>Ear, Nose & Throat (ENT) Services</h1>
  <p>Our ENT department at Lifeline Hospital is committed to diagnosing and treating disorders related to the ear, nose, throat, head, and neck. Our specialists use modern diagnostic tools and surgical techniques to provide both medical and surgical care to patients of all ages.</p>

  <p>ENT services include:</p>
  <ul>
    <li>Ear infections, hearing loss, tinnitus, and balance disorders</li>
    <li>Nasal congestion, sinusitis, nasal polyps, and allergies</li>
    <li>Tonsillitis, throat infections, voice problems, and sleep apnea</li>
    <li>Endoscopic sinus surgery and septoplasty</li>
    <li>Microscopic ear surgery and cochlear implant follow-up</li>
    <li>Head and neck tumors and thyroid disorders</li>
  </ul>

  <p>We provide outpatient consultations, audiological evaluations, allergy testing, and same-day minor procedures. Complex surgeries are performed in our fully equipped surgical suite under general anesthesia.</p>

  <p>Appointments can be booked through our Patient Information portal or by calling the hospital reception.</p>

  <a href="home.php">← Back to Home</a>
</body>
</html>
