<?php
session_start();
include('Includes/dbconn.php');
include('Includes/Function.php');
if (isset($_SESSION['user_signin'])) {
	$Email = $_SESSION['email'];
}

extract($_POST);

//Fetching Product Category  List
if (isset($_POST["Fetch_Product_Category_List"])) {
	$SQL = "SELECT * FROM `product_categories` ";
	$RESULT = mysqli_query($conn, $SQL);
	while ($row = mysqli_fetch_assoc($RESULT)) {
?>
		<option value="<?php echo $row["cat_id"]; ?>"><?php echo $row["cat_name"]; ?></option>
<?php }
}


// Execute When Contact us form is submitted
if (isset($_POST["InsertConatctUs"])) {
	$to = "somebody@example.com, somebodyelse@example.com";
    $subject = "Hello";
	$name = $_POST['FB_Uname'];
	$email = $_POST['FB_Uemail'];
	$phone = $_POST['FB_Uphone'];
	$msg = $_POST['FB_Umessage'];
	$MESSAGE="Hello ".$name." Thankyou for contacting us.We will reply as soon as possible.";
	$sql = "INSERT INTO `contactus`(`FB_U_Name`, `FB_U_Email`, `FB_U_Mobile`, `FB_Message`, `FB_Status`) VALUES ('$name','$email','$phone','$msg','Pending')";
	if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode" => 200));
		// mail("$email","My subject",$MESSAGE);
	} else {
		echo json_encode(array("statusCode" => 201));
	}
	mysqli_close($conn);
}

// Execute When Change Password Request is submitted
if (isset($_POST["ChangePwd"])) {
	$OldPwd = $_POST['OldPwd'];
	$NewPwd = $_POST['NewPwd'];
	$Confirm_NewPwd = $_POST['Confirm_NewPwd'];
	$User_Id = GetUserID($Email);
	$SQL = "SELECT * FROM `users` WHERE `user_id`='$User_Id'";
	$RESULT = mysqli_query($conn, $SQL);
	if ($RESULT) {
		while ($row = mysqli_fetch_assoc($RESULT)) {
			if ($row['user_password'] == $OldPwd and $row['user_id'] == $User_Id) {
				$sql = "UPDATE `users` SET `user_password`='$NewPwd' WHERE `user_id`='$User_Id'";
				if (mysqli_query($conn, $sql))
					echo json_encode(array("statusCode" => 200));
				else
					echo json_encode(array("statusCode" => 201));
			}
		}
	}


	mysqli_close($conn);
}


extract($_POST);
// Execute When New request form  is submitted
if (isset($_POST["InsertNewRequest"])) {
	$Item_Name = $_POST['Item_Name'];
	$Item_Rent_Days = $_POST['Item_Rent_Days'];
	$Item_Description = $_POST['Item_Description'];
	$User_Id = GetUserID($Email);
	$SQL = "INSERT INTO `itemrequest`( `u_id`, `item_name`, `no_of_days`, `Item_Description`) VALUES ('$User_Id','$Item_Name','$Item_Rent_Days','$Item_Description')";
	if (mysqli_query($conn, $SQL))
		echo json_encode(array("statusCode" => 200));
	else
		echo json_encode(array("statusCode" => 201));
	mysqli_close($conn);
}






//Fetching Toatal number of item in cart 
if (isset($_POST["FetchCartItemNo"]) && isset($_SESSION['user_signin'])) {
	$U_id = GetUserID($Email);
	$SQL = "SELECT COUNT(*) AS `count` FROM cart WHERE `u_id`='$U_id'";
	$RESULT = mysqli_query($conn, $SQL);
	$row = mysqli_fetch_assoc($RESULT);
	echo $row['count'];
}



extract($_POST);







//Fetching User Pic
if (isset($_POST["FetchUserPicture"])) {
	$U_id = GetUserID($Email);
	$SQL = "SELECT * FROM `users` WHERE `user_id`='$U_id'";
	$RESULT = mysqli_query($conn, $SQL);
	$row = mysqli_fetch_assoc($RESULT);
	if($row['user_profile_pic']=="")
	$row['user_profile_pic']="Images/UserLogo.png";
	echo json_encode(array(
		'user_pic' =>$row['user_profile_pic'],
		'username' =>$row['user_fullname'],
	),JSON_UNESCAPED_SLASHES);
}


// AddToCart
if (isset($_POST["AddToCart"])) {
	$U_id = GetUserID($Email);
    $PID =$_POST["PID"];
    $Query1=mysqli_query($conn,"SELECT * FROM products WHERE product_id='$PID'");
	$row=mysqli_fetch_assoc($Query1);
	$product_price=$row['product_price'];
	echo $U_id."<br>".$PID; 
	$SQL = "INSERT INTO `cart`(`p_id`, `u_id`,`price`) VALUES ('$PID','$U_id','$product_price')";
	$RESULT = mysqli_query($conn,$SQL);
     print_r($row);
	if($RESULT)
		echo " inserted ";
	 echo $PID;
}

if (isset($_POST["UpdateRentingDays"])) {
	$U_id = GetUserID($Email);
	$RendtingDays=$_POST["RendtingDays"];
    $PID = $_POST["PID"];
	$Query1=mysqli_query($conn,"SELECT * FROM products WHERE product_id='$PID'");
	$row=mysqli_fetch_assoc($Query1);
	$RentPrice=$RendtingDays*$row['product_price'];
	$SQL = "UPDATE `cart` SET `days`=$RendtingDays ,`price`=$RentPrice  WHERE `p_id`='$PID' and u_id='$U_id'";
	$RESULT = mysqli_query($conn, $SQL);
	if($RESULT)
	 echo "Done";
}



if(isset($_POST["InsertGoogleData"])){
	$Name=mysqli_real_escape_string($conn,$_POST['Name']);
	$Email=mysqli_real_escape_string($conn,$_POST['Email']);
	$Uid=mysqli_real_escape_string($conn,$_POST['Uid']);
	$Image=mysqli_real_escape_string($conn,$_POST['Image']);
	
	$_SESSION['uid']=$Uid;
			
	
	$res=mysqli_query($conn,"select * from users where user_id='$user_id'");
	$check=mysqli_num_rows($res);
			$row=mysqli_fetch_assoc($res);
			$_SESSION["user_signin"] = true;
			
	if($check>0){
	
	}else{
			mysqli_query($conn,"INSERT INTO `users`(`user_id`, `user_fullname`, `user_email`,`user_profile_pic`) VALUES ('$Uid','$Name','$Email','$Image')");
	}
	
	echo "done";
}



if(isset($_POST['email']))
{
    $user_email = $_POST['email'];
    $result = mysqli_query($conn,"SELECT * FROM users where user_email='" . $_POST['email'] . "'");
    $count=mysqli_num_rows($result);
    if($count>0){
        $otp=rand(11111,99999);
        mysqli_query($conn,"update users set hashcode='$otp' where user_email='$user_email'");
        $html="Your otp verification code is ".$otp;
        $_SESSION['EMAIL']=$user_email;
        $headers = "From:noreply@yourwebsite.com" . "\r\n";
        mail($user_email,'OTP Verification',$html,$headers);
        echo "yes";
    }else{
        echo "not_exist";
    }
   
}


if(isset($_POST['otp']))
{
	$otp=$_POST['otp'];
	$email=$_SESSION['EMAIL'];
	$res=mysqli_query($conn,"select * from users where user_email='$email' and hashcode='$otp'");
	$count=mysqli_num_rows($res);
	if($count>0){
		mysqli_query($conn,"update users set hashcode='' where user_email='$email'");
		$_SESSION['IS_LOGIN']=$email;
		echo "yes";
	}else{
		echo "not_exist";
	}
   
}


//Execute When User Click on Update Account
if (isset($_POST["UpdateAccountDetail"])) {
	$U_id = GetUserID($Email);
	
	$SQL = "SELECT * FROM `users` WHERE `user_id`='$U_id'";
	$RESULT = mysqli_query($conn, $SQL);
	$row = mysqli_fetch_assoc($RESULT);
	if($row['user_profile_pic']=="")
	$row['user_profile_pic']="Images/UserLogo.png";
	echo json_encode(array(
		'user_pic' =>$row['user_profile_pic'],
		'username' =>$row['user_fullname'],
	),JSON_UNESCAPED_SLASHES);
}

//Execute For Updating User Gender
if (isset($_POST["UpdateGender"])) {
	$U_id = GetUserID($Email);
	$User_Gender=$_POST['User_Gender'];
	$SQL = "UPDATE `users` SET `user_gender`='$User_Gender' WHERE  `user_id`='$U_id'";
	if(mysqli_query($conn,$SQL))
		echo "Done";
	
}
//Execute For Updating User Gender
if (isset($_POST["UpdateUserPhone"])) {
	$U_id = GetUserID($Email);
	$User_Phone=$_POST['User_Phone'];
	$SQL = "UPDATE `users` SET `user_phone`='$User_Phone' WHERE  `user_id`='$U_id'";
	if(mysqli_query($conn,$SQL))
		echo "Done";
	
}

//Execute For Updating UpdateSecondaryShippingAdd
if (isset($_POST["UpdateOtherShippingAdd"])) {
	$U_id = GetUserID($Email);
	$OtherShippingAdd=$_POST['OtherShippingAdd'];
	$SQL = "UPDATE `users` SET `Shipping_Address2`='$OtherShippingAdd' WHERE  `user_id`='$U_id'";
	if(mysqli_query($conn,$SQL))
		echo "Done";
	
}

//Execute For Updating Pickup Address
if (isset($_POST["UpdatePickupAdd"])) {
	$U_id = GetUserID($Email);
	$PickupAdd=$_POST['PickupAdd'];
	$SQL = "UPDATE `users` SET `Pickup_Address`='$PickupAdd' WHERE  `user_id`='$U_id'";
	if(mysqli_query($conn,$SQL))
		echo "Done";
	
}



//Execute For Fetching Products
if (isset($_POST["FetchProduct"])) {
	$Start=$_POST['Start'];
      $End=$_POST['End'];
      $SQL = "SELECT * FROM `products` WHERE `product_status`='Available' LIMIT  $Start,$End";
      $RESULT = mysqli_query($conn, $SQL);
	  $Count = 1;
	  while ($row = mysqli_fetch_assoc($RESULT)) {
		echo '
		  <div class="product">
			<div class="product-content">
			  <div class="product-img">
				<img src="'.$row['product_pic_1'].'" alt="product image">
			  </div>
			  <div class="product-btns">
				<button type="button" class="btn-cart AddToCart" value="'.$Count.'"> Add to cart
				  <span><i class="fas fa-plus"></i></span>
				</button>
				<span id="ProductId'.$Count.'" style="display: none;">'.$row['product_id'].'</span>
				<a href="ItemViewer.php?PID='.$row['product_id'].'" class="btn btn-buy">View
				  <span><i class="fas fa-eye"></i></span>
				</a>
			  </div>
			</div>
  
			<div class="product-info">
			  <div class="product-info-top">
				<h2 class="sm-title">'.$row['item_city'].$row['product_id'].'</h2>
				<div class="rating">
				  <span><i class="fas fa-star"></i></span>
				  <span><i class="fas fa-star"></i></span>
				  <span><i class="fas fa-star"></i></span>
				  <span><i class="fas fa-star"></i></span>
				  <span><i class="fas fa-star"></i></span>
				  <span><i style="color: black;" class="fa fa-info-circle"></i></span>
				</div>
			  </div>
			  <a href="#" class="product-name">'.$row['product_name'].'</a>
			  <p class="product-price">'.$row['product_price'].'₹/day</p>
			</div>
  
		  </div>';
		
		  $Count++;
		}
  
	
	
}

//Execute For Fetching Count Of Products
if (isset($_POST["FetchProductCount"])) {
	$SQL = "SELECT COUNT(*) AS `count` FROM products ";
	$Result=mysqli_query($conn,$SQL);
	$row=mysqli_fetch_assoc($Result);
	echo $row['count'];
}
// insert into item request table
if (isset($_POST["RaiseRequest"])) {
	 
	$SQL = "INSERT INTO itemrequest (u_id,item_name,no_of_days,Item_Description,status) VALUES({$_SESSION['uid']},'{$_POST['raise_item_name']}','{$_POST['raise_no_of_days']}','{$_POST['raise_product_desc']}','pending');";
	if(mysqli_query($conn,$SQL)){
    echo "request is raised successfully";
	}
	else{
		echo " Request is not raised due to error";
	}
	 
}



?>