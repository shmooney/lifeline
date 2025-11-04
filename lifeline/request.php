<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "host";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = trim($_POST["full_name"]);
    $patient_id = trim($_POST["patient_id"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);
    $record_type = $_POST["record_type"];
    $reason = trim($_POST["reason"]);

    $stmt = $conn->prepare("INSERT INTO medical_records_requests (full_name, patient_id, email, phone, record_type, reason) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $full_name, $patient_id, $email, $phone, $record_type, $reason);

    if ($stmt->execute()) {
        $success = "✅ Your medical records request has been submitted successfully.";
    } else {
        $error = "❌ Failed to submit your request. Please try again.";
    }

    $stmt->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Medical Records - Lifeline Hospital</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f0f8ff;
      margin: 0;
      padding: 20px;
    }

    .container {
      max-width: 800px;
      margin: auto;
      background: #ffffff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    h1, h2 {
      color: #0069d9;
      text-align: center;
    }

    p, ul, li {
      color: #333;
      line-height: 1.6;
    }

    ul {
      padding-left: 20px;
    }

    label {
      display: block;
      margin-top: 15px;
      font-weight: bold;
    }

    input, select, textarea {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border-radius: 6px;
      border: 1px solid #ccc;
      font-size: 15px;
    }

    button {
      margin-top: 20px;
      background-color: #e11295;
      color: white;
      border: none;
      padding: 12px 20px;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
    }

    button:hover {
      background-color: #a20c6f;
    }

    .message {
      margin-top: 10px;
      font-weight: bold;
      color: green;
    }

    .error {
      color: red;
    }

    .back-home {
      position: absolute;
      top: 20px;
      right: 30px;
      background-color: #0069d9;
      color: white;
      padding: 10px 16px;
      text-decoration: none;
      border-radius: 5px;
      font-weight: bold;
      transition: background-color 0.3s;
    }

    .back-home:hover {
      background-color: #004a9f;
    }
  </style>
</head>
<body>
  <div class="container">
    <a href="home.php" class="back-home">← Back to Homepage</a>
    <h1>Medical Records</h1>

    <p>At Lifeline Hospital, we maintain complete and secure medical records for every patient. You can request your records for personal use, doctor referrals, or insurance claims.</p>

    <h2>📋 What’s Included?</h2>
    <ul>
      <li>Diagnosis & treatment history</li>
      <li>Lab test & imaging results</li>
      <li>Doctor's visit notes</li>
      <li>Medications & prescriptions</li>
      <li>Discharge summaries & surgical reports</li>
    </ul>

    <h2>📝 Request Medical Records</h2>

    <?php if ($success): ?>
      <p class="message"><?php echo $success; ?></p>
    <?php elseif ($error): ?>
      <p class="message error"><?php echo $error; ?></p>
    <?php endif; ?>

<form action="" method="POST">
  <label for="full_name">Full Name:</label>
  <input type="text" name="full_name" id="full_name" required>

  <label for="patient_id">Patient ID:</label>
  <input type="text" name="patient_id" id="patient_id" required>

  <label for="email">Email Address:</label>
  <input type="email" name="email" id="email" required>

  <label for="phone">Phone Number:</label>
  <input type="tel" name="phone" id="phone" required>

  <label for="record_type">Type of Record Needed:</label>
  <select name="record_type" id="record_type" required>
    <option value="">-- Select --</option>
    <option>Full Medical History</option>
    <option>Lab Test Results</option>
    <option>X-Ray / Imaging</option>
    <option>Prescription Summary</option>
    <option>Hospital Admission Records</option>
  </select>

  <label for="reason">Purpose of Request:</label>
  <textarea name="reason" id="reason" rows="4" placeholder="E.g. For doctor referral, insurance claim, personal copy..." required></textarea>

  <button type="submit">Submit Request</button>
</form>

    

    <h2>🔒 Your Privacy Matters</h2>
    <p>We protect your information in accordance with Kenya’s Data Protection Act. Only authorized individuals can access or request your records with valid identification and consent.</p>

    <h2>⏱️ Processing Time</h2>
    <p>Most requests are processed within 2–5 working days. Our records team may contact you for verification or clarification if needed.</p>
    <?php include 'footer.php'; ?>

  </div>
</body>
</html>
