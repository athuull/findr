<?php
session_start();
require_once '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    $_SESSION['report_status'] = "Invalid request method.";
    header("Location: report.php");
    exit();
}

// check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // $_SESSION['login_error'] = "Please log in to report a lost item.";
    // header("Location: ../auth/login.php");
    echo "<script>
    alert('Please log in to report a lost item.');
    window.location.href = '../auth/login.php';
</script>";
exit();
}

// trim deletes trailing whitespaces
$title       = trim($_POST['title']);
$description = trim($_POST['description']);
$location    = trim($_POST['location']);
$dateLost    = $_POST['date_lost'] ?: null; 

$userId       = $_SESSION['user_id'];
$status       = "lost";
$points       = 5;
$dateReported = date("Y-m-d H:i:s");

// prepare the SQL statement
$sql = "INSERT INTO items (
            user_id, title, description, location_lost, date_lost,
            status, points_awarded, date_reported
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    $_SESSION['report_status'] = "Database error: " . $conn->error;
    header("Location: report.php");
    exit();
}

$stmt->bind_param(
    "isssssis",
    $userId,
    $title,
    $description,
    $location,
    $dateLost,
    $status,
    $points,
    $dateReported
);

if ($stmt->execute()) {
    $_SESSION['report_status'] = "Lost item reported successfully!";
    header("Location: list.php");
} else {
    $_SESSION['report_status'] = "Error submitting report: " . $stmt->error;
    header("Location: report.php");
}

$stmt->close();
$conn->close();
exit();
?>
