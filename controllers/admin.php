<?php
session_start();
include("../core/connection.php");
include("../core/functions.php");
$user_data = check_login($con);

if ($user_data['username'] != 'NaDulShpejrti') {
    header("Location: ../pages/myaccount.php");
    exit(); 
}

// Check if a delete request has been made and if the 'user_id' key exists
if (isset($_POST['delete']) && isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
    
    if ($user_id) {
        // SQL query to delete the user from the database
        $query = "DELETE FROM customers WHERE id = ?";
        if ($stmt = $con->prepare($query)) {
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $stmt->close();
        }
    }
    // Refresh the page to avoid resubmission upon refreshing
    header("Location: admin.php");
    exit();
}

// Fetch users
$users = get_users($con);
?>

<!DOCETYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="../assets/styles/style.css">
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
      <a href='#'><img src="../assets/img/logo.png " class="logo" alt=" " style="width:90px; height: 36px; border-radius: 13px;" ></a>
      <div>
        <ul id="navbar">
          <li><a href="../index.html">Home</a></li>
          <li><a href="../pages/shop.html">Shop</a></li>
          <li><a class="active" href="../pages/myaccount.php">MyAccount</a></li>
          <li><a href="../pages/contact.html">Contact</a></li>
          <li id="lg-bag"><a href="../pages/cart.html"><i
                class="far fa-shopping-bag"><span>0</span></i></a></li>
          <a href="#" id="close"><i class="far fa-times"></i></a>
        </ul>
      </div>
    </section>

    <section id="page-header">

      <h2>#Welcome Admin</h2>
      <p>Users List</p>
    
    </section>



    <section id="cart" class="section-p1">
        <table width="100%">
            <thead>
                <tr>
                    <td>Name</td>
                    <td>Email</td>
                    <td>Age</td>
                    <td>Total Points</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody class="products">
                <?php foreach ($users as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['username']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td><?= htmlspecialchars($row['age']) ?></td>
                        <td><?= htmlspecialchars($row['points']) ?></td>
                        <td>
                            <form action="admin.php" method="POST">
                                <input type="hidden" name="user_id" value="<?= htmlspecialchars($row['id']) ?>">
                                <button type="submit" name="delete" class="delete-button" onclick="return confirm('Are you sure?');" style="border: none; background: none; padding: 0; cursor: pointer;">
            <i class="far fa-times-circle cart-removes"></i>
          </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

     </br>
     </br>   
      <button id="logout" class="normal">  <a href="logout.php" style="text-decoration: none; color: white;">Log out</a>  </button>
    </section>

      
        <!-- Trigger/Open The Modal -->
   
    <footer class="section-p1">
      <div class="col">
        <img class="logo" src="../assets/img/logo.png" alt="" style="width:90px; height: 36px; border-radius: 13px;" >
        <h4>Contact</h4>
			<p><strong>Address:</strong> Epoka University, Tiranë-Rinas km 12</p>
            <p><strong>Phone:</strong> +355 69 99 99 999</p>
            <p><strong>Hours:</strong> 09:00-21:00, Mon-Sat</p>
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
        <a href="../pages/contact.html">Contact</a>
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

    </script>
  
  </body>
  </html>