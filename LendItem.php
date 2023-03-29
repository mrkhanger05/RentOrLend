
     <?php 
     $item_name='';
     $Item_Description='';
     $req_id=0;
     if(isset($_GET["Action"])){
            if($_GET["Action"]=="100"){
              session_start();
              include('Includes/Function.php');
              if (isset($_SESSION['email'])) {
                $Email = $_SESSION['email'];
              }
              if (isset($_SESSION['user_signin'])) {
                $_SESSION["uid"] = GetUserID($Email);
              }
             
              include('Includes/dbconn.php');
              include('Includes/IndexHeader.php');
              // include('Includes/Navbar.php');
              echo '<div class="container-fluid" style="background-color:black;">';
              $id=$_GET['id'];
              $sql = "SELECT * FROM itemrequest WHERE id='$id'";
              $result = mysqli_query($conn, $sql);

          if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
              $req_id=$row["id"];
              $item_name=$row["item_name"];
              $no_of_days=$row["no_of_days"];
              $Item_Description=$row["Item_Description"];
            }
            }
           
     }
    }

     ?>
     <div>

    
     
      <form class="signup-form" action="LendItemScript.php"   enctype="multipart/form-data" method="POST">

      <!-- form header -->
      <div class="form-header">
        <h1>Product lending form</h1>
      </div>

      <!-- form body -->
      <style>

        </style>
      <div class="form-body"  >

        <!-- Product name and Category -->
        <div class="horizontal-group">
           <div class="form-group"> 
            <!-- <label for="req_id" class="label-title">Request id *</label> -->
            <input type="hidden"  id="req_id" class="form-input" placeholder="reuest id" required="required" name="req_id" value="1" autocomplete="off" />
          </div>
          <div class="form-group">
            <label for="P_Name" class="label-title"><b>Product name *</b></label>
            <input type="text" id="P_Name" class="form-input" placeholder="Enter the product name" required="required" name="P_Name"/>
          </div>
          <div class="form-group">
            <label for="P_Categories" class="label-title"><b>Category *</b></label>
            <select class="form-input" id="P_Categories" name="P_Categories">
         <?php
          $SQL = "SELECT * FROM `product_categories` ";
        	$RESULT = mysqli_query($conn, $SQL);
      	while ($row = mysqli_fetch_assoc($RESULT)) {
        ?>
		    <option value="<?php echo $row["cat_id"]; ?>"><?php echo $row["cat_name"]; ?></option>
        <?php }
        ?>
          </select>
          </div>
        </div>

        <!-- Product description -->
        <div class="form-group">
          <label for="P_Description" class="label-title"><b> Product description *</b></label>
          <textarea class="form-input" rows="4" cols="50" id="P_Description" style="height:auto" placeholder="Enter product description" name="P_Description"></textarea>
        </div>

        <!-- Product Price and Product age-->
        <div class="horizontal-group">
          <div class="form-group">
            <label for="P_Price" class="label-title"><b> Product price (In ₹/ day) *</b></label>
            <input type="text" id="P_Price" class="form-input" placeholder="Price of the item " required="required" name="P_Price">
          </div>
          <div class="form-group">
            <label for="P_Age" class="label-title"><b> Product age (In years)</b></label>
            <input type="number" class="form-input" id="P_Age" placeholder="Enter the age of the product" required="required" name="P_Age">
          </div>
        </div>

        <!-- Product picture-->
        <div class="horizontal-group">
          <div class="form-group left" >
            <label for="Product_Picture_1" class="label-title"><b> Product Picture 1 * </b> </label>
            <input type="file" id="Product_Picture_1" size="80" name="Product_Picture_1"> <br><br>
            <label for="Product_Picture_2" class="label-title"><b> Product Picture 2 * </b> </label>
            <input type="file" id="Product_Picture_2" size="80" name="Product_Picture_2"> <br><br>
            <label for="Product_Picture_3" class="label-title"><b> Product Picture 3 * </b> </label>
            <input type="file" id="Product_Picture_3" size="80" name="Product_Picture_3">
          </div>
          
          <div class="form-group right">
            <div class="horizontal-group">
                <div class="form-group left" >
                  <label class="label-title" for="Item_City">City</label>
                  <select class="form-input" style="width: 100px;" id="Item_City" name="Item_City" >
                  <?php
                    $RESULT = mysqli_query($conn, "SELECT * FROM `city`");
                  while ($row = mysqli_fetch_assoc($RESULT)) {
                  ?>
                  <option value="<?php echo $row["city_name"]; ?>"><?php echo $row["city_name"]; ?></option>
                  <?php }
                  ?>
                  </select>
                </div>
              </div>
          </div>
        </div>

      <!-- form-footer -->
      <div class="form-footer">
        <button type="submit" class="btn" name="UploadItem">Upload item</button>
      </div>
    </form>
    </div>
        </div>
