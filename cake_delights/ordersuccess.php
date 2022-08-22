<?php 
require_once 'dbconnection.inc.php';
session_start();
if(empty($_REQUEST['id'])){ 
    header("Location: index2.php"); 
} 
$order_id = base64_decode($_REQUEST['id']); 
 
// Fetch order details from the database 
$sqlQ = "SELECT `order_id`, `customer_id`, `server_id`, `created_on`, `order_total`, `order_status` FROM `tbl_order` WHERE `order_id` = ?";
$stmt = $conn->prepare($sqlQ); 
$stmt->bind_param("i", $db_id); 
$db_id = $order_id; 
$stmt->execute(); 
$result = $stmt->get_result(); 
 
if($result->num_rows > 0){ 
    $orderInfo = $result->fetch_assoc(); 
}else{ 
    header("Location: index2.php"); 
}

if (!isset($_SESSION['Email1']) && !isset($_SESSION['servername'])) {
    header("Location: index.php");
}else{
  $email = $_SESSION['Email1'];
  $query=mysqli_query($conn,"SELECT * FROM `tbl_users` WHERE `email`='$email'")or die(mysqli_error());
  $row=mysqli_fetch_array($query);
}

// Include the configuration file 
require_once 'config.php'; 

?>

<!DOCTYPE html>
<html>
<head>
<title>Cake Delights - Checkout</title>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="css/style.css">
<!--[if IE 8]><link rel="stylesheet" type="text/css" href="css/ie8.css"><![endif]-->
<!--[if IE 7]><link rel="stylesheet" type="text/css" href="css/ie7.css"><![endif]-->
<!--[if IE 6]><link rel="stylesheet" type="text/css" href="css/ie6.css"><![endif]-->
</head>

            <script type="text/javascript">
function printData()
{
   var divToPrint=document.getElementById("printTable");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}

$('button').on('click',function(){
printData();
})  
</script>

        <script>
function updateCartItem(obj,id){
    $.get("cartAction.php", {action:"updateCartItem", id:id, qty:obj.value}, function(data){
        if(data == 'ok'){
            location.reload();
        }else{
            alert('Cart update failed, please try again.');
        }
    });
}
</script>

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
        <h2>Checkout</h2>
        <br>
   <?php if(!empty($orderInfo)){ ?>
            <div class="col-md-12">
                <div class="alert alert-success">Your order has been placed successfully.</div>
            </div>
            
            <!-- Order status & shipping info -->
            <div id="receipt" class="row col-lg-12 ord-addr-info">
                <div class="hdr">Order Info:
                <br>
                <p><b>Customer ID:</b> #<?php echo $orderInfo['customer_id']; ?>
                <br>
                <b>Total:</b> <?php echo CURRENCY_SYMBOL.$orderInfo['order_total'].' '.CURRENCY; ?>
                <br>
                <b>Order Placed On:</b> <?php echo $orderInfo['created_on']; ?>
                <br>
                <b>Server ID:</b> <?php echo $orderInfo['server_id']; ?>
                <br>
                <b>Order ID:</b> <?php echo $orderInfo['order_id']; ?>
                <br>
                <b>Order Status:</b> <?php echo $orderInfo['order_status']; ?></p>
                <br>
                </div>
            </div>
            
               <br>
                                   <br>
                                   <div class="col-md-12 col-sm-12">
                                        <button class="form-control" id="cf-submit" onclick="printData()">Print Receipt</button>
                                   </div>
                                   <br>
                                   <br>
            <div class="col mb-2">
                <div class="row">
                    <div class="col-sm-12  col-md-6">
                        <a href="index2.php" class="btn btn-block btn-primary"><i class="ialeft"></i>Make Another Order </a>
                    </div>
                </div>
            </div>
        <?php }else{ ?>
        <div class="col-md-12">
            <div class="alert alert-danger">Your order submission failed!</div>
        </div>
        <?php } ?>    
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