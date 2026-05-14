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
<title>bill</title>

<style>
body{
    font-family: 'Poppins', sans-serif;
    margin:0;
    padding: 0;
    background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), 
                url('https://images.unsplash.com/photo-1550966841-396ad886756b?w=1920&q=80') no-repeat center center/cover;
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

h1{
    padding:20px;
}

.container{
    display:flex;
    justify-content:space-between;
    padding:20px;
}

.cart{
    width:65%;
    background: rgba(30, 30, 30, 0.65);
    backdrop-filter: blur(15px);
    -webkit-backdrop-filter: blur(15px);
    border: 1px solid rgba(255, 255, 255, 0.15);
    box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.4);
    color: #fff;
    padding:20px;
    border-radius:12px;
}

.item{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:15px;
    border-bottom:1px solid rgba(255, 255, 255, 0.1);
    background: rgba(255, 255, 255, 0.05); /* subtle glow */
    border-radius:8px;
    margin-bottom:10px;
    transition: 0.3s;
}
.item:hover {
    background: rgba(255, 255, 255, 0.1);
}

.item-info{
    display:flex;
    gap:15px;
    align-items:center;
}

.item img{
    width:80px;
    height:80px;
    border-radius:10px;
    object-fit:cover;
    border: 2px solid gold;
}

.qty button{
    padding:3px 8px;
    margin:0 5px;
}

/* RIGHT SIDE - BILL */
.bill{
    width:30%;
    background: rgba(30, 30, 30, 0.65);
    backdrop-filter: blur(15px);
    -webkit-backdrop-filter: blur(15px);
    border: 1px solid rgba(255, 255, 255, 0.15);
    box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.4);
    color: #fff;
    padding:20px;
    border-radius:12px;
    height:fit-content;
}
/* Inputs */
input[type="text"], textarea {
    background: rgba(0, 0, 0, 0.4);
    color: white;
    border: 1px solid rgba(255, 255, 255, 0.2) !important;
}
input[type="text"]::placeholder, textarea::placeholder {
    color: rgba(255, 255, 255, 0.6);
}

.bill h2{
    margin-top:0;
}

.btn-pay {
    width: 100%;
    background: linear-gradient(135deg, #00C851, #007E33);
    color: white;
    padding: 15px;
    border: none;
    border-radius: 30px;
    cursor: pointer;
    font-size: 18px;
    font-weight: 800;
    margin-top: 20px;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(0, 200, 81, 0.3);
}

.btn-pay:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 200, 81, 0.5);
    filter: brightness(1.1);
}

.btn-print {
    width: 100%;
    background: linear-gradient(135deg, #33b5e5, #0099CC);
    color: white;
    padding: 15px;
    border: none;
    border-radius: 30px;
    cursor: pointer;
    font-size: 18px;
    font-weight: 800;
    margin-top: 10px;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(51, 181, 229, 0.3);
}

.btn-print:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(51, 181, 229, 0.5);
    filter: brightness(1.1);
}

.bill-row{
    display:flex;
    justify-content:space-between;
    margin:10px 0;
}

.total{
    font-weight:bold;
    font-size:18px;
    color:#e65100;
}

button{
    width:100%;
    padding:10px;
    margin-top:15px;
    border:none;
    border-radius:6px;
    cursor:pointer;
}

#qr{
    text-align:center;
    margin-top:15px;
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

<h1>Your Cart</h1>

<div class="container">

<!-- LEFT SIDE -->
<div class="cart" id="cartItems">

</div>

<!-- RIGHT SIDE -->
<div class="bill">

<h2>Bill Details</h2>

<div class="bill-row">
<span>Subtotal</span>
<span>₹<span id="subtotal">0</span></span>
</div>

<div class="bill-row">
<span>Tax (1%)</span>
<span>₹<span id="tax">0</span></span>
</div>

<div class="bill-row total">
<span>Total Amount</span>
<span>₹<span id="total">0</span></span>
</div>

<hr style="margin: 15px 0;">

<div style="margin-top: 15px;">
<label style="font-weight: bold;">Customer Name</label>
<input type="text" id="customerName" placeholder="Enter your name" style="width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box;">

<label style="font-weight: bold; display: block; margin-top: 10px;">Address</label>
<textarea id="customerAddress" placeholder="Enter your address" style="width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; height: 60px; resize: none;"></textarea>

<label style="font-weight: bold; display: block; margin-top: 10px;">Phone Number</label>
<input type="text" id="customerPhone" placeholder="Enter your phone number" style="width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box;">
</div>

<button class="pay" onclick="payNow()">Pay Now</button>
<button class="print" onclick="window.print()">Print Bill</button>

<div id="qr"></div>

</div>

</div>

<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "restaurant";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create orders table if not exists
$sql = "CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(255),
    address TEXT,
    phone VARCHAR(50),
    subtotal DECIMAL(10,2),
    tax DECIMAL(10,2),
    total DECIMAL(10,2),
    items TEXT,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
$conn->query($sql);

// Handle form submission
if (isset($_POST['save_order'])) {
    $customerName = $_POST['customer_name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $subtotal = $_POST['subtotal'];
    $tax = $_POST['tax'];
    $total = $_POST['total'];
    $items = $_POST['items'];
    
    $stmt = $conn->prepare("INSERT INTO orders (customer_name, address, phone, subtotal, tax, total, items) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssddss", $customerName, $address, $phone, $subtotal, $tax, $total, $items);
    
    if ($stmt->execute()) {
        echo "<script>alert('Order saved successfully! Order ID: " . $stmt->insert_id . "');</script>";
    }
    $stmt->close();
}

$conn->close();
?>

<script>

let cart = JSON.parse(localStorage.getItem('cart')) || []; 

function renderCart(){
    let cartDiv = document.getElementById("cartItems");
    cartDiv.innerHTML="";

    if(cart.length === 0){
        cartDiv.innerHTML = "<p>Your cart is empty.</p>";
        document.getElementById("subtotal").innerText = 0;
        document.getElementById("tax").innerText = "0.00";
        document.getElementById("total").innerText = "0.00";
        return;
    }

    let subtotal = 0;

    cart.forEach((item,index)=>{
        let price = parseFloat(item.price) || 0;
        let qty = parseInt(item.qty) || 1;
        subtotal += price * qty;

        cartDiv.innerHTML += `
        <div class="item">
            <div class="item-info">
                <img src="${item.img ? item.img : 'images/mango.jpeg'}">
                <div>
                    <h3>${item.name}</h3>
                    <p>₹${price}</p>
                    <div class="qty">
                        <button onclick="changeQty(${index},-1)">-</button>
                        ${qty}
                        <button onclick="changeQty(${index},1)">+</button>
                    </div>
                </div>
            </div>
            <div>₹${price * qty}</div>
        </div>`;
    });

    let tax = subtotal * 0.02;
    let total = subtotal + tax;

    document.getElementById("subtotal").innerText = subtotal;
    document.getElementById("tax").innerText = tax.toFixed(2);
    let finalTotal = total.toFixed(2);
    document.getElementById("total").innerText = finalTotal;

    // Generate QR code for payment automatically
    let upi = "upi://pay?pa=guna93472@okicici&pn=Food Factory&am="+finalTotal+"&cu=INR";
    let qrURL = "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data="+ encodeURIComponent(upi);
    document.getElementById("qr").innerHTML = "<h3 style='margin-top:20px;'>Scan to Pay ₹"+finalTotal+"</h3><img src='"+qrURL+"' style='border: 10px solid white; border-radius: 10px;'>";
}

function changeQty(index,change){
    cart[index].qty += change;
    if(cart[index].qty <= 0){
        cart.splice(index,1);
    }
    localStorage.setItem('cart', JSON.stringify(cart));
    renderCart();
}

function payNow(){
    let total = document.getElementById("total").innerText;
    let subtotal = document.getElementById("subtotal").innerText;
    let tax = document.getElementById("tax").innerText;
    let customerName = document.getElementById("customerName").value;
    let customerAddress = document.getElementById("customerAddress").value;
    let customerPhone = document.getElementById("customerPhone").value;
    
    if(!customerName || !customerAddress || !customerPhone){
        alert("Please fill in all customer details!");
        return;
    }
    
    // Get cart items as JSON string
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    let itemsJson = JSON.stringify(cart);
    
    // Create form and submit to save order
    let form = document.createElement('form');
    form.method = 'POST';
    form.innerHTML = `
        <input type="hidden" name="save_order" value="1">
        <input type="hidden" name="customer_name" value="${customerName}">
        <input type="hidden" name="address" value="${customerAddress}">
        <input type="hidden" name="phone" value="${customerPhone}">
        <input type="hidden" name="subtotal" value="${subtotal}">
        <input type="hidden" name="tax" value="${tax}">
        <input type="hidden" name="total" value="${total}">
        <input type="hidden" name="items" value="${itemsJson}">
    `;
    document.body.appendChild(form);
    form.submit();
    
    // Generate QR code for payment is now handled in renderCart
    
    // clear cart once payment info is generated
    localStorage.removeItem('cart');
    // We don't call renderCart() here because form.submit() will reload the page
}

renderCart();

</script>

</body>
</html>
