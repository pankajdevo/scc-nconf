<?php
// Manually include the mPDF library
require 'mpdf/src/Mpdf.php'; // Update the path to the correct location of the Mpdf.php file
require_once 'mpdf/src/Strict.php';

include 'config.php'; // Include database connection

// SQL query to fetch data
$sql = "SELECT sample_category, subcategory_sample, physical_condition, date_of_receipt, inspector_sample_code, sampling_date, expiry_date, ao_code, inspector_name_address, analysis_sent_to FROM sample_registration";

// Execute the query
$result = $conn->query($sql);

// Check if the query execution was successful
if (!$result) {
    die("Query failed: " . $conn->error);
}

// Create a new PDF document using mPDF
$mpdf = new \Mpdf\Mpdf(['default_font' => 'dejavusans']);

// Start HTML content of the form
$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .header { text-align: center; font-size: 14px; }
        .sub-header { text-align: center; font-size: 10px; margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; font-size: 10px; }
        th { background-color: #f2f2f2; }
        .footer { margin-top: 20px; }
        .signature { text-align: right; font-size: 10px; }
    </style>
</head>
<body>
    <div class="header">
        // <strong>राष्ट्रीय जैविक एवं प्राकृतिक खेती केंद्र, गाज़ियाबाद</strong>
        // <br>
        National Center for Organic and Natural Farming, Ghaziabad<br>
        <strong>प्रपत्र- B / Proforma – B</strong><br>
        रा.जै.प्रा.खे.कें., गाजियाबाद में पुन: कोडित नमूने पर लेबल चिपकाया जाएगा।<br>
        Label to be pasted over recoded sample at NCONF, Ghaziabad.
    </div>
';

// Check if there are records
if ($result && $result->num_rows > 0) {
    // Loop through each record and add it to the HTML
    while ($row = $result->fetch_assoc()) {
        $html .= '
        <table>
            <tr>
                <td>Sample Category:</td>
                <td>' . htmlspecialchars($row['sample_category']) . '</td>
            </tr>
            <tr>
                <td>Subcategory:</td>
                <td>' . htmlspecialchars($row['subcategory_sample']) . '</td>
            </tr>
            <tr>
                <td>Physical Condition:</td>
                <td>' . htmlspecialchars($row['physical_condition']) . '</td>
            </tr>
            <tr>
                <td>Receipt Date:</td>
                <td>' . htmlspecialchars($row['date_of_receipt']) . '</td>
            </tr>
            <tr>
                <td>Sample Code:</td>
                <td>' . htmlspecialchars($row['inspector_sample_code']) . '</td>
            </tr>
            <tr>
                <td>Sampling Date:</td>
                <td>' . htmlspecialchars($row['sampling_date']) . '</td>
            </tr>
            <tr>
                <td>Expiry Date:</td>
                <td>' . htmlspecialchars($row['expiry_date']) . '</td>
            </tr>
            <tr>
                <td>AO Code:</td>
                <td>' . htmlspecialchars($row['ao_code']) . '</td>
            </tr>
            <tr>
                <td>Inspector Address:</td>
                <td>' . htmlspecialchars($row['inspector_name_address']) . '</td>
            </tr>
            <tr>
                <td>Analysis Sent To:</td>
                <td>' . htmlspecialchars($row['analysis_sent_to']) . '</td>
            </tr>
        </table>
        <hr>
        ';
    }
} else {
    // Display if no data is found
    $html .= '<p>No data found</p>';
}

// End HTML content
$html .= '
    <div class="footer">
        <p class="signature">
            अधिकृत अधिकारी / Authorized Officer<br>
            सैंपल कोडिंग सेल, एनसीओएफ गाजियाबाद<br>
            Sample Coding Cell, NCONF Ghaziabad<br>
            दिनांक/Date: ………………………..
        </p>
    </div>
    <p>धातु की सील/ Metallic Seal</p>
</body>
</html>
';

// Write the HTML content to the PDF
$mpdf->WriteHTML($html);

// Output the generated PDF in the browser for viewing
$mpdf->Output('FORM_B.pdf', 'I'); // 'I' displays the PDF in the browser

// Close the database connection
$conn->close();
?>
