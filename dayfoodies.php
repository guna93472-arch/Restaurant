<?php 
session_start(); 
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$day = date('l'); 
$hour = (int)date('H');

$isBreakfastTime = ($hour >= 6 && $hour < 11);
$isLunchTime = ($hour >= 11 && $hour < 16);
$isDinnerTime = ($hour >= 18 || $hour < 4);

$isWeekend = ($day == 'Saturday' || $day == 'Sunday');
$isOffDay = ($day == 'Monday' || $day == 'Tuesday');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Day Foodies - Specials</title>
    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family: 'Poppins', sans-serif;
        }
        body{
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), 
                        url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=1920&q=80') no-repeat center center/cover;
            background-attachment: fixed;
            color: white;
            text-align: center;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }
        .content {
            margin-left: 260px;
            padding: 40px;
        }
        h2{
            margin: 40px 0;
            font-size: 3.5rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 4px;
            background: linear-gradient(to right, #ffd700, #fff, #ffd700);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 5px 15px rgba(255, 215, 0, 0.2);
            position: relative;
            display: inline-block;
            margin-bottom: 50px;
        }
        h2::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: gold;
            border-radius: 10px;
            box-shadow: 0 0 10px gold;
        }
        .section-header {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin-top: 50px;
            margin-bottom: 30px;
            position: relative;
        }
        .section-header h3 {
            font-size: 2rem;
            color: gold;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .section-header .badge {
            background: #ff4d4d;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: bold;
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(255, 77, 77, 0.7); }
            70% { transform: scale(1.05); box-shadow: 0 0 0 10px rgba(255, 77, 77, 0); }
            100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(255, 77, 77, 0); }
        }
        
        .food-grid {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
            margin-bottom: 50px;
        }

        .food-card{
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius:25px;
            padding:20px;
            width:300px;
            transition: 0.4s;
            position: relative;
            overflow: hidden;
        }
        .food-card:hover {
            transform: translateY(-10px);
            background: rgba(255, 255, 255, 0.1);
            border-color: gold;
        }
        .food-card img{
            width:100%;
            height:200px;
            object-fit:cover;
            border-radius:15px;
            margin-bottom: 15px;
        }
        .food-card h4 {
            font-size: 1.3rem;
            margin-bottom: 8px;
        }
        .food-card p {
            color: gold;
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .food-card button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(45deg, #FFD700, #FFA500);
            color: black;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }
        .food-card button:hover {
            filter: brightness(1.2);
        }

        .day-info {
            background: rgba(0,0,0,0.4);
            display: inline-block;
            padding: 15px 30px;
            border-radius: 50px;
            border: 1px solid rgba(255,215,0,0.3);
            margin-bottom: 30px;
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
        <a href="dayfoodies.php" class="active"><span class="icon">📅</span> Day Foodies</a>
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

<div class="content">
    <h2>Dynamic Day Specials 🍽️</h2>
    
    <div class="day-info">
        📅 Today: <strong><?php echo $day; ?></strong> | 🕒 Current Time: <strong><?php echo date('h:i A'); ?></strong>
    </div>

    <div style="margin-bottom: 30px;">
        <button onclick="goToBill()" style="padding: 12px 40px; background: gold; color: black; border: none; font-size: 1.1rem; cursor: pointer; border-radius: 50px; font-weight: bold; box-shadow: 0 4px 15px rgba(255,215,0,0.3);">
            🛒 View Cart & Checkout
        </button>
        <span id="cartCount" style="margin-left: 20px; font-size: 1.1rem; font-weight: bold;"></span>
    </div>

    <!-- BREAKFAST SECTION -->
    <div class="section-header">
        <h3>🍳 Morning Breakfast Specials</h3>
        <?php if($isBreakfastTime): ?><span class="badge">LIVE NOW</span><?php endif; ?>
    </div>
    <div class="food-grid">
        <?php
        $breakfastItems = [
            ['name' => 'Soft Idli (2 Nos)', 'price' => 30, 'img' => 'images/idli.jpeg'],
            ['name' => 'Crispy Dosa', 'price' => 20, 'img' => 'images/Dosa.jpeg'],
            ['name' => 'Ghee Pongal', 'price' => 40, 'img' => 'images/pongal.jpeg'],
            ['name' => 'Poori Masala', 'price' => 30, 'img' => 'images/poori.jpeg']
        ];
        foreach ($breakfastItems as $item) {
            echo "
            <div class='food-card'>
                <img src='{$item['img']}' alt='{$item['name']}'>
                <h4>{$item['name']}</h4>
                <p>₹{$item['price']}</p>
                <button onclick=\"addToCart('{$item['name']}', {$item['price']}, '{$item['img']}', this)\">Order Now</button>
            </div>";
        }
        ?>
    </div>

    <!-- LUNCH SECTION -->
    <div class="section-header">
        <h3>🌞 Afternoon Lunch Specials</h3>
        <?php if($isLunchTime): ?><span class="badge">LIVE NOW</span><?php endif; ?>
    </div>
    <div class="food-grid">
        <?php
        $lunchItems = [
            ['name' => 'Chicken Biryani', 'price' => 150, 'img' => 'images/chicken biryani.jpeg'],
            ['name' => 'Mutton Fry', 'price' => 120, 'img' => 'images/mutton fry.jpeg'],
            ['name' => 'Sambar Rice', 'price' => 40, 'img' => 'images/samber rice.jpeg'],
            ['name' => 'Veg Fried Rice', 'price' => 100, 'img' => 'images/veg fried Rice.jpeg']
        ];
        foreach ($lunchItems as $item) {
            echo "
            <div class='food-card'>
                <img src='{$item['img']}' alt='{$item['name']}'>
                <h4>{$item['name']}</h4>
                <p>₹{$item['price']}</p>
                <button onclick=\"addToCart('{$item['name']}', {$item['price']}, '{$item['img']}', this)\">Order Now</button>
            </div>";
        }
        ?>
    </div>

    <!-- DINNER SECTION -->
    <div class="section-header">
        <h3>🌙 Night Dinner Specials</h3>
        <?php if($isDinnerTime): ?><span class="badge">LIVE NOW</span><?php endif; ?>
    </div>
    <div class="food-grid">
        <?php
        $dinnerItems = [
            ['name' => 'Chicken Noodles', 'price' => 120, 'img' => 'images/chicken noodles.jpeg'],
            ['name' => 'Tandoori Chicken', 'price' => 200, 'img' => 'images/Tandoori.jpeg'],
            ['name' => 'Special Dosa', 'price' => 40, 'img' => 'images/masala_dosa.jpeg'],
            ['name' => 'Egg Gravy', 'price' => 80, 'img' => 'images/egg gravy.jpeg']
        ];
        foreach ($dinnerItems as $item) {
            echo "
            <div class='food-card'>
                <img src='{$item['img']}' alt='{$item['name']}'>
                <h4>{$item['name']}</h4>
                <p>₹{$item['price']}</p>
                <button onclick=\"addToCart('{$item['name']}', {$item['price']}, '{$item['img']}', this)\">Order Now</button>
            </div>";
        }
        ?>
    </div>

    <!-- DAY SPECIFIC SECTION (Weekend/Offdays) -->
    <?php if($isWeekend || $isOffDay): ?>
    <div class="section-header">
        <h3>✨ <?php echo $day; ?> Special Extras</h3>
    </div>
    <div class="food-grid">
        <?php
        $extraItems = [];
        if($isWeekend) {
            $extraItems = [
                ['name' => 'Chocolate Shake', 'price' => 80, 'img' => 'images/chocolate.jpeg'],
                ['name' => 'Vanilla Dream', 'price' => 120, 'img' => 'images/vanilla_ice_cream.png'],
                ['name' => 'Pani Puri', 'price' => 40, 'img' => 'images/pani pori.jpeg']
            ];
        } else {
            $extraItems = [
                ['name' => 'Sandwich', 'price' => 30, 'img' => 'images/sandwich.jpeg'],
                ['name' => 'Samosa', 'price' => 20, 'img' => 'images/samosa.jpeg']
            ];
        }
        foreach ($extraItems as $item) {
            echo "
            <div class='food-card'>
                <img src='{$item['img']}' alt='{$item['name']}'>
                <h4>{$item['name']}</h4>
                <p>₹{$item['price']}</p>
                <button onclick=\"addToCart('{$item['name']}', {$item['price']}, '{$item['img']}', this)\">Order Now</button>
            </div>";
        }
        ?>
    </div>
    <?php endif; ?>

</div>

<script>
function addToCart(item, price, img, button) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    let existing = cart.find(i => i.name === item);
    if (existing) {
        existing.qty += 1;
    } else {
        cart.push({name: item, price: price, qty: 1, img: img});
    }
    localStorage.setItem('cart', JSON.stringify(cart));
    
    // Interaction effect
    button.innerText = "Added! ✓";
    button.style.background = "#ffd700";
    button.style.color = "#000";
    
    let card = button.closest('.food-card');
    if(card) card.style.transform = "scale(1.05)";
    
    setTimeout(() => {
        if(card) card.style.transform = "translateY(-10px)";
        button.innerText = "Order Now";
        button.style.background = "linear-gradient(45deg, #FFD700, #FFA500)";
    }, 800);

    alert(item + ' added to cart! ✓');
    updateCartCount();
}

function updateCartCount() {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    let totalItems = cart.reduce((sum, item) => sum + item.qty, 0);
    document.getElementById('cartCount').textContent = '🛒 Items: ' + totalItems;
}

function goToBill() {
    window.location.href = 'bill.php';
}

window.addEventListener('load', updateCartCount);
</script>

</body>
</html>
