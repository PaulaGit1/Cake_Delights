<?php 

date_default_timezone_set('Africa/Nairobi');

//ADMINISTRATOR SECTION
//Add Servers
if (isset($_POST['adds'])) {
 $sname = $_POST['sname'];
 $oname = $_POST['oname'];
 $fname = $_POST['fname'];
 $gen = $_POST['gen'];
 $email = $_POST['email'];
 // $image = $_POST['image'];
 $dob = $_POST['dob'];
 $password = $_POST['password'];
 $role = "Server";

 require_once 'dbconnection.inc.php';

$da =  date("Y/m/d");
$datestamp = strtotime($dob);
$datestamp1 = strtotime($da);

// if ($datestamp1 > $datestamp) {
//   echo "Ensure Date of Birth is Not After Today's Date.";
// }

    $sqlrole = "INSERT INTO `tbl_roles`(`role_name`) VALUES (?)"; 
                $stmt = $conn->prepare($sqlrole); 
                $stmt->bind_param("s", $db_role); 
                $db_role = $role; 
                $insertrole = $stmt->execute(); 
             
                if($insertrole){ 
                    $newid = $stmt->insert_id; 


     if ($_FILES["image"]["error"] === 4) {
   echo "<script> alert('Image does not exist!'); </script>";
}else{
  $uploads_dir = 'images';
  $fileName = $_FILES["image"]["name"];
  $fileSize = $_FILES["image"]["size"];
  $tmpName = $_FILES["image"]["tmp_name"];

  $validImageExtension = ['jpg', 'jpeg', 'png'];
  $imageExtension = explode('.', $fileName);
  $imageExtension = strtolower(end($imageExtension));

  if (!in_array($imageExtension, $validImageExtension)) {
    echo "<script> alert('Invalid Image Format!'); </script>";
  }else if($fileSize > 10000000){
    echo "<script> alert('Image is too large!'); </script>";
  }else{

    $newImgName = uniqid();
    $newImgName .= '.' . $imageExtension;

    move_uploaded_file($tmpName, "$uploads_dir/$newImgName");

   $sql1 = "INSERT INTO `tbl_users`(`surname`, `first_name`, `othername`, `gender`, `dob`, `email`, `password`, `profile_pic`, `role_id`, `isdeleted`) VALUES ('$sname','$fname','$oname','$gen','$dob','$email',md5('$password'),'$newImgName','$newid','0')";

   //$sql2 = "INSERT INTO `tbl_ratings`(`server_id`, `created_on`, `rating`) VALUES ('$newid',NOW())";

     mysqli_query($conn, $sql1);
     //mysqli_query($conn, $sql2);
   // var_dump($sql);
   // die();
  header("Location: index1.php?serverregistration=success");
 }
}
}else{
  echo "Role has not yet been created.";
}
}

//Edit Servers
if (isset($_POST['eds'])) {
 $uid = $_POST['uid'];
 $sname = $_POST['sname'];
 $oname = $_POST['oname'];
 $fname = $_POST['fname'];
 $gen = $_POST['gen'];
 $email = $_POST['email'];
 // $image = $_POST['image'];
 $dob = $_POST['dob'];
 $password = $_POST['password'];

 $da =  date("Y/m/d");
// $datestamp = strtotime($dob);
// $datestamp1 = strtotime($da);

// if ($datestamp > $datestamp1) {
//   echo "Ensure Date of Birth is After Today's Date.";
// }

 require_once 'dbconnection.inc.php';

  $sql =  "SELECT * FROM `tbl_users` WHERE `user_id`='$uid'";

        $query = mysqli_query($conn,$sql);

        if(mysqli_num_rows($query) > 0){

     if ($_FILES["image"]["error"] === 4) {
   echo "<script> alert('Image does not exist!'); </script>";
}else{
  $uploads_dir = 'images';
  $fileName = $_FILES["image"]["name"];
  $fileSize = $_FILES["image"]["size"];
  $tmpName = $_FILES["image"]["tmp_name"];

  $validImageExtension = ['jpg', 'jpeg', 'png'];
  $imageExtension = explode('.', $fileName);
  $imageExtension = strtolower(end($imageExtension));

  if (!in_array($imageExtension, $validImageExtension)) {
    echo "<script> alert('Invalid Image Format!'); </script>";
  }else if($fileSize > 10000000){
    echo "<script> alert('Image is too large!'); </script>";
  }else{

    $newImgName = uniqid();
    $newImgName .= '.' . $imageExtension;

    move_uploaded_file($tmpName, "$uploads_dir/$newImgName");

   $sql = "UPDATE `tbl_users` SET `surname` = '$sname' , `first_name` = '$fname' , `othername` = '$oname' , `gender` = '$gen' , `password` = md5('$password'), `profile_pic` = '$newImgName' WHERE `user_id` = '$uid'";

     mysqli_query($conn, $sql);
   // var_dump($sql);
   // die();
  header("Location: index1.php?editserver=success");
 }
}
}else{
  echo "User does not exist, kindly try again with an existing User ID.";
 }
}

//Deactivate/Delete Server
if (isset($_POST['dels'])) {
  $sid = $_POST['sid'];
  $mod = $_POST['mod'];
  $deact = 1;
  $del = 2;

   require_once 'dbconnection.inc.php';

  if ($mod == $deact) {
    
        $sql = "SELECT * FROM `tbl_users` WHERE `user_id`='$sid'";

        $query = mysqli_query($conn,$sql);

        if(mysqli_num_rows($query) > 0){

  $sql = "UPDATE `tbl_users` SET `isdeleted` = '1' WHERE `user_id` = '$sid'";

  mysqli_query($conn, $sql);
   // var_dump($sql);
   // die();
  header("Location: index1.php?deactivateserver=success");
}else{
  echo "Server does not exist.";
}
  } else if ($mod == $del) {
    
        $sql = "SELECT * FROM `tbl_users` WHERE `user_id`='$sid'";

        $query = mysqli_query($conn,$sql);

        if(mysqli_num_rows($query) > 0){
           $row = mysqli_fetch_assoc($query);
            $role = $row['role_id'];

  $sql = "DELETE FROM `tbl_users` WHERE `user_id` = '$sid'";
  $sql2 = "DELETE FROM `tbl_roles` WHERE `role_id` = '$role'";
  $sql3 = "DELETE FROM `tbl_ratings` WHERE `server_id` = '$role'";

  mysqli_query($conn, $sql);
  mysqli_query($conn, $sql2);
  mysqli_query($conn, $sql3);
   // var_dump($sql);
   // die();
  header("Location: index1.php?deleteserver=success");
}else{
  echo "Server does not exist.";
}
  } else{
    echo "An error occured.";
  }
}

//Update A Wallet
if (isset($_POST['upw'])) {
  $uid = $_POST['uid'];
  $amo = $_POST['amo'];

   require_once 'dbconnection.inc.php';
    
        $sql = "SELECT * FROM `tbl_users` WHERE `user_id`='$uid'";

        $query = mysqli_query($conn,$sql);

        if(mysqli_num_rows($query) > 0){

  $sql = "UPDATE `tbl_wallet` SET `amount`= amount + $amo WHERE `user_id`='$uid'";

  mysqli_query($conn, $sql);
   // var_dump($sql);
   // die();
  header("Location: index1.php?updatewallet=success");
}else{
  echo "Client does not exist.";
} 
}

//Add Food
if (isset($_POST['addf'])) {
 $foname = $_POST['foname'];
 $fcat = $_POST['fcat'];
 $bprice = $_POST['bprice'];
 $sprice = $_POST['sprice'];
 $aid = $_POST['aid'];
 // $image = $_POST['image'];
 $quan = $_POST['quan'];
 $date = date("Y-m-d h:i:sa");

  require_once 'dbconnection.inc.php';

   $sql = "SELECT * FROM `tbl_foodcategories` WHERE `category_id`='$fcat'";

        $query = mysqli_query($conn,$sql);

        if(mysqli_num_rows($query) > 0){

     if ($_FILES["image"]["error"] === 4) {
   echo "<script> alert('Image does not exist!'); </script>";
}else{
  $uploads_dir = 'images';
  $fileName = $_FILES["image"]["name"];
  $fileSize = $_FILES["image"]["size"];
  $tmpName = $_FILES["image"]["tmp_name"];

  $validImageExtension = ['jpg', 'jpeg', 'png'];
  $imageExtension = explode('.', $fileName);
  $imageExtension = strtolower(end($imageExtension));

  if (!in_array($imageExtension, $validImageExtension)) {
    echo "<script> alert('Invalid Image Format!'); </script>";
  }else if($fileSize > 10000000){
    echo "<script> alert('Image is too large!'); </script>";
  }else{

    $newImgName = uniqid();
    $newImgName .= '.' . $imageExtension;

    move_uploaded_file($tmpName, "$uploads_dir/$newImgName");

   $sql1 = "INSERT INTO `tbl_food`(`food_name`, `food_image`, `created_on`, `updated_on`, `food_category`, `food_buyingprice`, `food_sellingprice`, `admin_id`, `quantity`, `isdeleted`) VALUES ('$foname','$newImgName',NOW(),NOW(),'$fcat','$bprice','$sprice','$aid','$quan','0')";

     mysqli_query($conn, $sql1);
   // var_dump($sql);
   // die();
  header("Location: index1.php?addfood=success");
 }
}
}else{
  echo "Food Category does not exist, kindly try again with an existing Food Category.
  <br>
  <p> Click <a href='index1.php'>HERE</a> to Try Again.";
}
}

//Edit Food
if (isset($_POST['upf'])) {
 $foname = $_POST['foname'];
 $fcat = $_POST['fcat'];
 $bprice = $_POST['bprice'];
 $sprice = $_POST['sprice'];
 $aid = $_POST['aid'];
 $fid = $_POST['fid'];
 $image = $_POST['image'];
 $quan = $_POST['quan'];
 $date = date("Y-m-d h:i:sa");

  require_once 'dbconnection.inc.php';

  $sql = "SELECT * FROM `tbl_foodcategories` WHERE `category_name`='$fcat'";

        $query = mysqli_query($conn,$sql);

        if(mysqli_num_rows($query) > 0){

   $sql = "SELECT * FROM `tbl_food` WHERE `food_id`='$fid'";

        $query = mysqli_query($conn,$sql);

        if(mysqli_num_rows($query) > 0){

     if ($_FILES["image"]["error"] === 4) {
   echo "<script> alert('Image does not exist!'); </script>";
}else{
  $uploads_dir = 'images';
  $fileName = $_FILES["image"]["name"];
  $fileSize = $_FILES["image"]["size"];
  $tmpName = $_FILES["image"]["tmp_name"];

  $validImageExtension = ['jpg', 'jpeg', 'png'];
  $imageExtension = explode('.', $fileName);
  $imageExtension = strtolower(end($imageExtension));

  if (!in_array($imageExtension, $validImageExtension)) {
    echo "<script> alert('Invalid Image Format!'); </script>";
  }else if($fileSize > 10000000){
    echo "<script> alert('Image is too large!'); </script>";
  }else{

    $newImgName = uniqid();
    $newImgName .= '.' . $imageExtension;

    move_uploaded_file($tmpName, "$uploads_dir/$newImgName");

   $sql = "UPDATE `tbl_food` SET `food_name` = '$foname' , `food_image` = '$newImgName' , `updated_on` = NOW(), `food_category` = '$fcat' , `food_buyingprice` = '$bprice' , `food_sellingprice` = '$sprice' , `admin_id` = '$aid' , `quantity` = '$quan' , `isdeleted` = '$isd' WHERE `food_id` = '$fid'";

     mysqli_query($conn, $sql);
   // var_dump($sql);
   // die();
  header("Location: index1.php?foodupdate=success");
 }
}
}else{
  echo "Food ID does not exist, kindly try again with an existing Food ID.
  <br>
  <p> Click <a href='index1.php'>HERE</a> to Try Again.";
}
}else{
  echo "Food Category does not exist, kindly try again with an existing Food Category.
  <br>
  <p> Click <a href='index1.php'>HERE</a> to Try Again.";
}
}

//Deactivate/Delete Food
if (isset($_POST['delf'])) {
  $fid = $_POST['fid'];
  $mod = $_POST['mod'];
  $deact = 1;
  $del = 2;

   require_once 'dbconnection.inc.php';

  if ($mod == $deact) {
    
        $sql = "SELECT * FROM `tbl_food` WHERE `food_id`='$fid'";

        $query = mysqli_query($conn,$sql);

        if(mysqli_num_rows($query) > 0){

  $sql = "UPDATE `tbl_food` SET `isdeleted` = '1' WHERE `food_id` = '$fid'";

  mysqli_query($conn, $sql);
   // var_dump($sql);
   // die();
  header("Location: index1.php?deactivatefood=success");
}else{
  echo "Food does not exist.";
}
  } else if ($mod == $del) {
    
        $sql = "SELECT * FROM `tbl_food` WHERE `food_id`='$fid'";

        $query = mysqli_query($conn,$sql);

        if(mysqli_num_rows($query) > 0){
           $row = mysqli_fetch_assoc($query);
            $role = $row['role_id'];

  $sql = "DELETE FROM `tbl_food` WHERE `food_id` = '$fid'";

  mysqli_query($conn, $sql);
   // var_dump($sql);
   // die();
  header("Location: index1.php?deletefood=success");
}else{
  echo "Food does not exist.";
}
  } else{
    echo "An error occured.";
  }
}

//Add Food Category
if (isset($_POST['addfc'])) {
 $cname = $_POST['cname'];

 require_once 'dbconnection.inc.php';

   $sql = "INSERT INTO `tbl_foodcategories`(`category_name`, `isdeleted`) VALUES ('$cname','0')";

     mysqli_query($conn, $sql);
   // var_dump($sql);
   // die();
  header("Location: index1.php?addfoodcategory=success");
 }

//Edit Food Category
if (isset($_POST['upfc'])) {
 $cname = $_POST['cname'];
 $cid = $_POST['cid'];

  require_once 'dbconnection.inc.php';

   $sql = "UPDATE `tbl_foodcategories` SET `category_name` = '$cname' WHERE `category_id` = '$cid'";

     mysqli_query($conn, $sql);
   // var_dump($sql);
   // die();
  header("Location: index1.php?updatefoodcategory=success");
 }

//Deactivate/Delete Food Category
if (isset($_POST['delfc'])) {
  $cid = $_POST['cid'];
  $mod = $_POST['mod'];
  $deact = 1;
  $del = 2;

   require_once 'dbconnection.inc.php';

  if ($mod == $deact) {
    
        $sql = "SELECT * FROM `tbl_foodcategories` WHERE `category_id`='$cid'";

        $query = mysqli_query($conn,$sql);

        if(mysqli_num_rows($query) > 0){

  $sql = "UPDATE `tbl_foodcategories` SET `isdeleted` = '1' WHERE `category_id` = '$cid'";

  mysqli_query($conn, $sql);
   // var_dump($sql);
   // die();
  header("Location: index1.php?deactivatefoodcategory=success");
}else{
  echo "Food Category does not exist.";
}
  } else if ($mod == $del) {
    
        $sql = "SELECT * FROM `tbl_foodcategories` WHERE `category_id`='$cid'";

        $query = mysqli_query($conn,$sql);

        if(mysqli_num_rows($query) > 0){
           $row = mysqli_fetch_assoc($query);
            $role = $row['role_id'];

  $sql = "DELETE FROM `tbl_foodcategories` WHERE `category_id` = '$cid'";

  mysqli_query($conn, $sql);
   // var_dump($sql);
   // die();
  header("Location: index1.php?deletefoodcategory=success");
}else{
  echo "Food Category does not exist.";
}
  } else{
    echo "An error occured.";
  }
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//SERVER Section
//Add Buyer
if (isset($_POST['addb'])) {
 $sname = $_POST['sname'];
 $oname = $_POST['oname'];
 $fname = $_POST['fname'];
 $gen = $_POST['gen'];
 $email = $_POST['email'];
 // $image = $_POST['image'];
 $dob = $_POST['dob'];
 $password = $_POST['password'];
 // $passwordconfirm = $_POST['cpassword'];
 $role1 = "Purchaser/Client";

 require_once 'dbconnection.inc.php';

 $da =  date("Y/m/d");
$datestamp = strtotime($dob);
$datestamp1 = strtotime($da);

// if ($datestamp > $datestamp1) {
//   echo "Ensure Date of Birth is Not After Today's Date.";
// }


       $sqlrole = "INSERT INTO `tbl_roles`(`role_name`) VALUES (?)"; 
                $stmt = $conn->prepare($sqlrole); 
                $stmt->bind_param("s", $db_role); 
                $db_role = $role1; 
                $insertrole = $stmt->execute(); 
             
                if($insertrole){ 
                    $newid = $stmt->insert_id; 

     if ($_FILES["image"]["error"] === 4) {
   echo "<script> alert('Image does not exist!'); </script>";
}else{
  $uploads_dir = 'images';
  $fileName = $_FILES["image"]["name"];
  $fileSize = $_FILES["image"]["size"];
  $tmpName = $_FILES["image"]["tmp_name"];

  $validImageExtension = ['jpg', 'jpeg', 'png'];
  $imageExtension = explode('.', $fileName);
  $imageExtension = strtolower(end($imageExtension));

  if (!in_array($imageExtension, $validImageExtension)) {
    echo "<script> alert('Invalid Image Format!'); </script>";
  }else if($fileSize > 10000000){
    echo "<script> alert('Image is too large!'); </script>";
  }else{

    $newImgName = uniqid();
    $newImgName .= '.' . $imageExtension;

    move_uploaded_file($tmpName, "$uploads_dir/$newImgName");

   // $sql1 = " ('$sname','$fname','$oname','$gen','$dob','$email',md5('$password'),'$newImgName','$newid','0')";

          $sqluser = "INSERT INTO tbl_users(surname, first_name, othername, gender, dob, email, password, profile_pic, role_id) VALUES (?,?,?,?,?,?,?,?,?)"; 
                $stmt = $conn->prepare($sqluser); 
                $stmt->bind_param("sssssssss", $db_sname, $db_fname, $db_oname, $db_gen, $db_dob, $db_email, $db_pass, $db_propic, $db_roleid); 
                $db_sname = $sname; 
                $db_fname = $fname;
                $db_oname = $oname;
                $db_gen = $gen; 
                $db_dob = $dob;
                $db_email = $email; 
                $db_pass = md5($password); 
                $db_propic = $newImgName;
                $db_roleid = $newid;     
                $insertuser = $stmt->execute(); 
             
                if($insertuser){ 
                    $wid = $stmt->insert_id; 

   $sql2 = "INSERT INTO `tbl_wallet`(`user_id`, `amount`, `created_on`) VALUES ('$wid','0',NOW())";

     // mysqli_query($conn, $sql1);
     mysqli_query($conn, $sql2);
   // var_dump($sql);
   // die();
  header("Location: index2.php?userregistration=success");
 }else{
  echo "User has not yet been created.";
  var_dump($stmt);
 }
}
}
}else{
  echo "Role has not yet been created.";
}
}

//Edit Buyer
if (isset($_POST['edb'])) {
 $uid = $_POST['uid'];
 $sname = $_POST['sname'];
 $oname = $_POST['oname'];
 $fname = $_POST['fname'];
 $gen = $_POST['gen'];
 $email = $_POST['email'];
 $image = $_POST['image'];
 $dob = $_POST['dob'];
 $password = $_POST['password'];
 $passwordconfirm = $_POST['cpassword'];

 require_once 'dbconnection.inc.php';

// $da =  date("Y/m/d");
// $datestamp = strtotime($dob);
// $datestamp1 = strtotime($da);

// if ($datestamp1 > $datestamp) {
//   echo "Ensure Date of Birth is After Today's Date.";
// }

  $sql =  "SELECT * FROM `tbl_users` WHERE `user_id`='$uid'";

        $query = mysqli_query($conn,$sql);

        if(mysqli_num_rows($query) > 0){

     if ($_FILES["image"]["error"] === 4) {
   echo "<script> alert('Image does not exist!'); </script>";
}else{
  $uploads_dir = 'images';
  $fileName = $_FILES["image"]["name"];
  $fileSize = $_FILES["image"]["size"];
  $tmpName = $_FILES["image"]["tmp_name"];

  $validImageExtension = ['jpg', 'jpeg', 'png'];
  $imageExtension = explode('.', $fileName);
  $imageExtension = strtolower(end($imageExtension));

  if (!in_array($imageExtension, $validImageExtension)) {
    echo "<script> alert('Invalid Image Format!'); </script>";
  }else if($fileSize > 10000000){
    echo "<script> alert('Image is too large!'); </script>";
  }else{

    $newImgName = uniqid();
    $newImgName .= '.' . $imageExtension;

    move_uploaded_file($tmpName, "$uploads_dir/$newImgName");

   $sql = "UPDATE `tbl_users` SET `surname` = '$sname' , `first_name` = '$fname' , `othername` = '$oname' , `gender` = '$gen' ,  `email` = '$email' , `password` = md5('$password'), `profile_pic` = '$newImgName' WHERE `user_id` = '$uid'";

     mysqli_query($conn, $sql);
   // var_dump($sql);
   // die();
  header("Location: index2.php?edituser=success");
 }
}
}else{
  echo "User does not exist, kindly try again with an existing User ID.";
 }
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//BUYER Section
//Edit Buyer
if (isset($_POST['edb1'])) {
 $uid = $_POST['uid'];
 $sname = $_POST['sname'];
 $oname = $_POST['oname'];
 $fname = $_POST['fname'];
 $gen = $_POST['gen'];
 $email = $_POST['email'];
 // $image = $_POST['image'];
 $dob = $_POST['dob'];
 $password = $_POST['password'];
 $passwordconfirm = $_POST['cpassword'];

 require_once 'dbconnection.inc.php';

//  $da =  date("Y/m/d");
// $datestamp = strtotime($dob);
// $datestamp1 = strtotime($da);

// if ($datestamp1 > $datestamp) {
//   echo "Ensure Date of Birth is After Today's Date.";
// }

  $sql =  "SELECT * FROM `tbl_users` WHERE `user_id`='$uid'";

        $query = mysqli_query($conn,$sql);

        if(mysqli_num_rows($query) > 0){

     if ($_FILES["image"]["error"] === 4) {
   echo "<script> alert('Image does not exist!'); </script>";
}else{
  $uploads_dir = 'images';
  $fileName = $_FILES["image"]["name"];
  $fileSize = $_FILES["image"]["size"];
  $tmpName = $_FILES["image"]["tmp_name"];

  $validImageExtension = ['jpg', 'jpeg', 'png'];
  $imageExtension = explode('.', $fileName);
  $imageExtension = strtolower(end($imageExtension));

  if (!in_array($imageExtension, $validImageExtension)) {
    echo "<script> alert('Invalid Image Format!'); </script>";
  }else if($fileSize > 10000000){
    echo "<script> alert('Image is too large!'); </script>";
  }else{

    $newImgName = uniqid();
    $newImgName .= '.' . $imageExtension;

    move_uploaded_file($tmpName, "$uploads_dir/$newImgName");

   $sql = "UPDATE `tbl_users` SET `surname` = '$sname' , `first_name` = '$fname' , `othername` = '$oname' , `gender` = '$gen' ,  `email` = '$email' , `password` = md5('$password'), `profile_pic` = '$newImgName' WHERE `user_id` = '$uid'";

     mysqli_query($conn, $sql);
   // var_dump($sql);
   // die();
  header("Location: index3.php?edituser=success");
 }
}
}else{
  echo "User does not exist, kindly try again with an existing User ID.";
 }
}

//Add Rating
if (isset($_POST['addr'])) {
 $cid = $_POST['cid'];
 $sid = $_POST['sid'];
 $rate = $_POST['rate'];
 $date = date("Y-m-d h:i:sa");

require_once 'dbconnection.inc.php';

  $sql = "SELECT * FROM `tbl_users` WHERE `user_id`='$cid'";

        $query = mysqli_query($conn,$sql);

        if(mysqli_num_rows($query) > 0){

   $sql = "SELECT * FROM `tbl_users` WHERE `user_id`='$sid'";

        $query = mysqli_query($conn,$sql);

        if(mysqli_num_rows($query) > 0){

 

   $sql = "INSERT INTO `tbl_ratings`(`server_id`, `created_on`, `updated_on`, `rating`) VALUES ('$sid',NOW(),NOW(),'$rate')";

     mysqli_query($conn, $sql);
   // var_dump($sql);
   // die();
  header("Location: index3.php?addrating=success");
 }else{
  echo "Server does not exist, kindly try again with an existing Server ID.";
 }
}
}

 ?>