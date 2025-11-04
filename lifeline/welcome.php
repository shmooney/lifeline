<?php
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: loginn.php");
    exit;
}

$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'User';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Welcome to Lifeline Hospital</title>
  <style>
    body {
      background-color: rgb(239, 60, 144);
      margin: 0;
      padding: 0;
      height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      font-family: 'Segoe UI', sans-serif;
    }

    .username {
      font-size: 60px;
      font-weight: bold;
      color: rgb(10, 29, 27);
      animation: slideFadeIn 2s ease-in-out forwards;
    }

    .welcome-text {
      font-size: 45px;
      font-weight: bold;
      color: rgb(8, 26, 23);
      opacity: 0;
      animation: fadeIn 2s ease-in-out forwards;
      animation-delay: 2s;
    }

    @keyframes slideFadeIn {
      0% {
        opacity: 0;
        transform: translateY(-40px);
      }
      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes fadeIn {
      0% { opacity: 0; transform: translateY(30px); }
      100% { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>

  <div class="username">
    ✅ Hey, <?php echo htmlspecialchars($username); ?>!
  </div>
  <div class="welcome-text">
    Welcome To Lifeline Hospital
  </div>

  <!-- Background music -->
  <audio id="welcomeSound" autoplay>
    <source src="sounds/welcome.mp3" type="audio/mpeg">
    Your browser does not support the audio tag.
  </audio>

  <script>
    // Delay redirect after welcome animation and sound
    setTimeout(function () {
      window.location.href = "home.php";
    }, 4500); // 4.5 seconds delay to allow animations
  </script>
</body>
</html>
