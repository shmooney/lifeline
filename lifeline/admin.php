<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: loginn.php");
    exit;
}

// Database connection
$conn = new mysqli("localhost", "root", "", "host");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Approve appointment
if (isset($_POST['approve_id'])) {
    $id = intval($_POST['approve_id']);
    $conn->query("UPDATE appointments SET status='approved' WHERE id=$id");
}

// Approve reschedule request
if (isset($_POST['approve_reschedule_id'])) {
    $id = intval($_POST['approve_reschedule_id']);
    $conn->query("UPDATE reschedule_requests SET status='approved' WHERE id=$id");
}

// Filter parameters
$filter_date = $_GET['filter_date'] ?? '';
$filter_start_date = $_GET['filter_start_date'] ?? '';
$filter_end_date = $_GET['filter_end_date'] ?? '';
$filter_email = $_GET['filter_email'] ?? '';
$filter_department = $_GET['filter_department'] ?? '';
$filter_status = $_GET['filter_status'] ?? '';

// Arrays to hold WHERE conditions
$where_clauses = [];
$reschedule_where = [];
$cancel_where = [];
$checkin_where = [];
$registration_where = [];
$comment_where = [];

// Filter by specific date
if ($filter_date) {
    $where_clauses[] = "date = '$filter_date'";
    $reschedule_where[] = "new_date = '$filter_date'";
    $cancel_where[] = "appointment_date = '$filter_date'";
    $checkin_where[] = "DATE(checkin_time) = '$filter_date'";
    $registration_where[] = "DATE(registration_time) = '$filter_date'";
    $comment_where[] = "DATE(time) = '$filter_date'";
}

// Filter by date range
if ($filter_start_date && $filter_end_date) {
    $where_clauses[] = "date BETWEEN '$filter_start_date' AND '$filter_end_date'";
    $reschedule_where[] = "new_date BETWEEN '$filter_start_date' AND '$filter_end_date'";
    $cancel_where[] = "appointment_date BETWEEN '$filter_start_date' AND '$filter_end_date'";
    $checkin_where[] = "DATE(checkin_time) BETWEEN '$filter_start_date' AND '$filter_end_date'";
    $registration_where[] = "DATE(registration_time) BETWEEN '$filter_start_date' AND '$filter_end_date'";
    $comment_where[] = "DATE(time) BETWEEN '$filter_start_date' AND '$filter_end_date'";
}

// Filter by email (use appropriate field names per table)
if ($filter_email) {
    // For appointments, reschedules, and cancellations - assuming they have 'email'
    $where_clauses[] = "email LIKE '%$filter_email%'";
    $reschedule_where[] = "email LIKE '%$filter_email%'";
    $cancel_where[] = "email LIKE '%$filter_email%'";

    // For checkins, patient_registration, and contact_support 
    $checkin_where[] = "patient_name LIKE '%$filter_email%'";
    $registration_where[] = "email LIKE '%$filter_email%'";
    $comment_where[] = "email LIKE '%$filter_email%'";
}

// Filter by department
if ($filter_department) {
    $where_clauses[] = "department LIKE '%$filter_department%'";
}

// Filter by status
if ($filter_status) {
    $where_clauses[] = "status = '$filter_status'";
    $reschedule_where[] = "status = '$filter_status'";
}

// SQL Queries (with filters applied)
$appointments_sql = "SELECT * FROM appointments" . (count($where_clauses) ? " WHERE " . implode(" AND ", $where_clauses) : "");
$rescheduled_sql = "SELECT * FROM reschedule_requests" . (count($reschedule_where) ? " WHERE " . implode(" AND ", $reschedule_where) : "");
$canceled_sql = "SELECT * FROM cancelled_appointments" . (count($cancel_where) ? " WHERE " . implode(" AND ", $cancel_where) : "");
$patients_sql = "SELECT * FROM checkins" . (count($checkin_where) ? " WHERE " . implode(" AND ", $checkin_where) : "");
$registered_sql = "SELECT * FROM patient_registration" . (count($registration_where) ? " WHERE " . implode(" AND ", $registration_where) : "");
$contact_sql = "SELECT * FROM contact_support" . (count($comment_where) ? " WHERE " . implode(" AND ", $comment_where) : "");

// Execute filtered queries
$appointments = $conn->query($appointments_sql);
$rescheduled = $conn->query($rescheduled_sql);
$canceled = $conn->query($canceled_sql);
$patients = $conn->query($patients_sql);
$registered = $conn->query($registered_sql);
$contact_support = $conn->query($contact_sql);
?>




<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>


    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(120deg, #74dbefff, #74dbefff);
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            margin-top: 30px;
            color: #333;
        }
        h2 {
            margin-top: 40px;
            color: #5c033a;
        }
        .dashboard-section {
            max-width: 900px;
            margin: 30px auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.08);
            padding: 30px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 30px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px 8px;
            text-align: left;
        }
        th {
            background: #eee;
            color: #333;
        }
        tr:nth-child(even) {
            background: #f9f9f9;
        }
        .approve-btn {
            background: #4CAF50;
            color: white;
            border: none;
            padding: 6px 14px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 15px;
        }
        .approve-btn:hover {
            background: #388e3c;
        }
        #redirect-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.9);
    z-index: 9999;
    display: flex;
    justify-content: center;
    align-items: center;
}

.redirect-box {
    text-align: center;
    font-size: 24px;
    color: #333;
    font-weight: bold;
    animation: fadeIn 0.8s ease-in-out;
}

.dots span {
    font-size: 40px;
    animation: bounce 1.5s infinite;
    display: inline-block;
}

.dots span:nth-child(2) {
    animation-delay: 0.2s;
}

.dots span:nth-child(3) {
    animation-delay: 0.4s;
}

@keyframes bounce {
    0%, 80%, 100% {
        transform: scale(0);
    }
    40% {
        transform: scale(1.2);
    }
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}
form {
    margin-bottom: 30px;
    text-align: center;
}
form input, form select {
    padding: 6px 10px;
    margin-right: 8px;
    border-radius: 4px;
    border: 1px solid #ccc;
}

    </style>
</head>
<body>
        <div style="text-align: right; margin: 10px 30px;">
    <form action="logout.php" method="post">
        <button type="submit" style="padding: 8px 16px; background-color: #c0392b; color: white; border: none; border-radius: 5px; cursor: pointer;">
            Logout
        </button>
    </form>
</div>
    <h1>Lifeline Hospital Admin</h1>
    <div class="dashboard-section">
<form method="get" style="text-align:center; margin-bottom: 30px;">
 <label for="filter_start_date">Start Date:</label>
<input type="date" name="filter_start_date" id="filter_start_date" value="<?= htmlspecialchars($_GET['filter_start_date'] ?? '') ?>">

<label for="filter_end_date">End Date:</label>
<input type="date" name="filter_end_date" id="filter_end_date" value="<?= htmlspecialchars($_GET['filter_end_date'] ?? '') ?>">

<label for="filter_email">Email:</label>
<input type="text" name="filter_email" id="filter_email" placeholder="e.g. john@example.com" value="<?= htmlspecialchars($_GET['filter_email'] ?? '') ?>">


    <label for="filter_department">Department:</label>
    <input type="text" name="filter_department" id="filter_department" placeholder="e.g. Cardiology" value="<?= htmlspecialchars($_GET['filter_department'] ?? '') ?>">

    <label for="filter_status">Status:</label>
    <select name="filter_status" id="filter_status">
        <option value="">All</option>
        <option value="approved" <?= ($_GET['filter_status'] ?? '') === 'approved' ? 'selected' : '' ?>>Approved</option>
        <option value="pending" <?= ($_GET['filter_status'] ?? '') === 'pending' ? 'selected' : '' ?>>Pending</option>
    </select>

    <button type="submit" style="padding: 6px 12px;">Apply Filter</button>
    <a href="admin.php" style="margin-left: 10px;">Reset</a>
    
</form>


    <h2>Appointments</h2>
    <table>
    <thead>
        <tr><th>ID</th><th>Patient</th><th>Phone No.</th><th>Appointment ID</th><th>Appointment Time</th><th>Appointment Date</th><th>Department</th><th>Action</th></tr>
    </thead>
    <tbody id="appointments-body">
        <?php while($row = $appointments->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['full_name']) ?></td>
            <td><?= $row['phone'] ?></td>
            <td><?= $row['appointment_id'] ?></td>
            <td><?= $row['time'] ?></td>
            <td><?= $row['date'] ?></td>
            <td><?= $row['department'] ?></td>
            <td>
    <?php if ($row['status'] === 'approved'): ?>
        <span style="color: green; font-weight: bold;">Approved</span>
    <?php else: ?>
        <button class="approve-btn" onclick="approveAppointment(<?= $row['id'] ?>, this)">Approve</button>
    <?php endif; ?>
</td>

        </tr>
        <?php endwhile; ?>
    </tbody>
    </table>

    <h2>Rescheduled Appointments</h2>
    <table>
    <thead>
        <tr><th>ID</th><th>Patient Email</th><th>New Date</th><th>Old Date</th><th>New Time</th><th>Reason</th><th>Action</th></tr>
    </thead>
    <tbody>
        <?php while($row = $rescheduled->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= $row['new_date'] ?></td>
    <td><?= $row['old_date'] ?></td>
    <td><?= $row['new_time'] ?></td>
    <td><?= $row['reason'] ?></td>
 <td>
    <?php if ($row['status'] === 'approved'): ?>
        <span style="color: green; font-weight: bold;">Approved</span>
    <?php else: ?>
        <button class="approve-btn" onclick="approveReschedule(<?= $row['id'] ?>, this)">Approve</button>
    <?php endif; ?>
</td>

</tr>
<?php endwhile; ?>
    </table>

    <h2>Canceled Appointments</h2>
    <table>
        <tr><th>ID</th><th>Patient Email</th><th>Appointment Date</th><th>Time of Cancellation</th><th>Reason</th></tr>
        <?php while($row = $canceled->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= $row['appointment_date'] ?></td>
            <td><?= $row['cancelled_at'] ?></td>
            <td><?= $row['reason'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <h2>Patients Who Reported Online</h2>
    <table>
        <tr><th>ID</th><th>Name</th><th>Checkin Time</th></tr>
        <?php while($row = $patients->fetch_assoc()): ?>    
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['patient_name']) ?></td>
            <td><?= htmlspecialchars($row['checkin_time']) ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
        <h2>Registered Patients</h2>
    <table>
        <tr><th>ID</th><th>Name</th><th>Date Of Birth</th><th>Gender</th><th>Email</th><th>Phone No.</th><th>Address</th><th>ID No.</th><th>Registered Time</th></tr>
        <?php while($row = $registered->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['fullname']) ?></td>
            <td><?= htmlspecialchars($row['dob']) ?></td>
            <td><?= htmlspecialchars($row['gender']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars($row['phone']) ?></td>
            <td><?= htmlspecialchars($row['address']) ?></td>
            <td><?= htmlspecialchars($row['id_number']) ?></td>
            <td><?= htmlspecialchars($row['registration_time']) ?></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <h2>Patient Comments</h2>
    <table>
        <tr><th>ID</th><th>Name</th><th>Email</th><th>Time</th><th>Comment</th></tr>
        <?php while($row = $contact_support->fetch_assoc()): ?>    
        <tr>
            <td><?= $row['id'] ?></td>
             <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars($row['time']) ?></td>
            <td><?= htmlspecialchars($row['message']) ?></td>
           </tr>
        <?php endwhile; ?>
    </table>
    </div>


<div id="redirect-overlay">
    <div class="redirect-box">
        <p>Redirecting to Admin Dashboard</p>
        <div class="dots">
            <span>.</span><span>.</span><span>.</span>
        </div>
    </div>
</div>
<script>
    window.addEventListener("load", function () {
        setTimeout(() => {
            const overlay = document.getElementById("redirect-overlay");
            if (overlay) {
                overlay.style.opacity = '0';
                overlay.style.transition = 'opacity 0.5s ease';
                setTimeout(() => overlay.remove(), 500);
            }
        }, 2500); // Display for 2.5 seconds
    });
</script>
<script>
function approveAppointment(id, btn) {
    btn.disabled = true;
    btn.textContent = 'Approving...';

    fetch('approve_appointment.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `id=${id}`
    })
    .then(response => response.text())
    .then(data => {
        if (data.trim() === 'success') {
            btn.outerHTML = '<span style="color: green; font-weight: bold;">Approved</span>';
        } else {
            btn.textContent = 'Approved';
            btn.style.background = '#0ebcf1ff';
        }
    })
    .catch(err => {
        console.error(err);
        btn.textContent = 'Error';
        btn.style.background = '#e74c3c';
    });
}
</script>
<script>
function approveReschedule(id, btn) {
    btn.disabled = true;
    btn.textContent = 'Approving...';

    fetch('approve_reschedule.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({ id: id })
    })
    .then(response => response.text())
    .then(data => {
        const result = data.trim();

        if (result === 'success') {
            btn.outerHTML = '<span style="color: green; font-weight: bold;">Approved</span>';
        } else if (result === 'email_error') {
            btn.outerHTML = '<span style="color: orange; font-weight: bold;">Approved (Email Failed)</span>';
            alert("Reschedule approved, but email failed to send.");
        } else if (result === 'not_found') {
            btn.textContent = 'Not Found';
            btn.style.background = '#e67e22';
        } else if (result === 'update_failed') {
            btn.textContent = 'Update Failed';
            btn.style.background = '#e67e22';
        } else {
            btn.textContent = 'Error';
            btn.style.background = '#e74c3c';
            alert("Unexpected server response: " + result);
        }
    })
    .catch(err => {
        console.error('Fetch error:', err);
        btn.textContent = 'Network Error';
        btn.style.background = '#e74c3c';
    });
}
</script>
<script>
document.querySelector('form[method="get"]').addEventListener('submit', function(e) {
    e.preventDefault();

    const params = new URLSearchParams(new FormData(this));

    fetch('fetch_filtered_data.php?' + params.toString())
        .then(res => res.text())
        .then(data => {
            document.getElementById('appointments-body').innerHTML = data;
        })
        .catch(error => {
            console.error("Error fetching filtered appointments:", error);
        });
});
</script>


</body>
</html>