<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Food Factory</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), 
                        url('https://images.unsplash.com/photo-1543353071-873f17a7a088?w=1920&q=80') no-repeat center center/cover;
            background-attachment: fixed;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            overflow: hidden;
        }

        /* Glassmorphism Card */
        .login-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 40px;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
            animation: fadeInScale 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes fadeInScale {
            from { opacity: 0; transform: scale(0.9) translateY(20px); }
            to { opacity: 1; transform: scale(1) translateY(0); }
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 32px;
            font-weight: 800;
            background: linear-gradient(135deg, #ffd700, #ff8c00);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 5px;
        }

        .header p {
            color: rgba(255, 255, 255, 0.6);
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.8);
        }

        input {
            width: 100%;
            padding: 14px 20px;
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            color: #fff;
            font-size: 15px;
            transition: all 0.3s ease;
            outline: none;
        }

        input:focus {
            background: rgba(0, 0, 0, 0.4);
            border-color: #ffd700;
            box-shadow: 0 0 15px rgba(255, 215, 0, 0.2);
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            margin-top: 10px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, #ffd700, #ff8c00);
            color: #000;
            font-size: 16px;
            font-weight: 800;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px rgba(255, 215, 0, 0.2);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(255, 215, 0, 0.4);
            filter: brightness(1.1);
        }

        .footer-links {
            text-align: center;
            margin-top: 25px;
            font-size: 14px;
            color: rgba(255, 255, 255, 0.6);
        }

        .footer-links a {
            color: #ffd700;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
        }

        .footer-links a:hover {
            text-decoration: underline;
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
        }

        .alert {
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            text-align: center;
        }
        .alert-error {
            background: rgba(255, 77, 77, 0.2);
            border: 1px solid #ff4d4d;
            color: #ff4d4d;
        }
        .alert-success {
            background: rgba(0, 255, 136, 0.2);
            border: 1px solid #00ff88;
            color: #00ff88;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="header">
            <h1 onclick="window.location.href='index.php'" style="cursor: pointer;">Food Factory</h1>
            <p>Welcome back! Let's get you fed.</p>
        </div>

        <?php
        if (isset($_SESSION['error'])) {
            echo '<div class="alert alert-error">' . $_SESSION['error'] . '</div>';
            unset($_SESSION['error']);
        }
        if (isset($_SESSION['success'])) {
            echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
            unset($_SESSION['success']);
        }
        ?>

        <form action="auth.php" method="POST">
            <input type="hidden" name="action" value="login">
            
            <div class="form-group">
                <label for="username">Username or Email</label>
                <input type="text" id="username" name="username" placeholder="Enter your username or email" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>

            <button type="submit" class="btn-login">Login to Flavors</button>
        </form>

        <div class="footer-links">
            New here? <a href="register.php">Create an account</a>
        </div>
    </div>
</body>
</html>
