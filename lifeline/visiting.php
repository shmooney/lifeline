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
  <title>Visiting Hours - Lifeline Hospital</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f0f4f8;
      margin: 0;
      padding: 20px;
    }

    .container {
      max-width: 900px;
      margin: auto;
      background-color: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    h2 {
      color: #b00070;
      font-size: 28px;
      margin-bottom: 15px;
    }

    h3 {
      color: #333;
      margin-top: 30px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 15px;
    }

    th, td {
      padding: 12px 15px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #b00070;
      color: white;
    }

    ul {
      padding-left: 20px;
    }

    li {
      margin-bottom: 10px;
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
    <h2>Visiting Hours</h2>
    <p>We encourage visits from friends and family while maintaining a healing environment for all patients. Below is the visiting schedule:</p>

    <table>
      <tr>
        <th>Day</th>
        <th>Visiting Hours</th>
      </tr>
      <tr>
        <td>Monday – Friday</td>
        <td>12:00 PM – 2:00 PM<br>4:30 PM – 6:30 PM</td>
      </tr>
      <tr>
        <td>Saturday</td>
        <td>10:00 AM – 1:00 PM<br>4:00 PM – 6:00 PM</td>
      </tr>
      <tr>
        <td>Sunday & Public Holidays</td>
        <td>10:00 AM – 12:30 PM<br>3:00 PM – 5:30 PM</td>
      </tr>
      <tr>
        <td>ICU & HDUs</td>
        <td>12:30 PM – 1:00 PM (Only 1 visitor per patient)</td>
      </tr>
    </table>

    <h3>Visitor Guidelines</h3>
    <ul>
      <li>Maximum of <strong>2 visitors</strong> per patient at a time.</li>
      <li>Children under <strong>12 years</strong> are not permitted in the wards.</li>
      <li><strong>Sanitize hands</strong> before and after visiting.</li>
      <li>Food, drinks, and loud music are <strong>not allowed</strong> in patient rooms.</li>
      <li>Please respect other patients by keeping voices <strong>low</strong> and minimizing disruption.</li>
      <li>Always follow directions from hospital staff for safety and care.</li>
      <li>Visits outside official hours require special permission from the ward nurse.</li>
      <li><strong>ICU areas have strict rules</strong> due to patient sensitivity—short, quiet visits only.</li>
    </ul>

    <h3>For Patients Coming to See Doctors (Outpatient/Consultation)</h3>
    <ul>
      <li>All patients must <strong>report at the reception</strong> upon arrival.</li>
      <li>Ensure you carry your <strong>hospital card or ID</strong> for identification.</li>
      <li>Appointments are attended based on <strong>booking time or medical urgency</strong>.</li>
      <li>Please <strong>arrive at least 15 minutes early</strong> to your appointment.</li>
      <li>If you have not booked online, you may still walk in but will be assisted based on availability.</li>
      <li>Accompanying persons should be limited to <strong>one guardian</strong> unless necessary.</li>
      <li>All patients are advised to follow <strong>masking, hygiene, and distancing</strong> measures inside the facility.</li>
    </ul>

    <a class="back-btn" href="home.php">⬅ Back to Homepage</a>
    <?php include 'footer.php'; ?>

  </div>
</body>
</html>
