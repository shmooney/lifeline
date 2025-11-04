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
  <title>Psychiatry Services | Lifeline Hospital</title>
  <meta charset="UTF-8">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f9ff;
      padding: 40px;
      line-height: 1.6;
    }
    h1 {
      color: #2e3e5e;
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
  <h1>Psychiatry Services</h1>
  <p>The Psychiatry Department at Lifeline Hospital is committed to supporting mental health and emotional well-being. We provide confidential, compassionate, and professional mental health care tailored to individual needs.</p>

  <h2>Conditions We Treat:</h2>
  <ul>
    <li>Depression and anxiety disorders</li>
    <li>Bipolar and mood disorders</li>
    <li>Post-Traumatic Stress Disorder (PTSD)</li>
    <li>Schizophrenia and psychotic disorders</li>
    <li>Substance abuse and addiction support</li>
    <li>Child and adolescent mental health issues</li>
    <li>Stress and sleep disorders</li>
  </ul>

  <h2>Our Services Include:</h2>
  <ul>
    <li>Comprehensive psychiatric evaluation</li>
    <li>Individual, group, and family therapy</li>
    <li>Medication management</li>
    <li>Support groups and crisis intervention</li>
    <li>Community outreach and awareness programs</li>
  </ul>

  <p>Our psychiatrists collaborate with psychologists, counselors, and other specialists to provide holistic care. We believe in breaking the stigma around mental health by offering respectful and effective treatment options.</p>

  <p>If you or someone you know needs help, reach out today — help starts here.</p>

  <a href="home.php">← Back to Home</a>
</body>
</html>
