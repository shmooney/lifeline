<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: loginn.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Book Appointment - Lifeline Hospital</title>
  <style>

    body {
      font-family: Arial, sans-serif;
      background-color: #f0f8ff;
      padding: 30px;
    }
    .container {
      max-width: 700px;
      margin: auto;
      background: #fff;
      padding: 30px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      border-radius: 10px;
    }
    h1 {
      color: #0069d9;
      margin-bottom: 20px;
    }
    label {
      display: block;
      margin-top: 15px;
      font-weight: bold;
      color: #333;
    }
    input, select, textarea {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 16px;
    }
    /*submit button*/
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
    a {
      display: inline-block;
      margin-top: 20px;
      color: #0069d9;
      text-decoration: none;
    }
    a:hover {
      text-decoration: underline;
    }
    .note {
      color: green;
      font-weight: bold;
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

    <h1>Book an Appointment</h1>

    <form action="process_booking.php" method="POST">
      <label for="full_name">Full Name:</label>
      <input type="text" id="full_name" name="full_name" required>

      <label for="phone">Phone Number:</label>
      <input type="tel" id="phone" name="phone" required>

      <label for="email">Email Address:</label>
      <input type="email" id="email" name="email" required>

      <label for="department">Select Department:</label>
      <select id="department" name="department" required>
        <option value="">--Choose Department--</option>
        <option>General Medicine</option>
        <option>Pediatrics</option>
        <option>Cardiology</option>
        <option>Orthopedics</option>
        <option>Gynecology</option>
        <option>Dental</option>
        <option>Eye Care</option>
      </select>

      <label for="date">Preferred Date:</label>
      <input type="date" id="date" name="date" required>

      <label for="time">Preferred Time:</label>
      <input type="time" id="time" name="time" required>

      <label for="notes">Additional Notes (Optional):</label>
      <textarea id="notes" name="notes" rows="4" placeholder="e.g. Describe symptoms or reason for visit..."></textarea>

      <button type="submit">Submit Appointment</button>
    </form>
  </div>
  <?php include 'footer.php'; ?>

</body>
</html>
