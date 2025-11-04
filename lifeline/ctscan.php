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
  <title>CT Scan / MRI Services | Lifeline Hospital</title>
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
  <h1>CT Scan & MRI Services</h1>
  <p>Lifeline Hospital offers state-of-the-art imaging through CT (Computed Tomography) and MRI (Magnetic Resonance Imaging) scans. These non-invasive diagnostic tools provide detailed views of internal structures, enabling accurate diagnosis and effective treatment planning.</p>

  <h2>CT Scan</h2>
  <p>Our 128-slice CT scanner produces rapid, high-resolution images of bones, organs, and blood vessels. Common CT procedures include:</p>
  <ul>
    <li>Brain CT for stroke, tumors, and trauma</li>
    <li>Chest CT for lungs, heart, and blood clots</li>
    <li>Abdominal CT for appendicitis, kidney stones, and liver disease</li>
    <li>Whole-body trauma scans</li>
  </ul>

  <h2>MRI Scan</h2>
  <p>MRI uses magnetic fields and radio waves to create detailed soft tissue images. It is especially useful for:</p>
  <ul>
    <li>Neurological imaging (brain, spine)</li>
    <li>Musculoskeletal scans (joints, ligaments, cartilage)</li>
    <li>Cardiac MRI</li>
    <li>Pelvic MRI for reproductive organs</li>
  </ul>

  <p>All scans are interpreted by highly skilled radiologists and are available with 3D reconstruction upon request. Our radiology team ensures patient safety and comfort, offering contrast-enhanced studies where needed.</p>

  <p>Appointments are required for CT and MRI scans. Urgent and emergency slots are prioritized.</p>

  <a href="home.php">← Back to Home</a>
</body>
</html>
