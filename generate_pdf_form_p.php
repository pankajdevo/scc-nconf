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
    // echo "No records found!";
    exit();
}
$ao_code=$row['ao_code'];
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
                font-size: 14px;
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
<br>
    <h3>राष्ट्रीय जैविक एवं प्राकृतिक खेती केंद्र, गाज़ियाबाद</h3>
    <h3>National Center for Organic and Natural Farming, Ghaziabad</h3>
    <h4>नमूना पंजीकरण फॉर्म/ SAMPLE REGISTRATION FORM A</h4>
    <p>फॉर्म "पी" का विवरण /Details of Form "P"</p>

    <table border="1">
        <tr>
            <th>1.       जैव उर्वरक/जैविक उर्वरक/अखाद्य डिऑयल्ड केक का नाम और श्रेणी-
<br>
                Name and Grade of Bio Fertilizer/ Organic fertilizer/ Non edible Deoiledcake</th>
            <td><?php echo $row['sample_category']; ?></td>
        </tr>
        <tr>
            <th>2.       नमूने की संरचना/सूक्ष्मजीव का नाम-
<br>
                Composition of Sample/Name of micro-organism</th>
            <td><?php echo $row['subcategory_sample']; ?></td>
        </tr>
        <tr>
            <th>3.       नमूने की भौतिक स्थिति (बरकरार/क्षतिग्रस्त)-
<br>
                Physical condition of the Sample (intact/damaged)</th>
            <td><?php echo $row['physical_condition']; ?></td>
        </tr>
        <tr>
            <th>4.       नमूना प्राप्त करने की तिथि 
<br>
                Date of receipt of the sample</th>
            <td><?php echo $row['date_of_receipt']; ?></td>
        </tr>
        <tr>
            <th>5.       निरीक्षक नमूना कोड संख्या-
<br>
                Inspector Sample Code No</th>
            <td><?php echo $row['inspector_sample_code']; ?></td>
        </tr>
        <tr>
            <th>6.       निरीक्षक द्वारा नमूने लेने की तिथि-
<br>
                Date of Sampling by Inspector</th>
            <td><?php echo $row['sampling_date']; ?></td>
        </tr>
        <tr>
            <th>7.    उत्पाद की समाप्ति तिथि-
<br>
                Expiry Date of Product</th>
            <td><?php echo $row['expiry_date']; ?></td>
        </tr>
        <tr>
            <th>8.       ए.ओ. कोडनं. / A.O. Code No.
</th>
            <td><?php echo $row['ao_code']; ?></td>
        </tr>
        <tr>
            <th>9.       उर्वरक निरीक्षक का नाम और पता तथा कार्यालय
<br>
                Name, Address & Office of Fertilizer Inspector drawing sample</th>
            <td><?php echo $row['inspector_name_address']; ?></td>
        </tr>
        <tr>
            <th>12.    नमूना विश्लेषण के लिए भेजा गया/ Sample sent for Analysis to-
</th>
            <td><?php echo $row['analysis_sent_to']; ?></td>
        </tr>
        <tr>
            <th>13.    Date of Despatch

</th>
            <td><?php echo date("d.m.Y"); ?></td>
        </tr>
    </table>

    <br><br><br><br><br><br><br>
    <h4 style="text-align:Right;">अधिकृत अधिकारी के हस्ताक्षर/ Signature of Authorized Officer</h4>
    <p style="text-align:Right;">नमूना कोडिंग सेल, रा.जै.प्रा.खे.कें. गाजियाबाद/ Sample Coding Cell, NCONF Ghaziabad</p>

    <br><br>
    
    <!-- <table> -->
        <tr>
            <th>डिकोडिंग/ Decoding</th>
            <td></td>
        </tr><br>   
        <tr>
            <th>परीक्षा परिणाम प्राप्त होने की तिथि<br>Date of receipt of test result</th>
            <td>:</td>
        </tr>
        <tr>
            <th>क्षे.जै.प्रा.खे.कें. परीक्षण प्रयोगशाला को फॉर्म-पी के प्रकटीकरण की तिथि<br>
                Date of disclosure of Form-P to RCONF Testing Lab</th>
            <td>:</td>
        </tr>
        <tr>
            <th>परीक्षण परिणाम<br>Sample Result</th>
            <td>:</td>
        </tr>
    <!-- </table> -->

    <br><br><br><br><br><br>
    <h4 style="text-align:left;">अधिकृत अधिकारी के हस्ताक्षर/ Signature of Authorized Officer</h4>
    <p style="text-align:left;">नमूना कोडिंग सेल, रा.जै.प्रा.खे.कें. गाजियाबाद/ Sample Coding Cell, NCONF Ghaziabad</p>

    <br>
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
    echo "No data received!";
    exit();
}

// Create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle('Sample Registration Form');

// Set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Sample Registration', 'Generated PDF');

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
<h1>राष्ट्रीय जैविक एवं प्राकृतिक खेती केंद्र, गाज़ियाबाद</h1>
<h2>National Center for Organic and Natural Farming, Ghaziabad</h2>
<h3>नमूना पंजीकरण फॉर्म/ SAMPLE REGISTRATION FORM A</h3>
<p>फॉर्म "पी" का विवरण /Details of Form "P"</p>

<table border="1" cellpadding="5">
    <tr><th>जैव उर्वरक/जैविक उर्वरक/अखाद्य डिऑयल्ड केक का नाम और श्रेणी</th><td>'.$sampleData['sample_category'].'</td></tr>
    <tr><th>नमूने की संरचना/सूक्ष्मजीव का नाम</th><td>'.$sampleData['subcategory_sample'].'</td></tr>
    <tr><th>नमूने की भौतिक स्थिति</th><td>'.$sampleData['physical_condition'].'</td></tr>
    <tr><th>नमूना प्राप्त करने की तिथि</th><td>'.$sampleData['date_of_receipt'].'</td></tr>
    <tr><th>निरीक्षक नमूना कोड संख्या</th><td>'.$sampleData['inspector_sample_code'].'</td></tr>
    <tr><th>निरीक्षक द्वारा नमूने लेने की तिथि</th><td>'.$sampleData['sampling_date'].'</td></tr>
    <tr><th>उत्पाद की समाप्ति तिथि</th><td>'.$sampleData['expiry_date'].'</td></tr>
    <tr><th>ए.ओ. कोडनं</th><td>'.$sampleData['ao_code'].'</td></tr>
    <tr><th>उर्वरक निरीक्षक का नाम और पता</th><td>'.$sampleData['inspector_name_address'].'</td></tr>
    <tr><th>नमूना विश्लेषण के लिए भेजा गया</th><td>'.$sampleData['analysis_sent_to'].'</td></tr>

</table>';

// Output the HTML content to PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Close and output PDF document
// $pdf->Output('generate_pdf_form_p.pdf', 'I');
// $pdf->Output('D', 'generate_pdf_form_p.pdf'); // 'D' forces download
$pdf->Output('D', 'sample_' . $ao_code . '_form_p.pdf'); // 'D' forces download
?>
