<?php
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
$success = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user = trim($_POST['username'] ?? '');
    $pass = $_POST['password'] ?? '';

    // Admin credentials list
    $admins = [
        "felix0@gmail.com" => "4567",
        "doe@gmail.com" => "1234", // new admin
        "son@gmail.com" => "7777"
    ];

    // Check admin login
    if (isset($admins[$user]) && $pass === $admins[$user]) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $user;
        $_SESSION['is_admin'] = true;
        header("Location: admin.php");
        exit;
    }

    // Normal user login
    $stmt = $conn->prepare("SELECT * FROM goat WHERE Username = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (password_verify($pass, $row['Password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $row['Username'];
            $_SESSION['is_admin'] = false;
            header("Location: welcome.php");
            exit;
        } else {
            $message = "Incorrect password.";
        }
    } else {
        $message = "User not found. Please sign up.";
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Hospital Login</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color:rgb(21, 212, 238); 
      background-size: cover;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .login-container {
      background: url('images/wallpaper.jpg') no-repeat center center;
      background-size: cover;
      padding: 30px 40px;
      border-radius: 8px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
      width: 300px;
      text-align: center;
      backdrop-filter: blur(4px);
      animation: fadeIn 0.8s;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    h2 {
      margin-bottom: 24px;
      color: #333;
    }
    .message {
      color: red;
      font-size: 14px;
      margin-bottom: 10px;
    }
    .success {
      color: green;
      font-size: 16px;
      margin-bottom: 10px;
    }
    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    button {
      width: 100%;
      padding: 10px;
      background-color: #5c033a;
      color: white;
      font-size: 16px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    button:hover {
      background-color:rgb(132, 5, 83);
    }
    .bottom-text {
      margin-top: 16px;
      font-size: 14px;
    }
    .bottom-text a {
      color:rgb(230, 87, 10);
      text-decoration: none;
    }
    .bottom-text a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <div class="login-container">
    <h2>Login</h2>
    <?php if (!empty($message)): ?>
      <div class="message"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>
    <?php if ($success): ?>
      <div class="success">☑️ Login successful. Redirecting...</div>
    <?php endif; ?>
    <form action="loginn.php" method="POST">
      <input type="text" name="username" placeholder="Email/Username" required />
      <input type="password" name="password" placeholder="Password" required />
      <button type="submit">Log In</button>
    </form>
    <div class="bottom-text">
      Don't have an account? <a href="sign upp.php">Sign up</a><br>
       <a href="forgot_password.php">Forgot Password?</a>
    </div>
  </div>

</body>
</html>
