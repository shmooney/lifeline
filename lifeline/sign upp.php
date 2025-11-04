<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

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
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user = trim($_POST['username']);
    $email = trim($_POST['email']);
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // ✅ Check if user already exists
    $checkUser = $conn->prepare("SELECT * FROM goat WHERE username = ? OR email = ?");
    $checkUser->bind_param("ss", $user, $email);
    $checkUser->execute();
    $result = $checkUser->get_result();

    if ($result->num_rows > 0) {
        $message = "⚠️ Account already exists. <a href='loginn.php'>Please log in</a>.";
        $checkUser->close();
    } else {
        $checkUser->close(); // close SELECT stmt before creating INSERT

        // ✅ Insert new user
        $insert = $conn->prepare("INSERT INTO goat (username, email, password) VALUES (?, ?, ?)");
        $insert->bind_param("sss", $user, $email, $pass);

        if ($insert->execute()) {
            echo "
            <div class='popup'>✅ Signup successful! Redirecting to login...</div>
            <style>
              .popup {
                position: fixed;
                top: 20%;
                left: 50%;
                transform: translate(-50%, -50%);
                background-color: rgb(96, 245, 240);
                color: #155724;
                padding: 20px 30px;
                border: 2px solid rgb(243, 146, 228);
                border-radius: 10px;
                font-size: 18px;
                box-shadow: 0 0 10px rgba(0,0,0,0.2);
                animation: fadeIn 0.5s ease-in-out;
                z-index: 9999;
              }
              @keyframes fadeIn {
                from { opacity: 0; transform: translate(-50%, -60%); }
                to { opacity: 1; transform: translate(-50%, -50%); }
              }
            </style>
            <script>
              setTimeout(function() {
                window.location.href = 'loginn.php';
              }, 3000);
            </script>";
            $insert->close();
            exit;
        } else {
            $message = "Error: " . $insert->error;
            $insert->close();
        }
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <script>
  window.onload = function () {
    if (localStorage.getItem("loggedIn") === "true") {
      window.location.href = "home.php";
    }
  };
</script>

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>WELCOME - Sign Up</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color:rgb(17, 198, 234);
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .signup-container {
     background: url('images/wallpaper.jpg') no-repeat center center;
  background-size: cover;
  padding: 30px 40px;
  border-radius: 8px;
  box-shadow: 0 0 15px rgba(0,0,0,0.1);
  width: 300px;
  text-align: center;
  backdrop-filter: blur(4px);
    }

    h1 {
      margin-bottom: 24px;
      color: #333;
    }

    .message {
      color: red;
      font-size: 14px;
      margin-bottom: 10px;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      margin: 8px 0;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    button {
      width: 100%;
      padding: 10px;
      background-color:rgb(102, 7, 29);
      border: none;
      color: white;
      font-size: 16px;
      border-radius: 4px;
      cursor: pointer;
    }

    button:hover {
      background-color:rgb(133, 9, 61);
    }

    .bottom-text {
      margin-top: 16px;
      font-size: 14px;
    }

    .bottom-text a {
      color:rgb(225, 103, 16);
      text-decoration: none;
    }

    .bottom-text a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <div class="signup-container">
    <h1>WELCOME</h1>
    <?php if (!empty($message)) echo "<div class='message'>$message</div>"; ?>
    <form action="sign upp.php" method="POST">
      <input type="text" name="username" placeholder="Username" required />
      <input type="email" name="email" placeholder="Email" required />
      <input type="password" name="password" placeholder="Password" required />
      <button type="submit">Sign Up</button>
    </form>
    <div class="bottom-text">
      Already have an account? <a href="loginn.php">Log in</a>
    </div>
  </div>


</body>
</html>
