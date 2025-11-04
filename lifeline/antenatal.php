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
  <title>Antenatal Care | Lifeline Hospital</title>
  <meta charset="UTF-8">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #fff8f0;
      padding: 40px;
      line-height: 1.6;
    }
    h1 {
      color: #a24c1f;
    }
    h2 {
      color: #c76b35;
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
      color: #a24c1f;
    }
    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <h1>Antenatal Care</h1>
  <p>At Lifeline Hospital, our Antenatal Care program is dedicated to ensuring the health and well-being of both expectant mothers and their babies throughout pregnancy. Our team of obstetricians, midwives, and nurses provides supportive, compassionate, and expert care from conception to delivery.</p>

  <h2>Our Antenatal Services Include:</h2>
  <ul>
    <li>Initial pregnancy confirmation and dating scans</li>
    <li>Regular prenatal checkups and physical assessments</li>
    <li>Ultrasound and fetal growth monitoring</li>
    <li>Blood tests and urine screening</li>
    <li>Management of high-risk pregnancies</li>
    <li>Nutrition counseling and supplementation</li>
    <li>Vaccinations during pregnancy (e.g., Tetanus, Flu)</li>
    <li>Health education classes for mothers and families</li>
    <li>Labor and birth preparation support</li>
  </ul>

  <h2>Why Choose Lifeline Hospital?</h2>
  <ul>
    <li>Highly experienced obstetric team</li>
    <li>Personalized care in a supportive environment</li>
    <li>Modern maternity ward with emergency support</li>
    <li>Seamless referral to specialists when needed</li>
  </ul>

  <p>Your pregnancy journey deserves attention, respect, and expertise — that’s exactly what you’ll find at Lifeline Hospital.</p>

  <a href="home.php">← Back to Home</a>
</body>
</html>
