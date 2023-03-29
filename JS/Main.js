// Used For Pointing Start Product
var Start=0;
// Used For Pointing End Product
var End=4;
// Used For Maintain Product Count
var ProductCount=0;


// Function For Add to cart
$(document).on('click', '.AddToCart', function() {
  var id = $(this).val();
  var PID = $('#ProductId' + id).text();
  var AddToCart = "AddToCart";
  console.log(PID);
  $.ajax({
    url: "Backend.php",
    type: 'POST',
    data: {
      AddToCart: AddToCart,
      PID: PID
    },
    success: function(Result) {
      console.log("Result"+Result);
      FetchCartItemNo();
    }
  });
});

$(document).ready(function(e) {
  FetchCartItemNo();
  // Function For Dislaying product on page
  GetProducts(Start,End);
  // Function For getting product quantity
  GetProductsCount();


  // Execute When Button is ShowNext Button is Clicked
  $('#ShowNext').on('click', function() {
     Start =Start+4;
    End=4;
    if(Start>=ProductCount){
      $("#ShowNext").prop("disabled", true);
      console.log("If block : Start"+Start);
    }
    else{
      $("#ShowPrev").prop("disabled", false);
      $("#ShowNext").prop("disabled", false);
      GetProducts(Start,4);
      console.log("Else block : Start"+Start);
    }
   
  });

   // Execute When Button is ShowPrev Button is Clicked
   $('#ShowPrev').on('click', function() {
    Start =Start-4;
   End=4;
   if(Start<0){
    $("#ShowNext").prop("enabled", true);
    $("#ShowPrev").prop("disabled", true);
    console.log("If block : Start"+Start);
   }
   else{
    $("#ShowPrev").prop("enabled", true);
    $("#ShowNext").prop("disabled",false);
    console.log("Else block : Start"+Start);
    GetProducts(Start,End);
   }
   
 });


//  Function for login
   $('#GetLogin').on('click', function() {
    var Email = $('#UEmail').val();
    var Password = $('#UPassword').val();
    $.ajax({
        url: "Users/Login.php",
        type: "POST",
        data: {
          Action: "Login",
          Email: Email,
          Password: Password
        },
        cache: false,
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

   // Function For Conatct US
   $('#ContactUS').on('click', function() {
    $("#ContactUS").attr("disabled", "disabled");
    var FB_Uname = $('#FB_Uname').val();
    var FB_Uemail = $('#FB_Uemail').val();
    var FB_Uphone = $('#FB_Uphone').val();
    var FB_Umessage = $('#FB_Umessage').val();
    var InsertConatctUs = "Insert Conatct Us";
    if (FB_Uname != "" && FB_Uemail != "" && FB_Uphone != "" && FB_Umessage != "") {
      $.ajax({
        url: "Backend.php",
        type: "POST",
        data: {
          FB_Uname: FB_Uname,
          FB_Uemail: FB_Uemail,
          FB_Uphone: FB_Uphone,
          FB_Umessage: FB_Umessage,
          InsertConatctUs: InsertConatctUs
        },
        cache: false,
        success: function(dataResult) {
          var dataResult = JSON.parse(dataResult);
          if (dataResult.statusCode == 200) {
            console.log("Submitted Successfully");
          } else if (dataResult.statusCode == 201) {
            alert("Error occured !");
          }

        }
      });
    } else {
      alert('Please fill all the field !');
    }
  });


// Fetching User Profile Pic In Navbar
FetchUserPic();  


});

// Definition For Product Fetching Function
function GetProducts(Start,End){
  $.ajax({
    url: "Backend.php",
    type: 'POST',
    data: {
      FetchProduct: "FetchProduct",
      Start:Start,
      End:End
    },
    success: function(Result) {
      console.log("Start"+Start+", End :"+End);
      $('#ShowProducts').html(Result);
    }
  });
}



//Fetching Cart Item number
function FetchCartItemNo() {
  var FetchCartItemNo = "FetchCartItemNo";
  $.ajax({
    url: "Backend.php",
    type: 'POST',
    data: {
      FetchCartItemNo: FetchCartItemNo
    },
    success: function(Result) {
      $('#CartItemCount').html(Result);
      console.log("CartItem Number"+Result);
      
    }
  });
}
// Definition For Product Item Count Function
function GetProductsCount(){
  $.ajax({
    url: "Backend.php",
    type: 'POST',
    data: {
      FetchProductCount: "FetchProductCount"
    },
    success: function(Result) {
      console.log("Count"+Result);
      ProductCount=Result;
    }
  });
}


//Functions For Fetching User Profile Pic in Navbar
function FetchUserPic() {
    var  FetchUserPicture = "FetchUserPicture";

    $.ajax({
      url: "Backend.php",
      type: 'POST',
      data: {
        FetchUserPicture: FetchUserPicture
      },
      success: function(Result) {
        var Result = JSON.parse(Result);
        $('#Userpic').attr('src',Result.user_pic);
        $('#UserName').html(Result.username);
        
        console.log(Result.user_pic);
        console.log(Result.username);
      }
    });
  }


//   Function for Login With Google
  function onSignIn(googleUser) {
    var profile = googleUser.getBasicProfile();
    var Uid= profile.getId();
    var Name=profile.getName();
    var Image=profile.getImageUrl();
    var Email=profile.getEmail();
    var InsertGoogleData="InsertGoogleData";
    console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
    console.log('Name: ' + profile.getName());
    console.log('Image URL: ' + profile.getImageUrl());
    console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
    $.ajax({
            url: "Backend.php",
            type: 'POST',
            data: {
                    InsertGoogleData:InsertGoogleData,
                    Uid:Uid,
                    Name:Name,
                    Image:Image,
                    Email:Email
            },
            success: function(Result) {
                    console.log(Result);
  
             }
            });
    }
  
    // Function For logging out from google 
    function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
    console.log('User signed out.');
    });
    }
  



// Function For Open Sidebar
function openNav() {
    document.getElementById("mySidenav")
        .style.width = "250px";

    document.getElementById("main")
        .style.marginLeft = "250px";

    document.body.style.backgroundColor =
        "rgba(0,0,0,0.4)";

}
// Function For close Sidebar
function closeNav() {
    document.getElementById("mySidenav")
        .style.width = "0";

    document.getElementById("main")
        .style.marginLeft = "0";

    document.body.style.backgroundColor =
        "white";

}

// Function For Toggling Feedback Form
function FB_Form_Togle() {
    var x = document.getElementById("myDIV");
    if (x.style.display === "none") {
      x.style.display = "block";
      x.style.color="black";
    } else {
      x.style.display = "none";
    }
  }