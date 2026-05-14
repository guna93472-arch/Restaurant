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
    <title>Ice Cream Items</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), 
                        url('https://images.unsplash.com/photo-1501443762994-82bd5dace89a?w=1920&q=80') no-repeat center center/cover;
            background-attachment: fixed;
            color: white;
            text-align: center;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
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
            gap: 30px;
            flex-wrap: wrap;
            padding: 40px;
            margin-top: 10px;
        }

        .food-card {
            background: rgba(20, 20, 20, 0.4);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 20px;
            width: 320px;
            border-radius: 20px;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            text-align: center;
            animation: fadeIn 0.8s ease-out;
        }

        .food-card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.7), 0 0 20px rgba(255, 105, 180, 0.2);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .food-card h3 {
            color: #ffffff;
            margin: 15px 0 5px;
            font-size: 22px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.5);
        }

        .food-card p {
            color: #ff69b4;
            font-weight: 800;
            font-size: 24px;
            margin-bottom: 15px;
            text-shadow: 0 0 10px rgba(255, 105, 180, 0.3);
        }

        .food-card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 12px;
            border: 2px solid #FFD700;
            box-shadow: 0 0 15px rgba(255, 215, 0, 0.4);
        }

        .food-card button {
            padding: 12px 30px;
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

        @keyframes zoomEffect {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .zoom {
            animation: zoomEffect 0.6s;
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

    <h2>Chilled Ice Creams </h2>
    <div style="margin-bottom: 20px;">
        <button onclick="goToBill()" style="padding: 10px 30px; background: #FFD700; color: black; border: none; font-size: 16px; cursor: pointer; border-radius: 5px;">
             View Bill & Checkout
        </button>
        <span id="cartCount" style="margin-left: 15px; font-size: 16px; font-weight: bold;"></span>
    </div>

    <div class="food-container">
        <!-- 1 -->
        <div class="food-card">
            <img src="images/vanilla_ice_cream.png" alt="Vanilla Dream" />
            <h3>Vanilla Dream</h3>
            <p>₹120</p>
            <button onclick="addToCart('Vanilla Dream', 120, 'images/vanilla_ice_cream.png', this)">Order Now</button>
        </div>
        <!-- 2 -->
        <div class="food-card">
            <img src="images/chocolate_ice_cream.png" alt="Belgian Chocolate" />
            <h3>Belgian Chocolate</h3>
            <p>₹150</p>
            <button onclick="addToCart('Belgian Chocolate', 150, 'images/chocolate_ice_cream.png', this)">Order Now</button>
        </div>
        <!-- 3 -->
        <div class="food-card">
            <img src="images/strawberry_ice_cream.png" alt="Strawberry Swirl" />
            <h3>Strawberry Swirl</h3>
            <p>₹140</p>
            <button onclick="addToCart('Strawberry Swirl', 140, 'images/strawberry_ice_cream.png', this)">Order Now</button>
        </div>
        <!-- 4 -->
        <div class="food-card">
            <img src="images/butter_pecan_ice_cream.png" alt="Butter Pecan" />
            <h3>Butter Pecan</h3>
            <p>₹160</p>
            <button onclick="addToCart('Butter Pecan', 160, 'images/butter_pecan_ice_cream.png', this)">Order Now</button>
        </div>
        <!-- 5 -->
        <div class="food-card">
            <img src="images/mint_choco_chip.png" alt="Mint Choco Chip" />
            <h3>Mint Choco Chip</h3>
            <p>₹130</p>
            <button onclick="addToCart('Mint Choco Chip', 130, 'images/mint_choco_chip.png', this)">Order Now</button>
        </div>
        <!-- 6 -->
        <div class="food-card">
            <img src="images/mango_sorbet.png" alt="Mango Sorbet" />
            <h3>Mango Sorbet</h3>
            <p>₹110</p>
            <button onclick="addToCart('Mango Sorbet', 110, 'images/mango_sorbet.png', this)">Order Now</button>
        </div>
        <!-- 7 -->
        <div class="food-card">
            <img src="https://images.unsplash.com/photo-1516100882582-96c3a05fe590?w=800&q=80" alt="Cookie Dough" />
            <h3>Cookie Dough</h3>
            <p>₹170</p>
            <button onclick="addToCart('Cookie Dough', 170, 'https://images.unsplash.com/photo-1516100882582-96c3a05fe590?w=800&q=80', this)">Order Now</button>
        </div>
        <!-- 8 -->
        <div class="food-card">
            <img src="https://images.unsplash.com/photo-1505394033323-4241b2213fd3?w=800&q=80" alt="Pistachio Paradise" />
            <h3>Pistachio Paradise</h3>
            <p>₹180</p>
            <button onclick="addToCart('Pistachio Paradise', 180, 'https://images.unsplash.com/photo-1505394033323-4241b2213fd3?w=800&q=80', this)">Order Now</button>
        </div>
        <!-- 9 -->
        <div class="food-card">
            <img src="https://images.unsplash.com/photo-1543255006-d6395b6f1171?w=800&q=80" alt="Caramel Crunch" />
            <h3>Caramel Crunch</h3>
            <p>₹145</p>
            <button onclick="addToCart('Caramel Crunch', 145, 'https://images.unsplash.com/photo-1543255006-d6395b6f1171?w=800&q=80', this)">Order Now</button>
        </div>
        <!-- 10 -->
        <div class="food-card">
            <img src="https://images.unsplash.com/photo-1576506295286-5cda18df43e7?w=800&q=80" alt="Rocky Road" />
            <h3>Rocky Road</h3>
            <p>₹155</p>
            <button onclick="addToCart('Rocky Road', 155, 'https://images.unsplash.com/photo-1576506295286-5cda18df43e7?w=800&q=80', this)">Order Now</button>
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
            
            // Interaction effect
            button.innerText = "Added! ?";
            button.style.background = "#00ff88";
            
            let card = button.closest('.food-card');
            card.classList.add('zoom');
            
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

