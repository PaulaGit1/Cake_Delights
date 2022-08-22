<?php 
require_once 'dbconnection.inc.php';
session_start();

// Include the configuration file 
require_once 'config.php'; 

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
// If the cart is empty, redirect to the products page 
if($cart->total_items() <= 0){ 
    header("Location: index2.php"); 
} 
 
// Get posted form data from session 
$postData = !empty($_SESSION['postData'])?$_SESSION['postData']:array(); 
unset($_SESSION['postData']); 
 
// Get status message from session 
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:''; 
if(!empty($sessData['status']['msg'])){ 
    $statusMsg = $sessData['status']['msg']; 
    $statusMsgType = $sessData['status']['type']; 
    unset($_SESSION['sessData']['status']); 
} 
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
        <h2>Checkout</h2>
        <br>
  <?php if(!empty($statusMsg) && ($statusMsgType == 'success')){ ?>
                <div class="col-md-12">
                    <div class="alert alert-success"><?php echo $statusMsg; ?></div>
                </div>
                <?php }elseif(!empty($statusMsg) && ($statusMsgType == 'error')){ ?>
                <div class="col-md-12">
                    <div class="alert alert-danger"><?php echo $statusMsg; ?></div>
                </div>
                <?php } ?>
                
                <div class="col-md-4 order-md-2 mb-4">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Your Orders</span>
                        <span class="badge badge-secondary badge-pill"><?php echo $cart->total_items(); ?></span>
                    </h4>
                    <ul class="list-group mb-3">
                    <?php 
                    if($cart->total_items() > 0){ 
                        // Get cart items from session 
                        $cartItems = $cart->contents(); 
                        foreach($cartItems as $item){ 
                    ?>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0"><?php echo $item["name"]; ?></h6>
                                <small class="text-muted"><?php echo CURRENCY_SYMBOL.$item["price"]; ?>(<?php echo $item["qty"]; ?>)</small>
                            </div>
                            <span class="text-muted"><?php echo CURRENCY_SYMBOL.$item["subtotal"]; ?></span>
                        </li>
                    <?php } } ?>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total (<?php echo CURRENCY; ?>)</span>
                            <strong><?php echo CURRENCY_SYMBOL.$cart->total(); ?></strong>
                        </li>
                    </ul>
                    <a href="index2.php" class="btn btn-sm btn-info">+ add items</a>
                </div>
                <div class="col-md-8 order-md-1">
                    <h4 class="mb-3">Checkout Details</h4>
                    <div class="contact-form">
                    <form method="post" action="cartaction.php">
                            <div class="mb-3">
                              <fieldset>
                                <label for="first_name">Customer ID</label>
                                <input style="width: 200px;" type="text" class="form-control" name="cid" placeholder="Customer ID" required>
                                <input type="hidden" class="form-control" name="sid" value="<?php echo $_SESSION['servername']; ?>" required>
                              </fieldset>
                            </div>
                            <div class="mb-3">
                              <fieldset>
                                <label for="first_name">Wallet ID</label>
                                <input type="text" style="width: 200px;" class="form-control" name="wai" placeholder="Wallet ID" required>
                              </fieldset>
                            </div>
                        <div class="mb-3">
                            <fieldset>
                            <label for="phone">Status</label>
                            <select required="" name="stat">
                                    <option value="" selected="" disabled="">Select Status</option>
                                    <option value="Paid">Paid </option>
                                    <option value="Unpaid">Unpaid </option>
                                </select>
                            </fieldset>
                        </div>
                        <input type="hidden" name="action" value="placeOrder"/>
                        <input class="btn btn-success btn-block" type="submit" name="checkoutSubmit" value="Place Order">
                    </form>
                  </div>
                </div>
              </div>
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