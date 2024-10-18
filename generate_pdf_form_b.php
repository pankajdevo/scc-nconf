<?php
// Include database connection
include 'config.php';

// SQL query to fetch data from the database
$sql = "SELECT sample_category, subcategory_sample, physical_condition, date_of_receipt, inspector_sample_code, sampling_date, expiry_date, ao_code, inspector_name_address, analysis_sent_to FROM sample_registration WHERE id = 1"; // Fetching for a specific sample (you can adjust the WHERE condition)
$result = $conn->query($sql);

// Check if record exists
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc(); // Fetch the single row
} else {
    echo "No records found!";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!--  <title>Sample Registration Form</title> -->
    <style>
        /* General styling */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 2px solid black;
            padding: 7px; /* Reduced padding for compact layout */
            text-align: left;
        }
        h3, h4, p {
            text-align: center;
            margin: 7px 0; /* Reduced margin for headings */
        }
        th {
            background-color: #f2f2f2;
        }

        /* Styling for printing */
        @media print {
            body {
                font-size: 16px;
                margin: 0;
                padding: 0;
            }
            table, th, td {
                border-width: 0.5px;
                padding: 4px; /* Further reduced padding for printing */
            }
            h3, h4 {
                margin: 0; /* Minimized margin for headings */
            }
            /* Fit to A4 page size */
            @page {
                size: A4;
                margin: 10mm; /* Margin set to fit content on one page */
            }
        }
    </style>
</head>

<body>
<br><br><br>
    <h3>राष्ट्रीय जैविक एवं प्राकृतिक खेती केंद्र, गाज़ियाबाद</h3>
    <h3>National Center for Organic and Natural Farming</h3>
    <h4>प्रपत्र- B / Proforma – B</h4>
    <p>रा.जै.प्रा.खे.कें., गाजियाबाद में पुन: कोडित नमूने पर लेबल चिपकाया जाएगा।<br>
    Label to be pasted over recoded sample at NCONF, Ghaziabad.</p>
    <br>

    <table border="1" cellpadding="4">
        <tr>
            <th>रा.जै.प्रा.खे.कें.कोड/ NCONF Code:</th>
             <td><?php echo $row['ao_code']; ?></td>
        </tr>
        <tr>
            <th>जैव उर्वरक/जैविक उर्वरक/अखाद्य डीऑइल्ड केक का नमूना<br>Sample of Bio Fertilizer/Organic fertilizer/Non edible Deoiled cake</th>
            <td><?php echo $row['sample_category']; ?></td>
        </tr>
        <tr>
            <th>जैव उर्वरक/जैविक उर्वरक/अखाद्य डीऑयल्ड केक का सामान्य नाम<br>Generic name of Bio Fertilizer/ Organic fertilizer/ Non edibleDeoiled cake</th>
            <!-- <td>' . $row['subcategory_sample'] . '</td> -->
             <td><?php echo $row['subcategory_sample']; ?></td>
        </tr>
        <tr>
            <th>नमूने की संरचना/सूक्ष्मजीवका नाम<br>Composition of Sample/Name of microorganism</th>
            <!-- <td>' . $row['physical_condition'] . '</td> -->
             <td><?php echo $row['physical_condition']; ?></td>
        </tr>
        <tr>
            <th>नमूने की समाप्ति तिथि <br>Expiry date of the Sample</th>
           <!--  <td>' . $row['expiry_date'] . '</td> -->
             <td><?php echo $row['expiry_date']; ?></td>
        </tr>
    </table>

    <br><br><br><br><br><br><br>
    <p style="text-align:right;">अधिकृत अधिकारी / Authorized Officer</p>
    <p style="text-align:right;">सैंपल कोडिंग सेल, एनसीओएफ गाजियाबाद</p>
    <p style="text-align:left;">दिनांक/Date: ………………………..</p>
    <p style="text-align:left;">धातु की सील/ Metallic Seal</p>

    
    <form action="" method="post">
        <input type="hidden" name="sample_data" value='<?php echo json_encode($row); ?>'>
     <!--    <input type="submit" value="Download PDF"> -->
    </form>

</body>
</html>


<?php
require_once('tcpdf/tcpdf.php');

// Get the data from the POST request
if (isset($_POST['sample_data'])) {
    $sampleData = json_decode($_POST['sample_data'], true);
} 
else {
    // echo "No data received!";
    exit();
}

// Create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle('Proforma – B');

// Set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Proforma – B', 'Generated PDF');

// Set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// Set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// Set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Add a page
$pdf->AddPage();

// Set font for content
$pdf->SetFont('dejavusans', '', 10);

// Prepare HTML content for PDF
$html = '
    <h3>राष्ट्रीय जैविक एवं प्राकृतिक खेती केंद्र, गाज़ियाबाद</h3>
    <h3>National Center for Organic and Natural Farming</h3>
    <h4>प्रपत्र- B / Proforma – B</h4>
    <p>रा.जै.प्रा.खे.कें., गाजियाबाद में पुन: कोडित नमूने पर लेबल चिपकाया जाएगा।<br>
    Label to be pasted over recoded sample at NCONF, Ghaziabad.</p>

    <table border="1" cellpadding="4">

     <tr>
            <th>रा.जै.प्रा.खे.कें.कोड/ NCONF Code:</th>
             
             <td>'.$sampleData['ao_code'].'</td>
        </tr>
        <tr>
            <th>जैव उर्वरक/जैविक उर्वरक/अखाद्य डीऑइल्ड केक का नमूना<br>Sample of Bio Fertilizer/Organic fertilizer/Non edible Deoiled cake</th>
           
            <td>'.$sampleData['sample_category'].'</td>
        </tr>
        <tr>
            <th>जैव उर्वरक/जैविक उर्वरक/अखाद्य डीऑयल्ड केक का सामान्य नाम<br>Generic name of Bio Fertilizer/ Organic fertilizer/ Non edibleDeoiled cake</th>
            
             <td>'.$sampleData['subcategory_sample'].'</td>
        </tr>
        <tr>
            <th>नमूने की संरचना/सूक्ष्मजीवका नाम<br>Composition of Sample/Name of microorganism</th>
           
             <td>'.$sampleData['physical_condition'].'</td>
        </tr>
        <tr>
            <th>नमूने की समाप्ति तिथि <br>Expiry date of the Sample</th>
          
             <td>'.$sampleData['expiry_date'].'</td>
        </tr>
    </table>

    <br><br>

    <p style="text-align:right;">अधिकृत अधिकारी / Authorized Officer</p>
    <p style="text-align:right;">सैंपल कोडिंग सेल, एनसीओएफ गाजियाबाद</p>
    <p style="text-align:left;">दिनांक/Date: ………………………..</p>
    <p style="text-align:left;">धातु की सील/ Metallic Seal</p>
';

// Output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// Close and output PDF document (to the browser in inline mode)
$pdf->Output('generate_pdf_form_b.pdf', 'D');
?>
