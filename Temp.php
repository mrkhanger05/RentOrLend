<?php
include 'Includes/dbconn.php';
session_start();
// // Function For Creating Auto genrated OrderID
// function CreateOrderID($oid){
//     $str_oid=strval($oid);
//     $Company="EE";
//     $year= date('y');
//     $month= date('m');
//     $OrderID=$Company.$year.$month;
//     $str_oid=strval($oid);
//     if(strlen($str_oid)==1){
//         $str_oid="000".$str_oid;
//     }
    
//     elseif(strlen($str_oid)==2){
//         $str_oid="00".$str_oid;
//     }
   
//     elseif(strlen($str_oid)==3)
//     $str_oid="0".$str_oid;

//     return $OrderID=$OrderID.$str_oid;
// } 
// include 'Includes/dbconn.php';
// $n_id=0;
// $result=mysqli_query($conn,"SELECT * FROM orders ORDER BY ID DESC LIMIT 1");
// if(mysqli_num_rows($result)>0){
//     mysqli_num_rows($result);
//     $row=mysqli_fetch_assoc($result);
//     $temp=$row['order_id'];
//     $oid= $temp[strlen($temp)-1]."<br>";
//     $n_id=(int)$oid;
// }
// else{
//     $n_id=1;
// }

// $OrderID=CreateOrderID($n_id);
$n_id=0;
$result=mysqli_query($conn,"SELECT p_ids FROM orders WHERE u_id={$_SESSION['uid']}");
$row=mysqli_fetch_assoc($result);
$temp=$row['p_ids'];
// use of explode
$string = $temp;
$str_arr = explode (",", $string);
$len=count($str_arr);
$i=0;
while($i<$len){
    if(mysqli_query($conn,"DELETE FROM `cart` WHERE p_id='$str_arr[$i]' AND u_id={$_SESSION['uid']}"))
        $i++;
}




// if(mysqli_num_rows($result)>0){
//     mysqli_num_rows($result);
//     $row=mysqli_fetch_assoc($result);
//     $temp=$row['order_id'];
//     $oid= $temp[strlen($temp)-1];
//     $n_id=(int)$oid;
// }

?>