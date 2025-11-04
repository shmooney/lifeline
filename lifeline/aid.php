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
  <title>First Aid Services | Lifeline Hospital</title>
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
  <h1>First Aid Services</h1>
  <p>Lifeline Hospital provides prompt and efficient first aid for minor injuries and medical conditions. Our goal is to stabilize patients and prepare them for further treatment when needed.</p>

  <h2>What We Offer</h2>
  <ul>
    <li>Treatment of minor cuts, burns, sprains, and bruises</li>
    <li>Basic wound cleaning and dressing</li>
    <li>Fever and pain management</li>
    <li>First aid for allergic reactions, insect bites, and nosebleeds</li>
    <li>Stabilization of fractures and dislocations before referral</li>
  </ul>

  <p>Our team is trained to assess and provide immediate care to both walk-in patients and those brought in through our ambulance services. We also offer first aid education and training sessions for schools, workplaces, and the general public.</p>

  <p>Visit our outpatient department or contact us for first aid inquiries or services.</p>

  <a href="home.php">← Back to Home</a>
</body>
</html>
