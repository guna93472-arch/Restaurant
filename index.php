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
<title>Food Factory</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family: 'Poppins', sans-serif;
}

body{
    background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), 
                url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=1920&q=80') no-repeat center center/cover;
    background-attachment: fixed;
    color: white;
    overflow-x: hidden;
    scroll-behavior: smooth;
    min-height: 100vh;
    margin: 0;
    padding: 0;
}

/* Floating particles for 3D effect */
.particles {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    z-index: -1;
    pointer-events: none;
    overflow: hidden;
}

.particle {
    position: absolute;
    width: 4px;
    height: 4px;
    background: rgba(0, 255, 255, 0.6);
    border-radius: 50%;
    animation: float 20s infinite;
    box-shadow: 0 0 10px rgba(0, 255, 255, 0.8), 0 0 20px rgba(0, 255, 255, 0.4);
}

@keyframes float {
    0%, 100% {
        transform: translateY(100vh) rotate(0deg);
        opacity: 0;
    }
    10% {
        opacity: 1;
    }
    90% {
        opacity: 1;
    }
    100% {
        transform: translateY(-100vh) rotate(720deg);
        opacity: 0;
    }
}

/* Header */
header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:0 50px;
    height:70px;
    background: rgba(0, 0, 0, 0.4);
    box-sizing:border-box;
    position: relative;
    z-index: 100;
    backdrop-filter: blur(15px);
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    animation: slideDown 0.8s ease-out;
}

@keyframes slideDown {
    from {
        transform: translateY(-100%);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

header h1 {
    animation: bounce 2s infinite;
}

@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-5px); }
}

nav a{
    position: relative;
    overflow: hidden;
}

nav a::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 2px;
    background: gold;
    transform: scaleX(0);
    transform-origin: right;
    transition: transform 0.3s ease;
}

nav a:hover::after {
    transform: scaleX(1);
    transform-origin: left;
}

/* Hero Section Animation */
.hero {
    animation: fadeIn 1s ease-out;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.hero h2 {
    animation: fadeInScale 1s ease-out, glowPulse 2s ease-in-out infinite;
}

@keyframes fadeInScale {
    from {
        transform: scale(0.5);
        opacity: 0;
    }
    to {
        transform: scale(1);
        opacity: 1;
    }
}

@keyframes glowPulse {
    0%, 100% {
        text-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
    }
    50% {
        text-shadow: 0 0 30px rgba(255, 215, 0, 0.9), 0 0 60px rgba(255, 215, 0, 0.5);
    }
}

.hero p {
    animation: slideUp 1s ease-out 0.3s backwards;
}

@keyframes slideUp {
    from {
        transform: translateY(30px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.hero .btn {
}

@keyframes bounce {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-10px);
    }
}

/* Scrollbar */
::-webkit-scrollbar {
    width: 10px;
}

::-webkit-scrollbar-track {
    background: #1a1a2e;
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(45deg, #00ffff, #00ff88);
    border-radius: 5px;
}

/* Loading Animation */
.loader {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: #1a1a2e;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
    animation: loaderFade 0.5s ease-out 2s forwards;
}

@keyframes loaderFade {
    to { opacity: 0; visibility: hidden; }
}

.loader::before {
    content: '🍽️';
    font-size: 60px;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

nav a{font-size:16px;}

header h1{
    font-size:24px;
    text-shadow: 0 0 10px rgba(0, 255, 255, 0.5);
}

/* Navigation */
nav a{
    color:white;
    text-decoration:none;
    margin:0 15px;
    font-weight:bold;
    transition:0.3s;
}

nav a:hover{
    color:gold;
    text-shadow: 0 0 10px gold;
}

/* Hero Section */
.hero{
    height:85vh;
    display:flex;
    flex-direction:row;
    justify-content:center;
    align-items:center;
    text-align:center;
    padding: 0 50px;
    position: relative;
    z-index: 10;
}

#sphere-container {
    position: absolute;
    right: 8%;
    top: 50%;
    transform: translateY(-50%);
    width: 400px;
    height: 400px;
    z-index: 1;
}

.hero h2{
    font-size:50px;
    margin-bottom:20px;
    text-shadow: 0 0 20px rgba(0, 255, 255, 0.8), 0 0 40px rgba(0, 255, 255, 0.4);
    animation: glow 2s ease-in-out infinite alternate;
}

@keyframes glow {
    from { text-shadow: 0 0 20px rgba(0, 255, 255, 0.8), 0 0 40px rgba(0, 255, 255, 0.4); }
    to { text-shadow: 0 0 30px rgba(255, 0, 255, 0.8), 0 0 60px rgba(255, 0, 255, 0.4); }
}

.hero p{
    font-size:20px;
    margin-bottom:30px;
    color: rgba(255, 255, 255, 0.9);
}

.btn{
    padding:12px 25px;
    background:linear-gradient(45deg, #00ffff, #00ff88);
    color:black;
    border:none;
    font-weight:bold;
    cursor:pointer;
    border-radius:5px;
    transition:0.3s;
    box-shadow: 0 0 20px rgba(0, 255, 255, 0.5);
}

.btn {
    display: inline-block;
    padding: 12px 30px;
    background: linear-gradient(135deg, #ffd700, #ff8c00);
    color: #000;
    text-decoration: none;
    font-weight: 800;
    border-radius: 50px;
    transition: all 0.3s ease;
    box-shadow: 0 10px 20px rgba(255, 215, 0, 0.2);
}

.btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 30px rgba(255, 215, 0, 0.4);
    background: linear-gradient(135deg, #ff8c00, #ffd700);
}

/* 3D Effect for Veg Items */
.veg-item:hover {
    transform: translateY(-15px) scale(1.02);
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.7), 0 0 20px rgba(0, 255, 136, 0.3);
}

.veg-item {
    cursor: pointer;
    background: rgba(20, 20, 20, 0.4);
    backdrop-filter: blur(10px);
    border-radius: 15px;
    padding: 15px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    animation: fadeInUp 0.6s ease-out forwards;
    opacity: 0;
}
.veg-item img {
    width: 100%;
    height: 350px;
    object-fit: cover;
    border-radius: 10px;
    border: 5px solid #FFD700;
    box-shadow: 0 0 10px rgba(255, 215, 0, 0.8);
}

.veg-item:nth-child(1) { animation-delay: 0.1s; }
.veg-item:nth-child(2) { animation-delay: 0.2s; }
.veg-item:nth-child(3) { animation-delay: 0.3s; }
.veg-item:nth-child(4) { animation-delay: 0.4s; }

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Non-Veg Items 3D Effect */
.nonveg-item:hover {
    transform: translateY(-15px) scale(1.02);
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.7), 0 0 20px rgba(255, 77, 77, 0.3);
}

.nonveg-item {
    cursor: pointer;
    background: rgba(20, 20, 20, 0.4);
    backdrop-filter: blur(10px);
    border-radius: 15px;
    padding: 15px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    animation: fadeInUp 0.6s ease-out forwards;
    opacity: 0;
}
.nonveg-item img {
    width: 100%;
    height: 350px;
    object-fit: cover;
    border-radius: 10px;
    border: 5px solid #FFD700;
    box-shadow: 0 0 10px rgba(255, 215, 0, 0.8);
}

/* Milkshake Items */
.milkshake-item:hover {
    transform: perspective(1000px) rotateX(5deg) rotateY(-5deg) translateY(-10px);
    box-shadow: 0 20px 40px rgba(255, 192, 203, 0.3), 0 0 20px rgba(255, 192, 203, 0.2);
    border-color: rgba(255, 192, 203, 0.8);
}

.milkshake-item {
    cursor: pointer;
    transform-style: preserve-3d;
    animation: fadeInUp 0.6s ease-out forwards;
    opacity: 0;
}
.milkshake-item img {
    width: 100%;
    height: 350px;
    object-fit: cover;
    border-radius: 10px;
    border: 5px solid #FFD700;
    box-shadow: 0 0 10px rgba(255, 215, 0, 0.8);
}

/* Section Titles */
section h2 {
    animation: slideIn 0.8s ease-out;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(-50px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

/* Button Pulse Animation */
@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

.btn-order {
    animation: pulse 2s infinite;
}

/* Footer */
footer{
    text-align:center;
    padding:15px;
    background:rgba(0,0,0,0.8);
    position: relative;
    z-index: 100;
}

</style>
</head>

<body>
<div class="loader"></div>

<!-- Floating Particles -->
<div class="particles" id="particles"></div>

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

<section class="hero">
    <div style="position: relative; z-index: 2;">
        <h2>Welcome To Food Factory 👋</h2>
        <p>Delicious Food | Fresh Ingredients | Fast Delivery</p>
        <button class="btn" onclick="window.location.href='All.php'">Order Now</button>
    </div>
    <div id="sphere-container"></div>
</section>

<!-- Popular Veg Items Section -->
<section style="padding: 50px 20px; background: rgba(0,0,0,0.7); position: relative; z-index: 10;">
    <h2 style="text-align: center; color: gold; font-size: 36px; margin-bottom: 30px; text-shadow: 0 0 20px rgba(255, 215, 0, 0.5);">🥬 Popular Veg Items</h2>
    <div style="display: flex; justify-content: center; gap: 20px; flex-wrap: wrap;">
        <div class="veg-item" style="background: rgba(20, 20, 20, 0.4); backdrop-filter: blur(15px); padding: 15px; border-radius: 10px; width: 220px; text-align: center; box-shadow: 0 4px 15px rgba(0, 255, 255, 0.2); border: 1px solid rgba(255, 255, 255, 0.1); transform-style: preserve-3d; transition: all 0.3s ease;">
            <img src="images/panner.jpeg" width="170" height="120" alt="Paneer" style="border-radius: 8px; transform: translateZ(20px);">
            <h3 style="color: #fff; margin: 10px 0; font-size: 16px; transform: translateZ(10px);">Paneer Masala</h3>
            <p style="color: #00ff88; font-weight: bold; transform: translateZ(5px);">₹80</p>
            <button onclick="addToCart('Paneer Butter Masala',80,'images/panner.jpeg', this)" style="padding: 10px 20px; background: linear-gradient(135deg, #00ff88, #00bd68); color: black; border: none; border-radius: 30px; cursor: pointer; margin-top: 10px; font-weight: bold; transform: translateZ(15px); transition: all 0.3s ease;">Order Now</button>
        </div>
        <div class="veg-item" style="background: rgba(20, 20, 20, 0.4); backdrop-filter: blur(15px); padding: 15px; border-radius: 10px; width: 220px; text-align: center; box-shadow: 0 4px 15px rgba(0, 255, 255, 0.2); border: 1px solid rgba(255, 255, 255, 0.1); transform-style: preserve-3d; transition: all 0.3s ease;">
            <img src="images/Dosa.jpeg" width="170" height="120" alt="Dosa" style="border-radius: 8px; transform: translateZ(20px);">
            <h3 style="color: #fff; margin: 10px 0; font-size: 16px; transform: translateZ(10px);">Dosa</h3>
            <p style="color: #00ff88; font-weight: bold; transform: translateZ(5px);">₹20</p>
            <button onclick="addToCart('Dosa',20,'images/Dosa.jpeg', this)" style="padding: 10px 20px; background: linear-gradient(135deg, #00ff88, #00bd68); color: black; border: none; border-radius: 30px; cursor: pointer; margin-top: 10px; font-weight: bold; transform: translateZ(15px); transition: all 0.3s ease;">Order Now</button>
        </div>
        <div class="veg-item" style="background: rgba(20, 20, 20, 0.4); backdrop-filter: blur(15px); padding: 15px; border-radius: 10px; width: 220px; text-align: center; box-shadow: 0 4px 15px rgba(0, 255, 255, 0.2); border: 1px solid rgba(255, 255, 255, 0.1); transform-style: preserve-3d; transition: all 0.3s ease;">
            <img src="images/idli.jpeg" width="170" height="120" alt="Idli" style="border-radius: 8px; transform: translateZ(20px);">
            <h3 style="color: #fff; margin: 10px 0; font-size: 16px; transform: translateZ(10px);">Idli</h3>
            <p style="color: #00ff88; font-weight: bold; transform: translateZ(5px);">₹30</p>
            <button onclick="addToCart('Idli',30,'images/idli.jpeg', this)" style="padding: 10px 20px; background: linear-gradient(135deg, #00ff88, #00bd68); color: black; border: none; border-radius: 30px; cursor: pointer; margin-top: 10px; font-weight: bold; transform: translateZ(15px); transition: all 0.3s ease;">Order Now</button>
        </div>
        <div class="veg-item" style="background: rgba(20, 20, 20, 0.4); backdrop-filter: blur(15px); padding: 15px; border-radius: 10px; width: 220px; text-align: center; box-shadow: 0 4px 15px rgba(0, 255, 255, 0.2); border: 1px solid rgba(255, 255, 255, 0.1); transform-style: preserve-3d; transition: all 0.3s ease;">
            <img src="images/Curd rice.jpeg" width="170" height="120" alt="Curd Rice" style="border-radius: 8px; transform: translateZ(20px);">
            <h3 style="color: #fff; margin: 10px 0; font-size: 16px; transform: translateZ(10px);">Curd Rice</h3>
            <p style="color: #00ff88; font-weight: bold; transform: translateZ(5px);">₹40</p>
            <button onclick="addToCart('Curd Rice',40,'images/Curd rice.jpeg', this)" style="padding: 10px 20px; background: linear-gradient(135deg, #00ff88, #00bd68); color: black; border: none; border-radius: 30px; cursor: pointer; margin-top: 10px; font-weight: bold; transform: translateZ(15px); transition: all 0.3s ease;">Order Now</button>
        </div>
    </div>
    <div style="text-align: center; margin-top: 30px;">
        <button class="btn" onclick="window.location.href='Veg.php'">View All Veg Items</button>
    </div>
</section>

<!-- Popular Non-Veg Items Section -->
<section style="padding: 50px 20px; background: rgba(0,0,0,0.7); position: relative; z-index: 10;">
    <h2 style="text-align: center; color: #ff6b6b; font-size: 36px; margin-bottom: 30px; text-shadow: 0 0 20px rgba(255, 107, 107, 0.5);">🍗 Popular Non-Veg Items</h2>
    <div style="display: flex; justify-content: center; gap: 20px; flex-wrap: wrap;">
        <div class="nonveg-item" style="background: rgba(20, 20, 20, 0.4); backdrop-filter: blur(15px); padding: 15px; border-radius: 10px; width: 220px; text-align: center; box-shadow: 0 4px 15px rgba(255, 77, 77, 0.2); border: 1px solid rgba(255, 255, 255, 0.1); transform-style: preserve-3d; transition: all 0.3s ease;">
            <img src="images/chicken biryani.jpeg" width="170" height="120" alt="Chicken Biryani" style="border-radius: 8px; transform: translateZ(20px);">
            <h3 style="color: #fff; margin: 10px 0; font-size: 16px; transform: translateZ(10px);">Chicken Biryani</h3>
            <p style="color: #ff6b6b; font-weight: bold; transform: translateZ(5px);">₹150</p>
            <button onclick="addToCart('Chicken biryani',150,'images/chicken biryani.jpeg', this)" class="btn-order" style="padding: 10px 20px; background: linear-gradient(135deg, #ff4d4d, #d43f3f); color: white; border: none; border-radius: 30px; cursor: pointer; margin-top: 10px; font-weight: bold; transform: translateZ(15px); transition: all 0.3s ease;">Order Now</button>
        </div>
        <div class="nonveg-item" style="background: rgba(20, 20, 20, 0.4); backdrop-filter: blur(15px); padding: 15px; border-radius: 10px; width: 220px; text-align: center; box-shadow: 0 4px 15px rgba(255, 77, 77, 0.2); border: 1px solid rgba(255, 255, 255, 0.1); transform-style: preserve-3d; transition: all 0.3s ease;">
            <img src="images/mutton fry.jpeg" width="170" height="120" alt="Mutton Fry" style="border-radius: 8px; transform: translateZ(20px);">
            <h3 style="color: #fff; margin: 10px 0; font-size: 16px; transform: translateZ(10px);">Mutton Fry</h3>
            <p style="color: #ff6b6b; font-weight: bold; transform: translateZ(5px);">₹120</p>
            <button onclick="addToCart('Mutton fry',120,'images/mutton fry.jpeg', this)" class="btn-order" style="padding: 10px 20px; background: linear-gradient(135deg, #ff4d4d, #d43f3f); color: white; border: none; border-radius: 30px; cursor: pointer; margin-top: 10px; font-weight: bold; transform: translateZ(15px); transition: all 0.3s ease;">Order Now</button>
        </div>
        <div class="nonveg-item" style="background: rgba(20, 20, 20, 0.4); backdrop-filter: blur(15px); padding: 15px; border-radius: 10px; width: 220px; text-align: center; box-shadow: 0 4px 15px rgba(255, 77, 77, 0.2); border: 1px solid rgba(255, 255, 255, 0.1); transform-style: preserve-3d; transition: all 0.3s ease;">
            <img src="images/lolipop.jpeg" width="170" height="120" alt="Chicken Lolipop" style="border-radius: 8px; transform: translateZ(20px);">
            <h3 style="color: #fff; margin: 10px 0; font-size: 16px; transform: translateZ(10px);">Chicken Lolipop</h3>
            <p style="color: #ff6b6b; font-weight: bold; transform: translateZ(5px);">₹30</p>
            <button onclick="addToCart('lolipop',30,'images/lolipop.jpeg', this)" class="btn-order" style="padding: 10px 20px; background: linear-gradient(135deg, #ff4d4d, #d43f3f); color: white; border: none; border-radius: 30px; cursor: pointer; margin-top: 10px; font-weight: bold; transform: translateZ(15px); transition: all 0.3s ease;">Order Now</button>
        </div>
        <div class="nonveg-item" style="background: rgba(20, 20, 20, 0.4); backdrop-filter: blur(15px); padding: 15px; border-radius: 10px; width: 220px; text-align: center; box-shadow: 0 4px 15px rgba(255, 77, 77, 0.2); border: 1px solid rgba(255, 255, 255, 0.1); transform-style: preserve-3d; transition: all 0.3s ease;">
            <img src="images/grill.jpeg" width="170" height="120" alt="Chicken Grill" style="border-radius: 8px; transform: translateZ(20px);">
            <h3 style="color: #fff; margin: 10px 0; font-size: 16px; transform: translateZ(10px);">Chicken Grill</h3>
            <p style="color: #ff6b6b; font-weight: bold; transform: translateZ(5px);">₹250</p>
            <button onclick="addToCart('grill',250,'images/grill.jpeg', this)" class="btn-order" style="padding: 10px 20px; background: linear-gradient(135deg, #ff4d4d, #d43f3f); color: white; border: none; border-radius: 30px; cursor: pointer; margin-top: 10px; font-weight: bold; transform: translateZ(15px); transition: all 0.3s ease;">Order Now</button>
        </div>
    </div>
    <div style="text-align: center; margin-top: 30px;">
        <button class="btn" onclick="window.location.href='Non-veg.php'">View All Non-Veg Items</button>
    </div>
</section>

<!-- Popular Milk Shakes Section -->
<section style="padding: 50px 20px; background: rgba(0,0,0,0.7); position: relative; z-index: 10;">
    <h2 style="text-align: center; color: #ff69b4; font-size: 36px; margin-bottom: 30px; text-shadow: 0 0 20px rgba(255, 105, 180, 0.5);">🥤 Popular Milk Shakes</h2>
    <div style="display: flex; justify-content: center; gap: 20px; flex-wrap: wrap;">
        <div class="milkshake-item" style="background: rgba(20, 20, 20, 0.4); backdrop-filter: blur(15px); padding: 15px; border-radius: 10px; width: 220px; text-align: center; transform-style: preserve-3d; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(255, 105, 180, 0.2); border: 1px solid rgba(255, 255, 255, 0.1);">
            <img src="images/Banana.jpeg" width="150" height="100" style="border-radius: 8px; transform: translateZ(20px);">
            <h3 style="color: #fff; margin: 10px 0; transform: translateZ(10px);">Banana Oreo Shake</h3>
            <p style="color: #ff69b4; font-weight: bold; transform: translateZ(5px);">₹50</p>
            <button class="btn btn-order" onclick="addToCart('Banana Oreo Shake', 50, 'images/Banana.jpeg', this)" style="padding: 10px 20px; background: linear-gradient(135deg, #ff69b4, #e0559e); color: white; border: none; border-radius: 30px; cursor: pointer; margin-top: 10px; font-weight: bold; transform: translateZ(15px); transition: all 0.3s ease;">Order Now</button>
        </div>
        <div class="milkshake-item" style="background: rgba(20, 20, 20, 0.4); backdrop-filter: blur(15px); padding: 15px; border-radius: 10px; width: 220px; text-align: center; transform-style: preserve-3d; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(255, 105, 180, 0.2); border: 1px solid rgba(255, 255, 255, 0.1);">
            <img src="images/mango.jpeg" width="150" height="100" style="border-radius: 8px; transform: translateZ(20px);">
            <h3 style="color: #fff; margin: 10px 0; transform: translateZ(10px);">Mango Milkshake</h3>
            <p style="color: #ff69b4; font-weight: bold; transform: translateZ(5px);">₹60</p>
            <button class="btn btn-order" onclick="addToCart('Mango Milkshake', 60, 'images/mango.jpeg', this)" style="padding: 10px 20px; background: linear-gradient(135deg, #ff69b4, #e0559e); color: white; border: none; border-radius: 30px; cursor: pointer; margin-top: 10px; font-weight: bold; transform: translateZ(15px); transition: all 0.3s ease;">Order Now</button>
        </div>
        <div class="milkshake-item" style="background: rgba(20, 20, 20, 0.4); backdrop-filter: blur(15px); padding: 15px; border-radius: 10px; width: 220px; text-align: center; transform-style: preserve-3d; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(255, 105, 180, 0.2); border: 1px solid rgba(255, 255, 255, 0.1);">
            <img src="images/chocolate.jpeg" width="150" height="100" style="border-radius: 8px; transform: translateZ(20px);">
            <h3 style="color: #fff; margin: 10px 0; transform: translateZ(10px);">Chocolate Shake</h3>
            <p style="color: #ff69b4; font-weight: bold; transform: translateZ(5px);">₹80</p>
            <button class="btn btn-order" onclick="addToCart('Chocolate Shake', 80, 'images/chocolate.jpeg', this)" style="padding: 10px 20px; background: linear-gradient(135deg, #ff69b4, #e0559e); color: white; border: none; border-radius: 30px; cursor: pointer; margin-top: 10px; font-weight: bold; transform: translateZ(15px); transition: all 0.3s ease;">Order Now</button>
        </div>
        <div class="milkshake-item" style="background: rgba(20, 20, 20, 0.4); backdrop-filter: blur(15px); padding: 15px; border-radius: 10px; width: 220px; text-align: center; transform-style: preserve-3d; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(255, 105, 180, 0.2); border: 1px solid rgba(255, 255, 255, 0.1);">
            <img src="images/Strawbarry.jpeg" width="150" height="100" style="border-radius: 8px; transform: translateZ(20px);">
            <h3 style="color: #fff; margin: 10px 0; transform: translateZ(10px);">Strawberry Shake</h3>
            <p style="color: #ff69b4; font-weight: bold; transform: translateZ(5px);">₹80</p>
            <button class="btn btn-order" onclick="addToCart('Strawberry Shake', 80, 'images/Strawbarry.jpeg', this)" style="padding: 10px 20px; background: linear-gradient(135deg, #ff69b4, #e0559e); color: white; border: none; border-radius: 30px; cursor: pointer; margin-top: 10px; font-weight: bold; transform: translateZ(15px); transition: all 0.3s ease;">Order Now</button>
        </div>
    </div>
    <div style="text-align: center; margin-top: 30px;">
        <button class="btn" onclick="window.location.href='milk_shakes.php'">View All Milk Shakes</button>
    </div>
</section>

<    
    <script>
        // Generate floating particles
        const particlesContainer = document.getElementById('particles');
        for (let i = 0; i < 50; i++) {
            const particle = document.createElement('div');
            particle.className = 'particle';
            particle.style.left = Math.random() * 100 + '%';
            particle.style.animationDelay = Math.random() * 20 + 's';
            particle.style.animationDuration = (15 + Math.random() * 10) + 's';
            
            // Random colors
            const colors = ['rgba(0, 255, 255, 0.6)', 'rgba(255, 0, 255, 0.6)', 'rgba(0, 255, 136, 0.6)', 'rgba(255, 255, 0, 0.6)'];
            particle.style.background = colors[Math.floor(Math.random() * colors.length)];
            particle.style.boxShadow = `0 0 10px ${colors[Math.floor(Math.random() * colors.length)]}`;
            
            particlesContainer.appendChild(particle);
        }
        
        // Scene setup
        const scene = new THREE.Scene();
        
        // Camera setup
        const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        camera.position.z = 5;
        
        // Renderer setup
        const renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
        renderer.setSize(400, 400);
        renderer.setPixelRatio(window.devicePixelRatio);
        document.getElementById('sphere-container').appendChild(renderer.domElement);
        
        // Create glowing sphere
        const geometry = new THREE.IcosahedronGeometry(1.5, 4);
        
        const material = new THREE.ShaderMaterial({
            uniforms: {
                time: { value: 0 },
                mouseX: { value: 0 },
                mouseY: { value: 0 },
                color1: { value: new THREE.Color(0x00ffff) },
                color2: { value: new THREE.Color(0xff00ff) },
                color3: { value: new THREE.Color(0x00ff88) }
            },
            vertexShader: `
                varying vec3 vNormal;
                varying vec3 vPosition;
                uniform float time;
                uniform float mouseX;
                uniform float mouseY;
                
                void main() {
                    vNormal = normalize(normalMatrix * normal);
                    vPosition = position;
                    
                    vec3 newPosition = position;
                    newPosition += normal * sin(time * 2.0 + position.x * 3.0) * 0.05;
                    newPosition += normal * cos(time * 1.5 + position.y * 2.0) * 0.03;
                    newPosition.x += mouseX * 0.3;
                    newPosition.y += mouseY * 0.3;
                    
                    gl_Position = projectionMatrix * modelViewMatrix * vec4(newPosition, 1.0);
                }
            `,
            fragmentShader: `
                uniform float time;
                uniform vec3 color1;
                uniform vec3 color2;
                uniform vec3 color3;
                varying vec3 vNormal;
                varying vec3 vPosition;
                
                void main() {
                    vec3 viewDirection = normalize(cameraPosition - vPosition);
                    float fresnel = pow(1.0 - dot(vNormal, viewDirection), 2.0);
                    
                    float colorMix = sin(vPosition.x * 2.0 + time) * 0.5 + 0.5;
                    float colorMix2 = cos(vPosition.y * 2.0 - time * 0.5) * 0.5 + 0.5;
                    
                    vec3 color = mix(color1, color2, colorMix);
                    color = mix(color, color3, colorMix2);
                    color += vec3(0.5, 0.8, 1.0) * fresnel * 1.5;
                    
                    float pulse = sin(time * 3.0) * 0.15 + 0.85;
                    color *= pulse;
                    
                    float alpha = 0.7 + fresnel * 0.3;
                    gl_FragColor = vec4(color, alpha);
                }
            `,
            transparent: true,
            side: THREE.DoubleSide
        });
        
        const sphere = new THREE.Mesh(geometry, material);
        scene.add(sphere);
        
        // Outer glow
        const glowGeometry = new THREE.IcosahedronGeometry(1.8, 3);
        const glowMaterial = new THREE.ShaderMaterial({
            uniforms: {
                time: { value: 0 },
                color: { value: new THREE.Color(0x00ffff) }
            },
            vertexShader: `
                varying vec3 vNormal;
                void main() {
                    vNormal = normalize(normalMatrix * normal);
                    gl_Position = projectionMatrix * modelViewMatrix * vec4(position, 1.0);
                }
            `,
            fragmentShader: `
                uniform float time;
                uniform vec3 color;
                varying vec3 vNormal;
                
                void main() {
                    float intensity = pow(0.7 - dot(vNormal, vec3(0.0, 0.0, 1.0)), 2.0);
                    float pulse = sin(time * 2.0) * 0.2 + 0.8;
                    gl_FragColor = vec4(color, intensity * 0.4 * pulse);
                }
            `,
            transparent: true,
            side: THREE.BackSide,
            blending: THREE.AdditiveBlending
        });
        
        const glowSphere = new THREE.Mesh(glowGeometry, glowMaterial);
        scene.add(glowSphere);
        
        // Particles
        const particleCount = 100;
        const particleGeometry = new THREE.BufferGeometry();
        const particlePositions = new Float32Array(particleCount * 3);
        
        for (let i = 0; i < particleCount * 3; i += 3) {
            const radius = 2 + Math.random() * 2;
            const theta = Math.random() * Math.PI * 2;
            const phi = Math.acos(2 * Math.random() - 1);
            
            particlePositions[i] = radius * Math.sin(phi) * Math.cos(theta);
            particlePositions[i + 1] = radius * Math.sin(phi) * Math.sin(theta);
            particlePositions[i + 2] = radius * Math.cos(phi);
        }
        
        particleGeometry.setAttribute('position', new THREE.BufferAttribute(particlePositions, 3));
        
        const particleMaterial = new THREE.PointsMaterial({
            color: 0x00ffff,
            size: 0.04,
            transparent: true,
            opacity: 0.6,
            blending: THREE.AdditiveBlending
        });
        
        const particles = new THREE.Points(particleGeometry, particleMaterial);
        scene.add(particles);
        
        let mouseX = 0, mouseY = 0, targetMouseX = 0, targetMouseY = 0;
        
        document.addEventListener('mousemove', (event) => {
            targetMouseX = (event.clientX / window.innerWidth) * 2 - 1;
            targetMouseY = -(event.clientY / window.innerHeight) * 2 + 1;
        });
        
        function animate() {
            requestAnimationFrame(animate);
            
            const time = performance.now() * 0.001;
            
            mouseX += (targetMouseX - mouseX) * 0.05;
            mouseY += (targetMouseY - mouseY) * 0.05;
            
            material.uniforms.time.value = time;
            material.uniforms.mouseX.value = mouseX;
            material.uniforms.mouseY.value = mouseY;
            glowMaterial.uniforms.time.value = time;
            
            sphere.rotation.x += 0.003 + mouseY * 0.01;
            sphere.rotation.y += 0.005 + mouseX * 0.01;
            
            glowSphere.rotation.x = sphere.rotation.x;
            glowSphere.rotation.y = sphere.rotation.y;
            
            particles.rotation.y += 0.001;
            particles.rotation.x += 0.0005;
            
            const scale = 1 + Math.sin(time * 2) * 0.05;
            glowSphere.scale.set(scale, scale, scale);
            
            renderer.render(scene, camera);
        }
        
        animate();
    </script>
    
    <script>
    function addToCart(name, price, image, btn) {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        let existing = cart.find(i => i.name === name);
        if (existing) {
            existing.qty += 1;
        } else {
            cart.push({name: name, price: price, img: image, qty: 1});
        }
        localStorage.setItem('cart', JSON.stringify(cart));
        
        btn.innerText = "Added! ✓";
        btn.style.background = "#00ff88";
        btn.style.color = "#000";
        
        let card = btn.closest('.veg-item, .nonveg-item, .milkshake-item');
        if(card) card.classList.add('zoom');
        
        setTimeout(() => {
            if(card) card.classList.remove('zoom');
            btn.innerText = "Order Now";
            // Reset to original style based on parent class
            if(btn.closest('.veg-item')) btn.style.background = "linear-gradient(135deg, #00ff88, #00bd68)";
            else if(btn.closest('.nonveg-item')) btn.style.background = "linear-gradient(135deg, #ff4d4d, #d43f3f)";
            else if(btn.closest('.milkshake-item')) btn.style.background = "linear-gradient(135deg, #ff69b4, #e0559e)";
            btn.style.color = btn.closest('.nonveg-item') || btn.closest('.milkshake-item') ? "white" : "black";
        }, 1000);
        
        alert(name + ' added to cart!');
    }
    </script>

    <!-- Social Media Links -->
    <footer style="background: rgba(0,0,0,0.8); padding: 30px; text-align: center; margin-top: 50px;">
        <div style="display: flex; justify-content: space-between; flex-wrap: wrap; max-width: 1200px; margin: 0 auto;">
            
            <!-- Left Side - Social Media -->
            <div style="text-align: left; flex: 1; min-width: 250px;">
                <h3 style="color: white; margin-bottom: 20px;">Follow Us</h3>
                <div style="display: flex; gap: 20px;">
                    <a href="https://instagram.com" target="_blank" style="text-decoration: none;">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/e/e7/Instagram_logo_2016.svg" width="40" height="40" alt="Instagram" style="border-radius: 8px; background: white; padding: 5px;">
                        <p style="color: white; margin-top: 5px;">Instagram</p>
                    </a>
                    <a href="https://twitter.com" target="_blank" style="text-decoration: none;">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/c/ce/X_logo_2023.svg" width="40" height="40" alt="Twitter" style="border-radius: 8px; background: white; padding: 5px;">
                        <p style="color: white; margin-top: 5px;">Twitter</p>
                    </a>
                    <a href="https://facebook.com" target="_blank" style="text-decoration: none;">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg" width="40" height="40" alt="Facebook" style="border-radius: 8px; background: white; padding: 5px;">
                        <p style="color: white; margin-top: 5px;">Facebook</p>
                    </a>
                </div>
            </div>
            
            <!-- Right Side - Contact -->
            <div style="text-align: right; flex: 1; min-width: 250px;">
                <h3 style="color: white; margin-bottom: 20px;">Contact Us</h3>
                <div style="text-align: right;">
                    <p style="color: #00ffff; font-size: 18px; margin-bottom: 5px;">📧 Email</p>
                    <p style="color: white; margin-bottom: 15px;">foodfactory@gmail.com</p>
                    <p style="color: #00ffff; font-size: 18px; margin-bottom: 5px;">📱 Phone</p>
                    <p style="color: white;">+91 9344565162</p>
                </div>
            </div>
        </div>
        <p style="color: #888; margin-top: 30px;">&copy; 2024 Food Factory. All rights reserved.</p>
    </footer>

</body>
</html>
