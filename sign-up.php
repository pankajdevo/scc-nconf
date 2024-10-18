<?php
// Include the database configuration file
include 'config.php';

// Check if the connection is established
if (!$conn) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

// Fetch regions data from the 'regions' table
$regions_query = "SELECT id, region_name FROM regions WHERE status = '1'";
$regions_result = mysqli_query($conn, $regions_query);

// Fetch roles data from the 'roles' table
$roles_query = "SELECT id, role_name FROM roles WHERE status = '1'";
$roles_result = mysqli_query($conn, $roles_query);

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Sanitize input data
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $role_id = mysqli_real_escape_string($conn, $_POST['role_id']);
    $regional_id = mysqli_real_escape_string($conn, $_POST['regions']);
    $mobile_no = mysqli_real_escape_string($conn, $_POST['mobile_no']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $created_at = date('Y-m-d H:i:s');
    $updated_at = date('Y-m-d H:i:s');

    // Check if the username already exists
    $check_username_query = "SELECT id FROM users WHERE username = '$username'";
    $check_username_result = mysqli_query($conn, $check_username_query);
    
    // Check if the email already exists
    $check_email_query = "SELECT id FROM users WHERE email = '$email'";
    $check_email_result = mysqli_query($conn, $check_email_query);

    // Check if the mobile number already exists
    $check_mobile_query = "SELECT id FROM users WHERE mobile_no = '$mobile_no'";
    $check_mobile_result = mysqli_query($conn, $check_mobile_query);

    // Handle specific checks and display appropriate error messages
    if (mysqli_num_rows($check_username_result) > 0) {
        echo "<script>alert('Username already exists. Please choose a different username.');</script>";
    } elseif (mysqli_num_rows($check_email_result) > 0) {
        echo "<script>alert('Email already exists. Please use a different email.');</script>";
    } elseif (mysqli_num_rows($check_mobile_result) > 0) {
        echo "<script>alert('Mobile number already exists. Please use a different mobile number.');</script>";
    } else {
        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>alert('Invalid email format');</script>";
        } 
        // Validate mobile number (example validation: should be 10 digits)
        elseif (!preg_match('/^[0-9]{10}$/', $mobile_no)) {
            echo "<script>alert('Invalid mobile number. It should be 10 digits.');</script>";
        } else {
            // Hash the password for security
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert data into the database
            $sql = "INSERT INTO users (fname, username, role_id, regional_id, mobile_no, email, password, created_at, updated_at) 
                    VALUES ('$fname', '$username', '$role_id', '$regional_id', '$mobile_no', '$email', '$hashed_password', '$created_at', '$updated_at')";

            // Execute the query and check if the data is inserted successfully
            if (mysqli_query($conn, $sql)) {
                echo "<script>
                    alert('You have successfully registered!');
                    window.location.href = 'sign-in.php';
                </script>";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }

    // Close the connection
    mysqli_close($conn);
}
?>


<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Sample Coding Cell Admin Sign-up</title>
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
                            <h1 class="mb-0">Sign Up</h1>
                            <p>Enter your email address and password to access admin panel.</p>
                            <form class="mt-4" method="POST" action="" enctype="multipart/form-data">
    <div class="form-group">
        <label>Your Full Name</label>
        <input type="text" class="form-control mb-0" id="fname" name="fname" placeholder="Your Full Name" required>
    </div>
    <div class="form-group">
        <label>Username</label>
        <input type="text" class="form-control mb-0" id="username" name="username" placeholder="Your Username" required>
    </div>
    <div class="form-group">
    <label>Role</label>
    <select class="form-control" name="role_id" id="role_id" required>
        <option value="">Select</option>
        <?php
            // Populate dropdown with roles data from MySQL
            if (mysqli_num_rows($roles_result) > 0) {
                while ($row = mysqli_fetch_assoc($roles_result)) {
                    echo '<option value="'.$row['id'].'">'.$row['role_name'].'</option>';
                }
            } else {
                echo '<option value="">No roles available</option>';
            }
        ?>
    </select>
</div>

    <div class="form-group">
        <label>Regional</label>
        <select class="form-control" name="regions" id="regions" required>
            <option value="">Select</option>
            <?php
                // Populate dropdown with region data from MySQL
                if (mysqli_num_rows($regions_result) > 0) {
                    while ($row = mysqli_fetch_assoc($regions_result)) {
                        echo '<option value="'.$row['id'].'">'.$row['region_name'].'</option>';
                    }
                } else {
                    echo '<option value="">No regions available</option>';
                }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail2">Email address</label>
        <input type="email" class="form-control mb-0" id="exampleInputEmail2" name="email" placeholder="Enter email" required>
    </div>
    <div class="form-group">
        <label>Mobile Number</label>
        <input type="Number" class="form-control mb-0" id="mobile_no" name="mobile_no" placeholder="Your Mobile Number" required>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control mb-0" id="exampleInputPassword1" name="password" placeholder="Password" required>
        <input type="checkbox" id="showPassword"> Show Password
    </div>

    <div class="d-inline-block w-100">
        <div class="custom-control custom-checkbox d-inline-block mt-2 pt-1">
            <input type="checkbox" class="custom-control-input" id="customCheck1" required>
            <label class="custom-control-label" for="customCheck1">I accept <a href="#">Terms and Conditions</a></label>
        </div>
        <input type="submit" class="btn btn-primary float-right" name='submit' value="Sign Up">
    </div>
    <div class="sign-info">
        <span class="dark-color d-inline-block line-height-2">Already Have Account ? <a href="sign-in.php">Log In</a></span>
    </div>
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

