<?php
// EcommerceProject/login_handler.php

session_start();
require_once 'db_connect.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email_or_username = trim($_POST['email_or_username'] ?? '');
    $password_plain = trim($_POST['password'] ?? '');

    if (empty($email_or_username) || empty($password_plain)) {
        $message = "Email/Username and password are required.";
    } else {
        $sql = "SELECT id, username, email, password, fullname FROM users WHERE email = ? OR username = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ss", $email_or_username, $email_or_username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $user = $result->fetch_assoc();
                if (password_verify($password_plain, $user['password'])) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['fullname'] = $user['fullname'];
                    // $_SESSION['email'] = $user['email']; // Optionally store email
                    $_SESSION['logged_in'] = true;

                    header("Location: ../index.php"); // Redirect to main page (index.php in root)
                    exit();
                } else {
                    $message = "Invalid login credentials (password mismatch).";
                }
            } else {
                $message = "User not found or invalid credentials.";
            }
            $stmt->close();
        } else {
            $message = "Database error. Please try again. ";
        }
    }
    // If login failed, redirect back to login page with error
    header("Location: src/pages/login.php?status=loginerror&message=" . urlencode($message));
    exit();

} else {
    // Not a POST request
    header("Location: src/pages/login.php");
    exit();
}

$conn->close();
?>