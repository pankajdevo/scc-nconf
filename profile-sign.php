<div class="collapse navbar-collapse" id="navbarSupportedContent"> </div>
 <ul class="navbar-list">
                     <li>
                        <a href="#" class="search-toggle iq-waves-effect bg-primary text-white"><img src="images/user/1.jpg" class="img-fluid rounded" alt="user"></a>
                        <div class="iq-sub-dropdown iq-user-dropdown">
                           <div class="iq-card shadow-none m-0">
                              <div class="iq-card-body p-0 ">
                                 <div class="bg-primary p-3">
                                    <h5 class="mb-0 text-white line-height">
                                       Hello   <?php echo isset($_SESSION['username'])?$_SESSION['username']:'';  ?>
                                       
                                       ( <?php echo isset($_SESSION['usersSession']['role_name'])?$_SESSION['usersSession']['role_name']:'';  ?>)

                                       ( <?php echo isset($_SESSION['usersSession']['region_name'])?$_SESSION['usersSession']['region_name']:'';  ?>)

                                      </h5>
                                    
                                 </div>
                               
                                 <a href="profile-edit.php" class="iq-sub-card iq-bg-primary-success-hover">
                                    <div class="media align-items-center">
                                       <div class="rounded iq-card-icon iq-bg-success">
                                          <i class="ri-profile-line"></i>
                                       </div>
                                       <div class="media-body ml-3">
                                          <h6 class="mb-0 ">Edit Profile </h6>
                                          <p class="mb-0 font-size-12">Modify your personal details.</p>
                                       </div>
                                    </div>
                                 </a>
                                 
                                  <div class="d-inline-block w-100 text-center p-3">
                                    <a class="iq-bg-danger iq-sign-btn" href="logout.php" role="button">Sign out<i class="ri-login-box-line ml-2"></i></a>
                                 </div>
                                
                                 
                              </div>
                           </div>
                        </div>
                     </li>
                  </ul>