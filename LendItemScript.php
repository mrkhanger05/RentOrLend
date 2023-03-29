<?php
session_start();
include('Includes/Function.php');
  $Email = 'ni30.info@gmail.com';
  echo "<pre>";
  print_r($_POST);
  echo "</pre>";

function compress_image($tempPath, $originalPath, $imageQuality){

  // Get image info 
  $imgInfo = getimagesize($tempPath); 
  $mime = $imgInfo['mime']; 
   
  // Create a new image from file 
  switch($mime){ 
      case 'image/jpeg': 
          $image = imagecreatefromjpeg($tempPath); 
          break; 
      case 'image/png': 
          $image = imagecreatefrompng($tempPath); 
          break; 
      case 'image/gif': 
          $image = imagecreatefromgif($tempPath); 
          break; 
      default: 
          $image = imagecreatefromjpeg($tempPath); 
  } 
   
  // Save image 
  imagejpeg($image, $originalPath,$imageQuality);    
  // Return compressed image 
  return $originalPath; 

}


if(isset($_POST["UploadItem"])){
  $uploadTo = "Upload/"; 
  $allowImageExt = array('jpg','png','jpeg','gif');
  $img1 = $_FILES['Product_Picture_1']['name'];
  $tmp1 = $_FILES['Product_Picture_1']['tmp_name'];
  $img2 = $_FILES['Product_Picture_2']['name'];
  $tmp2 = $_FILES['Product_Picture_2']['tmp_name'];
  $img3 = $_FILES['Product_Picture_3']['name'];
  $tmp3 = $_FILES['Product_Picture_3']['tmp_name'];
  $imageQuality= 10;
  $date = date('dmyhis');
  $final_image1 = $date.$img1;
  $final_image2 = $date.$img2;
  $final_image3 = $date.$img3;
  $basename1 = basename($final_image1);
  $basename2 = basename($final_image2);
  $basename3 = basename($final_image3);


  $originalPath1 = $uploadTo.$basename1; 
  $originalPath2 = $uploadTo.$basename2; 
  $originalPath3 = $uploadTo.$basename3; 


   // get uploaded file's extension
   $ext1 =pathinfo($originalPath1, PATHINFO_EXTENSION);
   $ext2 =pathinfo($originalPath2, PATHINFO_EXTENSION);
   $ext3 =pathinfo($originalPath3, PATHINFO_EXTENSION);

  if(empty($final_image1) || empty($final_image2) || empty($final_image3) ){ 
     $error="Please Select files..";
     return $error;
   
   }else{
 
  if(in_array($ext1, $allowImageExt) && in_array($ext2, $allowImageExt) && in_array($ext3, $allowImageExt) ){ 

  $compressedImage1 = compress_image($tmp1, $originalPath1, $imageQuality);
  $compressedImage2 = compress_image($tmp2, $originalPath2, $imageQuality);
  $compressedImage3 = compress_image($tmp3, $originalPath3, $imageQuality);
 
  if (!empty($_POST['P_Categories']) || !empty($_POST['P_Name']) || !empty($_POST['P_Age']) || !empty($_POST['P_Price']) || !empty($_POST['P_Description'])) {
 
      $P_Cat = $_POST['P_Categories'];
      $P_Name = $_POST['P_Name'];
      $P_Age = $_POST['P_Age'];
      $P_Price = $_POST['P_Price'];
      $P_Description = $_POST['P_Description'];
      $Item_City= $_POST['Item_City'];
      $reqid = $_POST['req_id'];
      // if(isset($_POST["req_id"])){
      //   $reqid = $_POST['req_id'];
      // }
      
      $User_Id = GetUserID($Email);
      echo "Category :".$P_Cat." Name: ".$P_Name." Age : ".$P_Age." Price : ".$P_Price." Description :".$P_Description." UserID : ".$User_Id." CityID : ".$Item_City;
      //include database configuration file
      include('Includes/dbconn.php');
      //insert form data in the database
      
      $sql="INSERT INTO `products`(`product_cat_id`, `user_id`, `product_name`, `product_age`, `product_price`, `product_description`, `item_city`, `product_pic_1`, `product_pic_2`, `product_pic_3`,`product_status`, `req_id`) VALUES ('$P_Cat','$User_Id','$P_Name','$P_Age','$P_Price','$P_Description', '$Item_City','$compressedImage1','$compressedImage2','$compressedImage3','Available','$reqid')";
      if(mysqli_query($conn,$sql)){
        // RequestMail($reqid);
        echo '<Script>alert("Data Inserted Successfully");</Script>';
        header('location:index.php');
      }
     
    }
}
   }
  }
?>


