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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>All Items</title>
    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family: Arial, sans-serif;
        }
        body{
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), 
                        url('https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=1920&q=80') no-repeat center center/cover;
            background-attachment: fixed;
            color: white;
            text-align: center;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }
        header{
            display:flex;
            justify-content:space-between;
            align-items:center;
            padding:0 50px;      /* horizontal only */
            height:70px;         /* fixed size matches Home */
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
            margin:0 10px;
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
        .food-container{
            display:grid;
            grid-template-columns:repeat(3,1fr);
            gap:20px;
            margin-bottom:40px;
        }

        .food-card{
            background: rgba(20, 20, 20, 0.4);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius:20px;
            padding:20px;
            width:350px;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            animation: fadeIn 0.8s ease-out;
        }
        .food-card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.7), 0 0 20px rgba(255, 215, 0, 0.2);
        }
        .food-card h3 {
            color: #ffffff;
            margin: 15px 0 5px;
            font-size: 20px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.5);
        }
        .food-card p {
            color: #ffd700;
            font-weight: 800;
            font-size: 22px;
            margin-bottom: 15px;
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.3);
        }
        @keyframes zoomEffect {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
        .zoom {
            animation: zoomEffect 0.6s;
        }

        .food-card img{
            width:100%;
            height:350px;
            object-fit:cover;
            border-radius:10px;
            border: 2px solid #FFD700;
            box-shadow: 0 0 10px rgba(255, 215, 0, 0.8);
        }
        .food-card h3{
            margin:20px 0;
        }
        .food-card p{
            color:#555;
            font-weight:bold;
        }
        .food-card button{
            padding: 12px 25px;
            background: linear-gradient(135deg, #ffd700, #ffa500);
            color: #000;
            font-weight: 800;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            margin-top: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(255, 215, 0, 0.2);
        }
        .food-card button:hover{
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 215, 0, 0.4);
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

<h2>All Menu Items</h2>
<div style="margin-bottom: 20px;">
    <button onclick="goToBill()" style="padding: 10px 30px; background: #FFD700; color: black; border: none; font-size: 16px; cursor: pointer; border-radius: 5px;">
        📋 View Bill & Checkout
    </button>
    <span id="cartCount" style="margin-left: 15px; font-size: 16px; font-weight: bold;"></span>
</div>
// veg Itams
<div class="food-container">
   <div class="food-card">
         <img src="images/pani pori.jpeg" width="200" height="180" alt="Pani puri" />
        <h3>Pani Puri</h3>
        <p>₹40</p>
        <button onclick="addToCart('Pani Puri',40,'images/pani pori.jpeg', this)">Order Now</button>
    </div>
    <div class="food-card">
        <img src="images/panner.jpeg" width="200" height="180" alt="Paneer Butter Masala" />
        <h3>Paneer Butter Masala</h3>
        <p>₹80</p>
        <button onclick="addToCart('Paneer Butter Masala',80,'images/panner.jpeg', this)">Order Now</button>
    </div>
    
     <div class="food-card">
         <img src="images/idli.jpeg" width="200" height="180" alt="Idli" />
        <h3>Idli</h3>
        <p>₹30</p>
        <button onclick="addToCart('Idli',30,'images/idli.jpeg', this)">Order Now</button>
    </div>
     <div class="food-card">
            <img src="images/Curd rice.jpeg" width="200" height="180" alt="Curd Rice">
            <h3>Curd rice</h3>
            <p>₹50</p>
            <button onclick="addToCart('Curd rice',50,'images/Curd rice.jpeg', this)">Order Now</button>
        </div>
         <div class="food-card">
            <img src="images/Lemon.jpeg" width="200" height="180" alt="Lemon Rice">
            <h3>Lemon rice</h3>
            <p>₹50</p>
            <button onclick="addToCart('Lemon rice',50,'images/Lemon.jpeg', this)">Order Now</button>
        </div>
         <div class="food-card">
            <img src="images/Dosa.jpeg" width="200" height="180" alt="Dosa">
            <h3>Dosa</h3>
            <p>₹20</p>
            <button onclick="addToCart('Dosa',20,'images/Dosa.jpeg', this)">Order Now</button>
        </div>
         <div class="food-card">
            <img src="images/poori.jpeg" width="200" height="180" alt="Poori">
            <h3>Poori </h3>
            <p>₹30</p>
            <button onclick="addToCart('Poori',30,'images/poori.jpeg', this)">Order Now</button>
    </div>
    <!-- 9 New Veg Items Added -->
    <div class="food-card">
        <img src="images/masala_dosa.jpeg" width="200" height="180" alt="Masala Dosa" />
        <h3>Masala Dosa</h3>
        <p>₹40</p>
        <button onclick="addToCart('Masala Dosa',40,'images/masala_dosa.jpeg', this)">Order Now</button>
    </div>
    <div class="food-card">
        <img src="images/samber rice.jpeg" width="200" height="180" alt="Sambar Rice" />
        <h3>Sambar Rice</h3>
        <p>₹35</p>
        <button onclick="addToCart('Sambar Rice',35,'images/samber rice.jpeg', this)">Order Now</button>
    </div>
    <div class="food-card">
        <img src="images/mushroom.jpeg" width="200" height="180" alt="Mushroom Fried Rice" />
        <h3>Mushroom Fried Rice</h3>
        <p>₹100</p>
        <button onclick="addToCart('Mushroom Fried Rice',100,'images/mushroom.jpeg', this)">Order Now</button>
    </div>
    <div class="food-card">
        <img src="images/sandwich.jpeg" width="200" height="180" alt="Sandwich" />
        <h3>Sandwich</h3>
        <p>₹30</p>
        <button onclick="addToCart('Sandwich',30,'images/sandwich.jpeg', this)">Order Now</button>
    </div>
    <div class="food-card">
        <img src="images/ponda.jpeg" width="200" height="180" alt="Bonda" />
        <h3>Bonda</h3>
        <p>₹25</p>
        <button onclick="addToCart('Bonda',25,'images/ponda.jpeg', this)">Order Now</button>
    </div>
    <div class="food-card">
        <img src="images/samosa.jpeg" width="200" height="180" alt="Samosa" />
        <h3>Samosa</h3>
        <p>₹20</p>
        <button onclick="addToCart('Samosa',20,'images/samosa.jpeg', this)">Order Now</button>
    </div>
    <div class="food-card">
        <img src="images/pakoda.jpeg" width="200" height="180" alt="Pakoda" />
        <h3>Pakoda</h3>
        <p>₹30</p>
        <button onclick="addToCart('Pakoda',30,'images/pakoda.jpeg', this)">Order Now</button>
    </div>
    <div class="food-card">
        <img src="images/upma.jpeg" width="200" height="180" alt="Upma" />
        <h3>Upma</h3>
        <p>₹25</p>
        <button onclick="addToCart('Upma',25,'images/upma.jpeg', this)">Order Now</button>
    </div>
    <div class="food-card">
        <img src="images/pongal.jpeg" width="200" height="180" alt="Pongal" />
        <h3>Pongal</h3>
        <p>₹40</p>
        <button onclick="addToCart('Pongal',40,'images/pongal.jpeg', this)">Order Now</button>
    </div>
    
    <!-- Non-Veg Items -->
    
    <div class="food-card">
            <img src="images/mutton fry.jpeg" width="200" height="180" alt="Mutton Fry">
            <h3>Mutton fry</h3>
            <p>₹120</p>
            <button onclick="addToCart('Mutton fry',120,'images/mutton fry.jpeg', this)">Order Now</button>
        </div>

        <div class="food-card">
            <img src="images/egg gravy.jpeg" width="200" height="180" alt="Egg gravy">
            <h3>Egg gravy</h3>
            <p>₹80</p>
            <button onclick="addToCart('Egg gravy',80,'images/egg gravy.jpeg', this)">Order Now</button>
        </div>

        <div class="food-card">
            <img src="images/chicken biryani.jpeg" width="200" height="180" alt="Chicken Biryani">
            <h3>Chicken biryani</h3>
            <p>₹150</p>
            <button onclick="addToCart('Chicken biryani',150,'images/chicken biryani.jpeg', this)">Order Now</button>
        </div>
         <div class="food-card">
            <img src="images/fish fry.jpeg" width="200" height="180" alt="Fish fry">
            <h3>Fish fry</h3>
            <p>₹40</p>
            <button onclick="addToCart('Fish fry',40,'images/fish fry.jpeg', this)">Order Now</button>
        </div>
         <div class="food-card">
            <img src="images/tandoori.jpeg" width="200" height="180" alt="Tandoori">
            <h3>Tandoori</h3>
            <p>₹200</p>
            <button onclick="addToCart('Tandoori',200,'images/tandoori.jpeg', this)">Order Now</button>
        </div>
        <div class="food-card">
            <img src="images/chicken noodles.jpeg" width="200" height="180" alt="Chicken Noodles">
            <h3>Chicken Noodles</h3>
            <p>₹120</p>
            <button onclick="addToCart('Chicken Noodles',120,'images/chicken noodles.jpeg', this)">Order Now</button>
        </div>
         <div class="food-card">
            <img src="images/grill.jpeg" width="200" height="180" alt="Grill">
            <h3>Grill Chicken</h3>
            <p>₹180</p>
            <button onclick="addToCart('Grill Chicken',180,'images/grill.jpeg', this)">Order Now</button>
        </div>
         <div class="food-card">
            <img src="images/lolipop.jpeg" width="200" height="180" alt="Lolipop">
            <h3>Chicken Lolipop</h3>
            <p>₹140</p>
            <button onclick="addToCart('Chicken Lolipop',140,'images/lolipop.jpeg', this)">Order Now</button>
        </div>

    <!-- Milk Shakes -->
    
    <div class="food-card">
            <img src="images/Banana.jpeg" width="200" height="180" alt="Banana Oreo Shake" />
            <h3>Banana Oreo Shake</h3>
            <p>₹50</p>
            <button onclick="addToCart('Banana Oreo Shake',50,'images/Banana.jpeg', this)">Order Now</button>
        </div>
        <div class="food-card">
            <img src="images/mango.jpeg" width="200" height="180" alt="Milk Shake" />
            <h3>Milk Shake</h3>
            <p>₹30</p>
            <button onclick="addToCart('Milk Shake',30,'images/mango.jpeg', this)">Order Now</button>
        </div>
        <div class="food-card">
            <img src="images/chocolate.jpeg" width="200" height="180" alt="Chocolate shake" />
            <h3>Chocolate shake</h3>
            <p>₹80</p>
            <button onclick="addToCart('Chocolate shake',80,'images/chocolate.jpeg', this)">Order Now</button>
        </div>
        <div class="food-card">
            <img src="images/Strawbarry.jpeg" width="200" height="180" alt="Strawbarry" />
            <h3>Strawbarry milkshake</h3>
            <p>₹80</p>
            <button onclick="addToCart('Strawbarry milkshake',80,'images/Strawbarry.jpeg', this)">Order Now</button>
        </div>
        <div class="food-card">
            <img src="images/mango.jpeg" width="200" height="180" alt="Mango" />
            <h3>Mango Milkshake</h3>
            <p>₹60</p>
            <button onclick="addToCart('Mango Milkshake',60,'images/mango.jpeg', this)">Order Now</button>
        </div>
        <!-- Ice Cream Items -->
        <div class="food-card">
            <img src="images/vanilla_ice_cream.png" alt="Vanilla Dream" />
            <h3>Vanilla Dream</h3>
            <p>₹120</p>
            <button onclick="addToCart('Vanilla Dream', 120, 'images/vanilla_ice_cream.png', this)">Order Now</button>
        </div>
        <div class="food-card">
            <img src="images/chocolate_ice_cream.png" alt="Belgian Chocolate" />
            <h3>Belgian Chocolate</h3>
            <p>₹150</p>
            <button onclick="addToCart('Belgian Chocolate', 150, 'images/chocolate_ice_cream.png', this)">Order Now</button>
        </div>
        <div class="food-card">
            <img src="images/strawberry_ice_cream.png" alt="Strawberry Swirl" />
            <h3>Strawberry Swirl</h3>
            <p>₹140</p>
            <button onclick="addToCart('Strawberry Swirl', 140, 'images/strawberry_ice_cream.png', this)">Order Now</button>
        </div>
        <div class="food-card">
            <img src="images/butter_pecan_ice_cream.png" alt="Butter Pecan" />
            <h3>Butter Pecan</h3>
            <p>₹160</p>
            <button onclick="addToCart('Butter Pecan', 160, 'images/butter_pecan_ice_cream.png', this)">Order Now</button>
        </div>
        <div class="food-card">
            <img src="images/mint_choco_chip.png" alt="Mint Choco Chip" />
            <h3>Mint Choco Chip</h3>
            <p>₹130</p>
            <button onclick="addToCart('Mint Choco Chip', 130, 'images/mint_choco_chip.png', this)">Order Now</button>
        </div>
        <div class="food-card">
            <img src="images/mango_sorbet.png" alt="Mango Sorbet" />
            <h3>Mango Sorbet</h3>
            <p>₹110</p>
            <button onclick="addToCart('Mango Sorbet', 110, 'images/mango_sorbet.png', this)">Order Now</button>
        </div>
        <div class="food-card">
            <img src="https://images.unsplash.com/photo-1516100882582-96c3a05fe590?w=800&q=80" alt="Cookie Dough" />
            <h3>Cookie Dough</h3>
            <p>₹170</p>
            <button onclick="addToCart('Cookie Dough', 170, 'https://images.unsplash.com/photo-1516100882582-96c3a05fe590?w=800&q=80', this)">Order Now</button>
        </div>
        <div class="food-card">
            <img src="https://images.unsplash.com/photo-1505394033323-4241b2213fd3?w=800&q=80" alt="Pistachio Paradise" />
            <h3>Pistachio Paradise</h3>
            <p>₹180</p>
            <button onclick="addToCart('Pistachio Paradise', 180, 'https://images.unsplash.com/photo-1505394033323-4241b2213fd3?w=800&q=80', this)">Order Now</button>
        </div>
        <div class="food-card">
            <img src="https://images.unsplash.com/photo-1543255006-d6395b6f1171?w=800&q=80" alt="Caramel Crunch" />
            <h3>Caramel Crunch</h3>
            <p>₹145</p>
            <button onclick="addToCart('Caramel Crunch', 145, 'https://images.unsplash.com/photo-1543255006-d6395b6f1171?w=800&q=80', this)">Order Now</button>
        </div>
        <div class="food-card">
            <img src="https://images.unsplash.com/photo-1576506295286-5cda18df43e7?w=800&q=80" alt="Rocky Road" />
            <h3>Rocky Road</h3>
            <p>₹155</p>
            <button onclick="addToCart('Rocky Road', 155, 'https://images.unsplash.com/photo-1576506295286-5cda18df43e7?w=800&q=80', this)">Order Now</button>
        </div>

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
    button.style.background = "#ffd700";
    button.style.color = "#000";
    
    let card = button.closest('.food-card');
    card.classList.add('zoom');
    
    setTimeout(() => {
        card.classList.remove('zoom');
        button.innerText = "Order Now";
        button.style.background = "linear-gradient(135deg, #ffd700, #ffa500)";
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
