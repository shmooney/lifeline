<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: loginn.php");
    exit;
}

// DB connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "host";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = trim($_POST['fullname']);
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $id_number = trim($_POST['id_number']);

    $sql = "INSERT INTO patient_registration (fullname, dob, gender, email, phone, address, id_number)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $fullname, $dob, $gender, $email, $phone, $address, $id_number);

    if ($stmt->execute()) {
        $message = "✅ Registration successful!";
    } else {
        $message = "❌ Error: " . $conn->error;
    }

    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Patient Registration - Lifeline Hospital</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f4f4f4; padding: 20px; }
    .container {
      background: #fff;
      padding: 30px;
      border-radius: 8px;
      max-width: 800px;
      margin: auto;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    h2 { color: #b00070; }
    p, label { font-size: 16px; }
    .back-btn {
      display: inline-block;
      margin-top: 20px;
      background-color: #b00070;
      color: #fff;
      padding: 10px 20px;
      text-decoration: none;
      border-radius: 5px;
    }
    .back-btn:hover { background-color: #900058; }
    form { margin-top: 25px; }
    input, select, textarea {
      width: 100%;
      padding: 10px;
      margin-top: 6px;
      margin-bottom: 16px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    input[type="submit"] {
      background-color: #b00070;
      color: white;
      cursor: pointer;
      border: none;
    }
    input[type="submit"]:hover {
      background-color: #900058;
    }
    .message {
      margin-top: 15px;
      color: green;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="container">
     <a href="home.php" class="back-btn">⬅ Back to Homepage</a>
         <p>To ensure smooth service delivery, all new patients must register at our reception or online portal.</p>
    <ul>
      <li>Bring your National ID or Passport.</li>
      <li>Insurance details if applicable.</li>
      <li>Medical history documents or prior diagnoses.</li>
      <li>Emergency contact details.</li>
      </ul>
      <h4>Patients willing to register online should fill the form below:</h4>

    <h2>Patient Registration</h2>
    <p>Please fill in the form below to register as a patient at Lifeline Hospital.</p>

    <?php if (!empty($message)): ?>
      <div class="message"><?php echo $message; ?></div>
    <?php endif; ?>

    <form method="POST" action="">
      <label for="fullname">Full Name</label>
      <input type="text" name="fullname" required>

      <label for="dob">Date of Birth</label>
      <input type="date" name="dob" required>

      <label for="gender">Gender</label>
      <select name="gender" required>
        <option value="">-- Select Gender --</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Other">Other</option>
      </select>

      <label for="email">Email</label>
      <input type="email" name="email" required>

      <label for="phone">Phone Number</label>
      <input type="text" name="phone" required>

      <label for="address">Address</label>
      <textarea name="address" rows="2" required></textarea>

      <label for="id_number">ID/Passport Number</label>
      <input type="text" name="id_number" required>

      <input type="submit" value="Register Patient">
    </form>

   <?php include 'footer.php'; ?>

  </div>
</body>
</html>
