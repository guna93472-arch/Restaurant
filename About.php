<?php 
session_start(); 
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>About Us</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family: Arial, sans-serif;
}

body{
    margin: 0;
    padding: 0;
    background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), 
                url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=1920&q=80') no-repeat center center/cover;
    background-attachment: fixed;
    color: white;
    min-height: 100vh;
    overflow-x: hidden;
}

/* Header styling */
header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:20px 50px;
    background:rgba(0,0,0,0.7);
}

header h1{
    font-size:24px;
    color:white;
}

nav a{
    color:white;
    text-decoration:none;
    margin:0 15px;
    font-weight:bold;
    transition:0.3s;
    font-size:16px;
}

nav a:hover{
    color:gold;
}

/* About Section */
.about{
    min-height:100vh;
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
    text-align:center;
    padding:40px;
    background: transparent; /* Background moved to body */
}

.about h2{
    font-size:45px;
    margin-bottom:20px;
    color:gold;
}

.about p{
    max-width:800px;
    font-size:18px;
    line-height:1.8;
    margin-bottom:20px;
}

.highlight{
    color:gold;
    font-weight:bold;
}

</style>
</head>

<body>
<link rel="stylesheet" href="sidebar.css">
<div class="sidebar">
    <h1>Foodies<span>.</span></h1>
    <hr class="sidebar-divider">
    <nav>
        <a href="index.php"><span class="icon">🏠</span> Home</a>
        <a href="dayfoodies.php"><span class="icon">📅</span> Day Foodies</a>
        <a href="All.php"><span class="glow-dot" style="--c: #00ffff;"></span> All Items</a>
        <a href="Veg.php"><span class="glow-dot" style="--c: #00ff55;"></span> Veg Menu</a>
        <a href="Non-veg.php"><span class="glow-dot" style="--c: #ff3333;"></span> Non-Veg Menu</a>
        <a href="milk_shakes.php"><span class="glow-dot" style="--c: #a833ff;"></span> Milkshakes</a>
        <a href="Juice.php"><span class="glow-dot" style="--c: #ff9933;"></span> Juice</a>
        <a href="Icecream.php"><span class="glow-dot" style="--c: #ff69b4;"></span> Ice Cream</a>
        <a href="bill.php"><span class="icon">🧾</span> Bill</a>
        <a href="About.php"><span class="icon">ℹ️</span> About</a>
        <hr class="sidebar-divider">
        <?php if(isset($_SESSION['username'])): ?>
            <a href="auth.php?action=logout" style="color: #ff4d4d;"><span class="icon">🚪</span> Logout (<?php echo $_SESSION['username']; ?>)</a>
        <?php else: ?>
            <a href="login.php" style="color: #00ff88;"><span class="icon">👤</span> Login / Register</a>
        <?php endif; ?>
    </nav>
</div>

<section class="about">

    <h2>About Us</h2>

    <p>
        Welcome to <span class="highlight">Food Factory</span> 🍴  
        We serve fresh, hygienic, and delicious food made with high-quality ingredients.
    </p>

    <p>
        Our mission is to provide authentic taste, fast service, 
        and affordable pricing for every customer.
    </p>

    <p>
        Thank you for choosing us. We are happy to serve you! 😎
    </p>

</section>

</body>
</html>