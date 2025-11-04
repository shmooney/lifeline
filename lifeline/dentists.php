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
  <title>Dental Services | Lifeline Hospital</title>
  <meta charset="UTF-8">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #fefefe;
      padding: 40px;
      line-height: 1.7;
    }
    h1 {
      color: #d43f00;
    }
    h2 {
      color: #b33900;
    }
    p, ul {
      margin-bottom: 20px;
    }
    ul {
      padding-left: 20px;
    }
    a {
      display: inline-block;
      margin-top: 20px;
      text-decoration: none;
      color: #d43f00;
    }
    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <h1>Dental Services</h1>
  <p>At Lifeline Hospital, we offer comprehensive dental services to help maintain your oral health and give you a confident smile. Our dental clinic is staffed with experienced dentists, hygienists, and specialists who use modern equipment and patient-focused care approaches.</p>

  <h2>Our Dental Services Include:</h2>
  <ul>
    <li>Routine dental check-ups and cleanings</li>
    <li>Tooth extractions (simple and surgical)</li>
    <li>Fillings and restorations</li>
    <li>Root canal therapy (endodontics)</li>
    <li>Dental crowns and bridges</li>
    <li>Teeth whitening and cosmetic dentistry</li>
    <li>Orthodontic consultations (braces & aligners)</li>
    <li>Scaling and polishing for gum health</li>
    <li>Dental education and preventive care</li>
  </ul>

  <h2>Why Choose Lifeline Dental Clinic?</h2>
  <p>Our dental department emphasizes gentle care, sterile techniques, and comprehensive treatment plans. We are committed to ensuring your comfort and dental well-being at every visit.</p>

  <p>We welcome patients of all ages and tailor services to your needs, whether it's pain management, cosmetic improvement, or long-term oral health.</p>

  <a href="home.php">&larr; Back to Home</a>
</body>
</html>
