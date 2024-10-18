<?php
// Include your database connection here
include 'config.php';

// Set dynamic user_id based on logged-in user/session (for example purposes, hardcoded)
$user_id = 1; 

// Fetch user data for pre-filling the form
$userQuery = "SELECT `id`, `role_id`, `regional_id`, `username`, `fname`, `email`, `mobile_no`, `designation`, `status`, `created_at`, `updated_at` FROM `users` WHERE `id` = ?";
$userStmt = $conn->prepare($userQuery);
$userStmt->bind_param('i', $user_id);
$userStmt->execute();
$userResult = $userStmt->get_result();
$user = $userResult->fetch_assoc();

// Fetch roles for the dropdown
$rolesQuery = "SELECT `id`, `role_name` FROM `roles` WHERE `status` = 1";
$rolesResult = $conn->query($rolesQuery);

// Fetch regions for the dropdown
$regionsQuery = "SELECT `id`, `region_name` FROM `regions` WHERE `status` = 1";
$regionsResult = $conn->query($regionsQuery);

// If the form is submitted, update the user profile
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fname = $_POST['fname'];
    $email = $_POST['email'];
    $mobile_no = $_POST['mobile_no'];
    $designation = $_POST['designation'];
    $role_id = $_POST['role'];
    $region_id = $_POST['region'];

    // Validate the input (basic example)
    if (!empty($fname) && !empty($email)) {
        // Update the user record
        $updateQuery = "UPDATE `users` SET `fname` = ?, `email` = ?, `mobile_no` = ?, `designation` = ?, `role_id` = ?, `regional_id` = ?, `updated_at` = NOW() WHERE `id` = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param('sssiiii', $fname, $email, $mobile_no, $designation, $role_id, $region_id, $user_id);

        if ($updateStmt->execute()) {
            echo "Profile updated successfully!";
        } else {
            echo "Error updating profile.";
        }
    } else {
        echo "Please fill in all required fields.";
    }
}
?>


<!doctype html>
<html lang="en">
    <?php include 'header.php'; ?>
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
      <!-- Wrapper Start -->
      <div class="wrapper">
      <!-- Sidebar  -->
       <?php include 'slider.php'; ?>
      <!-- TOP Nav Bar -->
      <div class="iq-top-navbar">
         <div class="iq-navbar-custom">
            <div class="iq-sidebar-logo">
               <div class="top-logo">
                  <a href="index.php" class="logo">
                  <img src="images/logo.png" class="img-fluid" alt="">
                  <span>Sample Coding Cell</span>
                  </a>
               </div>
            </div>
            <div class="navbar-breadcrumb">
               <h5 class="mb-0">User List</h5>
               <nav aria-label="breadcrumb">
                  <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                     <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                  </ul>
               </nav>
            </div>
            <nav class="navbar navbar-expand-lg navbar-light p-0">
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <i class="ri-menu-3-line"></i>
                  </button>
                  <div class="iq-menu-bt align-self-center">
                     <div class="wrapper-menu">
                        <div class="line-menu half start"></div>
                        <div class="line-menu"></div>
                        <div class="line-menu half end"></div>
                     </div>
                  </div>
                    <?php include 'profile-sign.php'; ?>
               </nav>
         </div>
      </div>
         <!-- TOP Nav Bar END -->
         <!-- Page Content  -->
         <div id="content-page" class="content-page">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="iq-card">
                        <div class="iq-card-body p-0">
                           <div class="iq-edit-list">
                              <ul class="iq-edit-profile d-flex nav nav-pills">
                                 <li class="col-md-3 p-0">
                                    <a class="nav-link active" data-toggle="pill" href="#personal-information">
                                       Personal Information
                                    </a>
                                 </li>
                                 <li class="col-md-3 p-0">
                                    <a class="nav-link" data-toggle="pill" href="#chang-pwd">
                                       Change Password
                                    </a>
                                 </li>
                                
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-12">
                     <div class="iq-edit-list-data">
                        <div class="tab-content">
                           <div class="tab-pane fade active show" id="personal-information" role="tabpanel">
                               <div class="iq-card">
                                 <div class="iq-card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                       <h4 class="card-title">Personal Information</h4>
                                    </div>
                                 </div>
                                 <div class="iq-card-body">
                                     <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                     <div class="row">
                        <div class="form-group col-md-6">
                           <label for="fname">First Name:</label>
                           <input type="text" class="form-control" name="fname" id="fname" value="<?php echo htmlspecialchars($user['fname']); ?>">
                        </div>
                        
                        <div class="form-group col-md-6">
                           <label for="designation">Designation:</label>
                           <input type="text" class="form-control" name="designation" id="designation" value="<?php echo htmlspecialchars($user['designation']); ?>">
                        </div>
                        
                        <div class="form-group col-md-6">
                           <label for="region">Office Regions:</label>
                           <select name="region" id="region" class="form-control">
                              <?php while ($region = $regionsResult->fetch_assoc()) { ?>
                                 <option value="<?php echo $region['id']; ?>" <?php echo $user['regional_id'] == $region['id'] ? 'selected' : ''; ?>>
                                    <?php echo $region['region_name']; ?>
                                 </option>
                              <?php } ?>
                           </select>
                        </div>

                        <div class="form-group col-md-6">
                           <label for="role">User Roles:</label>
                           <select name="role" id="role" class="form-control">
                              <?php while ($role = $rolesResult->fetch_assoc()) { ?>
                                 <option value="<?php echo $role['id']; ?>" <?php echo $user['role_id'] == $role['id'] ? 'selected' : ''; ?>>
                                    <?php echo $role['role_name']; ?>
                                 </option>
                              <?php } ?>
                           </select>
                        </div>

                        <div class="form-group col-md-6">
                           <label for="email">Email:</label>
                           <input type="email" class="form-control" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>">
                        </div>

                        <div class="form-group col-md-6">
                           <label for="mobile_no">Mobile Number:</label>
                           <input type="text" class="form-control" name="mobile_no" id="mobile_no" value="<?php echo htmlspecialchars($user['mobile_no']); ?>">
                        </div>
                     </div>
                     
                     <button type="submit" class="btn btn-primary">Submit</button>
                     <button type="reset" class="btn iq-bg-danger">Cancel</button>
                  </form>
                                 </div>
                              </div>
                           </div>
                           <div class="tab-pane fade" id="chang-pwd" role="tabpanel">
                               <div class="iq-card">
                                 <div class="iq-card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                       <h4 class="card-title">Change Password</h4>
                                    </div>
                                 </div>
                                 <div class="iq-card-body">
                                    <form>
                                       <div class="form-group">
                                          <label for="cpass">Current Password:</label>
                                          <a href="javascripe:void();" class="float-right">Forgot Password</a>
                                             <input type="Password" class="form-control" id="cpass" value="">
                                          </div>
                                       <div class="form-group">
                                          <label for="npass">New Password:</label>
                                          <input type="Password" class="form-control" id="npass" value="">
                                       </div>
                                       <div class="form-group">
                                          <label for="vpass">Verify Password:</label>
                                             <input type="Password" class="form-control" id="vpass" value="">
                                       </div>
                                       <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                       <button type="reset" class="btn iq-bg-danger">Cancle</button>
                                    </form>
                                 </div>
                              </div>
                           </div>
                           
                           <div class="tab-pane fade" id="manage-contact" role="tabpanel">
                               <div class="iq-card">
                                 <div class="iq-card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                       <h4 class="card-title">Manage Contact</h4>
                                    </div>
                                 </div>
                                 <div class="iq-card-body">
                                    <form>
                                       <div class="form-group">
                                          <label for="cno">Contact Number:</label>
                                          <input type="text" class="form-control" id="cno" value="001 2536 123 458">
                                       </div>
                                       <div class="form-group">
                                          <label for="email">Email:</label>
                                          <input type="text" class="form-control" id="email" value="nikjone@demo.com">
                                       </div>
                                       <div class="form-group">
                                          <label for="url">Url:</label>
                                          <input type="text" class="form-control" id="url" value="https://getbootstrap.com">
                                       </div>
                                       <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                       <button type="reset" class="btn iq-bg-danger">Cancel</button>
                                    </form>
                                 </div>
                              </div>
                           </div>                           
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Wrapper END -->
      <!-- Footer -->
      <footer class="bg-white iq-footer">
         <div class="container-fluid">
            <div class="row">
               <div class="col-lg-6">
                  <ul class="list-inline mb-0">
                     <li class="list-inline-item"><a href="privacy-policy.html">Privacy Policy</a></li>
                     <li class="list-inline-item"><a href="terms-of-service.html">Terms of Use</a></li>
                  </ul>
               </div>
               <div class="col-lg-6 text-right">
                  Copyright 2020 <a href="#">Sofbox</a> All Rights Reserved.
               </div>
            </div>
         </div>
      </footer>
      <!-- Footer END -->
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
      <!-- lottie JavaScript -->
      <script src="js/lottie.js"></script>
      <!-- Chart Custom JavaScript -->
      <script src="js/chart-custom.js"></script>
      <!-- Custom JavaScript -->
      <script src="js/custom.js"></script>
   </body>
</html>