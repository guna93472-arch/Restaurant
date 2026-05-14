<?php
require_once 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'register') {
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];

        if (empty($username) || empty($email) || empty($password)) {
            $_SESSION['error'] = "All fields are required!";
            header("Location: register.php");
            exit();
        }

        // Check if user exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        if ($stmt->get_result()->num_rows > 0) {
            $_SESSION['error'] = "Username or Email already exists!";
            header("Location: register.php");
            exit();
        }
        $stmt->close();

        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert user
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hashed_password);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Registration successful! Please login.";
            header("Location: login.php");
        } else {
            $_SESSION['error'] = "Something went wrong. Please try again.";
            header("Location: register.php");
        }
        $stmt->close();
    } 
    
    elseif ($action === 'login') {
        $username_input = trim($_POST['username']);
        $password_input = $_POST['password'];

        if (empty($username_input) || empty($password_input)) {
            $_SESSION['error'] = "Please fill in all fields!";
            header("Location: login.php");
            exit();
        }

        // Check user
        $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username_input, $username_input);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($user = $result->fetch_assoc()) {
            if (password_verify($password_input, $user['password'])) {
                // Success
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                header("Location: index.php");
                exit();
            } else {
                $_SESSION['error'] = "Invalid password!";
            }
        } else {
            $_SESSION['error'] = "User not found!";
        }
        header("Location: login.php");
        $stmt->close();
    }
}

if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_destroy();
    header("Location: index.php");
    exit();
}

$conn->close();
?>
