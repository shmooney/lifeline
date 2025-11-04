<?php
session_start();

// Database connection settings
$host = "localhost";
$dbname = "company db";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = htmlspecialchars(trim($_POST["fullname"] ?? ''));
   $department = htmlspecialchars(trim($_POST["department"] ?? ''));

    $salary = (float)($_POST["salary"] ?? 0);
    $number = htmlspecialchars(trim($_POST["number"] ?? ''));

    // Validate form inputs
    if (empty($fullname)) $errors[] = "Full name is required.";
    if (!is_numeric($salary)) $errors[] = "Salary must be a number.";
    if (strlen(preg_replace('/\D/', '', $number)) !== 10) $errors[] = "Number must be 10 digits.";

    if (empty($errors)) {
        // Insert into Table
        $stmt = $conn->prepare("INSERT INTO employees (fullname, department, salary, number) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssds", $fullname, $department, $salary, $number);


  echo "<h3>Form Submitted and Data Saved Successfully!</h3>";
echo "<p>" . getIntroduction($fullname, $department) . "</p>";


    // Display employee level message based on salary
    $level = "";
    if ($salary < 30000) {
        $level = "Entry Level";
    } elseif ($salary >= 30000 && $salary <= 70000) {
        $level = "Mid Level";
    } else {
        $level = "Senior Level";
    }

    echo "<h4>Employee Level: <strong>$level</strong></h4>";
} else {
    echo "<h3>Error: " . $stmt->error . "</h3>";
}


        $stmt->close();
    } else {
        foreach ($errors as $err) {
            echo "<div class='server-error'>$err</div>";
        }
    }
function getIntroduction($fullname, $department) {
    // Sanitize input
    $fullname = htmlspecialchars(trim($fullname));
    $department = htmlspecialchars(trim($department));

    // Format the message
    return "Hello, my name is <strong>$fullname</strong> and I work in the <strong>$department</strong> department.";
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            background-color:rgb(219, 247, 115);
        }
        .form-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(224, 54, 54, 0.1);
        }
        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }
        input {
            padding: 10px;
            margin-bottom: 15px;
            width: 100%;
            box-sizing: border-box;
        }
        .server-error {
            color: #d32f2f;
            background: #ffebee;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 10px;
        }
        button {
            background:rgb(236, 78, 210);
            color: white;
            padding: 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background:rgb(236, 37, 177);
        }
    </style>
</head>
<body>

<h2>Employee Information Form</h2>

<form method="post" action="">
    <label for="fullname">Full Name:</label>
    <input type="text" id="fullname" name="fullname" required>

 <label for="department">Department:</label>
<input type="text" id="department" name="department" required>


    <label for="salary">Salary:</label>
    <input type="number" id="salary" name="salary" min="0" required>

    <label for="number"> Contact Number:</label>
    <input type="number" id="number" name="number" required>

    <button type="submit">Submit</button>
</form>

<script>
    document.querySelector('form').addEventListener('submit', function(event) {
        let isValid = true;

        const name = document.getElementById('fullname').value.trim();
        const salary = document.getElementById('salary').value.trim();
        const contact = document.getElementById('number').value.trim();

        if (name === '') {
            alert("Full Name is required");
            isValid = false;
        }
        if (salary === '' || isNaN(salary)) {
            alert("Salary must be a valid number");
            isValid = false;
        }
        if (contact.replace(/\D/g, '').length !== 10) {
            alert("Number must be exactly 10 digits");
            isValid = false;
        }

        if (!isValid) {
            event.preventDefault();
        }
    });
</script>

</body>
</html>
