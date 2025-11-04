<?php
// forgot_password.php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "host";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);
    $newPass = $_POST['new_password'];
    $confirmPass = $_POST['confirm_password'];

    // Check passwords match
    if ($newPass !== $confirmPass) {
        $message = "❌ Passwords do not match.";
    } else {
        // Check if user exists by Email
        $stmt = $conn->prepare("SELECT * FROM goat WHERE Email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows === 1) {
            // Hash the new password
            $hashedPass = password_hash($newPass, PASSWORD_DEFAULT);

            // Update password by Email
            $updateStmt = $conn->prepare("UPDATE goat SET Password = ? WHERE Email = ?");
            $updateStmt->bind_param("ss", $hashedPass, $email);
            if ($updateStmt->execute()) {
                $message = "✅ Password updated successfully. You can now login.";
            } else {
                $message = "❌ Failed to update password.";
            }
            $updateStmt->close();
        } else {
            $message = "❌ Email not found.";
        }
        $stmt->close();
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Forgot Password</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: rgb(21, 212, 238);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .forgot-container {
      background: white;
      padding: 20px;
      border-radius: 6px;
      width: 300px;
      box-shadow: 0 0 10px rgba(0,0,0,0.2);
      text-align: center;
    }
    input {
      width: 100%;
      padding: 10px;
      margin: 8px 0;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    button {
      background-color: #5c033a;
      color: white;
      padding: 10px;
      width: 100%;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    button:hover {
      background-color: rgb(132, 5, 83);
    }
    .message {
      margin-bottom: 10px;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="forgot-container">
    <h2>Reset Password</h2>
    <?php if (!empty($message)): ?>
      <div class="message"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>
    <form method="POST">
      <input type="email" name="email" placeholder="Enter your email" required>
      <input type="password" name="new_password" placeholder="Enter new password" required>
      <input type="password" name="confirm_password" placeholder="Confirm new password" required>
      <button type="submit">Update Password</button>
    </form>
    <p><a href="loginn.php">Back to Login</a></p>
  </div>
</body>
</html>
