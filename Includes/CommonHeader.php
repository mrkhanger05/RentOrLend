<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
<!-- Custom CSS -->
<link rel="stylesheet" href="CSS/Style.css">
    <link rel="stylesheet" href="CSS/Mediaquery.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="CSS/Profile.css" />
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script> -->
    <script src="JS/Main.js"></script>
    </head>
    <body>  
    <nav>
  <div class="brandLogo">
    <img src="Images/CompanyLogo.png" alt="Hello" style="width: 70px; height: 45px; background: none; border-radius: 50%; border: none;">
    <a href="index.php">RentOrLendAnything</a>
  </div>
  <!-- SideNavbar Starts Here -->
  <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <?php
    if (isset($_SESSION['user_signin']))
      echo '
              <a href="#">Hello <span id="UserName"></span></a>
              <a href="Profile.php">My Profile</a>';
    ?>
    <a href="#">About</a>
    <a href="#">Services</a>
    <a href="#">Careers</a>
    <a href="#">Contact</a>
    <a href="Users/Logout.php" onclick="signOut();" id="LogoutBtn"><i class="fas fa-sign-out-alt"></i>Logout</a>
  </div>
  <!-- SideNavbar Ends Here -->

  <div id="main">
    <span style="font-size: 1.78rem;;cursor:
            pointer" onclick="openNav()"><i class="fa fa-bars" aria-hidden="true"></i>
    </span>
  </div>
  <hr style="margin: 2px;">
  <a type="button" data-toggle="modal" data-target="#myModal"
            style="position: absolute; right: 40px; top: 10px;">
            <span class="bagcart bagca">
                <i class="fa fa-shopping-bag bagcar"></i>
                <span class="fa bagcar" style="color:white">
                    <span style="font-size:18px;">
                        15
                    </span>
                </span>
            </span></a>
  <?php
  if (isset($_SESSION['user_signin'])) {
    echo '
    <a  style="position: absolute; right: 70px; top: 10px; text-decoration: none;"><img src="" alt="UserPic" style="position: absolute; right: 5px; top: -3px; text-decoration: none; width:30px;height:30px; border-radius:50%;" id="Userpic"></img></a>
    <a href="Cart.php"
    style="position: absolute; right: 40px; top: 10px;">
    <span class="bagcart bagca">
        <i class="fa fa-shopping-bag bagcar"></i>
        <span class="fa bagcar" style="color:white">
            <span style="font-size:18px;" id="CartItemCount">
                15
            </span>
        </span>
    </span></a>         ';
  }
  ?>
  </div>
</nav>

