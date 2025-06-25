<?php
$inputPassword = "root";
$storedHash = '$2y$10$nmRiXFxfMHeEQbN1nCGfheb2oyLTvMrkBBPeTakK0vFb6qdXTP2gi';

if (password_verify($inputPassword, $storedHash)) {
    echo "Password is valid!";
} else {
    echo "Invalid password.";
}

$password = "root";
$hash = password_hash($password, PASSWORD_DEFAULT);
echo "\nNew Hash: " . $hash;
?>
