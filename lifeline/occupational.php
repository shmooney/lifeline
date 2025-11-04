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
  <title>Occupational Therapy | Lifeline Hospital</title>
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
  <h1>Occupational Therapy</h1>
  <p>The Occupational Therapy Department at Lifeline Hospital helps patients of all ages develop, recover, or maintain the skills needed for daily living and working. Our occupational therapists use personalized interventions to improve independence and quality of life.</p>

  <h2>We Support Patients With:</h2>
  <ul>
    <li>Developmental delays in children</li>
    <li>Neurological conditions (stroke, cerebral palsy, multiple sclerosis)</li>
    <li>Post-injury or post-surgical rehabilitation</li>
    <li>Arthritis and other chronic illnesses</li>
    <li>Mental health and cognitive challenges</li>
    <li>Hand and upper limb therapy</li>
  </ul>

  <h2>Our Services Include:</h2>
  <ul>
    <li>Daily living activity training (e.g., dressing, grooming, eating)</li>
    <li>Adaptive equipment assessment and training</li>
    <li>Home and workplace modification guidance</li>
    <li>Sensory integration therapy</li>
    <li>Fine motor and coordination skill development</li>
    <li>Support for school-based and work-related tasks</li>
  </ul>

  <p>Through holistic and goal-directed care, we empower patients to lead fulfilling lives despite physical, cognitive, or emotional limitations.</p>

  <a href="home.php">← Back to Home</a>
</body>
</html>
