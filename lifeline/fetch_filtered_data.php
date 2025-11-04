<?php
$conn = new mysqli("localhost", "root", "", "host");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$filter_start_date = $_GET['filter_start_date'] ?? '';
$filter_end_date = $_GET['filter_end_date'] ?? '';
$filter_email = $_GET['filter_email'] ?? '';
$filter_department = $_GET['filter_department'] ?? '';
$filter_status = $_GET['filter_status'] ?? '';

$where_clauses = [];

if ($filter_start_date && $filter_end_date) {
    $where_clauses[] = "date BETWEEN '$filter_start_date' AND '$filter_end_date'";
}
if ($filter_email) {
    $where_clauses[] = "email LIKE '%$filter_email%'";
}
if ($filter_department) {
    $where_clauses[] = "department LIKE '%$filter_department%'";
}
if ($filter_status) {
    $where_clauses[] = "status = '$filter_status'";
}

$sql = "SELECT * FROM appointments";
if ($where_clauses) {
    $sql .= " WHERE " . implode(" AND ", $where_clauses);
}

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['id']}</td>
        <td>" . htmlspecialchars($row['full_name']) . "</td>
        <td>{$row['phone']}</td>
        <td>{$row['appointment_id']}</td>
        <td>{$row['time']}</td>
        <td>{$row['date']}</td>
        <td>{$row['department']}</td>
        <td>";

    if ($row['status'] === 'approved') {
        echo '<span style="color: green; font-weight: bold;">Approved</span>';
    } else {
        echo "<button class='approve-btn' onclick='approveAppointment({$row['id']}, this)'>Approve</button>";
    }

    echo "</td></tr>";
}
?>
