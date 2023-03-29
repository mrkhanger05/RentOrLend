
<?php

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

if(isset($_POST["PostReview"])){
    $UserName=$_POST["UserName"];
    $UserEmail=$_POST["UserEmail"];
    $UserReview=$_POST["UserReview"];
    $UserPic=$_FILES["UserPic"]['name'];
    $tmp=$_FILES["UserPic"]['tmp_name'];
    $uploadTo = "Upload/"; 
    $imageQuality= 10;
    $final_image = rand(1000,1000000).$UserPic;
    $basename = basename($final_image);
    $originalPath = $uploadTo.$basename;
    $compressedImage = compress_image($tmp, $originalPath, $imageQuality);

    include('Includes/dbconn.php');
    //insert form data in the database
    if(mysqli_query($conn,"INSERT INTO `review`(`name`, `email`, `pic`, `msg`) VALUES ('$UserName','$UserEmail','$compressedImage','$UserReview')")){
    echo '<Script>alert("Data Inserted Successfully");</Script>';
    header('location:index.php');
  }

    
}
include('Includes/Header.php');
?>
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
<a class="navbar-brand" href="index.php"><img src="Images/CompanyLogo.png" alt="" style="width:100px; height:50px; border-radius:20px;"></a>
<a class="nav-link" href="index.php"><b><-Back To Home</b></a>
</nav>
<div class="row justify-content-center" style="background-color: black;">
<div class="col-6 " >
<form action="WriteReview.php" class="form-group" enctype="multipart/form-data" method="POST">
    <div class="form-group">
        <label for="UserName">Full Name</label>
        <input type="text" class="form-control" name="UserName" id="UserName" required>
    </div>
    <div class="form-group">
        <label for="UserEmail">Email</label>
        <input type="Email" class="form-control" name="UserEmail" id="UserEmail" required>
    </div>
    <div class="form-group">
        <label for="UserPic">Picture</label>
        <input type="file" class="form-control" name="UserPic" id="UserPic" required>
    </div>
    <div class="form-group">
        <label for="UserReview">Review</label>
        <textarea name="UserReview" class="form-control" id="UserReview" cols="30" rows="10" required></textarea>
    </div>
    <div>
        <input type="submit" value="Post" class="btn btn-outline-danger form-control" name="PostReview">
    </div>
</form>
</div>
</div>
