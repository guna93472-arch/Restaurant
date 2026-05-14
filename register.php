<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Food Factory</title>
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
                        url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=1920&q=80') no-repeat center center/cover;
            background-attachment: fixed;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            overflow: hidden;
        }

        /* Glassmorphism Card */
        .register-card {
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
            position: relative;
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

        .btn-register {
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

        .btn-register:hover {
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

        /* Floating particles effect */
        .particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: #ffd700;
            border-radius: 50%;
            opacity: 0.2;
            animation: float 10s infinite;
        }

        @keyframes float {
            0% { transform: translateY(0) translateX(0); opacity: 0; }
            50% { opacity: 0.5; }
            100% { transform: translateY(-100vh) translateX(50px); opacity: 0; }
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
    <div class="particles" id="particles"></div>

    <div class="register-card">
        <div class="header">
            <h1 onclick="window.location.href='index.php'" style="cursor: pointer;">Food Factory</h1>
            <p>Create your account for personalized flavors</p>
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
            <input type="hidden" name="action" value="register">
            
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Choose a username" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Create a strong password" required>
            </div>

            <button type="submit" class="btn-register">Join the Factory</button>
        </form>

        <div class="footer-links">
            Already have an account? <a href="login.php">Login here</a>
        </div>
    </div>

    <script>
        // Simple particle generator
        const container = document.getElementById('particles');
        for (let i = 0; i < 30; i++) {
            const p = document.createElement('div');
            p.className = 'particle';
            p.style.left = Math.random() * 100 + 'vw';
            p.style.top = Math.random() * 100 + 'vh';
            p.style.animationDelay = Math.random() * 10 + 's';
            p.style.animationDuration = (5 + Math.random() * 10) + 's';
            container.appendChild(p);
        }
    </script>
</body>
</html>
