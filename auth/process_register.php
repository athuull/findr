$statement->bind_param("ssssis", $name, $userName, $email, $hashedPassword, $points, $createdAt);
<?php
session_start();
require_once '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $userName = $_POST['userName'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $points = 0;
    $createdAt = date("Y-m-d H:i:s");

    $sql = "INSERT INTO users (name, userName, email, password, points, created_at)
            VALUES (?, ?, ?, ?, ?, ?)";

    $statement = $conn->prepare($sql);

    if ($statement) {
        $statement->bind_param("ssssis", $name, $userName, $email, $hashedPassword, $points, $createdAt);

        if ($statement->execute()) {
            $_SESSION['register_success'] = "User registered successfully!";
            header("Location: ../auth/login.php");
            exit();
        } else {
            $_SESSION['register_error'] = "Error registering user: " . $statement->error;
            header("Location: ../auth/register.php");
            exit();
        }
    } else {
        $_SESSION['register_error'] = "Failed to prepare statement: " . $conn->error;
        header("Location: ../auth/register.php");
        exit();
    }
}
?>
