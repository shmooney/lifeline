<?php
/*Connect to database*/
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
    $id_number = trim($_POST["id_number"]);
    $service = trim($_POST["service"]);
    $amount = trim($_POST["amount"]);

    $stmt = $conn->prepare("INSERT INTO payments (full_name, id_number, service_received, amount) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssd", $full_name, $id_number, $service, $amount);

    if ($stmt->execute()) {
        $success = "✅ Payment recorded successfully.";
    } else {
        $error = "❌ Failed to record payment. Please try again.";
    }

    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Billing Information - Lifeline Hospital</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f0f8ff;
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

    h1, h2 {
      color: #0069d9;
      text-align: center;
    }

    p, ul {
      color: #333;
      line-height: 1.6;
    }

    ul {
      margin-left: 20px;
    }

    .highlight {
      color: #e11295;
      font-weight: bold;
    }

    .bank-details {
      margin-top: 30px;
      background: #f9f9f9;
      padding: 15px 20px;
      border-radius: 8px;
      border: 1px solid #ddd;
    }

    .bank {
      margin-bottom: 20px;
    }

    .bank-logo {
      width: 30px;
      vertical-align: middle;
      margin-right: 10px;
    }

    .mpesa {
      background-color: #e6ffe6;
      padding: 15px;
      border: 1px solid #cce5cc;
      border-radius: 8px;
      margin-top: 20px;
    }

    .mpesa-logo {
      width: 35px;
      vertical-align: middle;
      margin-right: 8px;
    }

    form {
      margin-top: 30px;
    }

    label {
      display: block;
      margin-top: 15px;
      font-weight: bold;
    }

    input, textarea {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 15px;
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
      margin-top: 40px;
      background-color: #5a85b1;
      color: white;
      padding: 20px;
      text-align: center;
      border-radius: 6px;
    }

    footer p {
      margin: 5px 0;
    }
  </style>
</head>
<body>
  <div class="container">
    <a href="home.php" class="back-home">← Back to Homepage</a>

    <h1>Billing Information</h1>

    <p>We are committed to providing transparent, timely, and patient-friendly billing services at Lifeline Hospital.</p>

    <h2>🧳 Payment Methods Accepted:</h2>
    <ul>
      <li>Cash</li>
      <li>Mobile money (e.g., M-Pesa Paybill)</li>
      <li>Credit/Debit Cards</li>
      <li>Bank Transfers</li>
      <li>Approved Insurance Providers</li>
    </ul>

    <h2>📍 Understanding Your Bill:</h2>
    <ul>
      <li><span class="highlight">Consultation Fees:</span> Doctor and specialist consultation charges.</li>
      <li><span class="highlight">Lab/Imaging Charges:</span> Tests such as X-rays, blood work, etc.</li>
      <li><span class="highlight">Medication:</span> Drugs dispensed from our pharmacy.</li>
      <li><span class="highlight">Procedures:</span> Surgeries or treatments received.</li>
      <li><span class="highlight">Ward Charges:</span> For inpatient services (daily rate based on ward type).</li>
    </ul>

    <h2>🧰 Insurance Billing:</h2>
    <p>If using insurance, please present:</p>
    <ul>
      <li>Your insurance card and ID</li>
      <li>A valid pre-authorization letter (if needed)</li>
      <li>Details of your insurance provider</li>
    </ul>

    <h2>📄 Receipts & Statements</h2>
    <p>You can request printed or emailed copies of your billing statements or receipts at the billing desk.</p>

    <h2>🗣️ Need Help With Billing?</h2>
    <p>Visit our billing office or contact the Finance Department for support.</p>
    <p><strong>Office Hours:</strong> Monday – Saturday, 8:00AM – 5:00PM</p>

    <h2>💳 Bank & MPESA Payment Options</h2>
    <div class="bank-details">
      <div class="bank">
        <img src="images/national.png" alt="National Bank" class="bank-logo">
        <strong>National Bank</strong><br>
        Account Name: NAKURU MEDICARE SERVICES LTD<br>
        Account Number: <strong>01020043120000</strong>
      </div>

      <div class="bank">
        <img src="images/coop.png" alt="Cooperative Bank" class="bank-logo">
        <strong>Cooperative Bank of Kenya</strong><br>
        Account Name: NAKURU MEDICARE SERVICES LTD<br>
        Account Number: <strong>01136031121900</strong>
      </div>

      <div class="bank">
        <img src="images/equity.png" alt="Equity Bank" class="bank-logo">
        <strong>Equity Bank</strong><br>
        Account Name: NAKURU MEDICARE SERVICES LTD<br>
        Account Number: <strong>0110290682826</strong>
      </div>
      
        <div class="bank">
            <img src="images/kcb.png" alt="KCB Bank" class="bank-logo">
            <strong>KCB Bank</strong><br>
            Account Name: NAKURU MEDICARE SERVICES LTD<br>
            Account Number: <strong>1102000000000</strong>
      </div>

      <div class="bank">
        <img src="images/stand.png" alt="Standard Chartered" class="bank-logo">
        <strong>Standard Chartered</strong><br>
        Account Name: NAKURU MEDICARE SERVICES LTD<br>
        Account Number: <strong>010209750250</strong>
      </div>
    </div>

    <div class="mpesa">
      <img src="images/mpesa.png" alt="MPESA" class="mpesa-logo">
      <strong>Paybill Number:</strong> 973010<br>
      <strong>Account Number:</strong> Patient Number
    </div>
  </div>



  <footer>
    <h3>📞 Contact Us</h3>
    <p>☎️ Call: +254 700066999</p>
    <p>💬 SMS/WhatsApp: +254 734 345 656</p>
    <p>📩 Email: info@lifelinehospital.co.ke</p>
    <p>📌 Address: Lifeline Hospital, Nakuru, Kenya</p>
    <p>&copy; 2025 Lifeline Hospital. All Rights Reserved.</p>
  </footer>
</body>
</html>
