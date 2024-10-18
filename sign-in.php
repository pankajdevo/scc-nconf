<?php
session_start(); // Start a new session or resume the existing one
include 'config.php'; // Include your database configuration file

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare the SQL query to fetch the user
        // $sql = "SELECT u.*, r.role_name as role_name, rg.region_name as region_name,
        // r.id as role_id,
        // rg.id as region_id,
        // FROM users as u 
        // LEFT JOIN roles as r ON r.id = u.role_id 
        // LEFT JOIN regions as rg ON rg.id = u.regional_id 
        // WHERE u.username = ?";
    $sql = "SELECT u.*, r.role_name as role_name, rg.region_name as region_name,
        r.id as role_id,
        rg.id as region_id
        FROM users as u 
        LEFT JOIN roles as r ON r.id = u.role_id 
        LEFT JOIN regions as rg ON rg.id = u.regional_id 
        WHERE u.username = ?";
        $stmt = $conn->prepare($sql);
        
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Store user details in session
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_id'] = $user['id']; // Optionally store the user ID5
            $_SESSION['usersSession'] = $user; // Optionally store the user ID
            header('Location: sample-list.php'); // Redirect to the index page
            exit();
        } else {
            echo "Incorrect password!";
        }
    } else {
        echo "User does not exist!";
    }
}
?>

<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Sample Coding Cell Admin Sign-in</title>
      <!-- Favicon -->
      <link rel="shortcut icon" href="images/favicon.ico" />
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <!-- Typography CSS -->
      <link rel="stylesheet" href="css/typography.css">
      <!-- Style CSS -->
      <link rel="stylesheet" href="css/style.css">
      <!-- Responsive CSS -->
      <link rel="stylesheet" href="css/responsive.css">
   </head>
   <body>
      <!-- loader Start -->
      <div id="loading">
         <div id="loading-center">
            <div class="loader">
               <div class="cube">
                  <div class="sides">
                     <div class="top"></div>
                     <div class="right"></div>
                     <div class="bottom"></div>
                     <div class="left"></div>
                     <div class="front"></div>
                     <div class="back"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- loader END -->
        <!-- Sign in Start -->
        <section class="sign-in-page bg-white">
            <div class="container-fluid p-0">
                <div class="row no-gutters">
                    <div class="col-sm-6 align-self-center">
                        <div class="sign-in-from">
                            <h1 class="mb-0">Sign in</h1>
                            <p>Enter your email address and password to access admin panel.</p>
                           <!-- <form class="mt-4" action="" method="POST"> -->
   <form action="" method="POST">
    <div class="form-group">
        <label>Username</label>
        <input type="text" class="form-control mb-0" id="username" name="username" placeholder="Your Username" required>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control mb-0" id="exampleInputPassword1" name="password" placeholder="Password" required>
        <br>
        <input type="checkbox" id="showPassword"> Show Password
        <a href="pages-recoverpw.html" class="float-right">Forgot password?</a><br>
    </div>
    <button type="submit" class="btn btn-primary float-right">Sign in</button>
</form>


                        </div>
                    </div>
                    <div class="col-sm-6 text-center">
                       <div class="sign-in-detail text-white" style="background: url(images/login/sample_testing_img.jpg) no-repeat 0 0; background-size: cover;">
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Sign in END -->
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <!-- Appear JavaScript -->
      <script src="js/jquery.appear.js"></script>
      <!-- Countdown JavaScript -->
      <script src="js/countdown.min.js"></script>
      <!-- Counterup JavaScript -->
      <script src="js/waypoints.min.js"></script>
      <script src="js/jquery.counterup.min.js"></script>
      <!-- Wow JavaScript -->
      <script src="js/wow.min.js"></script>
      <!-- Apexcharts JavaScript -->
      <script src="js/apexcharts.js"></script>
      <!-- Slick JavaScript -->
      <script src="js/slick.min.js"></script>
      <!-- Select2 JavaScript -->
      <script src="js/select2.min.js"></script>
      <!-- Owl Carousel JavaScript -->
      <script src="js/owl.carousel.min.js"></script>
      <!-- Magnific Popup JavaScript -->
      <script src="js/jquery.magnific-popup.min.js"></script>
      <!-- Smooth Scrollbar JavaScript -->
      <script src="js/smooth-scrollbar.js"></script>
      <!-- Chart Custom JavaScript -->
      <script src="js/chart-custom.js"></script>
      <!-- Custom JavaScript -->
      <script src="js/custom.js"></script>
      <script>
   document.getElementById('showPassword').addEventListener('change', function() {
       var passwordField = document.getElementById('exampleInputPassword1');
       if (this.checked) {
           passwordField.type = 'text';
       } else {
           passwordField.type = 'password';
       }
   });
</script>
   </body>
</html>


