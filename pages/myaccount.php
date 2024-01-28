<?php
 session_start();
	include("../core/connection.php");
	include("../core/functions.php");
	$user_data=check_login($con);

	/*	Nuk do te punojme me cookie
	if(isset($_COOKIE['points'])){
		set_points();}
		*/
	$points= get_points($user_data);
	$gender = $user_data['gender']; 
	 if ($gender == 'M') {
        $avatarImage = "../assets/img/people/male.png";
    } else if ($gender == 'F') {
        $avatarImage = "../assets/img/people/female.png";
	}
	else
	{
		$avatarImage = "../assets/img/people/admin.png";
	}
?>
<!DOCETYPE html>
	<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<title>MyAccount</title>
		<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
		<link rel="stylesheet" href="../assets/styles/style.css" >
		<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js">
		</script>
		<script type="text/javascript">
			(function () {
				emailjs.init("aHxlyyt3xBnTZ_q4O");
			})();
			let cartCost=4;
		
		</script>
		
	</head>

	<body>
		<section id="header">
			<a href='#'><img src="../assets/img/logo.png" class="logo" alt=" " style="width:90px; height: 36px; border-radius: 13px;" ></a>
			<div>
			<ul id="navbar">
				<li><a  href="../index.html">Home</a></li>
				<li><a  href="../pages/shop.html">Shop</a></li>
				<li><a class="active"  href="../pages/myaccount.php">MyAccount</a></li>
				<li><a  href="../pages/contact.html">Contact</a></li>
				<li id="lg-bag"><a href="../pages/cart.html"><i class="far fa-shopping-bag"><span>0</span></i></a></li>
				<a href="#" id="close"><i class="far fa-times"></i></a>
			</ul>
			</div>
		</section>

		<section id="page-header">

			<h2>#MyAccount</h2>
			<p>Collect 1000 points to get 50$ free shopping</p>
		
		</section>
		<section id="cart-add" class="section-p1">
			<div class="fjorela">
				<div class="subtotal">
				
				<!-- Kam kopjuar kodin tek cart-->
				<h3>Account Details</h3>
				<table class="MyAccount-details">
					<!--cart-total1 -->

					<tr>
						<td>Name</td>
						<td><?php echo $user_data['username'] ?></td>
					</tr>
					<tr>
						<td>Email</td>
						<td><?php echo $user_data['email'] ?></td>
					</tr>
					<tr>
						<td>Age</td>
						<td><?php echo $user_data['age'] ?></td>
					</tr>
					<tr>
						<td><strong>Total Points:</strong></td>
						<td><strong><?php echo $points ?></strong></td>
					</tr>

				</table>
				<!---->

				<button id="logout" class="normal">  <a href="../controllers/logout.php" style="text-decoration: none; color: white;">Log out</a>  </button>
				<!-- Trigger/Open The Modal -->

				<!-- Trigger Button -->
<button id="unsubscribe-btn" class="normal">Delete my account</button>

<button id="update-info-btn" class="normal"><a href="../controllers/updateMyInfo.php" style="text-decoration: none; color: white;">Update My Information</a></button>

<!-- Modal -->
<div id="confirmModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <p>Are you sure you want to unsubscribe? This action cannot be undone.</p>
    <button id="confirmDelete" class="normal">Confirm</button>
  </div>
</div>

<script>
    var modal = document.getElementById('confirmModal');

    // the button that opens the modal
    var btn = document.getElementById("unsubscribe-btn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // Get the button that confirms the deletion
    var confirmBtn = document.getElementById("confirmDelete");

    // When the user clicks the button, open the modal 
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks on Confirm, delete the account
    confirmBtn.onclick = function() {
        window.location.href = "../controllers/unsubscribe.php";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
</div>
<div class="avatar-frame">
    <img src="<?php echo htmlspecialchars($avatarImage); ?>" alt="User Avatar" class="user-avatar">
</div>

			</div>
		</section>

		<footer class="section-p1">
		<div class="col">
			<img class="logo" src="../assets/img/logo.png" alt="" style="width:90px; height: 36px; border-radius: 13px;">
			<h4>Contact</h4>
            <p><strong>Address:</strong>Epoka University,Tiranë-Rinas km 12</p>
            <p><strong>Phone:</strong>+355 69 99 99 999</p>
            <p><strong>Hours:</strong> 09:00-21:00,Mon-Sat</p>
			<div class="follow">
				<h4>Follow us</h4>
				<div class="icon">
                    <a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.linkedin.com/"><i class="fab fa-linkedin"></i></a>
                    <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.youtube.com/"><i class="fab fa-youtube"></i></a>
                </div>
			</div>
		</div>

			<div class="col">
			<h4>About</h4>
			<a href="#">About</a>
			<a href="contact.html">Contact</a>
			<a href="#">Privacy Policy</a>


		</div>

		<div class="col install">
			<h4>Install App</h4>
			<p>From App Store or Google Play</h4>
			<div class="row">
				<img src="../assets/img/pay/app.jpg" alt="">
				<img src="../assets/img/pay/play.jpg" alt="">	
			</div>
			<p>Secured Payment Gateways </p>
			<img src="../assets/img/pay/pay.png" alt="">
					
		</div>
			</div>
		</footer>


		<script>
			const bar = document.getElementById('bar');
			const close = document.getElementById('close');
			const nav = document.getElementById('navbar');
			const shoppingBag = document.getElementById('shopping-bag');
			if (bar) {
				bar.addEventListener('click', () => {
					nav.classList.add('active');
					shoppingBag.classList.add('active');
				})
			}
			if (close) {
				close.addEventListener('click', () => {
					nav.classList.remove('active');
					shoppingBag.classList.remove('active');
				})
			}

		</script>]
		<script src="../assets/scripts/main.js"></script>
		<script src="../assets/scripts/search.js"></script>
	</body>
	


	</html>