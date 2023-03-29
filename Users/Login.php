<?php
session_start();
include('../Includes/Function.php');
include('../Includes/dbconn.php');
if (isset($_SESSION['user_signin']))
        header('location:../index.php');
extract($_POST);
//When Login Request Comes
if ($_POST['Action'] == "Login") {
        $Email = $_POST['Email'];
        $Password = $_POST['Password'];
        $check = mysqli_query($conn, "SELECT * FROM `users` WHERE `user_email`='$Email' AND `user_password`='$Password' AND ustatus='1'");
        if (mysqli_num_rows($check) > 0) {
                $_SESSION['email'] = $Email;
                $_SESSION["user_signin"] = true;
                $_SESSION['uid']=GetUserID($Email);
                echo json_encode(array("statusCode" => 200));
        } else {
                echo json_encode(array("statusCode" => 201));
        }
        mysqli_close($conn);
}
