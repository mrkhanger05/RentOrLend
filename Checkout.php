<?php 
$title = "Checkout";
include('Includes/CommonHeader.php');
include('Includes/dbconn.php');
$Query1 = "Select * From users WHERE user_id='{$_SESSION['uid']}'";
$Result = mysqli_query($conn, $Query1);
$row = mysqli_fetch_assoc($Result);
?>

<div class="leftcon">
        <form action="submit">

            <div id="Checkoutform">

                <!-- About me section -->

                <div id="About-me">
                    <div class="email-phone">
                        <button id="Edit" class="open-button" onclick="openForm()">Edit</button>
                        <div id="myForm">
                            <h2 style="margin: 4px 0px;">ABOUT ME</h2>
                        <h3>Customer's Name</h3>
                        <p><?php 
                           
                        echo $row['user_fullname']; ?></p>
                        <p>Gender: <?php
                        if($row['user_gender']=="")
                         echo "Please Choose your Gender";
                         else
                         echo $row['user_gender'];
                          ?></p>
                        </div>
                        <div id="Form" style="display: none; flex-direction: column;">
                        <input type="tel" id="firstname" class="form-input" placeholder="Full Name" required="required" value="<?php echo $row['user_fullname']; ?>" disabled />
                        <select name="Gender" class="Gender" id="User_Gender">
                            <option value="Gender">Gender</option>
                            <option value="Others">Undefined</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>

                            <div class="Update-btn" style="display: flex;"><button type="button" class="btn-cancel"
                                    onclick="closeForm()">Close</button>
                                <button type="button" class="btn-cancel" onclick="closeForm()">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- My contact info -->

            <div id="my-contact-info">

<div class="email-phone">
    <button id="Edit1" class="open-button" onclick="openForm1()">Edit</button>
    <div id="myForm1">
        <h2>MY CONTACT INFO</h2>
        <h3>Email address:</h3>
        <p><?php echo $row['user_email']; ?></p>
        <h3>Phone-Number</h3>
        <p><?php 
         if($row['user_phone']=="")
         echo "Please Update your Mobile Number";
         else
         echo $row['user_phone'];
       ?></p>
    </div>
    <div id="Form1" style="display: none; flex-direction: column;">
        <input type="tel" id="User_Phone" class="form-input" placeholder="Phone-Number" value="<?php echo $row['user_phone']; ?>" />
        <input type="email" id="Email-address" class="form-input" placeholder="Email address" value="<?php echo $row['user_email']; ?>" disabled />

        <div class="Update-btn" style="display: flex;"><button type="button" class="btn-cancel" onclick="closeForm1()">Close</button>
            <button type="button" class="btn-cancel" onclick="closeForm1()" id="UpdateUserContact">Update</button>
        </div>
    </div>
</div>
</div>


            <div id="Id-proof" style="margin-left: 13%;">
                <div class="email-phone">
                <h2>2. ID PROOF <i class="fa fa-info-circle" aria-hidden="true"
                style="cursor: pointer;"></i></h2>
                    <input type="tel" id="firstname" class="form-input"
                    placeholder="Adhar Card/ DL/ Passport number" disabled value="<?php echo $row['user_proof_number']; ?>" />
                    <Label for="consent"> <br>
                        <input type="checkbox" id="hoooo" name="My Eligibilty">I give my <a
                        href="consent">
                        consent.</a></Label>
                    </div>
            </div>

            <!-- Shipping address -->

            <div id="Addresses">
                <div class="email-phone">
                    <div id="myForm2">
                        <h2>SHIPPING ADDRESS</h2>
                        <p> <B>ANIL KUMAR</B> <br> H.no 123, xyz street <br> Palwal, Haryana <br> 12345</p>
                        <a class="link" onclick="InputAddress1()"> Edit </a>
                        <a class="link" onclick="DeleteAddress1()"> Delete</a>
                    </div>

                    <div id="Form2" style="display: none; flex-direction: column;">
                        <div class="Address">
                            <div class="Address-name" style="display: flex;">
                                <input type="text" id="firstname" class="form-input" placeholder="First Name"
                                    required="required" />
                                <input type="text" id="lastname" class="form-input" placeholder="Last Name" />
                            </div>
                            <div class="Address-Apt" style="display: flex;">
                                <input type="text" id="Address" class="form-input" placeholder="Address"
                                    required="required" />
                                <input type="text" id="Apartment-num" class="form-input"
                                    placeholder="Apt/Bldg/H.no.(Optional)" required="required" />
                            </div>
                            <div class="City-zip" style="display: flex;">
                                <input type="text" id="City" class="form-input" placeholder="City"
                                    required="required" />
                                <input type="text" id="State" class="form-input" placeholder="State"
                                    required="required" />
                                <input type="text" id="Zip-code" class="form-input" placeholder="Zip-Code"
                                    required="required" />
                            </div>
                        </div>

                        <div class="Update-btn" style="display: flex;"><button type="button" class="btn-cancel"
                                onclick="closeForm2()">Close</button>
                            <button type="button" class="btn-cancel" onclick="closeForm2()">Update</button>
                        </div>
                    </div>

                </div>
            </div>

    </div>
    </form>
    </div>

    <div class="rightcon">
    <div class="review-bag">

    <h1>REVIEW BAG</h1>
    <p style="    padding: 10px; position: absolute; right: 4%; cursor: pointer;"><?php
                        $RESULT = mysqli_query($conn, "SELECT COUNT(*) AS `count` FROM cart WHERE `u_id`='{$_SESSION['uid']}'");
                        $row = mysqli_fetch_assoc($RESULT);
                        echo $row['count'];

                        ?><i
        class="fas fa-angle-down"></i> </p>


</div>

<section id="cart">
<?php
                    $Id = $_SESSION['uid'];
                    $sql = "SELECT * FROM `cart` INNER JOIN products ON products.product_id=cart.p_id INNER JOIN users ON users.user_id=cart.u_id WHERE u_id='$Id'";
                    $run = mysqli_query($conn, $sql);
                    $Total=0;
                    $ShippingCharge=40;
                    if (mysqli_num_rows($run) > 0) {

                        $Count = 1;
                        while ($data = mysqli_fetch_assoc($run)) {
                    ?>
<article class="product">

<div class="content">
    <header>
        <a class="remove">
            <img src="<?php echo $data['product_pic_1']; ?>" alt="">
        </a>
    </header>

    <h1><?php echo $data['product_name']; ?></h1>
    <div title="You have selected this product to be shipped in the color yellow." style="top: 0" class="color yellow"></div>
    <div style="top: 43px" class="type small">XXL</div>
    <span class="qts">Qty: <?php echo $data['days']; ?> days <br><?php echo $data['price']; ?>₹ </span>
    <div> <b>Shipping:</b> Standard shipping</div>
</div>
</article>
<?php
$Count++;
$Total+=(int)$data['price'];
}
}
?>

<article class="product">

    <div class="content">
        <h3 class="left">Subtotal <br>Taxes (5%) <br> Shipping <br> Order Total </h3>
        <h3 class="right" style="margin-right: 20px;"> <span>:<?php echo $Total; ?>₹ <br> :<?php echo ($Total*5)/100; ?>₹ <br> :<?php echo $ShippingCharge; ?>₹
                <br>
                :  <?php echo $Total+($Total*5)/100+$ShippingCharge; ?>₹ </span></h3>
                <span id="CheckoutPrice" style="display: none;"><?php echo $Total+($Total*5)/100+$ShippingCharge; ?></span>
    </div>
</article>
<a href="pay.php?CheckoutPrice=<?php echo $Total+($Total*5)/100+$ShippingCharge; ?>" style="background-color: black; color:white;padding:10px;margin-top:20px;" id="CheckoutBtn">Place Order</a>
</section>

</div>

</div>

</div>

</form>




    <!-- Profile Section Ends Here  -->
    
    <script src="JS/Profile.js"></script>
    <script src="JS/Main.js"></script>
    <script>
//         // Function For Update User Gender
//         $(document).ready(function(e) {
// $('#CheckoutBtn').on('click', function() {
//      var CheckoutPrice = $('#CheckoutPrice').text();
//      console.log(CheckoutPrice);
//      $.ajax({
//         url: "pay.php",
//         type: "POST",
//         data: {
//             CheckoutPrice: CheckoutPrice
//         }
       

     
// });
//         });
//     });
    </script>

