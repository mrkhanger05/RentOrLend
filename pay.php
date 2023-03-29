<?php
session_start();

// Function For Creating Auto genrated OrderID
function CreateOrderID($oid){
  $oid++;
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
 // echo "oid is".$oid."<br>";
  $n_id=(int)$oid;
}
else{
  $n_id=1;
}

$OrderID=CreateOrderID($n_id);
//echo $_SESSION['uid'];
if(isset($_GET["CheckoutPrice"]))
     $CheckoutPrice=$_GET["CheckoutPrice"];
//require('config.php');
require('razorpay-php/Razorpay.php');
include('Includes/dbconn.php');
$Query1 = "Select * From users WHERE user_id='{$_SESSION['uid']}'";
$Result = mysqli_query($conn, $Query1);
$row = mysqli_fetch_assoc($Result);
// session_start();

// Create the Razorpay Order

use Razorpay\Api\Api;
$keyId='rzp_live_rrMpo1tSVMxd9k';
$keySecret='2iERssgSmdrqtzQzuELMewCD';
$api = new Api($keyId, $keySecret);

//
// We create an razorpay order using orders api
// Docs: https://docs.razorpay.com/docs/orders
//

$orderData = [
    'receipt'         => 3456,
    'amount'          =>  $CheckoutPrice*100, // 1* 100

    'currency'        => 'INR',
    'payment_capture' => 1 // auto capture
];

$razorpayOrder = $api->order->create($orderData);

$razorpayOrderId = $razorpayOrder['id'];

$_SESSION['razorpay_order_id'] = $razorpayOrderId;

$displayAmount = $amount = $orderData['amount'];

// if ($displayCurrency !== 'INR')
// {
//     $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
//     $exchange = json_decode(file_get_contents($url), true);

//     $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
// }

$checkout = 'manual';

// if (isset($_GET['checkout']) and in_array($_GET['checkout'], ['automatic', 'manual'], true))
// {
//     $checkout = $_GET['checkout'];
// }


$data = [
    "key"               => $keyId,
    "amount"            => $amount,
    "name"              => $row["user_fullname"],
    "description"       => "Tron Legacy",
    "image"             => $row["user_profile_pic"],
    "prefill"           => [
    "name"              => "Daft Punk",
    "email"             => $row["user_email"],
    "contact"           => $row["user_phone"],
    ],
    "notes"             => [
    "address"           => "Hello World",
    "merchant_order_id" => "12312321",
    ],
    "theme"             => [
    "color"             => "#F37254"
    ],
    "order_id"          => $razorpayOrderId,
];
// echo "<pre>";
// print_r($data);
// echo "</pre>";
// if ($displayCurrency !== 'INR')
// {
//     $data['display_currency']  = $displayCurrency;
//     $data['display_amount']    = $displayAmount;
// }

$json = json_encode($data);
$sql = "SELECT p_id FROM cart where u_id={$_SESSION['uid']}";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
$pids="";
  while($row = mysqli_fetch_assoc($result)) {
    $pids=$pids.",".$row['p_id'];
  }
  $pids=ltrim($pids, ',');
 // echo $pids;
} else {
 // echo "0 results";
}
$sql = "INSERT INTO orders (u_id,order_id,razorpay_order_id,p_ids) VALUES ({$_SESSION['uid']},'$OrderID','{$razorpayOrderId}','$pids')";

if (mysqli_query($conn, $sql)) {
//  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

require("checkout/{$checkout}.php");


?>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script>
  $(document).ready(function(e) {
    document.getElementById("rzp-button1").click();
  });
</script>