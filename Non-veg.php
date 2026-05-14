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
    <title>Non-Veg Items</title>
 
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), 
                        url('https://images.unsplash.com/photo-1606787366850-de6330128bfc?w=1920&q=80') no-repeat center center/cover;
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
            background: rgba(20, 20, 20, 0.4);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 20px;
            width: 350px;
            border-radius: 20px;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            text-align: center;
            animation: fadeIn 0.8s ease-out;
        }

        .food-card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.7), 0 0 20px rgba(255, 77, 77, 0.2);
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
            color: #ff4d4d;
            font-weight: 800;
            font-size: 24px;
            margin-bottom: 15px;
            text-shadow: 0 0 10px rgba(255, 77, 77, 0.3);
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
            background: linear-gradient(135deg, #ff4d4d, #d43f3f);
            color: white;
            font-weight: 800;
            border: none;
            cursor: pointer;
            border-radius: 30px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(255, 77, 77, 0.2);
        }

        .food-card button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 77, 77, 0.4);
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


    <h2>Non-Veg Items</h2>
    <div style="margin-bottom: 20px;">
        <button onclick="goToBill()" style="padding: 10px 30px; background: #FFD700; color: black; border: none; font-size: 16px; cursor: pointer; border-radius: 5px;">
             View Bill & Checkout
        </button>
        <span id="cartCount" style="margin-left: 15px; font-size: 16px; font-weight: bold;"></span>
    </div>

    <div class="food-container">

        <div class="food-card">
            <img src="images/mutton fry.jpeg" width="200" height="140" alt="Mutton Fry">
            <h3>Mutton fry</h3>
            <p>₹120</p>
            <button onclick="addToCart('Mutton fry',120,'images/mutton fry.jpeg', this)">Order Now</button>
        </div>

        <div class="food-card">
            <img src="images/egg gravy.jpeg" width="200" height="140" alt="Egg gravy">
            <h3>Egg gravy</h3>
            <p>₹80</p>
            <button onclick="addToCart('Egg gravy',80,'images/egg gravy.jpeg', this)">Order Now</button>
        </div>

        <div class="food-card">
            <img src="images/chicken biryani.jpeg" width="200" height="140" alt="Chicken Biryani">
            <h3>Chicken biryani</h3>
            <p>₹150</p>
            <button onclick="addToCart('Chicken biryani',150,'images/chicken biryani.jpeg', this)">Order Now</button>
        </div>
         <div class="food-card">
            <img src="images/fish fry.jpeg" width="200" height="140" alt="Fish fry">
            <h3>Fish fry</h3>
            <p>₹40</p>
            <button onclick="addToCart('Fish fry',40,'images/fish fry.jpeg', this)">Order Now</button>
        </div>
         <div class="food-card">
            <img src="images/tandoori.jpeg" width="200" height="140" alt="Tandoori">
            <h3>Tandoori</h3>
            <p>₹200</p>
            <button onclick="addToCart('Tandoori',200,'images/tandoori.jpeg', this)">Order Now</button>
        </div>
        <div class="food-card">
            <img src="images/chicken noodles.jpeg" width="200" height="140" alt="Chicken Noodles">
            <h3>Chicken Noodles</h3>
            <p>₹120</p>
            <button onclick="addToCart('Chicken Noodles',120,'images/chicken noodles.jpeg', this)">Order Now</button>
        </div>
         <div class="food-card">
            <img src="images/grill.jpeg" width="200" height="140" alt="Grill">
            <h3>Grill Chicken</h3>
            <p>₹180</p>
            <button onclick="addToCart('Grill Chicken',180,'images/grill.jpeg', this)">Order Now</button>
        </div>
         <div class="food-card">
            <img src="images/lolipop.jpeg" width="200" height="140" alt="Lolipop">
            <h3>Chicken Lolipop</h3>
            <p>₹140</p>
            <button onclick="addToCart('Chicken Lolipop',140,'images/lolipop.jpeg', this)">Order Now</button>
        </div>
        <!-- New Items -->
        <div class="food-card">
            <img src="https://images.unsplash.com/photo-1519708227418-c8fd9a32b7a2?w=800&q=80" alt="Grilled Salmon">
            <h3>Grilled Salmon</h3>
            <p>₹250</p>
            <button onclick="addToCart('Grilled Salmon', 250, 'https://images.unsplash.com/photo-1519708227418-c8fd9a32b7a2?w=800&q=80', this)">Order Now</button>
        </div>
        <div class="food-card">
            <img src="https://images.unsplash.com/photo-1603894584373-5ac82b2ae398?w=800&q=80" alt="Butter Chicken">
            <h3>Butter Chicken</h3>
            <p>₹180</p>
            <button onclick="addToCart('Butter Chicken', 180, 'https://images.unsplash.com/photo-1603894584373-5ac82b2ae398?w=800&q=80', this)">Order Now</button>
        </div>
        <div class="food-card">
            <img src="https://images.unsplash.com/photo-1565557623262-b51c2513a641?w=800&q=80" alt="Prawn Roast">
            <h3>Prawn Roast</h3>
            <p>₹220</p>
            <button onclick="addToCart('Prawn Roast', 220, 'https://images.unsplash.com/photo-1565557623262-b51c2513a641?w=800&q=80', this)">Order Now</button>
        </div>
        <div class="food-card">
            <img src="https://images.unsplash.com/photo-1603048297172-c92544798d5a?w=800&q=80" alt="Lamb Chops">
            <h3>Lamb Chops</h3>
            <p>₹300</p>
            <button onclick="addToCart('Lamb Chops', 300, 'https://images.unsplash.com/photo-1603048297172-c92544798d5a?w=800&q=80', this)">Order Now</button>
        </div>
        <div class="food-card">
            <img src="https://images.unsplash.com/photo-1599487488170-d11ec9c172f0?w=800&q=80" alt="Chicken Tikka">
            <h3>Chicken Tikka</h3>
            <p>₹150</p>
            <button onclick="addToCart('Chicken Tikka', 150, 'https://images.unsplash.com/photo-1599487488170-d11ec9c172f0?w=800&q=80', this)">Order Now</button>
        </div>
         
    </div>
<div id="qrSection">
    <h3 id="paymentText"></h3>
    <img id="qrImage" src="" />
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
                button.style.background = "linear-gradient(135deg, #ff4d4d, #d43f3f)";
                updateCartCount();
            }, 800);

            // Show success message
            alert(item + ' added to cart! ?');
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

