<?php
session_start();
$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt'); // valid extensions
$path = 'Upload/'; // upload directory

if(!empty($_POST['user_proof_type']) || !empty($_POST['user_proof_number']) || $_FILES['user_proof_pic'])
{
$img = $_FILES['user_proof_pic']['name'];
$tmp = $_FILES['user_proof_pic']['tmp_name'];

// get uploaded file's extension
$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
$date = date('dmyhis');
// can upload same image using rand function
$user_proof_pic = $date.$img;

// check's valid format
if(in_array($ext, $valid_extensions)) 
{ 
    $user_proof_pic = $path.strtolower($user_proof_pic); 

if(move_uploaded_file($tmp,$user_proof_pic)) 
{
$user_proof_type = $_POST['user_proof_type'];
$user_proof_number = $_POST['user_proof_number'];

//include database configuration file
include_once 'Includes/dbconn.php';
$uid=$_SESSION['uid'];
//insert form data in the database
$insert = mysqli_query($conn,"UPDATE `users` SET  `user_proof_type`='$user_proof_type',`user_proof_number`='$user_proof_number',`user_proof_pic`='$user_proof_pic' WHERE `user_id`='$uid'");

}
} 
else 
{
echo 'invalid';
}
}
?>