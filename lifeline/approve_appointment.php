<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $conn = new mysqli("localhost", "root", "", "host");
    if ($conn->connect_error) {
        http_response_code(500);
        echo "DB connection failed";
        exit;
    }

    $id = intval($_POST['id']);
    $query = "UPDATE appointments SET status='approved' WHERE id = $id";
    
    if ($conn->query($query)) {
        echo "success";
    } else {
        echo "error";
    }

    $conn->close();
}
?>

