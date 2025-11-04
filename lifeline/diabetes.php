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
  <title>Diabetes Management | Lifeline Hospital</title>
  <meta charset="UTF-8">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f9f9ff;
      padding: 40px;
      line-height: 1.6;
    }
    h1 {
      color: #2b5d8a;
    }
    h2 {
      color: #3e79ad;
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
      color: #2b5d8a;
    }
    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <h1>Diabetes Management</h1>
  <p>Our Diabetes Management Clinic at Lifeline Hospital provides comprehensive care and education to help patients live well with diabetes. We aim to empower individuals with the tools they need to manage their condition effectively and prevent complications.</p>

  <h2>Services Offered:</h2>
  <ul>
    <li>Diagnosis and screening for Type 1, Type 2, and gestational diabetes</li>
    <li>Personalized diabetes management plans</li>
    <li>Blood glucose monitoring and HbA1c testing</li>
    <li>Diet and nutrition counseling by certified dietitians</li>
    <li>Medication and insulin therapy</li>
    <li>Foot care and eye screening to detect complications</li>
    <li>Diabetes education and self-care training</li>
    <li>Support groups and lifestyle coaching</li>
  </ul>

  <h2>Our Approach:</h2>
  <p>We take a multidisciplinary approach involving endocrinologists, nutritionists, nurses, and pharmacists to support each patient’s journey toward better health.</p>

  <p>Early intervention and continuous monitoring are key to preventing long-term complications such as heart disease, kidney damage, and neuropathy.</p>

  <a href="home.php">← Back to Home</a>
</body>
</html>
