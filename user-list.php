<?php

include 'config.php';


$sql = "SELECT u.id, u.username, u.fname, u.email, u.mobile_no, u.status, 
        r.role_name, rg.region_name 
        FROM users u 
        LEFT JOIN roles r ON u.role_id = r.id 
        LEFT JOIN regions rg ON u.regional_id = rg.id";
$result = $conn->query($sql);


// Toggle user status
// if(isset($_POST['user_id']) && isset($_POST['status'])){
//     $userId = $_POST['user_id'];
//     $newStatus = $_POST['status']; // Active/Inactive/Disabled
//     $updateSql = "UPDATE users SET status = ? WHERE id = ?";
//     $stmt = $conn->prepare($updateSql);
//     $stmt->bind_param('si', $newStatus, $userId);
//     $stmt->execute();
// }

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
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                     <li class="breadcrumb-item active" aria-current="page">User List</li>
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
            <div class="col-sm-12">
                  <div class="iq-card">
                     <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title">User List</h4>
                        </div>
                     </div>
                     <div class="iq-card-body">
                        <div class="table-responsive">
                           <div class="row justify-content-between">
                              <div class="col-sm-12 col-md-6">
                                 <div id="user_list_datatable_info" class="dataTables_filter">
                                    <form class="mr-3 position-relative">
                                       <div class="form-group mb-0">
                                          <input type="search" class="form-control" id="exampleInputSearch" placeholder="Search" aria-controls="user-list-table">
                                       </div>
                                    </form>
                                 </div>
                              </div>
                              <div class="col-sm-12 col-md-6">
                                 <div class="user-list-files d-flex float-right">
                                    <a href="javascript:void();" class="chat-icon-phone">
                                       Print
                                     </a>
                                    <a href="javascript:void();" class="chat-icon-video">
                                       Excel
                                     </a>
                                     <a href="javascript:void();" class="chat-icon-delete">
                                       Pdf
                                     </a>
                                   </div>
                              </div>
                           </div>
                           <table class="table table-bordered">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Full Name</th>
                    <th>Role</th>
                    <th>Region</th>
                    <th>Username</th>
                    <th>Email ID</th>
                    <th>Mobile No</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                
                <?php if($result->num_rows > 0): ?>
                    <?php $i = 1; while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $row['fname']; ?></td>
                        <td><?php echo $row['role_name']; ?></td>
                        <td><?php echo $row['region_name']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['mobile_no']; ?></td>
                        <td>
                            <span class="badge <?php echo ($row['status'] == 'active') ? 'badge-success' : 'badge-secondary'; ?>">
                                <?php echo ucfirst($row['status']); ?>
                            </span>
                           
                        </td>
                        <td>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="statusDropdown<?php echo $row['id']; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo ucfirst($row['status']); ?> <!-- Show current status -->
                    </button>
                    <div class="dropdown-menu" aria-labelledby="statusDropdown<?php echo $row['id']; ?>">
                        <a class="dropdown-item" href="#" onclick="changeStatus(<?php echo $row['id']; ?>, 'active', this)">Activate</a>
                        <a class="dropdown-item" href="#" onclick="changeStatus(<?php echo $row['id']; ?>, 'inactive', this)">Deactivate</a>
                        <a class="dropdown-item" href="profile-edit.php?user_id=<?php echo $row['id']; ?>">Edit User</a> <!-- User Edit link -->
                        <a class="dropdown-item" href="#" onclick="changeStatus(<?php echo $row['id']; ?>, 'disabled', this)">Disable</a>
                    </div>
                </div>
</td>


                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9">No users found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
                        </div>
                           <div class="row justify-content-between mt-3">
                              <div id="user-list-page-info" class="col-md-6">
                                 <span>Showing 1 to 5 of 5 entries</span>
                              </div>
                              <div class="col-md-6">
                                 <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-end mb-0">
                                       <li class="page-item disabled">
                                          <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                       </li>
                                       <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                       <li class="page-item"><a class="page-link" href="#">2</a></li>
                                       <li class="page-item"><a class="page-link" href="#">3</a></li>
                                       <li class="page-item">
                                          <a class="page-link" href="#">Next</a>
                                       </li>
                                    </ul>
                                 </nav>
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


    <!-- JavaScript to handle status change -->
    <script>
     function changeStatus(userId, newStatus, element) {
      alert(userId)
       $.ajax({
        url: 'update_user_status.php', // URL of your PHP script for updating status
        type: 'POST',
        data: {
            user_id: userId,
            status: newStatus
        },
        success: function(response) {
            console.log("Response:", response);
            if(response === "success") {
                // Update the status badge
                const statusBadge = $(element).closest('tr').find('span.badge');
                statusBadge.text(newStatus.charAt(0).toUpperCase() + newStatus.slice(1));
                
                // Change badge color
                if (newStatus === 'active') {
                    statusBadge.removeClass('badge-secondary').addClass('badge-success');
                } else {
                    statusBadge.removeClass('badge-success').addClass('badge-secondary');
                }
                
                // Update dropdown button text
                const dropdownButton = $(element).closest('.dropdown').find('.dropdown-toggle');
                dropdownButton.text(newStatus.charAt(0).toUpperCase() + newStatus.slice(1));
            } else {
                alert("Failed to update user status. Please try again.");
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error("AJAX Error:", textStatus, errorThrown);
            alert("An error occurred while updating user status.");
        }
    });
}

    </script>

    <!-- Include JS libraries -->
   <!--  <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script> -->
    <!-- jQuery -->
<script src="js/jquery.min.js"></script>
<!-- Bootstrap JS -->
<script src="js/bootstrap.min.js"></script>
<!-- Your custom JS for changeStatus function -->
<script src="js/custom.js"></script>

</body>

</html>

