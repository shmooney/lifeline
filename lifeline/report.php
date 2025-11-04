<?php
session_start();

// Connect to database
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = trim($_POST['full_name']);
    $appointment_id = trim($_POST['appointment_id']);
    $phone = trim($_POST['phone']);
    $arrival_status = isset($_POST['on_premises']) ? $_POST['on_premises'] : '';

    if ($full_name && $appointment_id && $phone && $arrival_status === 'yes') {

        // ✅ Check if appointment_id exists in appointments table
        $checkSql = "SELECT * FROM appointments WHERE appointment_id = ?";
        $checkStmt = $conn->prepare($checkSql);
        $checkStmt->bind_param("s", $appointment_id);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();

        if ($checkResult->num_rows === 0) {
            $error = "Invalid Appointment ID. Please check your booking details.";
        } else {
            // ✅ Check if already checked in
            $dupSql = "SELECT * FROM checkins WHERE appointment_id = ?";
            $dupStmt = $conn->prepare($dupSql);
            $dupStmt->bind_param("s", $appointment_id);
            $dupStmt->execute();
            $dupResult = $dupStmt->get_result();

            if ($dupResult->num_rows > 0) {
                $error = "You have already checked in for this appointment.";
            } else {
                // ✅ Proceed to insert check-in
                $stmt = $conn->prepare("INSERT INTO checkins (patient_name, appointment_id, checkin_time, status) VALUES (?, ?, NOW(), ?)");
                $status = "Checked In";
                $stmt->bind_param("sss", $full_name, $appointment_id, $status);

                if ($stmt->execute()) {
                    $success = "You have successfully reported online. Please proceed to your respective appointment location.";
                } else {
                    $error = "Failed to check in. Please try again or report at the reception.";
                }
            }
        }
    } else {
        $error = "Please fill all fields and confirm you are within hospital premises.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Online Reporting - Lifeline Hospital</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 600px;
      margin: 40px auto;
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    h2 {
      color: #008080;
      text-align: center;
    }
    label {
      font-weight: bold;
    }
    input, select {
      width: 100%;
      padding: 10px;
      margin: 8px 0 20px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    button {
      background-color: #008080;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      width: 100%;
    }
    button:hover {
      background-color: #006666;
    }
    .message {
      text-align: center;
      margin-bottom: 20px;
      color: green;
    }
    .error {
      color: red;
      text-align: center;
    }
    .back-home {
      display: block;
      text-align: center;
      margin-top: 20px;
      text-decoration: none;
      color: #008080;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <a class="back-home" href="home.php">⬅ Back to Homepage</a>
  <div class="container">
    <h2>Online Patient Reporting</h2>

    <section style="background-color: #f0f8ff; padding: 30px;">
      <h2 style="color: #800080;">📝 Patient Reporting Guidelines</h2>
      <ul style="text-align: left; font-size: 17px; line-height: 1.8;">
        <li><strong>Who should report online:</strong> Patients who have already booked an appointment.</li>
        <li><strong>When to report:</strong> At least <strong>30 minutes</strong> before your scheduled appointment time.</li>
        <li><strong>Documents to carry:</strong> Your National ID/Passport, appointment confirmation ID, and any medical records if applicable.</li>
        <li><strong>After reporting:</strong> You will receive a confirmation message and a staff member will call you in when it’s your turn.</li>
        <li><strong>Note:</strong> This online reporting is only valid for patients who are physically present at the hospital.</li>
      </ul>
    </section>

    <?php if ($success): ?>
      <p class="message">✅ <?php echo $success; ?></p>
    <?php elseif ($error): ?>
      <p class="error">❌ <?php echo $error; ?></p>
    <?php endif; ?>

    <form action="" method="POST">
      <label for="full_name">Full Name:</label>
      <input type="text" name="full_name" required>

      <label for="appointment_id">Appointment ID:</label>
      <input type="text" name="appointment_id" required>

      <label for="phone">Phone Number:</label>
      <input type="text" name="phone" required>

      <label for="on_premises">Are you within hospital premises?</label>
      <select name="on_premises" required>
        <option value="">--Select--</option>
        <option value="yes">Yes</option>
        <option value="no">No</option>
      </select>

      <button type="submit">Check In Now</button>
    </form>

    <?php include 'footer.php'; ?>
  </div>
</body>
</html>

