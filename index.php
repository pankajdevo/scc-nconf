
<?php
include 'config.php'; // Include your database configuration file
session_start(); // Start the session
if (!isset($_SESSION['username'])) {
    header("Location: sign-in.php"); // Redirect to login if no session is found
    exit();
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
                     <a href="index.html" class="logo">
                     <img src="images/logo.png" class="img-fluid" alt="">
                     <span>Sample Coding Cell</span>
                     </a>
                  </div>
               </div>
               <div class="navbar-breadcrumb">
                  <h5 class="mb-0">Dashboard</h5>
                  <nav aria-label="breadcrumb">
                     <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Home</li>
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
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                     <ul class="navbar-nav ml-auto navbar-list">
                        <li class="nav-item">
                           <a class="search-toggle iq-waves-effect" href="#"><i class="ri-search-line"></i></a>
                           <form action="#" class="search-box">
                              <input type="text" class="text search-input" placeholder="Type here to search..." />
                           </form>
                        </li>
                     
                        <li class="nav-item iq-full-screen"><a href="#" class="iq-waves-effect" id="btnFullscreen"><i class="ri-fullscreen-line"></i></a></li>
                     </ul>
                  </div>
                  <ul class="navbar-list">
                     <li>
                        <a href="#" class="search-toggle iq-waves-effect bg-primary text-white"><img src="images/user/1.jpg" class="img-fluid rounded" alt="user"></a>
                        <div class="iq-sub-dropdown iq-user-dropdown">
                           <div class="iq-card iq-card-block iq-card-stretch iq-card-height shadow-none m-0">
                              <div class="iq-card-body p-0 ">
                                 <div class="bg-primary p-3">
                                    <h5 class="mb-0 text-white line-height">Hello Nik jone</h5>
                                    <span class="text-white font-size-12">Available</span>
                                 </div>
                                 
                                 <a href="profile-edit.html" class="iq-sub-card iq-bg-primary-success-hover">
                                    <div class="media align-items-center">
                                       <div class="rounded iq-card-icon iq-bg-success">
                                          <i class="ri-profile-line"></i>
                                       </div>
                                       <div class="media-body ml-3">
                                          <h6 class="mb-0 ">Edit Profile</h6>
                                          <p class="mb-0 font-size-12">Modify your personal details.</p>
                                       </div>
                                    </div>
                                 </a>
                                 <a href="account-setting.html" class="iq-sub-card iq-bg-primary-danger-hover">
                                    <div class="media align-items-center">
                                       <div class="rounded iq-card-icon iq-bg-danger">
                                          <i class="ri-account-box-line"></i>
                                       </div>
                                       <div class="media-body ml-3">
                                          <h6 class="mb-0 ">Account settings</h6>
                                          <p class="mb-0 font-size-12">Manage your account parameters.</p>
                                       </div>
                                    </div>
                                 </a>
                                 
                                 <div class="d-inline-block w-100 text-center p-3">
                                    <a class="iq-bg-danger iq-sign-btn" href="sign-in.html" role="button">Sign out<i class="ri-login-box-line ml-2"></i></a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </li>
                  </ul>
               </nav>
            </div>
         </div>
         <!-- TOP Nav Bar END -->
         <!-- Page Content  -->
         <div id="content-page" class="content-page">
            <div class="container-fluid">
           
                  <div class="col-lg-12">
                     <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title">Order Summary</h4>
                           </div>
                           <div class="iq-card-header-toolbar d-flex align-items-center">
                              <div class="dropdown">
                                 <span class="dropdown-toggle text-primary" id="dropdownMenuButton5" data-toggle="dropdown">
                                 <i class="ri-more-2-fill"></i>
                                 </span>
                                 <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#"><i class="ri-eye-fill mr-2"></i>View</a>
                                    <a class="dropdown-item" href="#"><i class="ri-delete-bin-6-fill mr-2"></i>Delete</a>
                                    <a class="dropdown-item" href="#"><i class="ri-pencil-fill mr-2"></i>Edit</a>
                                    <a class="dropdown-item" href="#"><i class="ri-printer-fill mr-2"></i>Print</a>
                                    <a class="dropdown-item" href="#"><i class="ri-file-download-fill mr-2"></i>Download</a>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="iq-card-body">
                           <div class="table-responsive">
                              <table class="table mb-0 table-borderless">
                                 <thead>
                                    <tr>
                                       <th scope="col">Package No.</th>
                                       <th scope="col">Date</th>
                                       <th scope="col">Delivery</th>
                                       <th scope="col">Status</th>
                                       <th scope="col">Location</th>
                                       <th scope="col">Progress</th>

                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr>
                                       <td>#0879985</td>
                                       <td>26/12/2019</td>
                                       <td>30/12/2019</td>
                                       <td>
                                          <div class="badge badge-pill badge-success">Moving</div>
                                       </td>
                                       <td>Victoria 8007 Australia</td>
                                       <td>
                                          <div class="iq-progress-bar">
                                             <span class="bg-success" data-percent="90"></span>
                                          </div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>#0879984</td>
                                       <td>23/12/2019</td>
                                       <td>27/12/2019</td>
                                       <td>
                                          <div class="badge badge-pill badge-warning text-white">Pending</div>
                                       </td>
                                       <td>Athens 2745 Greece</td>
                                       <td>
                                          <div class="iq-progress-bar">
                                             <span class="bg-warning" data-percent="70"></span>
                                          </div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>#0879983</td>
                                       <td>18/12/2019</td>
                                       <td>21/12/2019</td>
                                       <td>
                                          <div class="badge badge-pill badge-danger">Canceled</div>
                                       </td>
                                       <td>Victoria 8007 Australia</td>
                                       <td>
                                          <div class="iq-progress-bar">
                                             <span class="bg-danger" data-percent="48"></span>
                                          </div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>#0879982</td>
                                       <td>14/12/2019</td>
                                       <td>20/12/2019</td>
                                       <td>
                                          <div class="badge badge-pill badge-info">Working</div>
                                       </td>
                                       <td>Delhi 0014 India</td>
                                       <td>
                                          <div class="iq-progress-bar">
                                             <span class="bg-info" data-percent="90"></span>
                                          </div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>#0879981</td>
                                       <td>10/12/2019</td>
                                       <td>18/12/2019</td>
                                       <td>
                                          <div class="badge badge-pill badge-success">Moving</div>
                                       </td>
                                       <td>Alabama 2741 USA</td>
                                       <td>
                                          <div class="iq-progress-bar">
                                             <span class="bg-success" data-percent="45"></span>
                                          </div>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
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
     <?php include 'footer.php'; ?>
      <!-- Footer END -->
     
   </body>
</html>
