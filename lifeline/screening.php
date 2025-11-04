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
  <title>Health Screening | Lifeline Hospital</title>
  <meta charset="UTF-8">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f5faff;
      padding: 40px;
      line-height: 1.6;
    }
    h1 {
      color: #195b8a;
    }
    h2 {
      color: #2574a9;
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
      color: #004080;
    }
    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <h1>Health Screening</h1>
  <p>Early detection saves lives. At Lifeline Hospital, our health screening services are designed to identify risk factors and detect diseases early, even before symptoms appear. We offer tailored screening packages for all age groups and lifestyles.</p>

  <h2>Types of Screenings Offered:</h2>
  <ul>
    <li>Blood pressure and cholesterol monitoring</li>
    <li>Diabetes and blood sugar screening</li>
    <li>Cancer screenings (breast, cervical, prostate, colon)</li>
    <li>Vision and hearing assessments</li>
    <li>HIV and STI testing</li>
    <li>Heart health assessments (ECG, lipid profiles)</li>
    <li>Kidney and liver function tests</li>
    <li>Bone density tests</li>
  </ul>

  <h2>Why Choose Us?</h2>
  <ul>
    <li>Qualified medical professionals with expert evaluations</li>
    <li>Customized screening packages based on individual risk factors</li>
    <li>Modern lab equipment and minimal wait times</li>
    <li>Health counseling and follow-up plans</li>
  </ul>

  <p>Whether you're preparing for travel, employment, school, or just want to stay proactive about your health — Lifeline Hospital is your trusted partner in preventative care.</p>

  <a href="home.php">← Back to Home</a>
</body>
</html>
