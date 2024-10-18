<!doctype html>
<html lang="en">
    <?php include 'header.html'; ?>
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
            <div class="col-lg-3">
                  <div class="iq-card">
                     <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title">Add New User</h4>
                        </div>
                     </div>
                     <div class="iq-card-body">
                        <form>
                           <div class="form-group">
                              <div class="add-img-user profile-img-edit">
                                 <img class="profile-pic img-fluid" src="images/user/11.png" alt="profile-pic">
                                 <div class="p-image">
                                   <!-- <h5 class="upload-button">file upload</h5> -->
                                   <a href="javascript:void();" class="upload-button btn iq-bg-primary">File Upload</a>
                                   <input class="file-upload" type="file" accept="image/*">
                                </div>
                              </div>
                             <div class="img-extension mt-3">
                                <div class="d-inline-block align-items-center">
                                    <span>Only</span>
                                   <a href="javascript:void();">.jpg</a>
                                   <a href="javascript:void();">.png</a>
                                   <a href="javascript:void();">.jpeg</a>
                                   <span>allowed</span>
                                </div>
                             </div>
                           </div>
                          <!--  <div class="form-group">
                              <label>User Role:</label>
                              <select class="form-control" id="selectuserrole">
                                 <option>Select</option>
                                 <option>Web Designer</option>
                                 <option>Web Developer</option>
                                 <option>Tester</option>
                                 <option>Php Developer</option>
                                 <option>Ios Developer </option>
                              </select>
                           </div> -->
                           <!-- <div class="form-group">
                              <label for="furl">Facebook Url:</label>
                              <input type="text" class="form-control" id="furl" placeholder="Facebook Url">
                           </div>
                           <div class="form-group">
                              <label for="turl">Twitter Url:</label>
                              <input type="text" class="form-control" id="turl" placeholder="Twitter Url">
                           </div>
                           <div class="form-group">
                              <label for="instaurl">Instagram Url:</label>
                              <input type="text" class="form-control" id="instaurl" placeholder="Instagram Url">
                           </div>
                           <div class="form-group">
                              <label for="lurl">Linkedin Url:</label>
                              <input type="text" class="form-control" id="lurl" placeholder="Linkedin Url">
                           </div> -->
                        </form>
                     </div>
                  </div>
            </div>
            <div class="col-lg-9">
                  <div class="iq-card">
                     <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title">New User Information</h4>
                        </div>
                     </div>
                     <div class="iq-card-body">
                        <div class="new-user-info">
                           <form>
                              <div class="row">
                                 <div class="form-group col-md-6">
                                    <label for="fname">First Name:</label>
                                    <input type="text" class="form-control" id="fname" placeholder="First Name">
                                 </div>
                                 <div class="form-group col-md-6">
                                    <label for="lname">Last Name:</label>
                                    <input type="text" class="form-control" id="lname" placeholder="Last Name">
                                 </div>
                                 <div class="form-group col-md-6">
                                    <label for="dname">Designation:</label>
                                    <input type="text" class="form-control" id="cname" placeholder="Designation">
                                 </div>
                                 <div class="form-group col-md-6">
                                <label>Office:</label>
                                <select class="form-control" id="selectuserrole">
                                 <option>Select</option>
                                 <option>NCONF Ghaziabad</option>
                                 <option>RCONF Ghaziabad</option>
                                 <option>RCONF Bhubaneshwar</option>
                                 <option>RCONF Bangalore</option>
                                 <option>RCONF Nagpur </option>
                                 <option>RCONF Imphal </option>
                                </select>
                                </div>
                                <div class="form-group col-md-6">
                                <label>User Role:</label>
                                <select class="form-control" id="selectuserrole">
                                 <option>Select</option>
                                 <option>Web Designer</option>
                                 <option>Web Developer</option>
                                 <option>Tester</option>
                                 <option>Php Developer</option>
                                 <option>Ios Developer </option>
                                </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" id="email" placeholder="Email">
                                 </div>
                                 <div class="form-group col-md-6">
                                    <label for="mobno">Mobile Number:</label>
                                    <input type="text" class="form-control" id="mobno" placeholder="Mobile Number">
                                 </div>
                                 <div class="form-group col-md-6">
                                    <label for="altconno">Alternate Contact:</label>
                                    <input type="text" class="form-control" id="altconno" placeholder="Alternate Contact">
                                 </div>
                                 
                                 <div class="form-group col-md-6">
                                    <label for="add1">Street Address 1:</label>
                                    <input type="text" class="form-control" id="add1" placeholder="Street Address 1">
                                 </div>
                                 <div class="form-group col-md-6">
                                    <label for="add2">Street Address 2:</label>
                                    <input type="text" class="form-control" id="add2" placeholder="Street Address 2">
                                 </div>
                                 <div class="form-group col-md-6">
                                    <label for="city">Town/City:</label>
                                    <input type="text" class="form-control" id="city" placeholder="Town/City">
                                 </div>
                                 <div class="form-group col-sm-6">
                                    <label>State:</label>
                                    <select class="form-control" id="selectcountry">
                                       <option>Select State</option>
            <option>Andhra Pradesh</option>
            <option>Arunachal Pradesh</option>
            <option>Assam</option>
            <option>Bihar</option>
            <option>Chhattisgarh</option>
            <option>Goa</option>
            <option>Gujarat</option>
            <option>Haryana</option>
            <option>Himachal Pradesh</option>
            <option>Jharkhand</option>
            <option>Karnataka</option>
            <option>Kerala</option>
            <option>Madhya Pradesh</option>
            <option>Maharashtra</option>
            <option>Manipur</option>
            <option>Meghalaya</option>
            <option>Mizoram</option>
            <option>Nagaland</option>
            <option>Odisha</option>
            <option>Punjab</option>
            <option>Rajasthan</option>
            <option>Sikkim</option>
            <option>Tamil Nadu</option>
            <option>Telangana</option>
            <option>Tripura</option>
            <option>Uttar Pradesh</option>
            <option>Uttarakhand</option>
            <option>West Bengal</option>
            <option>Andaman and Nicobar Islands</option>
            <option>Chandigarh</option>
            <option>Dadra and Nagar Haveli and Daman and Diu</option>
            <option>Delhi</option>
            <option>Lakshadweep</option>
            <option>Puducherry</option>
            <option>Ladakh</option>
            <option>Jammu and Kashmir</option>
                                    </select>
                                 </div>
                                 <div class="form-group col-sm-6">
                                    <label>Country:</label>
                                    <select class="form-control" id="selectcountry">
                                       <option>Select Country</option>
                                       <option selected>Caneda</option>
                                       <option>USA</option>
                                       <option>India</option>
                                       <option>Africa</option>
                                    </select>
                                 </div>
                                 <div class="form-group col-md-6">
                                    <label for="pno">Pin Code:</label>
                                    <input type="text" class="form-control" id="pno" placeholder="Pin Code">
                                 </div>
                                 
                              </div>
                              <hr>
                              <h5 class="mb-3">Security</h5>
                              <div class="row">
                                 <div class="form-group col-md-12">
                                    <label for="uname">User Name:</label>
                                    <input type="text" class="form-control" id="uname" placeholder="User Name">
                                 </div>
                                 <div class="form-group col-md-6">
                                    <label for="pass">Password:</label>
                                    <input type="password" class="form-control" id="pass" placeholder="Password">
                                 </div>
                                 <div class="form-group col-md-6">
                                    <label for="rpass">Repeat Password:</label>
                                    <input type="password" class="form-control" id="rpass" placeholder="Repeat Password ">
                                 </div>
                              </div>
                              <div class="checkbox">
                                 <label><input class="mr-2" type="checkbox">Enable Two-Factor-Authentication</label>
                              </div>
                              <button type="submit" class="btn btn-primary">Add New User</button>
                           </form>
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