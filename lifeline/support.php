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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = trim($_POST["name"]);
  $email = trim($_POST["email"]);
  $subject = trim($_POST["subject"]);
  $message = trim($_POST["message"]);

  $stmt = $conn->prepare("INSERT INTO contact_support (name, email, subject, message) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("ssss", $name, $email, $subject, $message);

  if ($stmt->execute()) {
    $success = "✅ Your message has been sent. We will get back to you soon.";
  } else {
    $error = "❌ There was a problem sending your message. Please try again.";
  }

  $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Contact Support - Lifeline Hospital</title>
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
      background: #ffffff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    h1 {
      color: #0069d9;
      text-align: center;
      margin-bottom: 30px;
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
      border-radius: 6px;
      border: 1px solid #ccc;
      font-size: 15px;
    }

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

    .message {
      margin-top: 20px;
      font-weight: bold;
    }

    .success {
      color: green;
    }

    .error {
      color: red;
    }

    .contact-details {
      margin-top: 40px;
      padding-top: 20px;
      border-top: 1px solid #ccc;
    }

    .contact-details p {
      line-height: 1.8;
    }

    iframe {
      width: 100%;
      height: 300px;
      margin-top: 20px;
      border: 0;
      border-radius: 6px;
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
  </style>
</head>
<body>
  <div class="container">
    <a href="home.php" class="back-home">← Back to Homepage</a>
    <h1>Contact Support</h1>
<h2>Send Your Comments/Suggestions</h2>
    <?php if ($success): ?>
      <p class="message success"><?= $success ?></p>
    <?php elseif ($error): ?>
      <p class="message error"><?= $error ?></p>
    <?php endif; ?>

    <form action="" method="POST">
      <label for="name">Full Name:</label>
      <input type="text" name="name" required>

      <label for="email">Email Address:</label>
      <input type="email" name="email" required>

      <label for="subject">Subject:</label>
      <input type="text" name="subject" required>

      <label for="message">Your Message:</label>
      <textarea name="message" rows="5" required></textarea>

      <button type="submit">Send Message</button>
    </form>

    <div class="contact-details">
      <h2>📞 Other Ways to Reach Us</h2>
      <p>☎️ Call: +254 700066999</p>
      <p>💬 SMS/WhatsApp: +254 734 345 656</p>
      <p>📩 Email: info@lifelinehospital.co.ke</p>
      <p>📌 Address: Lifeline Hospital, Nakuru, Kenya</p>

      <!-- Optional Google Map -->
      <iframe
        src="https://www.google.com/maps?q=Lifeline+Hospital+Nakuru+Kenya&output=embed"
        allowfullscreen>
      </iframe>
    </div>
  </div>

  <footer>
    <p>&copy; 2025 Lifeline Hospital. All Rights Reserved.</p>
  </footer>
</body>
</html>
