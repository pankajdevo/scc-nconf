
<!doctype html>
<html lang="en">
<?php include 'header.php';
include 'config.php';
// Handling form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sample_category = $_POST['sample_category'];
    $subcategory_sample = $_POST['subcategory_sample'];
    $physical_condition = $_POST['physical_condition'];
    $date_of_receipt = $_POST['date_of_receipt'];
    $inspector_sample_code = $_POST['inspector_sample_code'];
    $sampling_date = $_POST['sampling_date'];
    $expiry_date = $_POST['expiry_date'];
    $ao_code = $_POST['ao_code'];
    $inspector_name_address = $_POST['inspector_name_address'];
    $analysis_sent_to = $_POST['analysis_sent_to'];
     $added_by = $_SESSION['usersSession']['id'];
     $created_date = date('Y-m-d H:i:s');
     $status       = 1;  // for Assgned

    // Handle file upload
    $form_pk_pdf = "";
    if (isset($_FILES['form_pk_pdf']) && $_FILES['form_pk_pdf']['error'] == UPLOAD_ERR_OK) {
        $target_dir = "uploads/";
        $form_pk_pdf = $target_dir . basename($_FILES["form_pk_pdf"]["name"]);
        move_uploaded_file($_FILES["form_pk_pdf"]["tmp_name"], $form_pk_pdf);
    }

    // Insert data into the database
    $sql = "INSERT INTO sample_registration (sample_category, subcategory_sample, physical_condition, date_of_receipt, inspector_sample_code, sampling_date, expiry_date, ao_code, inspector_name_address, analysis_sent_to, form_pk_pdf,added_by,create_dt,status)
            VALUES ('$sample_category', '$subcategory_sample', '$physical_condition', '$date_of_receipt', '$inspector_sample_code', '$sampling_date', '$expiry_date', '$ao_code', '$inspector_name_address', '$analysis_sent_to', '$form_pk_pdf','$added_by','$created_date','$status')";

    if ($conn->query($sql) === TRUE) {
         echo "Record saved successfully.";
        @header("Location: sample-list.php"); 
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

$regions_query = "SELECT id, region_name FROM regions WHERE status = '1' and id != 1";
$regions_result = $conn->query($regions_query);
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
               <h5 class="mb-0">Add Sample </h5>
               <nav aria-label="breadcrumb">
                  <ul class="breadcrumb">
                     <li class="breadcrumb-item"><a href="#">Home</a></li>
                     <li class="breadcrumb-item active" aria-current="page">Add Sample</li>
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
                     
                  </div>
            </div>
            <div class="col-lg-12">
                  <div class="iq-card">
                     <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title" style="text-align: center;">
                           <h3 class="card-title">नमूना पंजीकरण फॉर्म/ SAMPLE REGISTRATION FORM A</h3><br>
                           <h4 class="card-title">नमूना पंजीकरण फॉर्म/ SAMPLE REGISTRATION FORM A</h4><br>
                        </div>
                     </div>
                     <div class="iq-card-body">
                        <div class="new-user-info">
                           <form action="" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="form-group col-md-9">
                        <label for="fname">जैव उर्वरक/जैविक उर्वरक/अखाद्य डिऑयल्ड केक का नाम और श्रेणी / Name and Grade of Bio Fertilizer/ Organic fertilizer/ Non edible Deoiledcake</label>
                        <select class="form-control" id="sample_category" name="sample_category" onchange="updateSubcategories()">
                            <option value="">Select</option>
                            <option value="Biofertilizer">Biofertilizer</option>
                            <option value="Organic-Fertilizer">Organic Fertilizer</option>
                            <option value="Non-Edible-De-Oiled">Non Edible De-Oiled</option>
                        </select>
                    </div>

                    <div class="form-group col-md-9">
                        <label for="fname">नमूने की संरचना/सूक्ष्मजीव का नाम / Composition of Sample/Name of micro-organism</label>
                        <select class="form-control" id="subcategory_sample" name="subcategory_sample">
                            <option value="">Select</option>
                        </select>
                    </div>

                    <div class="form-group col-md-9">
                        <label for="fname">नमूने की भौतिक स्थिति / Physical condition of the Sample</label>
                        <select class="form-control" id="physical_condition" name="physical_condition">
                            <option>Select</option>
                            <option>Intact</option>
                            <option>Damaged</option>
                        </select>
                    </div>

                    <div class="form-group col-md-9">
                        <label for="dname">नमूना प्राप्त करने की तिथि / Date of receipt of the sample</label>
                        <input type="date" class="form-control" id="date_of_receipt" name="date_of_receipt">
                    </div>

                    <div class="form-group col-md-9">
                        <label for="dname">निरीक्षक नमूना कोड संख्या / Inspector Sample Code No</label>
                        <input type="text" id="is_code" class="form-control" name="inspector_sample_code" readonly onclick="isc_generateCode()">
                    </div>

                    <div class="form-group col-md-9">
                        <label for="dname">निरीक्षक द्वारा नमूने लेने की तिथि / Date of Sampling by Inspector</label>
                        <input type="date" class="form-control" id="sampling_date" name="sampling_date">
                    </div>

                    <div class="form-group col-md-9">
                        <label for="dname">उत्पाद की समाप्ति तिथि / Expiry Date of Product</label>
                        <input type="date" class="form-control" id="expiry_date" name="expiry_date">
                    </div>

                    <div class="form-group col-md-9">
    <label for="dname">ए.ओ. कोडनं. / A.O. Code No.</label>
    <input type="text" class="form-control" name="ao_code" id="ao_code" readonly onclick="generateCode()">
    <!-- <button type="button" >Generate Code</button> -->
</div>

                    <div class="form-group col-md-9">
                        <label for="dname">उर्वरक निरीक्षक का नाम और पता तथा कार्यालय/ Name, Address & Office of Fertilizer Inspector drawing sample</label>
                        <input type="text" class="form-control" id="inspector_name_address" name="inspector_name_address">
                    </div>

                    <div class="form-group col-md-9">
                        <label>नमूना विश्लेषण के लिए भेजा गया/ Sample sent for Analysis to-</label>
                        <select class="form-control" id="analysis_sent_to" name="analysis_sent_to">
                            <option>Select</option>
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

                    <div class="form-group col-md-9">
                        <label for="myfile">Upload Form P & K (PDF Files):</label>
                        <input type="file" id="myfile" name="form_pk_pdf">
                    </div>

                    <div class="form-group col-md-9">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
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
      <?php include 'footer.php'; ?>
      <!-- Footer END -->
    
</body>
<script>
    let serialNumber = 1; // Initialize serial number

    function isc_generateCode() {
        // Generate 4 random letters
        let letters = '';
        const alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        for (let i = 0; i < 4; i++) {
            letters += alphabet[Math.floor(Math.random() * alphabet.length)];
        }

        // Get the current date in YYYYMMDD format
        const date = new Date();
        const currentDate = date.toISOString().slice(0, 10).replace(/-/g, '');

        // Generate the code with serial number
        const generatedCode = `${letters}-${currentDate}-${serialNumber}`;

        // Set the generated code in the input box
        document.getElementById('is_code').value = generatedCode;

        // Increment the serial number for the next click
        serialNumber++;
    }
</script>
<script>
    let serialNumber = 1; // Initialize serial number

    function generateCode() {
        // Generate 4 random letters
        let letters = '';
        const alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        for (let i = 0; i < 4; i++) {
            letters += alphabet[Math.floor(Math.random() * alphabet.length)];
        }

        // Get the current date in YYYYMMDD format
        const date = new Date();
        const currentDate = date.toISOString().slice(0, 10).replace(/-/g, '');

        // Generate the code with serial number
        const generatedCode = `${letters}-${currentDate}-${serialNumber}`;

        // Set the generated code in the input box
        document.getElementById('codeBox').value = generatedCode;

        // Increment the serial number for the next click
        serialNumber++;
    }
</script>

<script>
    // JavaScript for updating subcategories
    const subcategories = {
        "Biofertilizer": ["Azotobacter", "Rhizobium", "Azospirillum", "Phosphate Solubilizing Bacteria"],
        "Organic-Fertilizer": ["Vermicompost", "Compost", "Green Manure", "Farm Yard Manure"],
        "Non-Edible-De-Oiled": ["Neem Cake", "Mahua Cake", "Karanja Cake", "Castor Cake"]
    };

    function updateSubcategories() {
        const category = document.getElementById('sample_category').value;
        const subcategoryDropdown = document.getElementById('subcategory_sample');

        subcategoryDropdown.innerHTML = '<option value="">Select</option>';

        if (category && subcategories[category]) {
            subcategories[category].forEach(sub => {
                const option = document.createElement('option');
                option.value = sub.toLowerCase().replace(/\s+/g, '-');
                option.textContent = sub;
                subcategoryDropdown.appendChild(option);
            });
        }
    }
</script>

<script>
function generateCode() {
    const prefix = "SCCGZB"; // Replace 'FIXED' with your desired 5-letter prefix
    const currentDate = new Date().toISOString().slice(0, 10).replace(/-/g, ''); // Formats date as YYYYMMDD
    const serialNumber = Math.floor(Math.random() * 900) + 100; // Generates a 4-digit serial number

    const autoCode = `${prefix}${currentDate}${serialNumber}`;
    document.getElementById("ao_code").value = autoCode;
}
</script>
</html>


