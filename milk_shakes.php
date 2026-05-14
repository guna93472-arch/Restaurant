<?php 
session_start(); 
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Veg Items</title>
 
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), 
                        url('https://images.unsplash.com/photo-1579954115545-a95591f28be9?w=1920&q=80') no-repeat center center/cover;
            background-attachment: fixed;
            color: white;
            text-align: center;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        /* Header styling */
        header{
            display:flex;
            justify-content:space-between;
            align-items:center;
            padding:0 50px;
            height:70px;
            background:rgba(0,0,0,0.7);
            box-sizing:border-box;
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

        h2 {
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

        .food-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
            margin-top: 30px;
        }

        .food-card {
            background: rgba(20, 20, 20, 0.7);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 20px;
            width: 250px;
            border-radius: 15px;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.8);
            transition: all 0.3s ease;
            text-align: center;
        }
        .food-card h3 {
            color: #ffffff;
            margin: 15px 0 5px;
            font-size: 20px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.5);
        }
        .food-card p {
            color: #ff69b4;
            font-weight: 800;
            font-size: 22px;
            margin-bottom: 15px;
            text-shadow: 0 0 10px rgba(255, 105, 180, 0.3);
        }
        .food-card img {
            width: 100%;
            height: 350px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid #FFD700;
            box-shadow: 0 0 10px rgba(255, 215, 0, 0.8);
        }
        @keyframes zoomEffect {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
        .zoom {
            animation: zoomEffect 0.6s;
        }

        .food-card h3 {
            margin: 10px 0;
        }

        .food-card p {
            color: #555;
        }

        .food-card button {
            padding: 12px 25px;
            background: linear-gradient(135deg, #ff69b4, #e0559e);
            color: #fff;
            font-weight: 800;
            border: none;
            cursor: pointer;
            border-radius: 30px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(255, 105, 180, 0.2);
        }

        .food-card button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 105, 180, 0.4);
            filter: brightness(1.1);
        }
    </style>
</head>

<body>
<link rel="stylesheet" href="sidebar.css">
<div class="sidebar">
    <h1>Foodies<span>.</span></h1>
    <hr class="sidebar-divider">
    <nav>
        <a href="index.php"><span class="icon">??</span> Home</a>
        <a href="dayfoodies.php"><span class="icon">??</span> Day Foodies</a>
        <a href="All.php"><span class="glow-dot" style="--c: #00ffff;"></span> All Items</a>
        <a href="Veg.php"><span class="glow-dot" style="--c: #00ff55;"></span> Veg Menu</a>
        <a href="Non-veg.php"><span class="glow-dot" style="--c: #ff3333;"></span> Non-Veg Menu</a>
        <a href="milk_shakes.php"><span class="glow-dot" style="--c: #a833ff;"></span> Milkshakes</a>
        <a href="Juice.php"><span class="glow-dot" style="--c: #ff9933;"></span> Juice</a>
        <a href="Icecream.php"><span class="glow-dot" style="--c: #ff69b4;"></span> Ice Cream</a>
        <a href="bill.php"><span class="icon">??</span> Bill</a>
        <a href="About.php"><span class="icon">??</span> About</a>
        <hr class="sidebar-divider">
        <?php if(isset($_SESSION['username'])): ?>
            <a href="auth.php?action=logout" style="color: #ff4d4d;"><span class="icon">??</span> Logout (<?php echo $_SESSION['username']; ?>)</a>
        <?php else: ?>
            <a href="login.php" style="color: #00ff88;"><span class="icon">??</span> Login / Register</a>
        <?php endif; ?>
    </nav>
</div>

    <h2>Milks Items </h2>
    <div style="margin-bottom: 20px;">
        <button onclick="goToBill()" style="padding: 10px 30px; background: #FFD700; color: black; border: none; font-size: 16px; cursor: pointer; border-radius: 5px;">
             View Bill & Checkout
        </button>
        <span id="cartCount" style="margin-left: 15px; font-size: 16px; font-weight: bold;"></span>
    </div>

    <div class="food-container">

<div class="food-card">
<img src="images/Banana.jpeg" width="150" height="100" alt="Banana Oreo Shake" />
<h3>Banana Oreo Shake</h3>
<p>₹50</p>
<button onclick="addToCart('Banana Oreo Shake',50,'images/Banana.jpeg', this)">Order Now</button>
</div>
<div class="food-card">
<img src="images/mango.jpeg" width="150" height="100" alt="Milk Shake" />
<h3>Milk Shake</h3>
<p>₹30</p>
<button onclick="addToCart('Milk Shake',30,'images/mango.jpeg', this)">Order Now</button>
</div>
<div class="food-card">
<img src="images/chocolate.jpeg" width="150" height="100" alt="Chocolate shake" />
<h3>Chocolate shake</h3>
<p>₹80</p>
<button onclick="addToCart('Chocolate shake',80,'images/chocolate.jpeg', this)">Order Now</button>
</div>
<div class="food-card">
<img src="images/Strawbarry.jpeg" width="150" height="100" alt="Strawbarry" />
<h3>Strawbarry milkshake</h3>
<p>₹80</p>
<button onclick="addToCart('Strawbarry milkshake',80,'images/Strawbarry.jpeg', this)">Order Now</button>
</div>
<div class="food-card">
<img src="images/mango.jpeg" width="150" height="100" alt="Mango" />
<h3>Mango Milkshake</h3>
<p>₹60</p>
<button onclick="addToCart('Mango Milkshake',60,'images/mango.jpeg', this)">Order Now</button>
</div>
<div class="food-card">
<img src="images/grape.jpeg" width="150" height="100" alt="Grape" />
<h3>Grape Milkshake</h3>
<p>₹50</p>
<button onclick="addToCart('Grape Milkshake',50,'images/grape.jpeg', this)">Order Now</button>
</div>
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
            
            // Zoom effect
            let card = button.closest('.food-card');
            card.classList.add('zoom');
            
            button.innerText = "Added! ?";
            button.style.background = "#00ff88";

            setTimeout(() => {
                card.classList.remove('zoom');
                button.innerText = "Order Now";
                button.style.background = "linear-gradient(135deg, #ff69b4, #e0559e)";
            }, 800);
            
            // Show success message
            alert(item + ' added to cart! ?');
            updateCartCount();
        }

        function updateCartCount() {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            let totalItems = cart.reduce((sum, item) => sum + item.qty, 0);
            document.getElementById('cartCount').textContent = '?? Items in cart: ' + totalItems;
        }

        function goToBill() {
            window.location.href = 'bill.php';
        }

        // Update cart count on page load
        window.addEventListener('load', updateCartCount);
    </script>

</body>
</html>

