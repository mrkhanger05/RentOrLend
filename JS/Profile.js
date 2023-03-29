$(document).ready(function(e) {


// Function For Ajax of Document Verification
$("#form").on('submit',(function(e) {
    e.preventDefault();
    $.ajax({
           url: "DocumentVerification.php",
     type: "POST",
     data:  new FormData(this),
     contentType: false,
           cache: false,
     processData:false,
     beforeSend : function()
     {
      //$("#preview").fadeOut();
      $("#err").fadeOut();
     },
     success: function(data)
        {
      if(data=='invalid')
      {
       // invalid file format.
       $("#err").html("Invalid File !").fadeIn();
      }
      else
      {
       // view uploaded file.
       $("#preview").html(data).fadeIn();
       $("#form")[0].reset(); 
      }
        },
       error: function(e) 
        {
      $("#err").html(e).fadeIn();
        }          
      });
   }));

// Function For Update Account Detail
$('#GetAccountDetail').on('click', function() {
    var Account_Number = $('#Account_Number').val();
    var CAccount_Number = $('#CAccount_Number').val();
    var Account_IFSC = $('#Account_IFSC').val();
    var Account_Holder = $('#Account_Holder').val();
    
    console.log(Account_Number+CAccount_Number+Account_IFSC+
        Account_Holder);

        $.ajax({
            url: "Users/Login.php",
            type: "POST",
            data: {
                Account_Number: Account_Number,
                Account_IFSC:Account_IFSC,
                Account_Holder:Account_Holder,
                UpdateAccountDetail:"UpdateAccount"
              
            },
            success: function(dataResult) {
              var dataResult = JSON.parse(dataResult);
              console.log(dataResult);
              if (dataResult.statusCode == 200)
                    window.location.reload();
              else if (dataResult.statusCode == 201)
                        document.getElementById("LoginErrorMsg").style.display="block";
            }
          });
});

// Function For Update Primary Shipping Address
$('#Set_Pri_Add').on('click', function() {
    var Shipping1_Hno = $('#Shipping1_Hno').val();
    var Shipping1_Street = $('#Shipping1_Street').val();
    var Shipping1_Area = $('#Shipping1_Area').val();
    var Shipping1_Landmark = $('#Shipping1_Landmark').val();
    var Shipping1_City = $('#Shipping1_City').val();
    var Shipping1_State = $('#Shipping1_State').val();
    var Shipping1_Zipcode = $('#Shipping1_Zipcode').val();
    var PrimaryShippingAdd=Shipping1_Hno+","+Shipping1_Street+","+Shipping1_Area+","+Shipping1_Landmark+","+Shipping1_City+","+Shipping1_State+","+Shipping1_Zipcode;
    console.log(PrimaryShippingAdd);
    $.ajax({
        url: "Backend.php",
        type: "POST",
        data: {
            PrimaryShippingAdd: PrimaryShippingAdd,
            UpdatePrimaryShippingAdd:"UpdatePrimaryShippingAdd"
        },
        success: function(dataResult) {
          console.log(dataResult);
        }
      });

     
});
// Function For Update Secondary Shipping Address
$('#UpdateOtherShippingAdd').on('click', function() {
    var Shipping2_Hno = $('#Shipping2_Hno').val();
    var Shipping2_Street = $('#Shipping2_Street').val();
    var Shipping2_Area = $('#Shipping2_Area').val();
    var Shipping2_Landmark = $('#Shipping2_Landmark').val();
    var Shipping2_City = $('#Shipping2_City').val();
    var Shipping2_State = $('#Shipping2_State').val();
    var Shipping2_Zipcode = $('#Shipping2_Zipcode').val();
    var OtherShippingAdd=Shipping2_Hno+","+Shipping2_Street+","+Shipping2_Area+","+Shipping2_Landmark+","+Shipping2_City+","+Shipping2_State+","+Shipping2_Zipcode;
    console.log(OtherShippingAdd);
    $.ajax({
        url: "Backend.php",
        type: "POST",
        data: {
            OtherShippingAdd: OtherShippingAdd,
            UpdateOtherShippingAdd:"UpdateOtherShippingAdd"
        },
        success: function(dataResult) {
          console.log(dataResult);
        }
      });

     
});

// Function For Update User Gender
$('#UpdateBasicProfile').on('click', function() {
     var User_Gender = $('#User_Gender').val();
     $.ajax({
        url: "Backend.php",
        type: "POST",
        data: {
            User_Gender: User_Gender,
            UpdateGender:"UpdateGender"
        },
        success: function(dataResult) {
          console.log(dataResult);
        }
      });

     
});

// Function For Update User Conatct
$('#UpdateUserContact').on('click', function() {
    var User_Phone = $('#User_Phone').val();
    $.ajax({
       url: "Backend.php",
       type: "POST",
       data: {
        User_Phone: User_Phone,
           UpdateUserPhone:"UpdateUserPhone"
       },
       success: function(dataResult) {
         console.log(dataResult);
       }
     });

    
});

// Function For Update Pickup Address
$('#SetPickAdd').on('click', function() {
    console.log("Clicked");
    var Pick_Hno = $('#Pick_Hno').val();
    var Pick_Street = $('#Pick_Street').val();
    var Pick_Area = $('#Pick_Area').val();
    var Pick_Landmark = $('#Pick_Landmark').val();
    var Pick_City = $('#Pick_City').val();
    var Pick_State = $('#Pick_State').val();
    var Pick_Zipcode = $('#Pick_Zipcode').val();
    var PickupAdd=Pick_Hno+","+Pick_Street+","+Pick_Area+","+Pick_Landmark+","+Pick_City+","+Pick_State+","+Pick_Zipcode;
    
    
    console.log(Pick_Hno+","+Pick_Street+","+Pick_Area+","+Pick_Landmark+","+Pick_City+","+Pick_State+","+Pick_Zipcode);
    $.ajax({
        url: "Backend.php",
        type: "POST",
        data: {
            PickupAdd: PickupAdd,
            UpdatePickupAdd:"UpdatePickupAdd"
        },
        success: function(dataResult) {
          console.log(dataResult);
        }
      });
     
});


});

// Scrit for primary shipping address
function InputAddress1() {

    document.getElementById("Form2").style.display = "block"

}
function DeleteAddress1() {

    document.getElementById("myForm2").style.display = "none"

}
function closeForm2() {

    document.getElementById("Form2").style.display = "none"

}


// Script for other shipping address

function InputAddress() {

    document.getElementById("Edit-Address").style.display = "block"

}
function DeleteAddress() {

    document.getElementById("Oth-Address").style.display = "none"

}
function closeForm3() {

    document.getElementById("Edit-Address").style.display = "none"

}


// Script for ID section


function openForm4() {

    document.getElementById("Form4").style.display = "flex"

    if (document.getElementById("Form4").style.display = "flex") {

        (document.getElementById("myForm4").style.display = "none")

    }
}

function closeForm4() {
    document.getElementById("myForm4").style.display = "block"

    if (document.getElementById("myForm4").style.display = "block") {

        (document.getElementById("Form4").style.display = "none")

    }

}


// script for Contact info section -->

function openForm() {

    document.getElementById("Form").style.display = "flex"

    if (document.getElementById("Form").style.display = "flex") {

        (document.getElementById("myForm").style.display = "none")

    }
}

function closeForm() {
    document.getElementById("myForm").style.display = "block"

    if (document.getElementById("myForm").style.display = "block") {

        (document.getElementById("Form").style.display = "none")

    }

}

// Bank details info 
function openForm7() {

    document.getElementById("Form7").style.display = "flex"

    if (document.getElementById("Form7").style.display = "flex") {

        (document.getElementById("myForm7").style.display = "none")

    }
}

function closeForm7() {
    document.getElementById("myForm7").style.display = "block"

    if (document.getElementById("myForm7").style.display = "block") {

        (document.getElementById("Form7").style.display = "none")

    }

}

// Script for Change password

function openForm8() {

    document.getElementById("Form8").style.display = "flex"

    if (document.getElementById("Form8").style.display = "flex") {

        (document.getElementById("myForm8").style.display = "none")

    }
}

function closeForm8() {
    document.getElementById("myForm8").style.display = "block"

    if (document.getElementById("myForm8").style.display = "block") {

        (document.getElementById("Form8").style.display = "none")

    }

}
// script for About me section -->

function openForm1() {

    document.getElementById("Form1").style.display = "flex"

    if (document.getElementById("Form1").style.display = "flex") {

        (document.getElementById("myForm1").style.display = "none")

    }
}

function closeForm1() {
    document.getElementById("myForm1").style.display = "block"

    if (document.getElementById("myForm1").style.display = "block") {

        (document.getElementById("Form1").style.display = "none")

    }

}


// Script for item pickup address


function InputAddress6() {

    document.getElementById("Edit-Address6").style.display = "block"

}
function DeleteAddress6() {

    document.getElementById("PickUp-Address").style.display = "none"

}
function closeForm6() {

    document.getElementById("Edit-Address6").style.display = "none"

}
