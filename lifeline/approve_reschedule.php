<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $conn = new mysqli("localhost", "root", "", "host");
    if ($conn->connect_error) {
        http_response_code(500);
        echo "DB connection failed";
        exit;
    }

    $id = intval($_POST['id']);

    // Get reschedule data
    $res = $conn->query("SELECT * FROM reschedule_requests WHERE id = $id LIMIT 1");
    if ($res->num_rows === 0) {
        echo "not_found";
        exit;
    }

    $row = $res->fetch_assoc();
    $email = $row['email'];
    $new_date = $row['new_date'];
    $new_time = $row['new_time'];
    $old_date = $row['old_date'];

    // Step 1: Update the appointment
    $update = $conn->prepare("UPDATE appointments SET date=?, time=?, status='approved' WHERE email=? AND date=?");
    $update->bind_param("ssss", $new_date, $new_time, $email, $old_date);

    if ($update->execute()) {
        // ✅ Step 2: Mark reschedule request as approved
        $conn->query("UPDATE reschedule_requests SET status='approved' WHERE id = $id");

        echo "success";
    } else {
        echo "update_failed";
    }

    $conn->close();
} else {
    echo "invalid_request";
}
