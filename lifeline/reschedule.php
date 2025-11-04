<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: loginn.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Connect to the database
    $conn = new mysqli("localhost", "root", "", "host");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data
    $email = $_POST['email'] ?? null;
    $old_date = $_POST['old_date'] ?? null;
    $new_date = $_POST['new_date'] ?? null;
    $new_time = $_POST['new_time'] ?? null;
    $reason = $_POST['reason'] ?? null;

    // Validate required fields
    if (!$email || !$old_date || !$new_date || !$new_time) {
        echo "<script>alert('Please fill in all required fields.');</script>";
    } else {
        // Step 1: Check if appointment exists
        $checkSql = "SELECT * FROM appointments WHERE email = ? AND date = ?";
        $checkStmt = $conn->prepare($checkSql);
        $checkStmt->bind_param("ss", $email, $old_date);
        $checkStmt->execute();
        $result = $checkStmt->get_result();

        if ($result->num_rows === 0) {
            echo "<script>alert('No appointment found for this email and date. Please check your details.'); window.history.back();</script>";
            exit;
        }

        // Step 2: Insert into reschedule_requests
        $stmt = $conn->prepare("INSERT INTO reschedule_requests (email, old_date, new_date, new_time, reason) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $email, $old_date, $new_date, $new_time, $reason);

      if ($stmt->execute()) {
    // Step 3: Update the appointments table
    $updateSql = "UPDATE appointments SET date = ?, time = ? WHERE email = ? AND date = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("ssss", $new_date, $new_time, $email, $old_date);

    if ($updateStmt->execute()) {
        echo "<script>alert('Your appointment has been rescheduled successfully.'); window.location.href='home.php';</script>";
        exit;
    } else {
        echo "<script>alert('Reschedule log saved, but failed to update appointment: " . $updateStmt->error . "');</script>";
    }

        } else {
            echo "<script>alert('Database error: " . $stmt->error . "');</script>";
        }

        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Reschedule Appointment - Lifeline Hospital</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f9ff;
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
      color: #0069d9;
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin: 10px 0 5px;
      font-weight: bold;
    }

    input, select {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    button {
      background: #0069d9;
      color: white;
      border: none;
      padding: 12px 20px;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
      width: 100%;
    }

    button:hover {
      background: #0056b3;
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

  <script>
    window.onload = function () {
      const today = new Date().toISOString().split('T')[0];
      document.getElementById("old_date").setAttribute("max", today); // Old date must not be in future
      document.getElementById("new_date").setAttribute("min", today); // New date must be today or later
    };
  </script>
</head>
<body>

<div class="container">
   <a href="home.php" class="back-home">← Back to Homepage</a>
   <h2>Reschedule Your Appointment</h2>
   <form action="reschedule.php" method="POST">
     <label for="email">Email Address Used for Booking:</label>
     <input type="email" name="email" id="email" required>

     <label for="old_date">Current Appointment Date:</label>
     <input type="date" name="old_date" id="old_date" required>

     <label for="new_date">New Preferred Date:</label>
     <input type="date" name="new_date" id="new_date" required>

     <label for="new_time">New Preferred Time:</label>
     <input type="time" name="new_time" id="new_time" required>

     <label for="reason">Reason for Rescheduling (optional):</label>
     <input type="text" name="reason" id="reason">

     <button type="submit">Submit Reschedule Request</button>
   </form>
   <?php include 'footer.php'; ?>
</div>

</body>
</html>
