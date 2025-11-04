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
  <title>Cardiology Services | Lifeline Hospital</title>
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
  <h1>Cardiology Services</h1>
  <p>At Lifeline Hospital, our cardiology department provides expert care in diagnosing and treating heart and blood vessel conditions. We use the latest technology to deliver safe and effective cardiovascular care to patients of all ages.</p>

  <h2>Cardiology Services Offered:</h2>
  <ul>
    <li>Cardiac consultations and evaluations</li>
    <li>Electrocardiogram (ECG) and Echocardiography</li>
    <li>Stress testing and cardiac monitoring</li>
    <li>Hypertension and cholesterol management</li>
    <li>Heart failure and arrhythmia management</li>
    <li>Pre- and post-operative cardiac care</li>
    <li>Referral for cardiac catheterization or surgery</li>
  </ul>

  <p>Our cardiologists work closely with other specialists to ensure a comprehensive approach to cardiovascular health. Patient education and preventive care are central to our treatment philosophy.</p>

  <p>For heart health concerns or routine cardiac check-ups, book an appointment with our team today.</p>

  <a href="home.php">← Back to Home</a>
</body>
</html>
