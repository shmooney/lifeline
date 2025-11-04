<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: loginn.php");
    exit;
}

// Only run this logic when the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // DB connection
    $conn = new mysqli("localhost", "root", "", "host");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Collect form data
    $email = $_POST['email'] ?? null;
    $appointment_date = $_POST['appointment_date'] ?? null;
    $reason = $_POST['reason'] ?? null;

    if (!$email || !$appointment_date) {
        echo "<script>alert('Email and appointment date are required.'); window.history.back();</script>";
        exit;
    }

    // Step 1: Check if appointment exists
    $checkSql = "SELECT * FROM appointments WHERE email = ? AND date = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("ss", $email, $appointment_date);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows === 0) {
        echo "<script>alert('No appointment found with that email and date.'); window.history.back();</script>";
        exit;
    }

    // Step 2: Insert into cancelled_appointments
    $insertSql = "INSERT INTO cancelled_appointments (email, appointment_date, reason) VALUES (?, ?, ?)";
    $insertStmt = $conn->prepare($insertSql);
    $insertStmt->bind_param("sss", $email, $appointment_date, $reason);
    $insertStmt->execute();

    // Step 3: Delete from appointments
    $deleteSql = "DELETE FROM appointments WHERE email = ? AND date = ?";
    $deleteStmt = $conn->prepare($deleteSql);
    $deleteStmt->bind_param("ss", $email, $appointment_date);
    $deleteStmt->execute();

    // Done
    echo "<script>alert('Appointment cancelled successfully.'); window.location.href='home.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Cancel Appointment - Lifeline Hospital</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #fdf2f8;
      margin: 0;
      padding: 0;
    }

    .container {
      width: 80%;
      max-width: 600px;
      margin: 60px auto;
      background: white;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 0 12px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      color: #c2185b;
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin: 10px 0 5px;
      font-weight: bold;
    }

    input, textarea {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    button {
      background: #c2185b;
      color: white;
      border: none;
      padding: 12px 20px;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
      width: 100%;
    }

    button:hover {
      background: #ad1457;
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
  <h2>Cancel Your Appointment</h2>
  <form action="cancel.php" method="POST">
    <label for="email">Email Address Used for Booking:</label>
    <input type="email" name="email" id="email" required>

    <label for="appointment_date">Appointment Date:</label>
    <input type="date" name="appointment_date" id="appointment_date" required>

    <label for="reason">Reason for Cancellation:</label>
    <textarea name="reason" id="reason" rows="4" placeholder="Optional, but helps us improve service..."></textarea>

    <button type="submit">Submit Cancellation</button>
  </form>
</div>
<?php include 'footer.php'; ?>

</body>
</html>
