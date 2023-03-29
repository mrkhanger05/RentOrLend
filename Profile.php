<?php
$title = "My Profile";
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
                <h1 style="font-size: 2.4rem;">MY PROFILE <img src="<?php if ($row['user_profile_pic'] == "") echo "Images/UserLogo.png";
                                                                    else echo $row['user_profile_pic']; ?>" alt="USER PIC"> </h1>
                <div class="email-phone">
                    <button id="Edit" class="open-button" onclick="openForm()">Edit</button>
                    <div id="myForm">
                        <h2 style="margin: 4px 0px;">ABOUT ME</h2>
                        <h3>Customer's Name</h3>
                        <p><?php echo $row['user_fullname']; ?></p>
                        <p>Gender: <?php echo $row['user_gender']; ?></p>
                    </div>
                    <div id="Form" style="display: none; flex-direction: column;">
                        <?php


                        ?>
                        <input type="tel" id="firstname" class="form-input" placeholder="Full Name" required="required" value="<?php echo $row['user_fullname']; ?>" disabled />
                        <select name="Gender" class="Gender" id="User_Gender">
                            <option value="Gender">Gender</option>
                            <option value="Others">Undefined</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>

                        <div class="Update-btn" style="display: flex;"><button type="button" class="btn-cancel" onclick="closeForm()">Close</button>
                            <button type="button" class="btn-cancel" onclick="closeForm()" id="UpdateBasicProfile">Update</button>
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
                    <p><?php echo $row['user_phone']; ?></p>
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

        <!-- Shipping address -->

        <div id="Addresses">
            <div class="email-phone">
                <div id="myForm2">
                    <h2>SHIPPING ADDRESS</h2>
                    <h3>Primary Shipping Address</h3>
                    <p> <B><?php echo $row['user_fullname']; ?></B> <br> <?php echo $row['Shipping_Address1']; ?></p>
                    <a class="link" onclick="InputAddress1()"> Edit </a>
                    <a class="link" onclick="DeleteAddress1()"> Delete</a>
                </div>

                <div id="Form2" style="display: none; flex-direction: column;">
                    <div class="Address">
                        <div class="Address-name" style="display: flex;">
                            <input type="text" id="Shipping1_Hno" class="form-input" placeholder="House Number" required="required" />
                            <input type="text" id="Shipping1_Street" class="form-input" placeholder="Street" />
                        </div>
                        <div class="Address-Apt" style="display: flex;">
                            <input type="text" id="Shipping1_Area" class="form-input" placeholder="Area" required="required" />
                            <input type="text" id="Shipping1_Landmark" class="form-input" placeholder="Landmark(Optional)" />
                        </div>
                        <div class="City-zip" style="display: flex;">
                            <input type="text" id="Shipping1_City" class="form-input" placeholder="City" required="required" />
                            <input type="text" id="Shipping1_State" class="form-input" placeholder="State" required="required" />
                            <input type="text" id="Shipping1_Zipcode" class="form-input" placeholder="Zip-Code" required="required" />
                        </div>
                    </div>

                    <div class="Update-btn" style="display: flex;"><button type="button" class="btn-cancel" onclick="closeForm2()">Close</button>
                        <button type="button" class="btn-cancel" onclick="closeForm2()" id="Set_Pri_Add">Update</button>
                    </div>
                </div>

                <div id="Oth-Address">
                    <h3>Other Shipping Address</h3>
                    <p> <B><?php echo $row['user_fullname']; ?></B> <br> <?php echo $row['Shipping_Address2']; ?><br><br>
                        <b>Phone number: </b> 9876543210 <br>
                        <b>Email-address: </b> ancds@gmail.com
                    </p>
                    <a class="link" onclick="InputAddress()"> Edit </a>
                    <a class="link" onclick="DeleteAddress()"> Delete</a>
                </div>


                <div id="Edit-Address" class="Address" style="display: none;">
                <div class="Address-name" style="display: flex;">
                            <input type="text" id="Shipping2_Hno" class="form-input" placeholder="House Number" required="required" />
                            <input type="text" id="Shipping2_Street" class="form-input" placeholder="Street" />
                        </div>
                        <div class="Address-Apt" style="display: flex;">
                            <input type="text" id="Shipping2_Area" class="form-input" placeholder="Area" required="required" />
                            <input type="text" id="Shipping2_Landmark" class="form-input" placeholder="Landmark(Optional)" />
                        </div>
                        <div class="City-zip" style="display: flex;">
                            <input type="text" id="Shipping2_City" class="form-input" placeholder="City" required="required" />
                            <input type="text" id="Shipping2_State" class="form-input" placeholder="State" required="required" />
                            <input type="text" id="Shipping2_Zipcode" class="form-input" placeholder="Zip-Code" required="required" />
                        </div>
                    <div class="Update-btn" style="display: flex;"><button type="button" class="btn-cancel" onclick="closeForm3()">Close</button>
                        <button type="button" class="btn-cancel" onclick="closeForm3()" id="UpdateOtherShippingAdd">Update</button>
                    </div>
                </div>

            </div>
        </div>

        <!-- Change password -->

        <div id="Checkoutform">
            <div id="Password">
                <div class="email-phone">
                    <button id="Edit" class="open-button" onclick="openForm8()">Edit</button>
                    <div id="myForm8">
                        <h2 style="margin: 4px 0px;">CHANGE PASSWORD</h2>

                    </div>
                    <div id="Form8" style="display: none; flex-direction: column;">

                        <input type="password" id="old-password" class="form-input" placeholder="OLD PASSWORD" required="required" name="OldPwd" />
                        <input type="password" id="new-password" class="form-input" placeholder="NEW PASSWORD" required="required" name="NewPwd" />
                        <input type="password" id="confirm-password" class="form-input" placeholder="CONFIRM PASSWORD" required="required" name="Confirm_NewPwd" />
                        <p><input type="checkbox"> Show Password </p>
                        <div class="Update-btn" style="display: flex;"><button type="button" class="btn-cancel" onclick="closeForm8()">Close</button>
                            <button type="button" class="btn-cancel" onclick="closeForm8()">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</div>
</form>
</div>

<div class="rightcon">
    <!-- 
        <div class="review-bag">


        </div>
 -->

    <!-- Lendor details -->


    <!-- Id input -->

    <div id="Checkoutform">
        <div id="About-me">
            <h1 style="font-size: 2.4rem;">FOR LENDORS</h1>
            <div class="email-phone">
                <button id="Edit" class="open-button" onclick="openForm4()">Edit</button>
                <div id="myForm4">
                    <h2 style="margin: 4px 0px;">ID PROOF</h2>
                    <h3>Verified: <i class="fas fa-check"></i> <i class="fa fa-window-close" aria-hidden="true"></i>
                    </h3>
                </div>
                <div id="Form4" style="display: none; flex-direction: column;">
                    <form id="Proof_Form" action="DocumentVerification.php" method="post" enctype="multipart/form-data">
                        <select name="user_proof_type" id="user_proof_type" class="Gender">
                            <option value="Select">Select</option>
                            <option value="Aadhar Number">Aadhar Number</option>
                            <option value="Driving License">Driving License</option>
                            <option value="Electricity Bill">Electricity Bill</option>
                        </select>
                        <input type="tel" id="user_proof_number" name="user_proof_number" class="form-input" placeholder="Input Document Number" required="required" />
                        <p><input type="file" id="user_proof_pic" name="user_proof_pic" class="Gender" name="img" accept="image/*"> <i class="fa fa-info-circle" aria-hidden="true" style="cursor: pointer;"></i></p>

                        <div class="Update-btn" style="display: flex;"><button type="button" class="btn-cancel" onclick="closeForm4()">Close</button>
                            <button type="submit" class="btn-cancel" onclick="closeForm4()">Update</button>
                        </div>
                    </form>
                    <div id="err"></div>
                </div>
            </div>
        </div>
    </div>


    <!-- Bank details -->


    <div id="bank-details">
        <div class="email-phone">
            <button id="Edit7" class="open-button" onclick="openForm7()">Edit</button>
            <div id="myForm7">
                <h3>BANK DETAILS</h3>
                <p> <b>NAME: </b> ANIL RAWAT <br>
                    <b>ACCOUNT NUMBER: </b> xxxxxx1234 <br>
                    <b>IFSC: </b> ABCD0123456
                </p>
            </div>
            <div id="Form7" style="display: none; flex-direction: column;">
                <input type="text" id="Account_Number" class="form-input" placeholder="ACCOUNT NO." required="required" pattern="" />
                <input type="tel" id="CAccount_Number" class="form-input" placeholder="CONFIRM ACCOUNT NUMBER" required="required" />
                <input type="tel" id="Account_IFSC" class="form-input" style="text-transform: uppercase;" placeholder="IFSC" required="required" />
                <input type="email" id="Account_Holder" class="form-input" style="text-transform: uppercase;" placeholder="Name On Account" required="required" />

                <div class="Update-btn" style="display: flex;"><button type="button" class="btn-cancel" onclick="closeForm7()">Close</button>
                    <button type="button" class="btn-cancel" onclick="closeForm7()" id="GetAccountDetail">Update</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Pickup address -->

    <div id="Addresses">
        <div class="email-phone">

            <div id="PickUp-Address">
                <h3>ITEM PICKUP ADDRESS</h3>
                <p> <B><?php echo $row['user_fullname']; ?></B> <br> <?php echo $row['Pickup_Address']; ?><br><br>
                    <b>Phone number: </b> 9876543210 <br>
                    <b>Email-address: </b> ancds@gmail.com
                </p>
                <a class="link" onclick="InputAddress6()"> Edit </a>
                <a class="link" onclick="DeleteAddress6()"> Delete</a>
            </div>



            <div id="Edit-Address6" class="Address" style="display: none;">
                <div class="Address-name" style="display: flex;">
                    <input type="text" id="Pick_Hno" class="form-input" placeholder="House Number" required="required" />
                    <input type="text" id="Pick_Street" class="form-input" placeholder="Street" />
                </div>
                <div class="Address-Apt" style="display: flex;">
                    <input type="text" id="Pick_Area" class="form-input" placeholder="Area" required="required" />
                    <input type="text" id="Pick_Landmark" class="form-input" placeholder="Landmark(Optional)" />
                </div>
                <div class="City-zip" style="display: flex;">
                    <input type="text" id="Pick_City" class="form-input" placeholder="City" required="required" />
                    <input type="text" id="Pick_State" class="form-input" placeholder="State" required="required" />
                    <input type="text" id="Pick_Zipcode" class="form-input" placeholder="Zip-Code" required="required" />
                </div>
                <div class="Update-btn" style="display: flex;"><button type="button" class="btn-cancel" onclick="closeForm6()">Close</button>
                    <button type="button" class="btn-cancel" onclick="closeForm6()" id="SetPickAdd">Update</button>
                </div>
            </div>


        </div>
    </div>

</div>

</form>

</div>


<!-- Profile Section Ends Here  -->

<script src="JS/Profile.js"></script>
<script src="JS/Main.js"></script>