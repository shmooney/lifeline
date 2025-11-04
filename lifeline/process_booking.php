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
$appointment_id = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = trim($_POST["full_name"]);
    $phone = trim($_POST["phone"]);
    $email = trim($_POST["email"]);
    $department = trim($_POST["department"]);
    $date = $_POST["date"];
    $time = $_POST["time"];
    $notes = isset($_POST["notes"]) ? trim($_POST["notes"]) : "";

    // Generate unique appointment ID
    $random = rand(100, 999);
    $appointment_id = "APT" . date("Ymd") . "-" . $random;

    // Check for duplicates
    $check = $conn->prepare("SELECT * FROM appointments WHERE full_name=? AND date=? AND time=?");
    $check->bind_param("sss", $full_name, $date, $time);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        $error = "❌ You already have an appointment at that time.";
    } else {
        $stmt = $conn->prepare("INSERT INTO appointments (appointment_id, full_name, phone, email, department, date, time, notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $appointment_id, $full_name, $phone, $email, $department, $date, $time, $notes);

        if ($stmt->execute()) {
            $success = "✅ Appointment booked successfully!";
        } else {
            $error = "❌ Error booking appointment. Please try again.";
        }
        $stmt->close();
    }
    $check->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Appointment Confirmation</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #eef6fc;
      padding: 40px;
      text-align: center;
    }
    .container {
      background: white;
      max-width: 600px;
      margin: auto;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    h1 {
      color: #0069d9;
      margin-bottom: 20px;
    }
    .message {
      font-size: 18px;
      margin: 20px 0;
    }
    .success {
      color: green;
      font-weight: bold;
    }
    .error {
      color: red;
      font-weight: bold;
    }
    .appointment-id {
      font-size: 20px;
      margin-top: 10px;
      color: #4a148c;
    }
    a.button {
      display: inline-block;
      margin: 15px;
      padding: 10px 18px;
      background-color: #0069d9;
      color: white;
      text-decoration: none;
      border-radius: 6px;
      font-weight: bold;
    }
    a.button:hover {
      background-color: #004899;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Appointment Status</h1>

    <?php if ($success): ?>
      <div class="message success"><?php echo $success; ?></div>
      <div class="appointment-id">📋 Your Appointment ID: <strong><?php echo $appointment_id; ?></strong>. Please keep it safe.</div>
    <?php elseif ($error): ?>
      <div class="message error"><?php echo $error; ?></div>
    <?php endif; ?>

    <a href="book.php" class="button">Book Another Appointment</a>
    <a href="home.php" class="button">← Back to Homepage</a>
    <?php include 'footer.php'; ?>

  </div>
</body>
</html>
