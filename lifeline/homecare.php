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
  <title>Homecare Services | Lifeline Hospital</title>
  <meta charset="UTF-8">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f0f8f5;
      padding: 40px;
      line-height: 1.6;
    }
    h1 {
      color: #206a5d;
    }
    h2 {
      color: #2c7873;
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
      color: #206a5d;
    }
    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <h1>Homecare Services</h1>
  <p>Lifeline Hospital's Homecare Services bring quality healthcare directly to your home. Our dedicated team of nurses, therapists, and doctors ensures that patients with chronic illnesses, disabilities, or post-surgery needs receive personalized, compassionate care in a familiar setting.</p>

  <h2>Our Homecare Offerings Include:</h2>
  <ul>
    <li>Post-surgical wound care and follow-up visits</li>
    <li>Medication administration and IV therapy</li>
    <li>Chronic disease monitoring (e.g., diabetes, hypertension)</li>
    <li>Palliative and end-of-life care</li>
    <li>Rehabilitation and physiotherapy at home</li>
    <li>Caregiver support and education</li>
    <li>Nutrition management and counseling</li>
    <li>Routine health check-ups and lab sample collection</li>
  </ul>

  <h2>Why Choose Lifeline Homecare:</h2>
  <p>Our services ensure continuity of care, improved comfort, and reduced hospital visits. We prioritize patient dignity, safety, and quality of life.</p>

  <p>Contact our homecare coordinator today to schedule an assessment or learn more about how we can support your healthcare needs at home.</p>

  <a href="home.php">← Back to Home</a>
</body>
</html>
