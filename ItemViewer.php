<?php
include('Includes/dbconn.php');
?>

<!DOCTYPE html>
<html>

<head>
	<title>RentOrlendAnything.com</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
		integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
	<link rel="stylesheet" type="text/css" href="CSS/ItemViewer.css">
</head>

<body>

	<nav>
		<div class="brandLogo">
			<img src="Images/CompanyLogo.png" alt="Hello"
				style="width: 70px; height: 45px; background: none; border-radius: 50%; border: none;">
			<p>RentOrLendAnything</p>
		</div>

		<div id="mySidenav" class="sidenav">
			<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

			<a href="#">About</a>
			<a href="#">Services</a>
			<a href="#">Careers</a>
			<a href="#">Contact</a>

		</div>

		<div id="main">

			<span style="font-size: 1.78rem;;cursor:
			pointer" onclick="openNav()"><i class="fa fa-bars" aria-hidden="true"></i>
			</span>

		</div>
		<hr style="margin: 2px;">

		<script>


			function openNav() {
				document.getElementById("mySidenav")
					.style.width = "250px";

				document.getElementById("main")
					.style.marginLeft = "250px";

				document.body.style.backgroundColor =
					"rgba(0,0,0,0.4)";

			}

			function closeNav() {
				document.getElementById("mySidenav")
					.style.width = "0";

				document.getElementById("main")
					.style.marginLeft = "0";

				document.body.style.backgroundColor =
					"white";

			}
		</script>
		<a type="button" data-toggle="modal" data-target="#myModal"
			style="position: absolute; right: 40px; top: 10px;"><i class="fa fa-shopping-bag" aria-hidden="true"
				style="font-size: 1.4rem;"></i></a>

		<a type="button" style="position: absolute; right: 70px; top: 10px; text-decoration: none;"><i
				class="fa fa-user" aria-hidden="true" style="font-size: 1.4rem;"></i></a>
		</div>
		</nav>

		<div id="content-wrapper">

            <?php 
            $SQL = "SELECT * FROM `products` WHERE product_id={$_GET["PID"]}";
            $RESULT = mysqli_query($conn, $SQL);
            $row = mysqli_fetch_assoc($RESULT);
            ?>
			<div class="column">
				<img id=featured src="<?php echo $row['product_pic_1']; ?>">

				<div id="slide-wrapper">
					<img id="slideLeft" class="arrow" src="Images/arrow-left.png">

					<div id="slider">
						<img class="thumbnail active"
							src="<?php echo $row['product_pic_1']; ?>">
						<img class="thumbnail"
							src="<?php echo $row['product_pic_2']; ?>">
						<img class="thumbnail"
							src="<?php echo $row['product_pic_3']; ?>">
					</div>

					<img id="slideRight" class="arrow" src="Images/arrow-right.png">
				</div>
			</div>

			<div class="column">
				<h1 style="background-color: black; color: white;"><?php echo $row['product_name']; ?></h1>
				<hr>
				<h3>Rs.  <?php echo $row['product_price']; ?></h3>

				<p><?php echo $row['product_description']; ?></p>

				<b>Enter number of days to rent: </b> <br><input value=1 type="number"
					style="border: 1.45px solid black;" placeholder="Number of days to rent"> <br> <br>
				<div class="btns">
					<button type="submit" class="btn">Rent now</button>
					<button type="button" class="btn-cart btn AddToCart" value="'.$Count.'"> Add to cart
				  <span><i class="fas fa-plus"></i></span>
				</div>


			</div>

		</div>
		<hr>

		<script type="text/javascript">
			let thumbnails = document.getElementsByClassName('thumbnail')

			let activeImages = document.getElementsByClassName('active')

			for (var i = 0; i < thumbnails.length; i++) {

				thumbnails[i].addEventListener('click', function () {
					console.log(activeImages)

					if (activeImages.length > 0) {
						activeImages[0].classList.remove('active')
					}


					this.classList.add('active')
					document.getElementById('featured').src = this.src
				})
			}


			let buttonRight = document.getElementById('slideRight');
			let buttonLeft = document.getElementById('slideLeft');

			buttonLeft.addEventListener('click', function () {
				document.getElementById('slider').scrollLeft -= 180
			})

			buttonRight.addEventListener('click', function () {
				document.getElementById('slider').scrollLeft += 180
			})


		</script>

		<br>
		<br>
		<br>


		<!-- ABOUT EYLOR SECTION  START-->

		<?php
include('Includes/AboutEylor.php');
?>

		<!--EYLOR SECTION END  -->


		<!-- FOOTER SECTION START -->
		<?php
include('Includes/Footer.php');
?>

		<!-- Footer section end -->





</body>

</html>