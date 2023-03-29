<?php
//File For Google API Configuration
include('config.php');
//File For Some Important Function
include('Includes/Function.php');
// File for Header Of File
include('Includes/IndexHeader.php');
// File For Establish DB Connection
include('Includes/dbconn.php');
 
//Execute When User Gets Login
if (isset($_GET["code"])) {
  $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

  if (!isset($token['error'])) {
    $google_client->setAccessToken($token['access_token']);
    $_SESSION['access_token'] = $token['access_token'];

    $google_service = new Google_Service_Oauth2($google_client);
    $data = $google_service->userinfo->get();
    $_SESSION['user_email'] = $data['email'];
    $_SESSION['gid'] = $data['id'];
    $_SESSION['name'] = $data['name'];
    $_SESSION['user_image'] = $data['picture'];
    $_SESSION['login_button'] = false;
  }
}


if (isset($_SESSION['login_button'])) {
  $login_button = $_SESSION['login_button'];
} else {
  $login_button = true;
}
?>

<!-- Navbar Starts Here -->
<nav>
  <div class="brandLogo">
    <img src="Images/CompanyLogo.png" alt="Hello" style="width: 70px; height: 45px; background: none; border-radius: 50%; border: none;">
    <p>RentOrLendAnything</p>
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
    <?php
    if (isset($_SESSION['user_signin']))
      echo '<a href="Users/Logout.php" onclick="signOut();" id="LogoutBtn"><i class="fas fa-sign-out-alt"></i>Logout</a>
              ';
    ?>
  </div>
  <!-- SideNavbar Ends Here -->

  <div id="main">
    <span style="font-size: 1.78rem;;cursor:
			pointer" onclick="openNav()"><i class="fa fa-bars" aria-hidden="true"></i>
    </span>
  </div>
  <hr style="margin: 2px;">
  

  
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
  } else
    echo '<a type="button"  style="position: absolute; right: 70px; top: 12px; text-decoration: none;" onclick="LoginForm()"><i class="fa fa-user"
              aria-hidden="true" style="font-size: 1.3rem;"></i></a>
              <a type="button" style="position: absolute; right: 40px; top: 10px;" onclick="LoginForm()"><i class="fa fa-shopping-bag" aria-hidden="true" style="font-size: 1.4rem;"></i><span class="badge badge-secondary" style="margin: 0px -6px; background-color: transparent;" id="CartItemCount"></span></a>';

  ?>
  </div>
</nav>
<!-- Navbar Ends Here -->

<!-- Login Popup Starts Here -->
<div id="Loginid"  class="LoginForm animate" style="display: none; 
        box-shadow: rgba(0, 0, 0, 0.58) 6px 10px 20px 0px;;">
            <i type="button" class="far fa-times-circle" onclick="CloseLogin()" style="font-size:30px; cursor:pointer; float: right; padding-top: 10px; color: black; cursor: poiter;"></i>
            <br>

            <!-- Change in tags i.e h2 replaced with h4/h3 -->

            <h5 >RentOrLendAnything.com</h5>
            <h2>Sign in</h2>
            <h5>New User? <a href="#" onclick="OpenSignUp()">Create an account</a> </h5>

            <!-- Removed label tag from the input because that was causing the difference in spacing  -->

            <div >
                <input type="email" class="element" id="UEmail" name="UEmail" placeholder="Enter Your Registred Email" required>
            </div>
            <div >
                <input type="password" id="UPassword" class="element" name="UPassword" placeholder="Enter Your Password" required>
            </div>
            <p id="LoginErrorMsg" style = "width: 280px; display:none;"><i class="fas fa-exclamation" style = "color: red;"></i> Invalid Username and Password </p>
            <div id="checkbox">
                <input type="checkbox" id="Address" name="CurrentAddress"> Keep me Signed in <br>
            </div>
            <div>
                <div class="Signbtn">
                    <button type="submit" name="GetLogin" id="GetLogin" onclick="SignInUp()">
                        Sign in
                    </button>
                </div>
               <strong> _______Or Sign in with_______ </strong>
               <br>
               <?php
        if ($login_button) {
        ?>
          <a href="<?= $google_client->createAuthUrl() ?>" ><i class="fab fa-google" style="font-size:35px; color: black; cursor:pointer;"></i></a>
        <?php
        } else {
          if (!isset($_SESSION['user_signin'])) {
            $name = $_SESSION["name"];
            $email = $_SESSION["user_email"];
            $user_pic = $_SESSION["user_image"];
            $user_id = (string)$_SESSION["gid"];
            $duplicate = mysqli_query($conn, "select * from users where user_email='{$email}'");
            $count = (mysqli_num_rows($duplicate));
            if ($count > 0) {
              echo '<script>alert("Email ID Already registered");</script>';
              $row = mysqli_fetch_assoc($duplicate);
              $_SESSION['uid'] = $row['user_id'];
              $_SESSION['email'] = $email;
              $_SESSION["user_signin"] = true;
              echo '<script>location.reload();</script>';
            } else {
              if (mysqli_query($conn, "INSERT INTO users(google_uid,user_fullname,user_email,user_profile_pic) VALUES('$user_id','$name','$email','$user_pic')")) {
                $_SESSION['email'] = $email;
                $_SESSION["user_signin"] = true;
                $_SESSION["uid"] = GetUserID($_SESSION['email']);
                echo '<script>location.reload();</script>';
              }
            }
          }

        ?>
          <div class="panel panel-default">
            <div class="panel-heading">Welcome User</div>
            <div class="panel-body">
              <img src="<?= $_SESSION['user_image'] ?>" class="img-responsive img-circle img-thumbnail" />
              <h3><b>Name :</b><?= $_SESSION['user_first_name'] ?> <?= $_SESSION['user_last_name'] ?></h3>
              <h3><b>Email :</b> <?= $_SESSION['user_email_address'] ?> </h3>
              <h3><a href="logout.php">Logout</h3>
            </div>
            <div align="center"></div>
          </div>
        <?php
        }
        ?>
                
                <br>
                <br>

            </div>

        </div>
<!-- Login Popup Ends Here -->

<!-- Signup Popup Starts Here -->
<div id="SignUp">
            <div id="SignUp-btn" style="display: none; 
        box-shadow: rgba(0, 0, 0, 0.58) 6px 10px 20px 0px;" class="LoginForm">
                <i type="button" class="far fa-times-circle" onclick="CloseSignUp()" style="font-size:30px; cursor:pointer; float: right; padding-top: 10px; color: black;"></i>
                <br>
                <h5>RentOrLendAnything.com</h5>
                <h2>Sign Up</h2>

                <h5>Already a user? <a href="#home" onclick="OpenLoginForm()">Sign in</a> </h5>
                <form action="Users/Signup.php"  method="post">
                <div class=""> 
                    <input type="text" id="Name"  class="element" name="Name" placeholder="Enter Your Full Name" required>
                </div>
                
                <div class=""> 
                    <input type="email" id="Email" class="element" name="Email" placeholder="Enter Your Email" required>
                </div>
                <div class="">
                    <input type="number and text" class="element" id="Password"  placeholder="Enter Your Password" name="Password"
                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                </div>
                <div class="">
                    <input type="number and text" class="element" id="CPassword" placeholder="Confirm Your Password" name="CPassword"
                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                </div>
                <div id="checkbox">
                    <input type="checkbox" id="Address" name="CurrentAddress"> Keep me Signed in <br>
                </div>
                <div>
                    <div class="Signbtn">
                
                        <button type="submit"  name="Signup" value="Signup">
                            Sign up
                        </button>
                    </div>
                </form>
                    <strong>_______Or Sign in with_______ </strong>  <br>
                    <i class="fab fa-google" style="font-size:35px; cursor:pointer;"></i>
                    <br>
                    <br>
                </div>
            </div>
            
<!-- Signup Popup Ends Here -->

<!-- Id = Blur given to entire section apart from header to make the content blurry -->

<div id="blur">
<!-- RentOrLendAnything Banner -->
  <section>
    <div class="banner">
      <div class="overlay">
        <div class="bannerHeading">
          RentOrLendAnything
        </div>
        <div class="bannerDesc">
          Welcome to our platform RentOrLendAnything.com. Here you can rent or lend anything that you want just in few
          clicks.
        </div>

  </section>
  <!-- RentOrLendAnything Banner -->


<!-- Product Category Section Starts Here -->


<section class="category">
  <div class="container-fluid">
    <div class="row">
      <?php
      include('Includes/dbconn.php');
      $RESULT = mysqli_query($conn, "SELECT * FROM product_categories");
      while ($row = mysqli_fetch_array($RESULT)) {
        echo '
                        <div class="col-lg-2 col-3 col-md-2 col-sm-2">
                            <button type="button" class="btn btn-light">
                                <i class="' . $row['cat_icon'] . '"></i>
                            </button><br>
                            <label class="h5 mt-3">' . $row['cat_name'] . '</label>
                        </div>';
      } ?>
    </div>
  </div>
</section>
<!--Product Category Section Starts Here   -->



<!-- Tab links -->
<div class="tab">
  <button class="tablinks" onclick="openRequests(event, 'Rent')" id="RentOpen">Rent</button>
  <button class="tablinks" onclick="openRequests(event, 'Requests')">Requests</button>
  <button class="tablinks" onclick="openRequests(event, 'Lend')">Lend</button>
</div>
<div class="RaiseReq" style= "display: block;">

      <button id="Raise-Req-btn" class= "btn-cart" onclick="RequestForm()"> <i class="fas fa-hand-sparkles"></i> Raise Request </button>

</div>


<div id="RIR"  class="LoginForm animate" style="display: none">
            <i type="button" class="far fa-times-circle" onclick="CloseForm()" style="font-size:30px; cursor:pointer; float: right; padding-top: 10px; color: black; cursor: poiter;"></i>
            <br>

            <!-- Change in tags i.e h2 replaced with h4/h3 -->

            <h5 >RentOrLendAnything.com</h5>
            <h2>Raise Item Request</h2>

            <!-- Removed label tag from the input because that was causing the difference in spacing  -->

            <div >
                <input type="email" class="element" name="myEmail" id="raise_item_name" placeholder="Item Name">
            </div>
            <div >
                <input type="number and text" class="element" id="raise_no_of_days" name="My number" placeholder="Number Of Days To Rent">
            </div>
            <div >
                <textarea name="Description" class="element" id="raise_product_desc" cols="30" rows="3"  placeholder= "Product Description" ></textarea>
            </div>
            <div class="Update-btn" style="display: flex;margin-left: 20px;"><button type="button" class="btn-cancel"
                            onclick="CloseForm()">Close</button>
                        <button type="button" class="btn-cancel RaiseRequest">Raise</button>
                    </div>
                <br>
                <br>

            </div>

        </div>
        
      <script>

        
 function RequestForm()
{
    document.getElementById("RIR").style.display ="block"
}

function CloseForm() {
    
    document.getElementById("RIR").style.display = "none"
}

      </script>

<!-- Tab content -->
<div id="Rent" class="tabcontent">
  <div class="products">
    <div class="product-items" id="ShowProducts">
       
     
    </div>
  </div>

<button id="ShowPrev">Prev</button>
<button id="ShowNext">Next</button>
</div>

<div id="Requests" class="tabcontent">
  <h1>Rent</h1>
  <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Item Name</th>
      <th scope="col">No Of Days</th>
      <th scope="col">Item Description</th>
      <th> </Th>
    </tr>
  </thead>
  <tbody>
  <?PHP
 

$sql = "SELECT * FROM itemrequest";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  $i=0;

  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    // echo "id: " . $row["item_name"]. " - Name: " . $row["no_of_days"]. " " . $row["Item_Description"]. "<br>";
    ?>

 

    <tr>
      <th scope="row" class="myClass" id="request_id<?php echo $i;?>" ><?php echo  $row["id"];?></th>
      <td><?php echo  $row["item_name"];?></td>
      <td><?php echo $row["no_of_days"];?></td>
      <td><?php  echo $row["Item_Description"];?></td>
       <td> <button  class='fullfillreq' value="<?php echo  $row["id"];?>">Full fill Request</button></td>
    </tr>
    
    
  
<?php
$i++;
 }

} else {
  echo "0 results";
}

?>
</tbody>
</table>

</div>
<div id="Lend" class="tabcontent">
  <?php
  if (isset($_SESSION["user_signin"]))
    include('LendItem.php');
  else
    echo '<div class="row justify-content-center"><h2 class="">Currently You are not logged in.<button type="button" class="btn btn-outline-danger" data-dismiss="modal" data-toggle="modal" data-target="#LoginModal" id="LoginBtn">Login Required</button></h2></div>';
  ?>
</div>

<!-- Script for tabs -->

<script>
  function openRequests(evt, ReqRen) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(ReqRen).style.display = "block";
    evt.currentTarget.className += " active";
  }
  document.getElementById("RentOpen").click()
</script>

<!-- Script for tabs end here -->

<style type="text/css">
      .HC-name h2{
        display: block; 
        color: #000000;
        float: right; 
        margin: 10px; 
        font-size: 1.7rem;
        display: block;
        float: right;
        margin: -53px 8px 12px 0px;
    
    }
</style>

<!-- happy customer -->
  <div class="HC-Card-Container">
<?php
// Check connection
 

$sql = "SELECT * FROM `review`";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {

  

  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    ?>
 
 
  

   
    <div class="HC-Container">

        <div class="HC-Img" style="display: block;">
            <img src="<?php echo $row['pic'];?>" alt="">

           <div class="HC-name"><h2> <?php echo  $row["name"];?> </h2></div> 
            <div class="HC-rating" style="margin-bottom: -14px;">
                <span><i class="fas fa-star"></i></span>
                <span><i class="fas fa-star"></i></span>
                <span><i class="fas fa-star"></i></span>
                <span><i class="fas fa-star"></i></span>
                <span><i class="fas fa-star"></i></span>
            </div> 
        </div>

        <div class="HC-content">
             <?php echo $row['msg']; ?>
        </div>

    </div>


<?php

 }
} else {
  echo "0 results";
}
?>

</div>


<!-- Form For Write Review -->
<h2 class="mt-3 ml-4 font-weight-bold Feedback"><i class="fas fa-smile-beam " style= "font-size: 30px;"></i>Share your Feedback &nbsp;<button type="button" class="btn btn-dark" onclick="FB_Form_Togle()"><i class="fas fa-plus"></i></button> </h2>
<div id="myDIV" style="display: none; color:black;">
<div class="conatiner-fluid p-4"  style="background-color: black;color:white;">
  <div class="container">
    <form action="WriteReview.php" class="form-group" enctype="multipart/form-data" method="POST">

      <label for="UserName">Full Name</label>
      <input type="text" class="form-control" name="UserName" id="UserName" required>

      <label for="UserEmail">Email</label>
      <input type="Email" class="form-control" name="UserEmail" id="UserEmail" required>

      <label for="UserPic">Picture</label>
      <input type="file" class="form-control" name="UserPic" id="UserPic" required>

      <label for="UserReview">Review</label>
      <textarea name="UserReview" class="form-control" id="UserReview" cols="30" rows="10" required></textarea>
      <input type="submit" value="Post" class="btn btn-outline-danger form-control mt-2" name="PostReview">

    </form>
  </div>

</div>
</div>












<!-- HOW WE WORK SECTION -->
<section class="container" style="margin-top: 60px;">

  <div class="row">
    <div class="col-lg-6 col-md-6">
      <p class="h1 font-weight-bold text-center">How We Work</p>
      <p>
 Welcome to our platform RentOrLendAnything.com. Here you can lend or rent anything that you want. If you want to lend anything. Click on our lend tab. Fill the lending form and boom! Your item is listed on our website for thousands of renters out there! <b>&#128512;</b>
      </p>
    </div>
    <div class="col-lg-6 col-md-6">


<iframe width="100%" height="315" src="https://www.youtube.com/embed/qZDAANcD4cY" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>



    </div>
  </div>
</section>
<!-- how we work section end -->
<Br>
<br>
<!-- Contact us section -->

<section class="container-fluid contactsection">
  <div class="row" style="background-color: black;">
    <div class="col-lg-9 col-sm-12"><br><br>
      <h1 class="font-weight-bold textwhite" style="font-size: 3.85rem;">Contact Us </h1>
    </div>
    <div class="col-lg-3 col-sm-12">
      <address class="textwhite">
        <br>
        <i class="fa fa-map-marker" aria-hidden="true" style="font-size: 34px;"></i> &#160;&#160;SGM Nagar,NIT Faridabad<br><br>
        <i class="fas fa-phone-square-alt fa-2x"></i> &nbsp;&#160;&#160;(+91) 8607 265 253<br><br>
        <i class="fa fa-mobile" aria-hidden="true" style="font-size: 30px;"></i>&nbsp;&#160;&#160;(+91) 8607 265 253 <br><br>

      </address>
    </div>
  </div>
  <form>
    <div class="row " style=" background-color: black;">
      <div class="col-lg-3 col-sm-12">
        <input type="text" class="form-control" placeholder="Name :" name="FB_Uname" id="FB_Uname">
      </div>
      <br>
      <div class="col-lg-9 col-sm-12">
        <input type="text" class="form-control inputemail" placeholder="Email Address:" name="FB_Uemail" id="FB_Uemail">
      </div>
      <div class="form-group col-lg-12 col-sm-12 mt-2">

        <textarea class="form-control mt-3" id="FB_Umessage" rows="3" placeholder="Write Your message here" name="FB_Umessage"></textarea>
        <input type="button" name="save" class="btn btn-light btn-lg btn-block col-lg-12 col-sm-12  font-weight-bold mb-3 mt-3" value="Submit" id="ContactUS">
      </div>

    </div>
  </form>



</section>
<!--  CONTACT US SECTION END -->
<br>
<br>
<br>


<!-- ABOUT EYLOR SECTION  START-->

<section class="container">
  <div class="row">
    <div class="col-lg-5 col-sm-12 text-center">
      <ul class="list-unstyled">
        <li class="h2 font-weight-bold  text-left">Eylor Enlisting Private Ltd.</li><br>

        <li class="h5 text-left"> H.no 2370 'b' bloack 22 feet road<br></li>
        <li class="h5 text-left ">SGM Nagar,NIT Faridabad<br></li>
        <li class="h5 text-left">Faridabad, 121001<br></li>
        <li class="h5 text-left">admin@rentorlendanything.com
        </li>


      </ul><br>
      <br>

      <span><i class="fab fa-facebook fa-3x mr-5"></i></span>
      <span><i class="fab fa-twitter fa-3x mr-5"></i></span>
      <span><i class="fab fa-youtube fa-3x mr-5"></i></span>
      <span><i class="fab fa-linkedin-in fa-3x mr-5"></i></span>

    </div>
    <div class="col-lg-7 col-sm-12 text-center">

      <br>
      <p class="h2 font-weight-bold ">Explore RentOrLendAnything</p><br>
      <div class="row">
        <div class="col-lg-4 col-6">
          <span class="h5 mb-2 text-left"> <a href="https://www.rentorlendanything.com" target="_blank">About us</a>
 </span><br><br>
          <span class="h5 mb-2 text-left"><a href="https://www.rentorlendanything.com" target="_blank">Customer Service</span><br><br>
          <span class="h5 mb-2  text-left"><a href="https://www.rentorlendanything.com" target="_blank">Privacy & Security</span><br> <br>
          <span class="h5"><a href="https://www.rentorlendanything.com" target="_blank">pricing</span><br><br>
        </div>
        <div class="col-lg-4 col-6">
          <span class="h5 text-left"><a href="https://www.rentorlendanything.com" target="_blank">Our Team </span><br><br>
          <span class="h5 text-left"><a href="https://www.rentorlendanything.com" target="_blank">Carrier</span><br><br>
          <span class="h5 text-left"><a href="https://www.rentorlendanything.com" target="_blank">Why Us</span><br><br>
          <span class="h5 text-left"><a href="https://www.rentorlendanything.com" target="_blank">FAQS</span><Br><br>

        </div>
        <div class="col-lg-4 col-6">
          <span class="h5"><a href="https://www.rentorlendanything.com" target="_blank">News</span><br><br>
          <span class="h5"><a href="https://www.rentorlendanything.com" target="_blank">Vlogs</span><br><br>
          <span class="h5"><a href="https://www.rentorlendanything.com" target="_blank">Videos</span><Br><br>
          <SPAN class="h5"><a href="https://www.rentorlendanything.com" target="_blank">FAQS</SPAN><br>

        </div>
      </div>


    </div>

  </div>
</section>
<br>
<br>
<br>
<br>
<br>
</div>
<!--EYLOR SECTION END  -->





<!-- Includes Footer -->
<?php
include('Includes/Footer.php');
?>

<script type="text/javascript">
  $(document).on('click', '.RaiseRequest', function() {
  //var id = $(this).val();
  console.log("you click on raise")
 // var PID = $('#ProductId' + id).text();
  var RaiseRequest = "RaiseRequest";
    var raise_product_desc= $('#raise_product_desc' ).val();
    var raise_item_name =$('#raise_item_name').val();
    var raise_no_of_days=$('#raise_no_of_days').val();
 
  console.log( raise_product_desc,raise_item_name ,raise_no_of_days);
   $.ajax({
    url: "Backend.php",
    type: 'POST',
    data: {
      RaiseRequest: RaiseRequest,
      raise_item_name: raise_item_name,
      raise_product_desc:raise_product_desc,
      raise_no_of_days:raise_no_of_days
    },
    success: function(Result) {
      console.log("Result"+Result);
       alert(Result);
       window.reload();

    }
  });
      
});
    $(document).on('click', '.fullfillreq', function() {
        
  var id = $(this).val();
  console.log(id);
 openRequests(event, 'Lend');


  console.log("you click on full fill Request");
 // var request_id=$('#request_id').text();
  //console.log(request_id);
 // var PID = $('#ProductId' + id).text();
 $('#req_id').val(id);
   
   
      
});
</script>