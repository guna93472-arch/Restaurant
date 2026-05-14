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
    <title> Juice Items</title>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), 
                        url('https://images.unsplash.com/photo-1622597467827-43b05b1ed8ff?w=1920&q=80') no-repeat center center/cover;
            background-attachment: fixed;
            color: white;
            text-align: center;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        h2 {
            margin-top: 30px;
            color: #ffffff;
            font-size: 32px;
            text-transform: uppercase;
            letter-spacing: 2px;
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
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.7), 0 0 20px rgba(255, 165, 0, 0.2);
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
            color: #ffa500;
            font-weight: 800;
            font-size: 24px;
            margin-bottom: 15px;
            text-shadow: 0 0 10px rgba(255, 165, 0, 0.3);
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
            background: linear-gradient(135deg, #ffa500, #ff8c00);
            color: #fff;
            font-weight: 800;
            border: none;
            cursor: pointer;
            border-radius: 30px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(255, 165, 0, 0.2);
        }

        .food-card button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 165, 0, 0.4);
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

    <h2>Refreshing Juices 🥤</h2>
    <div style="margin-bottom: 20px;">
        <button onclick="goToBill()" style="padding: 10px 30px; background: #FFD700; color: black; border: none; font-size: 16px; cursor: pointer; border-radius: 5px;">
            📋 View Bill & Checkout
        </button>
        <span id="cartCount" style="margin-left: 15px; font-size: 16px; font-weight: bold;"></span>
    </div>

    <div class="food-container">
        <!-- 1 -->
        <div class="food-card">
            <img src="https://images.unsplash.com/photo-1613478223719-2ab802602423?w=800&q=80" alt="Orange Juice" />
            <h3>Fresh Orange Juice</h3>
            <p>₹90</p>
            <button onclick="addToCart('Orange Juice', 90, 'https://images.unsplash.com/photo-1613478223719-2ab802602423?w=800&q=80', this)">Order Now</button>
        </div>
        <!-- 2 -->
        <div class="food-card">
            <img src="https://images.unsplash.com/photo-1568909344668-6f14a07b56a0?w=800&q=80" alt="Apple Juice" />
            <h3>Apple Bliss</h3>
            <p>₹120</p>
            <button onclick="addToCart('Apple Juice', 120, 'https://images.unsplash.com/photo-1568909344668-6f14a07b56a0?w=800&q=80', this)">Order Now</button>
        </div>
        <!-- 3 -->
        <div class="food-card">
            <img src="https://images.unsplash.com/photo-1563227812-0ea4c22e6cc8?w=800&q=80" alt="Watermelon Juice" />
            <h3>Pure Watermelon</h3>
            <p>₹80</p>
            <button onclick="addToCart('Watermelon Juice', 80, 'https://images.unsplash.com/photo-1563227812-0ea4c22e6cc8?w=800&q=80', this)">Order Now</button>
        </div>
        <!-- 4 -->
        <div class="food-card">
            <img src="https://images.unsplash.com/photo-1546173159-315724a31696?w=800&q=80" alt="Mango Juice" />
            <h3>Royal Mango</h3>
            <p>₹150</p>
            <button onclick="addToCart('Mango Juice', 150, 'https://images.unsplash.com/photo-1546173159-315724a31696?w=800&q=80', this)">Order Now</button>
        </div>
        <!-- 5 -->
        <div class="food-card">
            <img src="https://images.unsplash.com/photo-1550617931-e17a7b70dce2?w=800&q=80" alt="Pineapple Juice" />
            <h3>Tropical Pineapple</h3>
            <p>₹110</p>
            <button onclick="addToCart('Pineapple Juice', 110, 'https://images.unsplash.com/photo-1550617931-e17a7b70dce2?w=800&q=80', this)">Order Now</button>
        </div>
        <!-- 6 -->
        <div class="food-card">
            <img src="https://images.unsplash.com/photo-1602404251759-0a4db7c6fe70?w=800&q=80" alt="Grape Juice" />
            <h3>Velvet Grape</h3>
            <p>₹100</p>
            <button onclick="addToCart('Grape Juice', 100, 'https://images.unsplash.com/photo-1602404251759-0a4db7c6fe70?w=800&q=80', this)">Order Now</button>
        </div>
        <!-- 7 -->
        <div class="food-card">
            <img src="https://images.unsplash.com/photo-1602860637860-fa3d04533a07?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8UG9tZWdyYW5hdGUlMjBQdW5jaHxlbnwwfHwwfHx8MA%3D%3D" alt="Pomegranate Juice" />
            <h3>Pomegranate Punch</h3>
            <p>₹140</p>
            <button onclick="addToCart('Pomegranate Juice', 140, 'https://images.unsplash.com/photo-1613149487012-3269b5522538?w=800&q=80', this)">Order Now</button>
        </div>
        <!-- 8 -->
        <div class="food-card">
            <img src="https://images.unsplash.com/photo-1601058498590-7d92eb962f33?w=800&q=80" alt="Lemonade" />
            <h3>Classic Lemonade</h3>
            <p>₹60</p>
            <button onclick="addToCart('Lemonade', 60, 'https://images.unsplash.com/photo-1601058498590-7d92eb962f33?w=800&q=80', this)">Order Now</button>
        </div>
        <!-- 9 -->
        <div class="food-card">
            <img src="https://images.unsplash.com/photo-1621506289937-4c72ba5ddac7?w=800&q=80" alt="Mixed Fruit Juice" />
            <h3>Mixed Fruit Medley</h3>
            <p>₹130</p>
            <button onclick="addToCart('Mixed Fruit Juice', 130, 'https://images.unsplash.com/photo-1621506289937-4c72ba5ddac7?w=800&q=80', this)">Order Now</button>
        </div>
        <!-- 10 -->
        <div class="food-card">
            <img src="https://images.unsplash.com/photo-1582281298055-e25b84a30b44?w=800&q=80" alt="Kiwi Juice" />
            <h3>Zesty Kiwi</h3>
            <p>₹160</p>
            <button onclick="addToCart('Kiwi Juice', 160, 'https://images.unsplash.com/photo-1582281298055-e25b84a30b44?w=800&q=80', this)">Order Now</button>
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
            button.innerText = "Added! ✓";
            button.style.background = "#FFD700";
            button.style.color = "#000";
            
            let card = button.closest('.food-card');
            card.classList.add('zoom');
            
            setTimeout(() => {
                card.classList.remove('zoom');
                button.innerText = "Order Now";
                button.style.background = "linear-gradient(135deg, #ffa500, #ff8c00)";
            }, 800);

            // Show success message
            alert(item + ' added to cart! ✓');
            updateCartCount();
        }

        function updateCartCount() {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            let totalItems = cart.reduce((sum, item) => sum + item.qty, 0);
            document.getElementById('cartCount').textContent = '🛒 Items in cart: ' + totalItems;
        }

        function goToBill() {
            window.location.href = 'bill.php';
        }

        // Update cart count on page load
        window.addEventListener('load', updateCartCount);
    </script>

</body>
</html>