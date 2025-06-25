<?php
session_start();
require_once '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $userName = $_POST['userName'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE userName = ?"; // ? is a placeholder
    $statement = $conn->prepare($sql); // preparing the sql statement
    $statement->bind_param("s", $userName); // binds the username 
    $statement->execute(); // executes the statement

    $result = $statement->get_result();
    $user = $result->fetch_assoc(); // user will have username and password key-value pairs
    

    // if a user if found and password is correct, we set the SESSION variables
    if ($user && password_verify($password, $user["password"])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];

        // FIXME: redirects to nowhere
        header("Location: ../dashboard.php"); // success
        exit();
    } else {

        
        $_SESSION['login_error'] = "Invalid Username or Password!";
        header("Location: ../auth/login.php"); // redirect back to the form
        exit();
    }
}
?>
