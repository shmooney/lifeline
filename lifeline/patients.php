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
  <title>Inpatient & Outpatient Services - Lifeline Hospital</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f0f8ff;
      margin: 0;
      padding: 20px;
    }

    .container {
      max-width: 900px;
      margin: auto;
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 12px rgba(0,0,0,0.1);
    }

    h1 {
      color: #0069d9;
      text-align: center;
      margin-bottom: 30px;
    }

    h2 {
      color: #e11295;
      margin-top: 30px;
    }

    p, li {
      color: #333;
      line-height: 1.6;
    }

    ul {
      margin-top: 10px;
      padding-left: 20px;
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

    footer {
      margin-top: 50px;
      padding: 20px;
      background-color: #5a85b1;
      color: white;
      text-align: center;
      border-radius: 0 0 10px 10px;
    }
  </style>
</head>
<body>
  
    <a href="home.php" class="back-home">← Back to Homepage</a>
    <h1>Inpatient & Outpatient Services</h1>
<p>Lifeline Hospital offers both outpatient care (same-day visits) and inpatient services for patients requiring overnight or extended medical attention.</p>
 <div class="container">
    <h2>🏥 Inpatient Services</h2>
    <p>These are services provided to patients who are admitted for overnight stays or longer. Our inpatient care ensures 24-hour medical supervision and tailored treatment in a comfortable environment.</p>
    <ul>
      <li>24/7 doctor and nurse availability</li>
      <li>General wards, private, and semi-private rooms</li>
      <li>Meals and basic amenities included</li>
      <li>Pre-surgical and post-surgical care</li>
    </ul>

    <h3>🛏️ Wards Information</h3>
    <ul>
      <li><strong>Private Ward:</strong> One patient per room with TV, AC, and private bathroom</li>
      <li><strong>Semi-private Ward:</strong> Two patients per room with shared amenities</li>
      <li><strong>General Ward:</strong> 3+ beds per room for patients with general care needs</li>
    </ul>

    <h2>🤰 Maternity Services</h2>
    <p>We offer full maternity care from antenatal checkups to safe delivery and postnatal support.</p>
    <ul>
      <li>Antenatal clinics and routine scans</li>
      <li>Normal and Cesarean delivery options</li>
      <li>Private maternity rooms available</li>
      <li>Support for both mother and baby post-delivery</li>
    </ul>

    <h3 style="color:#e11295;">Admission Process:</h3>
    <ol>
      <li><strong>Doctor Consultation:</strong> Admission begins after evaluation by a doctor.</li>
      <li><strong>Authorization:</strong> You receive an admission note, then proceed to the admission desk.</li>
      <li><strong>Documents Needed:</strong> Bring ID, insurance card, and any referrals.</li>
      <li><strong>Ward Allocation:</strong> Based on medical need, room availability, and preference.</li>
      <li><strong>Initial Assessment:</strong> Nurses will monitor vitals and history; the doctor begins your care plan.</li>
    </ol>

    <h3 style="color:#e11295;">Discharge Process:</h3>
    <ol>
      <li><strong>Doctor Clearance:</strong> You'll be informed of your discharge date after assessment.</li>
      <li><strong>Discharge Summary:</strong> Includes diagnosis, treatment, meds, and follow-up instructions.</li>
      <li><strong>Billing:</strong> Settle bills or process insurance claims at the finance desk.</li>
      <li><strong>Pharmacy Pickup:</strong> Collect any prescribed medication before leaving.</li>
      <li><strong>Final Check:</strong> Nurse checks your stability before departure.</li>
    </ol>

  </div>

    <h2>🩺 Outpatient Services</h2>
    <p>Outpatients do not stay overnight and receive care during a scheduled visit.</p>
    <ul>
      <li>Specialist consultations (cardiology, pediatrics, gynecology, etc.)</li>
      <li>Laboratory tests and radiology (X-ray, ultrasound)</li>
      <li>Minor procedures and injections</li>
      <li>Chronic disease clinics (diabetes, hypertension)</li>
    </ul>

    <h2>📌 Notes to Patients</h2>
    <ul>
      <li>Arrive 15 minutes early for outpatient appointments</li>
      <li>Follow visiting hours for inpatients: <strong>11:00 AM – 1:00 PM</strong> and <strong>4:00 PM – 6:00 PM</strong></li>
      <li>Only 2 visitors per patient allowed per session</li>
    </ul>


  <footer>
    <p><strong>Contact Us</strong><br>
    ☎️ Call: +254 700066999 | 💬 SMS/WhatsApp: +254 734 345 656<br>
    📩 Email: info@lifelinehospital.co.ke<br>
    📌 Address: Lifeline Hospital, Nakuru, Kenya</p>
  </footer>
</body>
</html>
