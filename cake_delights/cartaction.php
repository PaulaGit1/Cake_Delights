<?php 
// Include the database connection file 
require_once 'dbconnection.inc.php'; 
 
// Initialize shopping cart class 
require_once 'cart.class.php'; 
$cart = new Cart; 
 
// Default redirect page 
$redirectURL = 'index.php'; 
 
// Process request based on the specified action 
if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])){ 
    if($_REQUEST['action'] == 'addToCart' && !empty($_REQUEST['id'])){ 
        $food_id = $_REQUEST['id']; 
 
        // Fetch product details from the database 
        $sqlQ = "SELECT * FROM tbl_food WHERE food_id=?"; 
        $stmt = $conn->prepare($sqlQ); 
        $stmt->bind_param("i", $db_id); 
        $db_id = $food_id; 
        $stmt->execute(); 
        $result = $stmt->get_result(); 
        $productRow = $result->fetch_assoc(); 
 
        $itemData = array( 
            'id' => $productRow['food_id'], 
            'image' => $productRow['food_image'], 
            'name' => $productRow['food_name'], 
            'category' => $productRow['food_category'], 
            'price' => $productRow['food_sellingprice'], 
            'qty' => 1 
        ); 
         
        // Insert item to cart 
        $insertItem = $cart->insert($itemData); 
         
        // Redirect to cart page 
        $redirectURL = $insertItem?'viewcart.php':'index2.php'; 
    }elseif($_REQUEST['action'] == 'updateCartItem' && !empty($_REQUEST['id'])){ 
        // Update item data in cart 
        $itemData = array( 
            'rowid' => $_REQUEST['id'], 
            'qty' => $_REQUEST['qty'] 
        ); 
        $updateItem = $cart->update($itemData); 
         
        // Return status 
        echo $updateItem?'ok':'err';die; 
    }elseif($_REQUEST['action'] == 'removeCartItem' && !empty($_REQUEST['id'])){ 
        // Remove item from cart 
        $deleteItem = $cart->remove($_REQUEST['id']); 
         
        // Redirect to cart page 
        $redirectURL = 'viewcart.php'; 
    }elseif($_REQUEST['action'] == 'placeOrder' && $cart->total_items() > 0){ 
        $redirectURL = 'checkout.php'; 
         
        // Store post data 
        $_SESSION['postData'] = $_POST; 
     
        $cid = strip_tags($_POST['cid']); 
        $sid = strip_tags($_POST['sid']); 
        $stat = strip_tags($_POST['stat']);
        $waID = strip_tags($_POST['wai']); 

        $errorMsg = ''; 
        if(empty($cid)){ 
            $errorMsg .= 'Please enter Customer ID.<br/>'; 
        } 
        // if(empty($email1) || !filter_var($email1, FILTER_VALIDATE_EMAIL)){ 
        //     $errorMsg .= 'Please enter a valid email.<br/>'; 
        // } 
        if(empty($sid)){ 
            $errorMsg .= 'Please enter Server ID.<br/>'; 
        } if(empty($stat)){ 
            $errorMsg .= 'Please enter Order Status.<br/>'; 
        } if(empty($waID)){ 
            $errorMsg .= 'Please enter Wallet ID.<br/>'; 
        } 
         
        if(empty($errorMsg)){ 
            // Insert customer data into the database 
            $sqlQ = "INSERT INTO tbl_order(customer_id, server_id, created_on, updated_on, order_total, order_status) VALUES (?,?,NOW(),NOW(),?,?)"; 
            $stmt = $conn->prepare($sqlQ); 
            $stmt->bind_param("iids", $db_cid, $db_sid, $db_total, $db_status); 
            $db_cid = $cid; 
            $db_status = $stat; 
            $db_sid = $sid; 
            $db_total = $cart->total(); 
            $insertOrd = $stmt->execute(); 
             
            if($insertOrd){ 
                $ordID = $stmt->insert_id; 

                // Insert payment info in the database 
                $sqlQ = "INSERT INTO tbl_payment(wallet_id, server_id, order_id, amount, created_on, update_on) VALUES (?,?,?,?,NOW(),NOW())"; 
                $stmt = $conn->prepare($sqlQ); 
                $stmt->bind_param("iiid", $db_wid, $db_sid, $db_order_id, $db_grand_total); 
                $db_order_id = $ordID; 
                $db_grand_total = $cart->total(); 
                $db_wid = $waID; 
                $db_sid = $sid; 
                $insertPay = $stmt->execute(); 
             
                if($insertPay){ 
                    $payID = $stmt->insert_id; 
                     
                    // Retrieve cart items 
                    $cartItems = $cart->contents(); 
                     
                    // Insert order details in the database 
                    if(!empty($cartItems)){ 
                        $sqlQ = "INSERT INTO tbl_orderdetails(food_name, food_id, quantity, price, order_id, created_on) VALUES (?,?,?,?,?,NOW())"; 
                        $stmt = $conn->prepare($sqlQ); 
                        foreach($cartItems as $item){ 
                            $stmt->bind_param("sssdi", $db_fname, $db_fid, $db_quantity, $db_fprice, $db_order_id); 
                            $db_order_id = $ordID; 
                            $db_fid = $item['id']; 
                            $db_quantity = $item['qty']; 
                            $db_fname = $item['name']; 
                            $db_fprice = $item['price']; 
                            $insertitemsss = $stmt->execute(); 
                        } 

                        // Deduct food quantities from the database 
                    if($insertitemsss){ 
                        $sqlQ = "UPDATE tbl_food SET quantity = quantity - $db_quantity WHERE food_id = ?"; 
                        $stmt = $conn->prepare($sqlQ); 
                        foreach($cartItems as $item){ 
                            $stmt->bind_param("i", $db_fid); 
                            $db_fid = $item['id']; 
                            $db_quantity = $item['qty']; 
                            $upquan = $stmt->execute(); 
                        } 

                          if($upquan){ 

                  //Deduct amount from customer wallet
                $sqlQ = "UPDATE tbl_wallet SET amount = amount - $db_total WHERE user_id=?"; 
                $stmt = $conn->prepare($sqlQ); 
                $stmt->bind_param("i", $db_customer_id); 
                $db_customer_id = $cid; 
                $db_total = $cart->total();
                $deductwallet = $stmt->execute();
                         
                        // Remove all items from cart 
                        $cart->destroy(); 
                         
                        // Redirect to the status page 
                        $redirectURL = 'ordersuccess.php?id='.base64_encode($orderID); 
                    }else{ 
                        $sessData['status']['type'] = 'error'; 
                        $sessData['status']['msg'] = 'Something went wrong, please try again.'; 
                    } 
                }else{ 
                    $sessData['status']['type'] = 'error'; 
                    $sessData['status']['msg'] = 'Something went wrong, please try again. 1'; 
                } 
            }else{ 
                $sessData['status']['type'] = 'error'; 
                $sessData['status']['msg'] = 'Something went wrong, please try again. 2';
            } 
        }else{ 
                $sessData['status']['type'] = 'error'; 
                $sessData['status']['msg'] = 'Something went wrong, please try again. 3';
            } 
        }else{ 
                $sessData['status']['type'] = 'error'; 
                $sessData['status']['msg'] = 'Something went wrong, please try again. 4';
            }
        }else{ 
            $sessData['status']['type'] = 'error'; 
            $sessData['status']['msg'] = '<p>Please fill all the mandatory fields.</p>'.$errorMsg;  
        } 
         
        // Store status in session 
        $_SESSION['sessData'] = $sessData; 
    } 
} 

// Redirect to the specific page 
header("Location: $redirectURL"); 
exit();
?>
