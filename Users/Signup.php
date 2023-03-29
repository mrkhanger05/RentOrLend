<?php
include('../Includes/Function.php');
session_start();
if(isset($_SESSION['user_signin']))
        header('location:../index.php');
//include database configuration file
include('../Includes/dbconn.php');
echo "Hello";
print_r($_POST);
if(isset($_POST["Signup"])){
        echo "SignUp Clicked";
    if(isset($_POST['Name']) && isset($_POST['Email']) && isset($_POST['Password']) && isset($_POST['CPassword'])){
                $Name=$_POST['Name'];
                $Email=$_POST['Email'];
                $Pwd=$_POST['Password'];
                echo "Data are not empty";

                if($_POST['Password'] !=$_POST['CPassword']){
                        echo "<script>alert('Both Password didn't matched');</script>";
                }


                if($_POST['Password'] ==$_POST['CPassword']){
                        $duplicate=mysqli_query($conn,"select * from users where user_email='$Email'");
                        $count=(mysqli_num_rows($duplicate));
                        if($count>0){
                                echo "Duplicate";
                                echo "<script>alert('Email Already registered');</script>";
                        }else{
                                $otp=rand(11111,99999);
                                // Example output: f4552671f8909587cf485ea990207f3b
                                //insert form data in the database
                                echo "Executing Query";

                                $q="INSERT INTO `users`(`user_fullname`, `user_email`, `user_password`,hashcode) VALUES ('$Name','$Email','$Pwd','$otp')";
                                if(mysqli_query($conn,$q)){
                                        // $to      = $Email; // Send email to our user
                                        // $subject = 'Signup | Verification'; // Give the email a subject 
                                        // $message = '
                                        
                                        // Thanks for signing up!
                                        // Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
                                        
                                        // ------------------------
                                        // Username: '.$Name.'
                                        // Password: '.$Pwd.'
                                        // ------------------------
                                        
                                        // Please Enter your otp as signup verification:
                                        // Your OTP is : '.$otp.'
                                        
                                        // '; // Our message above including the link
                                                        
                                        // $headers = 'From:noreply@rentorlendanything.com' . "\r\n"; // Set from headers
                                        // if(mail($to, $subject, $message, $headers)){
                                        //         $_SESSION['email']=$Email;
                                        //         $_SESSION["uid"] = GetUserID($Email);
                                        //         header('location:../CheckOTP.php');
                                        $_SESSION['email']=$Email;
                                        $_SESSION["uid"] = GetUserID($Email);
                                        $_SESSION['user_signin']=true;
                                        header('location:../Index.php');
                                        }

                                        
                                }
                               
                        }

                }
        }
   

?>
