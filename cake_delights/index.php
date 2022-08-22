<!DOCTYPE html>
<html>
<head>
<title>Cake Delights - Homepage</title>
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
      <div id="logo"> <a href="index.php"><img src="images/logo1.png" style="width: 325px;" alt=""></a> </div>
      <div>
        <div> <a href="#login">Get Started</a></div>
      </div>
    </div>
    <ul>
      <li class="current"><a href="index.php">Home</a></li>
      <li><a href="#menu">Our Pastry Menu</a></li>
      <li><a href="#content">About us</a></li>
      <li><a href="#login">Login</a></li>
      <li><a href="#contact">Contact Us</a></li>
    </ul>
    <div id="section">
     <ul>
       <li style="font-size: 25px; color: white; font-style: italic;">Quality Cakes & Good Vibes</li>
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
        <h2>Get Started</h2>
            <form id="login" action="authentication.php" method="post">
<!--       <input type="text" required="" style="width: 200px;" value="Name" name="" class="textcontact"> -->
      <input type="text" required="" style="width: 200px;" placeholder="E-mail Address" name="email" class="textcontact">
      <input type="password" required="" style="width: 200px;" placeholder="Password" name="password" class="textcontact">
      <select name="mod" required="" style="width: 200px;" class="textcontact">
        <option value="" disabled="" selected="">Select User Type*</option>
        <option value="Administrator">Administrator</option>
        <option value="Server">Server</option>
        <option value="Purchaser/Client">Purchaser/Client</option>
      </select>
      <!-- <textarea name="message" id="message" cols="30" rows="10"></textarea> -->
      <br>
      <br>
      <button type="submit" style="width: 200px;" name="login" class="submit">Login</button>
    </form>
      </div>
      <ul>
        <li class="first"> <a href="#"><img src="images/cake.jpg" alt=""></a> </li>
        <li> <a href="#"><img src="images/burgercake.jpg" alt=""></a> </li>
        <li> <a href="#"><img src="images/cupcake.jpg" alt=""></a> </li>
      </ul>
    </div>
  </div>
<br>
<br>
  <div id="menu" class="home">
    <div class="aside">
      <h1>Our Menu</h1>
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
</tr>

<?php
$conn = mysqli_connect("localhost", "root", "", "cake_delights");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT `food_name`, `food_image`, `created_on`, `updated_on`, `food_category`, `food_buyingprice`, `food_sellingprice`, `admin_id`, `quantity`, `isdeleted` FROM `tbl_food` WHERE `isdeleted` = 0";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
echo "<tr><td>" . $row["food_name"] . "</td><td>" . $row["food_category"] . "</td><td>" . $row["food_sellingprice"] . "</td><td>" . $row["quantity"] . "</td><td><img src= 'images/" . $row["food_image"] . "' style = 'width : 150px;' title='" . $row["food_image"] . "'></td></tr>";
}
echo "</table>";
} else { echo "We are working on our Menu, kindly check again later."; }
$conn->close();
?>

</table>
    </div>
  </div>
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
      <p>Copyright &copy; 2022 <a href="index.php">Cake Delights</a></p>
    </div>
  </div>
</div>
</body>
</html>