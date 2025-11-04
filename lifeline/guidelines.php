<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: loginn.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Appointment Guidelines - Lifeline Hospital</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f0f8ff;
      margin: 0;
      padding: 20px;
    }

    .container {
      max-width: 850px;
      margin: auto;
      background-color: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    h2 {
      color: #b00070;
      font-size: 28px;
      margin-bottom: 20px;
    }

    h3 {
      margin-top: 30px;
      color: #333;
    }

    ul {
      padding-left: 20px;
    }

    li {
      margin-bottom: 12px;
      line-height: 1.6;
    }

    .back-btn {
      display: inline-block;
      margin-top: 30px;
      background-color: #b00070;
      color: white;
      padding: 10px 18px;
      text-decoration: none;
      border-radius: 6px;
    }

    .back-btn:hover {
      background-color: #8a004f;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Appointment Guidelines</h2>

    <h3>General Guidelines for All Appointments</h3>
    <ul>
      <li>Please arrive at least <strong>15 minutes before</strong> your appointment time.</li>
      <li>Carry your hospital ID card, national ID, or insurance information if applicable.</li>
      <li>If you're visiting a specialist, bring along any past medical reports or prescriptions.</li>
      <li>In case you're running late, kindly notify us in advance to avoid delays or cancellation.</li>
      <li>For follow-up appointments, always bring the summary or referral form from your last visit.</li>
      <li>Minimize the number of people accompanying you unless necessary (e.g., for minors or elderly).</li>
    </ul>

    <h3>Guidelines for Booking Appointments Online</h3>
    <ul>
      <li>Ensure all form fields are filled out correctly, including your preferred date and time.</li>
      <li>You will receive a confirmation message or email after successful booking.</li>
      <li>Please <strong>do not refresh the page</strong> or click multiple times when submitting your form.</li>
      <li>If you do not receive a confirmation within 1 hour, call us to verify your booking.</li>
      <li>Ensure your contact details are accurate so we can reach you for any updates or reminders.</li>
    </ul>

    <h3>Guidelines for Rescheduling Appointments</h3>
    <ul>
      <li>You can only reschedule an appointment <strong>at least 12 hours before</strong> the original time.</li>
      <li>Use the same contact details as in your original booking for faster verification.</li>
      <li>Wait for a confirmation of the new time slot after rescheduling online.</li>
      <li>If your requested time is unavailable, we will reach out with the next available option.</li>
    </ul>

    <h3>Guidelines for Cancelling Appointments</h3>
    <ul>
      <li>If you no longer need your appointment, please cancel it early to give the slot to another patient.</li>
      <li>You will receive a cancellation confirmation after submitting your request.</li>
      <li>If you cancel accidentally, you must rebook a new appointment — cancellations are final.</li>
      <li>Repeat no-shows without cancellation may result in booking restrictions.</li>
    </ul>

    <a class="back-btn" href="home.php">⬅ Back to Homepage</a>
    <?php include 'footer.php'; ?>

  </div>
</body>
</html>
