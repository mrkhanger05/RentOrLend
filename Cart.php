<?php
session_start();

  // echo "<pre>";
  // print_r($_SESSION);
  // echo "</pre>";

include('Includes/dbconn.php');
?>
<!DOCTYPE html>
<html>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>

<style>
body {
  background: #eee;
  margin: 0;
  padding: 0;
  overflow-x: hidden;
}

/* Navbar styling  */
.sidenav {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    right: 0;
    background-color: #111;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;
}

.sidenav a {
  padding: 12px 8px 8px 16px;
    font-size: 25px;
    color: #ffffff;
    display: block;
    transition: 0.3s
}

.sidenav a:hover, .offcanvas a:focus{
    color: #000000;
    background-color: white;
    transform: scale(1.1);
}

.sidenav .closebtn {
  position: absolute;
  top: 0;
  border: none;
  right: 10px;
  font-size: 30px;
}

.closebtn:hover{
  background-color: #000000;
}

#main {
  transition: margin-left .5s;
    position: absolute;
    padding: 0px;
    top: 0px;
    right: 2px;
}

@media screen and (max-height: 450px){
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}

.brandLogo{
  display: flex;
    align-items: center;
    background-color: white;
}
.brandLogo p{
    font-size: 14px;
    font-weight: bold;
    margin-top: 12px;
    margin-left: 3px;
}

/* Navbar styling end */

.Link1{
    font-size:18px;
    text-decoration:none;
    color: black;
    border:none;
    }
    .Link1:hover{
    font-size:20px;
    background-color:light;
    color:black;
    border-bottom:2px solid black;
    }
    .navbar{
        margin: 0px;
        padding: 0px;
    }
.clearfix {
  content: "";
  display: table;
  clear: both;  
}

#site-header, #site-footer {
  background: #fff;
}

#site-header {
  margin: 0 0 30px 0;
}

#site-header h1 {
  font-size: 31px;
  font-weight: 300;
  padding: 40px 0;
  position: relative;
  margin: 0;
}

a {
  color: #000;
  text-decoration: none;

  -webkit-transition: color .2s linear;
  -moz-transition: color .2s linear;
  -ms-transition: color .2s linear;
  -o-transition: color .2s linear;
  transition: color .2s linear;
}

a:hover {
  color: #53b5aa;
}

#site-header h1 span {
  color: #53b5aa;
}

#site-header h1 span.last-span {
  background: #fff;
  padding-right: 150px;
  position: absolute;
  left: 217px;

  transition: all .2s linear;
}

#site-header h1:hover span.last-span, #site-header h1 span.is-open {
  left: 363px;
}

#site-header h1 em {
  font-size: 16px;
  font-style: normal;
  vertical-align: middle;
}

.container1 {
  font-family: 'Open Sans', sans-serif;
  margin: 0 auto;
  width: 96%;
}

#cart {
  width: 100%;
}

#cart h1 {
  font-weight: 300;
}

#cart a {
  color: #000000;
  text-decoration: none;

  -webkit-transition: color .2s linear;
  -moz-transition: color .2s linear;
  -ms-transition: color .2s linear;
  -o-transition: color .2s linear;
  transition: color .2s linear;
}

#cart a:hover {
  color: #000;
}

.product.removed {
  margin-left: 980px !important;
  opacity: 0;
}

.product {
  border: 1px solid #eee;
  margin: 20px 0;
  width: 100%;
  height: 195px;
  position: relative;
  transition: margin .2s linear, opacity .2s linear;
}

.product:hover{

  transform: scale(1.005);
}

.product img {
  width: 100%;
  height: 100%;
}

.product header, .product .content {
  background-color: #fff;
  border: 1px solid #ccc;
  border-style: none none solid none;
  float: left;
}

.product header {
  background: #000;
  margin: 0 1% 20px 0;
  overflow: hidden;
  padding: 0;
  position: relative;
  width: 24%;
  height: 195px;
}

.product header:hover img {
  opacity: .7;
}

.product header:hover h3 {
  bottom: 73px;
}

.product header h3 {
  background: #53b5aa;
  color: #fff;
  font-size: 22px;
  font-weight: 300;
  line-height: 49px;
  margin: 0;
  padding: 0 30px;
  position: absolute;
  bottom: -50px;
  right: 0;
  left: 0;

  -webkit-transition: bottom .2s linear;
  -moz-transition: bottom .2s linear;
  -ms-transition: bottom .2s linear;
  -o-transition: bottom .2s linear;
  transition: bottom .2s linear;
}

.remove {
  cursor: pointer;
}

.product .content {
  box-sizing: border-box;
  -moz-box-sizing: border-box;
  height: 140px;
  padding: 0 20px;
  width: 75%;
}

.product h1 {
    color: white;
    background: black;
  font-size: 25px;
  font-weight: 300;
  margin: 17px 0 20px 0;
}

.product footer.content {
  height: 50px;
  margin: 6px 0 0 0;
  padding: 0;
}

.product footer .price {
  background: #fcfcfc;
  color: #000;
  float: right;
  font-size: 15px;
  font-weight: 300;
  line-height: 49px;
  margin: 0;
  padding: 0 30px;
}

.product footer .full-price {
  background: #000000;
  color: #fff;
  float: right;
  font-size: 22px;
  font-weight: 300;
  line-height: 49px;
  margin: 0;
  padding: 0 30px;

  -webkit-transition: margin .15s linear;
  -moz-transition: margin .15s linear;
  -ms-transition: margin .15s linear;
  -o-transition: margin .15s linear;
  transition: margin .15s linear;
}

.product footer .full-price:hover
{
    transform: scale(1.1);
}
.qt, .qt-plus, .qt-minus {
  display: block;
  float: left;
}

.qt {
  font-size: 19px;
  line-height: 50px;
  width: 70px;
  text-align: center;
}

.qt-plus, .qt-minus {
  background: #fcfcfc;
  border: none;
  font-size: 30px;
  font-weight: 300;
  height: 100%;
  padding: 0 20px;
  -webkit-transition: background .2s linear;
  -moz-transition: background .2s linear;
  -ms-transition: background .2s linear;
  -o-transition: background .2s linear;
  transition: background .2s linear;
}

.qt-plus:hover, .qt-minus:hover {
  background: #53b5aa;
  color: #fff;
  cursor: pointer;
}

.qt-plus {
  line-height: 50px;
}

.qt-minus {
  line-height: 47px;
}

#site-footer {
  margin: 30px 0 0 0;
}

#site-footer {
  padding-bottom: 12px;
    position: sticky;
    bottom: 0;
}

#site-footer h1 {
  background: #fcfcfc;
  border: 1px solid #ccc;
  border-style: none none solid none;
  font-size: 24px;
  font-weight: 300;
  margin: 0 0 7px 0;
  padding: 14px 40px;
  text-align: center;
}

#site-footer h2 {
  font-size: 24px;
  font-weight: 300;
  margin: 10px 0 0 0;
}

#site-footer h3 {
  font-size: 19px;
  font-weight: 300;
  margin: 15px 0;
}

.left {
  float: left;
}

.right {
  float: right;
}

.btn {
  background: black;
  border: 1px solid #999;
  border-style: none none solid none;
  cursor: pointer;
  display: block;
  font-size: 20px;
  padding: 16px 0;
  width: 290px;
  text-align: center;


  transition: all .2s linear;
}

.btn:hover {
  transform: scale(1.1);
  color: rgb(255, 255, 255);
  background: #000000;
}

.Backbtn{

  color: white;
   padding-right: 8px;
    height: 30px;
    background: black;
    width: auto;
    border: black;
    margin: 8px;
  
  transition: all .2s linear;
}
.Backbtn:hover{

  transform: scale(1.1);
  color: rgb(255, 255, 255);
  background: #000000;
}

</style>
  </header>


  <body>

    <body>

      <nav>
        <div class="brandLogo">
          <img src="Images/CompanyLogo.png" alt="Hello"
          style="width: 70px; height: 45px; background: none; border-radius: 50%; border: none;">
          <a href="index.php">RentOrLendAnything</a>
        </div>
      
          <div id="mySidenav" class="sidenav">
          <a href="javascript:void(0)"
          class="closebtn"
          onclick="closeNav()">&times;</a>
          
          <a href="#">About</a>
          <a href="#">Services</a>
          <a href="#">Careers</a>
          <a href="#">Contact</a>
          
          </div>
          
          <div id="main">
          
          <span style="font-size: 1.78rem;;cursor:
          pointer"
          
          onclick="openNav()"><i class="fa fa-bars" aria-hidden="true"></i>
          </span>
          
          </div>
          <hr style="margin: 2px;">
          
          <script>
          
          
          function openNav() {
           document.getElementById("mySidenav")
           .style.width="250px";
          
           document.getElementById("main")
           .style.marginLeft="250px";
          
           document.body.style.backgroundColor=
           "rgba(0,0,0,0.4)";
          
          }
          
          function closeNav() {
           document.getElementById("mySidenav")
           .style.width = "0";
          
           document.getElementById("main")
           .style.marginLeft= "0";
          
           document.body.style.backgroundColor =
           "white";
          
          }
          </script>
              <a type="button" data-toggle="modal" data-target="#myModal" style="position: absolute; right: 40px; top: 10px;"><i
            class="fa fa-shopping-bag" aria-hidden="true" style="font-size: 1.4rem;"></i></a>
        
          <a type="button" style="position: absolute; right: 70px; top: 10px; text-decoration: none;"><i class="fa fa-user"
            aria-hidden="true" style="font-size: 1.4rem;"></i></a>
        </div>
    

<a class="Backbtn" href="index.php"> <i class="fas fa-angle-double-left"></i>Back</a>

  <div class="container1">

    <section id="cart"> 
    <?php
      $Id = $_SESSION['uid'];
      $sql = "SELECT * FROM `cart` INNER JOIN products ON products.product_id=cart.p_id INNER JOIN users ON users.user_id=cart.u_id WHERE u_id='$Id'";
      $run = mysqli_query($conn, $sql);
      if (mysqli_num_rows($run) > 0) {

        $Count=1;
        while($data = mysqli_fetch_assoc($run)){
          ?>
          <article class="product">
        <header>
          <a class="remove"  >
            <img src="<?php echo $data['product_pic_1']; ?>" alt="">
            <?php
            echo "<h3><a href='Add_Remove_Cart_Item.php?Product_id={$data['product_id']}&Action=Remove' >Remove product</a></h3>";
            ?>
             
          </a>
        </header>

        <div class="content">
        <span id="PID<?php echo $Count; ?>" style=""><?php echo $data['p_id']; ?></span>
          <h1><?php echo $data['product_name']; ?></h1>

          <?php echo $data['product_description']; ?>

          <div title="You have selected this product to be shipped in the color yellow." style="top: 0" class="color yellow"></div>
          <div style="top: 43px" class="type small">XXL</div>
        </div>

        <footer class="content">
        <!-- <span class="qt-minus">-</span> -->
        <button type='button'  class='qt-minus UpdateRentDays' value= '<?php echo $Count; ?>'>-</button>
          <span  class="qt" id="RentingDays<?php echo $Count; ?>"><?php echo $data['days']; ?></span>
         <!--  <span class="qt-plus">+</span> -->
          <button type='button'  class='qt-plus UpdateRentDays' value= '<?php echo $Count; ?>'>+</button>
           <span class="full-price">
           
            <?php echo $data['price']; ?>₹
          </span>
            <span class="price">
          <?php echo $data['product_price']; ?>₹/day
          </span>
        <!--   <button type='button'  class='btn-outline-warning UpdateRentDays' value= '<?php echo $Count; ?>'>Add To cart</button> -->
            
         

        
        </footer>
      </article>

          <?php
          $Count++;
        }



        

    }?>





    </section>

  </div>

  

  <footer id="site-footer">
    <div class="container1 clearfix">

      <div class="left">
        <?php
         $sql = "SELECT sum(price) AS subtotal FROM `cart` INNER JOIN products ON products.product_id=cart.p_id INNER JOIN users ON users.user_id=cart.u_id WHERE u_id='$Id'";
      $run = mysqli_query($conn, $sql);

      if($row = mysqli_fetch_assoc($run)){
       $subtotal= $row['subtotal'];
      }
        ?>
        <h2 class="subtotal">Subtotal: <span> <?php echo $subtotal;?></span>₹</h2>
        <h3 class="tax">Taxes (5%): <span><?php echo ($subtotal*5)/100; ?></span>₹</h3>
        <h3 class="shipping">Shipping: <span><?php echo "40"; ?></span>₹</h3>
      </div>

      <div class="right">
        <h1 class="total">Total: <span><?php echo $subtotal+($subtotal*5)/100+40; ?></span>₹</h1>
        <a id="Checkout" class="btn" href="Checkout.php" name="save" style="color: white; font-weight: 400; border-radius: 1px;">Checkout</a>
      </div>

    </div>

    <script>
$(document).on('click', '.UpdateRentDays', function() {
    var id = $(this).val();
    var RendtingDays = $('#RentingDays' + id).text();
    var PID = $('#PID' + id).text();
    console.log(PID);
    var UpdateRentingDays = "UpdateRentingDays";

$.ajax({
  url: "Backend.php",
  type: 'POST',
  data: {
    RendtingDays: RendtingDays,
    PID: PID,
    UpdateRentingDays:UpdateRentingDays
  },
  success: function(Result) {
    console.log(Result);
    //window.location.reload();
  }
});
  
  });
        var check = false;

function changeVal(el) {
  var qt = parseFloat(el.parent().children(".qt").html());
  var price = parseFloat(el.parent().children(".price").html());
  var eq = Math.round(price * qt * 100) / 100;
  
  el.parent().children(".full-price").html( eq + "" );
  
  changeTotal();      
}

function changeTotal() {
  
  var price = 0;
  
  $(".full-price").each(function(index){
    price += parseFloat($(".full-price").eq(index).html());
  });
  
  price = Math.round(price * 100) / 100;
  var tax = Math.round(price * 0.05 * 100) / 100
  var shipping = parseFloat($(".shipping span").html());
  var fullPrice = Math.round((price + tax + shipping) *100) / 100;
  
  if(price == 0) {
    fullPrice = 0;
  }
  
  $(".subtotal span").html(price);
  $(".tax span").html(tax);
  $(".total span").html(fullPrice);
}

$(document).ready(function(){
  
  // $(".remove").click(function(){
  //   var el = $(this);
  //   el.parent().parent().addClass("removed");
  //   window.setTimeout(
  //     function(){
  //       el.parent().parent().slideUp('fast', function() { 
  //         el.parent().parent().remove(); 
  //         if($(".product").length == 0) {
  //           if(check) {
  //              $("#cart").html("<h1>Your order has been placed successfully!</h1><p> You will receive a confirmation email on your registered email address. Thank you!</p>");
  //           } else {
  //             // $("#cart").html("<h1>No products! Let's rent more</h1>");
  //           }
  //         }
  //         changeTotal(); 
  //       });
  //     }, 200);
  // });
  
  $(".qt-plus").click(function(){
    $(this).parent().children(".qt").html(parseInt($(this).parent().children(".qt").html()) + 5);
    
    $(this).parent().children(".full-price").addClass("added");
    
    var el = $(this);
    window.setTimeout(function(){el.parent().children(".full-price").removeClass("added"); changeVal(el);}, 150);
  });
  
  $(".qt-minus").click(function(){
    
    child = $(this).parent().children(".qt");
    
    if(parseInt(child.html()) > 1) {
      child.html(parseInt(child.html()) - 1);
    }
    
    $(this).parent().children(".full-price").addClass("minused");
    
    var el = $(this);
    window.setTimeout(function(){el.parent().children(".full-price").removeClass("minused"); changeVal(el);}, 150);
  });
  
  window.setTimeout(function(){$(".is-open").removeClass("is-open")}, 1200);
  
  $(".btn").click(function(){
    check = true;
    $(".remove").click();
  });
});
</script>



</body>
</html>