<?php
require_once 'dbconnection.inc.php';
session_start();

// Initialize shopping cart class 
include_once 'cart.class.php'; 
$cart = new Cart; 

if (!isset($_SESSION['Email1']) && !isset($_SESSION['servername'])) {
    header("Location: index.php");
}else{
  $email = $_SESSION['Email1'];
  $query=mysqli_query($conn,"SELECT * FROM `tbl_users` WHERE `email`='$email'")or die(mysqli_error());
  $row=mysqli_fetch_array($query);
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Cake Delights - Server Homepage</title>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="css/style.css">
<!--[if IE 8]><link rel="stylesheet" type="text/css" href="css/ie8.css"><![endif]-->
<!--[if IE 7]><link rel="stylesheet" type="text/css" href="css/ie7.css"><![endif]-->
<!--[if IE 6]><link rel="stylesheet" type="text/css" href="css/ie6.css"><![endif]-->
</head>

<body>
<div id="header">
  <div>
    <div>
      <div id="logo"> <a href="index2.php"><img src="images/logo1.png" style="width: 325px;" alt=""></a> </div>
      <div>
      </div>
    </div>
    <ul>
      <li class="current"><a href="index2.php">Home</a></li>
      <li><a href="#data">Database</a></li>
      <li><a href="viewcart.php">View Food Orders (<?php echo ($cart->total_items() > 0)?$cart->total_items().'':0; ?>)</a></li>
      <li><a href="#content">About us</a></li>
      <li><a href="logout.php">Logout</a></li>
      <li><a href="#contact">Contact Us</a></li>
    </ul>
    <div id="section">
     <ul>
       <li style="font-size: 25px; color: white; font-style: italic;">Welcome Server, <?php echo $row['surname']; ?></li>
       <br>
       <br>
       <br>
       <br>
       <li style="font-weight: bold; font-size: 18px;">The Recipe for Success!</li>
       <br>
       <br>
     </ul>
      <a href="#"><img src="images/h2.jpg" alt="" style=""></a> </div>
  </div>
</div>
<div id="content">
  <div class="home">
    <div class="aside">
      <h1>Welcome to our site</h1>
      <p>Pastry is the name given to various kinds of baked goods made from ingredients such as flour, butter, shortening, baking powder or eggs. Small cakes, tarts and other sweet baked goods are called &#34;pastries&#34;.</p>
      <p>Pastry may also refer to the dough from which such baked goods are made. Pastry dough is rolled out thinly and used as a base for baked goods. Common pastry dishes include pies, tarts and quiches.
      <p>Pastry is distinguished from bread by having a higher fat content, which contributes to a flaky or crumbly texture. A good pastry is light and airy and fatty, but firm enough to support the weight of the filling. When making a shortcrust pastry, care must be taken to blend the fat and flour thoroughly before adding.</p>
    </div>
    <div class="section">
      <div>
        <h2>Add A Client</h2>
      <form action="insertion.inc.php" class="col-md" enctype="multipart/form-data" method="post">
      <input type="text" required="" style="width: 200px;" placeholder="Surname" name="sname" class="textcontact">
      <input type="text" required="" style="width: 200px;" placeholder="First Name" name="fname" class="textcontact">
      <input type="text" required="" style="width: 200px;" placeholder="Other Name" name="oname" class="textcontact">
       <input type="file" required name="image" id = "image" value="" accept=".jpg, .jpeg, .png">
      <input type="text" required="" style="width: 200px;" placeholder="E-mail Address" name="email" class="textcontact">
      <input type="date" required="" style="width: 200px;" placeholder="" name="dob" class="textcontact">
      <input type="password" required="" style="width: 200px;" placeholder="Password" name="password" class="textcontact">
      <select name="gen" required="" style="width: 200px;" class="textcontact">
        <option value="" disabled="" selected="">Select Gender*</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
      </select>
      <!-- <textarea name="message" id="message" cols="30" rows="10"></textarea> -->
      <br>
      <br>
      <button type="submit" style="width: 200px;" name="addb" class="submit">Add</button>
    </form>
      </div>
      <ul>
        <li class="first"> <a href="#"><img src="images/cake.jpg" alt=""></a> </li>
        <li> <a href="#"><img src="images/burgercake.jpg" alt=""></a> </li>
        <li> <a href="#"><img src="images/cupcake.jpg" alt=""></a> </li>
      </ul>
    </div>

<br>
<br>
<br>
  </div>
  <div class="home">
        <div class="section">
      <div>
        <h2>Edit A Buyer</h2>
      <form  action="insertion.inc.php" enctype="multipart/form-data" method="post">
      <input type="text" required="" style="width: 200px;" placeholder="User ID" name="uid" class="textcontact">
      <input type="text" required="" style="width: 200px;" placeholder="Surname" name="sname" class="textcontact">
      <input type="text" required="" style="width: 200px;" placeholder="First Name" name="fname" class="textcontact">
      <input type="text" required="" style="width: 200px;" placeholder="Other Name" name="oname" class="textcontact">
       <input type="file" required name="image" id = "image" value="" accept=".jpg, .jpeg, .png">
      <input type="password" required="" style="width: 200px;" placeholder="Password" name="password" class="textcontact">
      <!-- <textarea name="message" id="message" cols="30" rows="10"></textarea> -->
      <br>
      <br>
      <button type="submit" style="width: 200px;" name="edb" class="submit">Add</button>
    </form>
      </div>
      <ul>
        <li class="first"> <a href="#"><img src="images/cake.jpg" alt=""></a> </li>
        <li> <a href="#"><img src="images/burgercake.jpg" alt=""></a> </li>
        <li> <a href="#"><img src="images/cupcake.jpg" alt=""></a> </li>
      </ul>
      <br>
      <br>
    </div>
  </div>
   
  <div id="menu" class="home">
    <div class="aside">
      <h1>Database</h1>
      <br>
      <h2>Our Menu</h2>
      <br>
                  <table id="printTable">
<tr style="text-align: left;
  padding: 8px;">
<th style="text-align: left;
  padding: 8px;">Name </th>
<th style="text-align: left;
  padding: 8px;">Category </th>
  <th style="text-align: left;
  padding: 8px;">Price (in .kshs) </th>
  <th style="text-align: left;
  padding: 8px;">Servings </th>
  <th style="text-align: left;
  padding: 8px;">Image </th>
  <th style="text-align: left;
  padding: 8px;"></th>
</tr>

<?php
$conn = mysqli_connect("localhost", "root", "", "cake_delights");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT `food_id`, `food_name`,`food_image`, `created_on`, `updated_on`, `food_category`, `food_buyingprice`, `food_sellingprice`, `admin_id`, `quantity` FROM `tbl_food` WHERE `isdeleted` = '0'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
echo "<tr><td>" . $row["food_name"] . "</td><td>" . $row["food_category"] . "</td><td>" . $row["food_sellingprice"] . "</td><td>" . $row["quantity"] . "</td><td><img src= 'images/" . $row["food_image"] . "' style = 'width : 150px;' title='" . $row["food_image"] . "'></td><td><a href='cartaction.php?action=addToCart&id=" . $row['food_id'] . "' class='btn btn-primary'>Add to Orders</a></td></tr>";
}
echo "</table>";
} else { echo "Kindly check again, when the Foods are populated."; }
$conn->close();
?>

</table>
      <br>
      <h2>Our Users</h2>
      <br>
   <table id="printTable">
<tr style="text-align: left;
  padding: 8px;">
<th style="text-align: left;
  padding: 8px;">User ID </th>
<th style="text-align: left;
  padding: 8px;">Surname </th>
  <th style="text-align: left;
  padding: 8px;">First Name </th>
  <th style="text-align: left;
  padding: 8px;">Other Name </th>
  <th style="text-align: left;
  padding: 8px;">Gender </th>
  <th style="text-align: left;
  padding: 8px;">Date of Birth </th>
<th style="text-align: left;
  padding: 8px;">Email Address </th>
  <th style="text-align: left;
  padding: 8px;">Profile Pic </th>
  <th style="text-align: left;
  padding: 8px;">Role ID </th>
</tr>

<?php
$conn = mysqli_connect("localhost", "root", "", "cake_delights");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT `user_id`, `surname`, `first_name`, `othername`, `gender`, `dob`, `email`, `profile_pic`, `role_id` FROM `tbl_users` WHERE `isdeleted` = '0' AND `user_id` != '1'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
echo "<tr><td>" . $row["user_id"] . "</td><td>" . $row["surname"] . "</td><td>" . $row["first_name"] . "</td><td>" . $row["othername"] . "</td><td>" . $row["gender"] . "</td><td>" . $row["dob"] . "</td><td>" . $row["email"] . "</td><td><img src= 'images/" . $row["profile_pic"] . "' style = 'width : 150px;' title='" . $row["profile_pic"] . "'></td><td>" . $row["role_id"] . "</td></tr>";
}
echo "</table>";
} else { echo "Kindly check again, when the Users are populated."; }
$conn->close();
?>

</table>
      <br>
      <h2>Our Food Categories</h2>
      <br>
              <table id="printTable">
<tr style="text-align: left;
  padding: 8px;">
<th style="text-align: left;
  padding: 8px;">Category ID </th>
<th style="text-align: left;
  padding: 8px;">Category Name </th>
</tr>

<?php
$conn = mysqli_connect("localhost", "root", "", "cake_delights");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT `category_id`, `category_name` FROM `tbl_foodcategories` WHERE `isdeleted` = '0'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
echo "<tr><td>" . $row["category_id"] . "</td><td>" . $row["category_name"] . "</td></tr>";
}
echo "</table>";
} else { echo "Kindly check again, when the Food Categories are populated."; }
$conn->close();
?>

</table>

      <br>
      <h2>User Wallets</h2>
      <br>
 <table id="printTable">
<tr style="text-align: left;
  padding: 8px;">
<th style="text-align: left;
  padding: 8px;">Wallet ID </th>
<th style="text-align: left;
  padding: 8px;">User ID </th>
  <th style="text-align: left;
  padding: 8px;">Amount </th>
  <th style="text-align: left;
  padding: 8px;">Created On </th>
</tr>

<?php
$conn = mysqli_connect("localhost", "root", "", "cake_delights");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT `wallet_id`, `user_id`, `amount`, `created_on` FROM `tbl_wallet` WHERE `isdeleted` = '0'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
echo "<tr><td>" . $row["wallet_id"] . "</td><td>" . $row["user_id"] . "</td><td>" . $row["amount"] . "</td><td>" . $row["created_on"] . "</td></tr>";
}
echo "</table>";
} else { echo "Kindly check again, when the User Wallets are populated."; }
$conn->close();
?>

</table>
      <br>
      <h2>Our Orders</h2>
      <br>
<table id="printTable">
<tr style="text-align: left;
  padding: 8px;">
<th style="text-align: left;
  padding: 8px;">Order ID </th>
<th style="text-align: left;
  padding: 8px;">Customer ID </th>
  <th style="text-align: left;
  padding: 8px;">Server ID </th>
  <th style="text-align: left;
  padding: 8px;">Created On </th>
  <th style="text-align: left;
  padding: 8px;">Updated On </th>
  <th style="text-align: left;
  padding: 8px;">Order Total </th>
  <th style="text-align: left;
  padding: 8px;">Order Status </th>
</tr>

<?php
$conn = mysqli_connect("localhost", "root", "", "cake_delights");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT `order_id`, `customer_id`, `server_id`, `created_on`, `updated_on`, `order_total`, `order_status` FROM `tbl_order` WHERE `isdeleted` = '0'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
echo "<tr><td>" . $row["order_id"] . "</td><td>" . $row["customer_id"] . "</td><td>" . $row["server_id"] . "</td><td>" . $row["created_on"] . "</td><td>" . $row["updated_on"] . "</td><td>" . $row["order_total"] . "</td><td>" . $row["order_status"] . "</td></tr>";
}
echo "</table>";
} else { echo "Kindly check again, when the Orders are populated."; }
$conn->close();
?>

</table>
br>
      <h2>Order Details</h2>
      <br>
  <table id="printTable">
<tr style="text-align: left;
  padding: 8px;">
<th style="text-align: left;
  padding: 8px;">Details ID </th>
<th style="text-align: left;
  padding: 8px;">Food Name </th>
  <th style="text-align: left;
  padding: 8px;">Food ID </th>
<th style="text-align: left;
  padding: 8px;">Quantity </th>
  <th style="text-align: left;
  padding: 8px;">Price (in .kshs) </th>
  <th style="text-align: left;
  padding: 8px;">Order ID </th>
<th style="text-align: left;
  padding: 8px;">Created On </th>
</tr>

<?php
$conn = mysqli_connect("localhost", "root", "", "cake_delights");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT `orderdetails_id`, `food_name`, `food_id`, `quantity`, `price`, `order_id`, `created_on` FROM `tbl_orderdetails` WHERE `isdeleted` = '0'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
echo "<tr><td>" . $row["orderdetails_id"] . "</td><td>" . $row["food_name"] . "</td><td>" . $row["food_id"] . "</td><td>" . $row["quantity"] . "</td><td>" . $row["price"] . "</td><td>" . $row["order_id"] . "</td><td>" . $row["created_on"] . "</td></tr>";
}
echo "</table>";
} else { echo "Kindly check again, when the Order Details are populated."; }
$conn->close();
?>

</table>
<br>
      <h2>Payments</h2>
      <br>
 <table id="printTable">
<tr style="text-align: left;
  padding: 8px;">
<th style="text-align: left;
  padding: 8px;">Payment ID </th>
<th style="text-align: left;
  padding: 8px;">Wallet ID </th>
  <th style="text-align: left;
  padding: 8px;">Server ID </th>
<th style="text-align: left;
  padding: 8px;">Order ID </th>
  <th style="text-align: left;
  padding: 8px;">Total Price (in .kshs) </th>
  <th style="text-align: left;
  padding: 8px;">Date </th>
</tr>

<?php
$conn = mysqli_connect("localhost", "root", "", "cake_delights");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT `payment_id`, `wallet_id`, `server_id`, `order_id`, `amount`, `created_on` FROM `tbl_payment` WHERE `isdeleted` = '0';";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
echo "<tr><td>" . $row["payment_id"] . "</td><td>" . $row["wallet_id"] . "</td><td>" . $row["server_id"] . "</td><td>" . $row["order_id"] . "</td><td>" . $row["amount"] . "</td><td>" . $row["created_on"] . "</td></tr>";
}
echo "</table>";
} else { echo "Kindly check again, when the Payments are populated."; }
$conn->close();
?>

</table>
    </div>
  </div>
</p>
</div>
<div id="footer">
  <div class="home">
    <div>
      <div class="aside">
        <div class="signup">
          <div> <b>Too <span>BUSY</span> to shop?</b> do reach out to us,
            <p>and we'll deliver it on your doorstep</p>
          </div>
        </div>
        <div id="contact" class="connect"> <span>Contact Us</span>
          <ul>
            <li>Email: <a href="mailto:cake.delights@gmail.com" class="">cake.delights@gmail.com</a></li>
            <li>Phone: <a href="#" class="">+254 73678 93898</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div id="navigation">
    <div>
      <p>Copyright &copy; 2022 <a href="index2.php">Cake Delights</a></p>
    </div>
  </div>
</div>

</body>
</html>