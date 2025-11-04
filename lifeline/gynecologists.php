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
  <title>Gynecology Services | Lifeline Hospital</title>
  <meta charset="UTF-8">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f9ff;
      padding: 40px;
      line-height: 1.6;
    }
    h1 {
      color: #8a045f;
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
  <h1>Gynecology Services</h1>
  <p>Lifeline Hospital offers comprehensive gynecological services tailored to meet the unique healthcare needs of women at every stage of life. Our experienced gynecologists provide care in a supportive, confidential, and compassionate environment.</p>

  <h2>Our Gynecology Services Include:</h2>
  <ul>
    <li>Annual well-woman exams and Pap smears</li>
    <li>Family planning and contraceptive counseling</li>
    <li>Menstrual disorder diagnosis and treatment</li>
    <li>Management of fibroids, endometriosis, and PCOS</li>
    <li>Gynecological cancer screening and treatment referrals</li>
    <li>Hormonal therapy and menopause care</li>
    <li>Minimally invasive gynecologic surgeries</li>
  </ul>

  <p>We are committed to empowering women to take control of their health through education, prevention, and timely intervention. All consultations are handled with the highest level of privacy and respect.</p>

  <p>Schedule your gynecology appointment today by calling our clinic or using our patient portal.</p>

  <a href="home.php">← Back to Home</a>
</body>
</html>
