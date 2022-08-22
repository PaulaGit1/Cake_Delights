<?php
require_once 'dbconnection.inc.php';
session_start();

if (!isset($_SESSION['Email']) && !isset($_SESSION['adminname'])) {
    header("Location: index.php");
}else{
  $email = $_SESSION['Email'];
  $query=mysqli_query($conn,"SELECT * FROM `tbl_users` WHERE `email`='$email'")or die(mysqli_error());
  $row=mysqli_fetch_array($query);
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Cake Delights - Administrator Homepage</title>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="css/style.css">
<!--[if IE 8]><link rel="stylesheet" type="text/css" href="css/ie8.css"><![endif]-->
<!--[if IE 7]><link rel="stylesheet" type="text/css" href="css/ie7.css"><![endif]-->
<!--[if IE 6]><link rel="stylesheet" type="text/css" href="css/ie6.css"><![endif]-->
</head>

       <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>

<body>
<div id="header">
  <div>
    <div>
      <div id="logo"> <a href="index1.php"><img src="images/logo1.png" style="width: 325px;" alt=""></a> </div>
      <div>
      </div>
    </div>
    <ul>
      <li class="current"><a href="index1.php">Home</a></li>
      <li><a href="#data">Database</a></li>
      <li><a href="#chart">Reports</a></li>
      <li><a href="#content">About us</a></li>
      <li><a href="logout.php">Logout</a></li>
      <li><a href="#contact">Contact Us</a></li>
    </ul>
    <div id="section">
     <ul>
       <li style="font-size: 25px; color: white; font-style: italic;">Welcome Administrator, <?php echo $row['surname']; ?></li>
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
        <h2>Add A Server</h2>
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
      <button type="submit" style="width: 200px;" name="adds" class="submit">Add</button>
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
        <h2>Edit A Server</h2>
      <form  action="insertion.inc.php" enctype="multipart/form-data" method="post">
      <input type="text" required="" style="width: 200px;" placeholder="Server ID" name="sid" class="textcontact">
      <input type="text" required="" style="width: 200px;" placeholder="Surname" name="sname" class="textcontact">
      <input type="text" required="" style="width: 200px;" placeholder="First Name" name="fname" class="textcontact">
      <input type="text" required="" style="width: 200px;" placeholder="Other Name" name="oname" class="textcontact">
       <input type="file" required name="image" id = "image" value="" accept=".jpg, .jpeg, .png">
      <input type="password" required="" style="width: 200px;" placeholder="Password" name="password" class="textcontact">
      <input type="password" required="" style="width: 200px;" placeholder="Confirm Password" name="cpassword" class="textcontact">
      <!-- <textarea name="message" id="message" cols="30" rows="10"></textarea> -->
      <br>
      <br>
      <button type="submit" style="width: 200px;" name="eds" class="submit">Add</button>
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
    <div class="section">
      <div>
        <h2>Add A Food</h2>
            <form action="insertion.inc.php" enctype="multipart/form-data" method="post">
      <input type="text" required="" style="width: 200px;" placeholder="Food Name" name="foname" class="textcontact">
      <input type="text" required="" style="width: 200px;" placeholder="Food Category ID" name="fcat" class="textcontact">
      <input type="text" required="" style="width: 200px;" placeholder="Food Buying Price" name="bprice" class="textcontact">
      <input type="text" required="" style="width: 200px;" placeholder="Food Selling Price" name="sprice" class="textcontact">
      <input type="text" required="" style="width: 200px;" placeholder="Food Quantity" name="quan" class="textcontact">
      <input type="hidden" name="aid" value="<?php echo $_SESSION['adminname']; ?>" required="">
       <input type="file" required name="image" id = "image" value="" accept=".jpg, .jpeg, .png">
       <br>
      <button type="submit" style="width: 200px;" name="addf" class="submit">Add</button>
    </form>
      </div>
    </div>
  </div>
<br>
<br>
  <div class="home">
        <div class="section">
      <div>
        <h2>Edit A Food</h2>
     <form action="insertion.inc.php" enctype="multipart/form-data" method="post">
      <input type="text" required="" style="width: 200px;" placeholder="Food ID" name="fid" class="textcontact">
      <input type="text" required="" style="width: 200px;" placeholder="Food Name" name="foname" class="textcontact">
      <input type="text" required="" style="width: 200px;" placeholder="Food Category ID" name="fid" class="textcontact">
      <input type="text" required="" style="width: 200px;" placeholder="Food Buying Price" name="bprice" class="textcontact">
      <input type="text" required="" style="width: 200px;" placeholder="Food Selling Price" name="sprice" class="textcontact">
      <input type="text" required="" style="width: 200px;" placeholder="Food Quantity" name="quan" class="textcontact">
      <input name="aid" type="hidden" id="name" value="<?php echo $_SESSION['adminname']; ?>" required="">
       <input type="file" required name="image" id = "image" value="" accept=".jpg, .jpeg, .png">
      <br>
      <br>
      <button type="submit" style="width: 200px;" name="addf" class="submit">Add</button>
    </form>
      </div>
      <ul>
        <li class="first"> <a href="#"><img src="images/cake.jpg" alt=""></a> </li>
        <li> <a href="#"><img src="images/burgercake.jpg" alt=""></a> </li>
        <li> <a href="#"><img src="images/cupcake.jpg" alt=""></a> </li>
      </ul>
    </div>
    <div class="section">
      <div>
        <h2>Update A Wallet</h2>
            <form action="insertion.inc.php" method="post">
      <input type="text" required="" style="width: 200px;" placeholder="User ID" name="uid" class="textcontact">
      <input type="text" required="" style="width: 200px;" placeholder="Amount (in .kshs)" name="amo" class="textcontact">
      <br>
      <br>
      <button type="submit" style="width: 200px;" name="upw" class="submit">Update</button>
    </form>
    <br>
            <h2>Add A Food Category</h2>
            <form action="insertion.inc.php" method="post">
      <input type="text" required="" style="width: 200px;" placeholder="Category Name" name="cname" class="textcontact">
      <br>
      <br>
      <button type="submit" style="width: 200px;" name="addfc" class="submit">Add</button>
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
    <div class="home">
     <div class="section">
      <div>
        <h2>Delete/Deactivate A Server</h2>
            <form action="insertion.inc.php" method="post">
      <input type="text" required="" style="width: 200px;" placeholder="Server ID" name="sid" class="textcontact">
       <select name="mod" required="" style="width: 200px;" class="textcontact">
        <option value="" disabled="" selected="">Select Action*</option>
        <option value="1">Deactivate</option>
        <option value="2">Delete</option>
      </select>
      <br>
      <br>
      <button type="submit" style="width: 200px;" name="dels" class="submit">Delete</button>
    </form>
      <br>
        <h2>Delete/Deactivate A Food</h2>
            <form action="insertion.inc.php" method="post">
      <input type="text" required="" style="width: 200px;" placeholder="Food ID" name="fid" class="textcontact">
       <select name="mod" required="" style="width: 200px;" class="textcontact">
        <option value="" disabled="" selected="">Select Action*</option>
        <option value="1">Deactivate</option>
        <option value="2">Delete</option>
      </select>
      <br>
      <br>
      <button type="submit" style="width: 200px;" name="delf" class="submit">Delete</button>
    </form>
      </div>
      <ul>
        <li class="first"> <a href="#"><img src="images/cake.jpg" alt=""></a> </li>
        <li> <a href="#"><img src="images/burgercake.jpg" alt=""></a> </li>
        <li> <a href="#"><img src="images/cupcake.jpg" alt=""></a> </li>
      </ul>
    </div>
    <div class="section">
           <div>
        <h2>Delete/Deactivate A Food Category</h2>
            <form action="insertion.inc.php" method="post">
      <input type="text" required="" style="width: 200px;" placeholder="Food Category ID" name="cid" class="textcontact">
       <select name="mod" required="" style="width: 200px;" class="textcontact">
        <option value="" disabled="" selected="">Select Action*</option>
        <option value="1">Deactivate</option>
        <option value="2">Delete</option>
      </select>
      <br>
      <br>
      <button type="submit" style="width: 200px;" name="delfc" class="submit">Delete</button>
    </form>
      </div>
      <ul>
        <li class="first"> <a href="#"><img src="images/cake.jpg" alt=""></a> </li>
        <li> <a href="#"><img src="images/burgercake.jpg" alt=""></a> </li>
        <li> <a href="#"><img src="images/cupcake.jpg" alt=""></a> </li>
      </ul>
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
</tr>

<?php
$conn = mysqli_connect("localhost", "root", "", "cake_delights");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT `food_name`, `food_image`, `created_on`, `updated_on`, `food_category`, `food_buyingprice`, `food_sellingprice`, `admin_id`, `quantity`, `isdeleted` FROM `tbl_food`";
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

$sql = "SELECT `user_id`, `surname`, `first_name`, `othername`, `gender`, `dob`, `email`, `profile_pic`, `role_id` FROM `tbl_users`";
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

$sql = "SELECT `category_id`, `category_name` FROM `tbl_foodcategories`";
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
      <h2>Our Roles</h2>
      <br>
<table id="printTable">
<tr style="text-align: left;
  padding: 8px;">
<th style="text-align: left;
  padding: 8px;">Role ID </th>
<th style="text-align: left;
  padding: 8px;">Role Name </th>
</tr>

<?php
$conn = mysqli_connect("localhost", "root", "", "cake_delights");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT `role_id`, `role_name` FROM `tbl_roles`";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
echo "<tr><td>" . $row["role_id"] . "</td><td>" . $row["role_name"] . "</td></tr>";
}
echo "</table>";
} else { echo "Kindly check again, when the Roles are populated."; }
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
      <p>Copyright &copy; 2022 <a href="index1.php">Cake Delights</a></p>
    </div>
  </div>
</div>

    <script type="text/javascript">
      $(document).ready(function(){

        makechart();

      function makechart()
  {
    $.ajax({
      url:"data.php",
      method:"POST",
      data:{action:'fetch'},
      dataType:"JSON",
      success:function(data)
      {
        var language = [];
        var total = [];
        var color = [];

        for(var count = 0; count < data.length; count++)
        {
          language.push(data[count].language);
          total.push(data[count].total);
          color.push(data[count].color);
        }

        var chart_data = {
          labels:language,
          datasets:[
            {
              label:'Vote',
              backgroundColor:color,
              color:'#fff',
              data:total
            }
          ]
        };

        var options = {
          responsive:true,
          scales:{
            yAxes:[{
              ticks:{
                min:0
              }
            }]
          }
        };

     var group_chart1 = $('#pie_chart');

        var graph1 = new Chart(group_chart1, {
          type:"pie",
          data:chart_data
        });
      }
    })
  }

        makechart1();

      function makechart1()
  {
    $.ajax({
      url:"data.php",
      method:"POST",
      data:{action:'fetch1'},
      dataType:"JSON",
      success:function(data)
      {
        var language = [];
        var total = [];
        var color = [];

        for(var count = 0; count < data.length; count++)
        {
          language.push(data[count].language);
          total.push(data[count].total);
          color.push(data[count].color);
        }

        var chart_data = {
          labels:language,
          datasets:[
            {
              label:'Purchases',
              backgroundColor:color,
              color:'#fff',
              data:total
            }
          ]
        };

        var options = {
          responsive:true,
          scales:{
            yAxes:[{
              ticks:{
                min:0
              }
            }]
          }
        };

       var group_chart3 = $('#pie_chart1');

        var graph3 = new Chart(group_chart3, {
          type:'pie',
          data:chart_data,
          options:options
        });
      }
    })
  }

});

    </script>

</body>
</html>