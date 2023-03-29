<?php
 function GetUserID($Email)
 {
     include('dbconn.php');
     $SQL = "SELECT * FROM `users` WHERE `user_email`='$Email'";
     if ($result = mysqli_query($conn, $SQL)) {
         while ($row = mysqli_fetch_row($result)) {
             return $row[0];
         } //end while
 
     } // end if
 }


 function RequestMail($reqid){
  include('dbconn.php'); 
 $SQL = "SELECT * FROM `itemrequest` INNER JOIN users ON itemrequest.u_id=users.user_id WHERE itemrequest.id='$reqid'";
 $result = mysqli_query($conn, $SQL);
  $row=mysqli_fetch_assoc($result);
  print_r($row);
  $email=$row['user_email'];
  $to = $email;
              echo $to;
              $subject = "Your Request is fullfilled";
              $message = '
          
        Hey '.$row['user_name'].'
        Your request has been fullfilled, Now you can rent it on our website.
          
        Item Request Detail
        ------------------------
        Item Name: '.$row['item_name'].'
        Renting Days: '.$row['no-of_days'].'
        ------------------------
          
        Please click this to open our website:
        http://www.rentorlendanything.com
          
        '; // Our message above including the link
              $headers = "From:noreply@rentorlendanything.com" . "\r\n";
              if(mail($to,$subject,$message,$headers)){
                mysqli_query($conn,"UPDATE `itemrequest` SET `status`='FULLFILLED' WHERE `id`='$reqid'");
              }
              

}


function  check_if_added_to_cart($item_id)
{
	include('dbconn.php');
$conn = new mysqli($host, $user, $pass, $db);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
  //session_start();
  $Email = $_SESSION['email'];
 
$user_id=GetUserID($Email);
$sql = "SELECT * FROM cart WHERE p_id='$item_id' AND u_id ='$user_id' ";
$result = $conn->query($sql);

if ($result->num_rows >= 1) {
  // output data of each row
  return 1;
} else {
  return 0;
}

$conn->close();
}



function  check_if_ordered($user_id,$item_id)
{
	 
include 'dbconn.php';	 
 
$sql = "SELECT * FROM cart WHERE p_id='$item_id' AND u_id ='$user_id'";
$result = $conn->query($sql);

if ($result->num_rows >= 1) {
  // output data of each row
  return 1;

} else {
	
  return 0;
}

$conn->close();
}



//Remove Item From Cart
function RemoveCartItem($product_id,$user_id)
{
    include('dbconn.php');
    $SQL="DELETE FROM `cart` WHERE `p_id`='$product_id' AND `u_id`='$user_id'";
    echo "PRODUCT ID :".$product_id." User ID : ".$user_id;
    if(mysqli_query($conn,$SQL));
    {
      header('location:cart.php');
    }
}

?>