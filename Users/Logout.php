<?php
   session_start();
   $_SESSION["user_signin"]=false;
   session_destroy();
   header('location:../index.php');
?>