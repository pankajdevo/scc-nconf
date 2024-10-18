<!doctype html>
<html lang="en">
 <?php 

include 'header.php'; 
include 'config.php';
require('fpdf/fpdf.php');

// Array of status IDs - move this above where it's needed
$status_ids = [1, 2, 3, 4, 5, 6,7];

// Define the function to get status options
function getStatus($status_id) { 
    switch ($status_id) {
        case 1:
            return 'Assigned';
        case 2:
            return 'Received Sample By Region';
        case 3:
            return 'Not Received By Region';
        case 4:
            return 'Submit Phase 1 Report';
        case 5:
            return 'Phase 1 Report Received from Analyst By Incharge';
        case 6:
            return 'Final Report Pending';
        case 7:
            return 'Completed';
        default:
            return 'Pending';
    }
}

$sql = '';
if ($_SESSION['usersSession']['role_id'] == 1) {
    $sql = "SELECT sr.*, r.region_name 
            FROM sample_registration sr 
            LEFT JOIN regions r ON sr.analysis_sent_to = r.id 
            ORDER BY sr.id DESC";
} else {
    $region_id = $_SESSION['usersSession']['region_id'];
    $sql = "SELECT sr.*, r.region_name 
            FROM sample_registration sr 
            LEFT JOIN regions r ON sr.analysis_sent_to = r.id 
            WHERE sr.analysis_sent_to = '".$region_id."' 
            ORDER BY sr.id DESC";
}
$result = $conn->query($sql);
?>

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
               <h5 class="mb-0">Sample List</h5>
               <nav aria-label="breadcrumb">
                  <ul class="breadcrumb">
                     <li class="breadcrumb-item"><a href="#">Home</a></li>
                     <li class="breadcrumb-item active" aria-current="page">Sample List</li>
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
                           <h4 class="card-title">Sample List</h4>
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

    <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
    <thead style="text-align: center;">
        <tr>
            <th>Sr.No</th>
            <th>Sample Type</th>
            <th>Receipt Date</th>
            <th>Insp S.Code</th>
            <th>AO Code</th>
            <th>Sample Analysis</th>
            <th>FORM P & K</th>
            <th>FORM P</th>
            <th>FORM B</th>
            <th>FORM B1</th>
            <th>Phase 1 Report</th>
            <th>Final Report</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody style="text-align: center;">
        <?php
        // Check if there are results and loop through each row to display
        if ($result->num_rows > 0) {
            $srNo = 1;
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $srNo++ . "</td>";
                echo "<td>" . htmlspecialchars($row['sample_category']) . "</td>";
                echo "<td>" . htmlspecialchars($row['date_of_receipt']) . "</td>";
                echo "<td>" . htmlspecialchars($row['inspector_sample_code']) . "</td>";
                echo "<td>" . htmlspecialchars($row['ao_code']) . "</td>";
                echo "<td>" . htmlspecialchars($row['region_name']) . "</td>";

                
                // Assuming `form_pk_pdf` stores file names or paths
                if($_SESSION['usersSession']['role_id'] != 1  ){
                     if($row['status'] == 6) {
                      echo "<td><a href='uploads/{$row['form_pk_pdf']}' download>Download</a> | <a href='{$row['form_pk_pdf']}' target='_blank'>View</a></td>";
                        echo "<td> <a href='generate_pdf_form_p.php' target='_blank'>Download Form P</a></td>";
                     }else{
                         echo "<td>--</td>";
                         echo "<td>--</td>";
                     }

                }else{
                  echo "<td><a href='uploads/{$row['form_pk_pdf']}' download>Download</a> | <a href='{$row['form_pk_pdf']}' target='_blank'>View</a></td>";
                   echo "<td> <a href='generate_pdf_form_p.php' target='_blank'>Download Form P</a></td>";
                }
                

                echo "<td> <a href='generate_pdf_form_b.php' target='_blank' >Download Form B</a></td>";

               echo "<td><a href='generate_pdf_form_b1.php' target='_blank' >Download Form B1</a></td>";


                echo "<td>
                    <button class='btn btn-secondary' onclick='uploadReport()'>Upload phase 1 Report</button>
                    <form id='reportForm' action='upload_report.php' method='post' enctype='multipart/form-data' style='display:none;'>
                        <input type='file' name='report' id='reportInput' accept='application/pdf'>
                        <input type='hidden' name='id' value='{$row['id']}'>
                    </form>
                </td>";

                echo "<td>
                    <button class='btn btn-secondary' onclick='uploadReport()'>Upload final Report</button>
                    <form id='reportForm' action='upload_final_report.php' method='post' enctype='multipart/form-data' style='display:none;'>
                        <input type='file' name='report' id='reportInput' accept='application/pdf'>
                        <input type='hidden' name='id' value='{$row['id']}'>
                    </form>
                </td>";
                echo "<td><span class='badge iq-bg-primary'>".getStatus($row['status'])."</span></td>";



               echo "<td>
                    <div class='flex align-items-center list-user-action'>
                        <select name='status_action' class='form-control'>";
                            foreach ($status_ids as $status_id) {
                                // Check if the current status matches the status in the row and mark it as selected
                                $selected = ($row['status'] == $status_id) ? 'selected' : '';
                                echo "<option value='" . htmlspecialchars($status_id) . "' $selected>" . htmlspecialchars(getStatus($status_id)) . "</option>";
                            }
                        echo "</select>
                    </div>
                </td>";

                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='11'>No data found</td></tr>";
        }

        // Close the database connection
        $conn->close();
        ?>
    </tbody>
</table>

<script>
function uploadReport() {
    document.getElementById('reportInput').click(); // Opens the file selector
}

document.getElementById('reportInput').onchange = function() {
    document.getElementById('reportForm').submit(); // Submits the form when a file is selected
};
</script>

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
     
     <!-- Wrapper END -->
    <!-- Footer -->
      <?php include 'footer.php'; ?>
      <!-- Footer END -->
    
</body>
</html>




