<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentOrLend</title>
</head>
<body>
<?php
// Function For Creating Auto genrated OrderID
function CreateOrderID($oid){
    $Company="EE";
    $year= date('y');
    $month= date('m');
    $OrderID=$Company.$year.$month;
    $str_oid=strval($oid);
    if(strlen($str_oid)==1){
        $str_oid="000".$str_oid;
    }
    
    elseif(strlen($str_oid)==2){
        $str_oid="00".$str_oid;
    }
   
    elseif(strlen($str_oid)==3)
    $str_oid="0".$str_oid;

    return $OrderID=$OrderID.$str_oid;
} 
include 'Includes/dbconn.php';
$n_id=0;
$result=mysqli_query($conn,"SELECT * FROM orders ORDER BY ID DESC LIMIT 1");
if(mysqli_num_rows($result)>0){
    mysqli_num_rows($result);
    $row=mysqli_fetch_assoc($result);
    $temp=$row['order_id'];
    $oid= $temp[strlen($temp)-1];
    echo "oid is".$oid."<br>";
    $n_id=(int)$oid;
}
else{
    $n_id=1;
}

$OrderID=CreateOrderID($n_id);

require('config.php');


require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$success = true;

$error = "Payment Failed";
$keyId='rzp_live_rrMpo1tSVMxd9k';
$keySecret='2iERssgSmdrqtzQzuELMewCD';
if (empty($_POST['razorpay_payment_id']) === false)
{
    $api = new Api($keyId, $keySecret);

    try
    {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
    }
    catch(SignatureVerificationError $e)
    {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}

if ($success === true)
{
    $html = "<p>Your payment was successful</p>
           
           
             <p>Payment ID: {$_POST['razorpay_payment_id']}</p>";
             if(!empty($_POST['razorpay_payment_id'])){

             
             $oid=$_SESSION['razorpay_order_id'];
             $sql = "UPDATE orders SET order_id='$OrderID',razorpay_signature='{$_POST['razorpay_signature']}',  razorpay_payment_id='{$_POST['razorpay_payment_id']}' WHERE razorpay_order_id='$oid'";

if (mysqli_query($conn, $sql)) {
  echo "Record updated successfully !!";
} else {
  echo "Error updating record: " . mysqli_error($conn);
}

$result=mysqli_query($conn,"SELECT p_ids FROM orders WHERE u_id={$_SESSION['uid']} and razorpay_order_id='{$_SESSION['razorpay_order_id']}'");
$row=mysqli_fetch_assoc($result);
$temp=$row['p_ids'];
// use of explode
$string = $temp;
$str_arr = explode (",", $string);
print_r($string);

$len=count($str_arr);
echo $len."value of len<br>";
$i=0;
while($i<$len){
    echo "<br>value of i is {$i}<br>";
    echo $str_arr[$i];
    if(mysqli_query($conn,"DELETE FROM `cart` WHERE p_id='$str_arr[$i]' AND u_id={$_SESSION['uid']}")){
        echo "delete from cart {$str_arr[$i]} <br>";
       if (mysqli_query($conn,"UPDATE `products` SET `product_status`='Unavailable' WHERE `product_id`={$str_arr[$i]}")){
        echo "unavailable from product {$str_arr[$i]} <br>";
       }       }
        
        $i++;
    }
}

header("location:index.php");

             }
else
{
    $html = "<p>Your payment failed</p>
             <p>{$error}</p>";
}

echo $html;

?>
</body>
</html>

