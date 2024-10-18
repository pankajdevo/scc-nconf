<?php
// Include FPDF library
require('fpdf/fpdf.php');
include 'config.php'; // Include database connection

// SQL query to fetch data
$sql = "SELECT sample_category, subcategory_sample, physical_condition, date_of_receipt, inspector_sample_code, sampling_date, expiry_date, ao_code, inspector_name_address, analysis_sent_to FROM sample_registration";

// Execute the query
$result = $conn->query($sql);

// Check if the query execution was successful
if (!$result) {
    die("Query failed: " . $conn->error);
}

// Create a new PDF document
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);

// Adding the header
$pdf->Cell(0, 10, 'Sample Registration Report', 0, 1, 'C');
$pdf->Ln(10);

// Check if there are records
if ($result && $result->num_rows > 0) {
    // Loop through each record and display in a vertical format
    while ($row = $result->fetch_assoc()) {
        // Draw a border around each record
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(190, 10, 'Record', 1, 1, 'C');

        // Display each field in a row
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(50, 10, 'Category:', 1);
        $pdf->Cell(140, 10, htmlspecialchars($row['sample_category']), 1, 1);

        $pdf->Cell(50, 10, 'Subcategory:', 1);
        $pdf->Cell(140, 10, htmlspecialchars($row['subcategory_sample']), 1, 1);

        $pdf->Cell(50, 10, 'Physical Condition:', 1);
        $pdf->Cell(140, 10, htmlspecialchars($row['physical_condition']), 1, 1);

        $pdf->Cell(50, 10, 'Receipt Date:', 1);
        $pdf->Cell(140, 10, htmlspecialchars($row['date_of_receipt']), 1, 1);

        $pdf->Cell(50, 10, 'Sample Code:', 1);
        $pdf->Cell(140, 10, htmlspecialchars($row['inspector_sample_code']), 1, 1);

        $pdf->Cell(50, 10, 'Sampling Date:', 1);
        $pdf->Cell(140, 10, htmlspecialchars($row['sampling_date']), 1, 1);

        $pdf->Cell(50, 10, 'Expiry Date:', 1);
        $pdf->Cell(140, 10, htmlspecialchars($row['expiry_date']), 1, 1);

        $pdf->Cell(50, 10, 'AO Code:', 1);
        $pdf->Cell(140, 10, htmlspecialchars($row['ao_code']), 1, 1);

        $pdf->Cell(50, 10, 'Inspector Address:', 1);
        $pdf->Cell(140, 10, htmlspecialchars($row['inspector_name_address']), 1, 1);

        $pdf->Cell(50, 10, 'Analysis Sent To:', 1);
        $pdf->Cell(140, 10, htmlspecialchars($row['analysis_sent_to']), 1, 1);

        // Add a gap between records
        $pdf->Ln(5);
    }
} else {
    $pdf->Cell(0, 10, 'No data found', 1, 1, 'C');
}

// Output the generated PDF in the browser for viewing
$pdf->Output('I', 'FORM_B.pdf'); // 'I' displays the PDF in the browser
$conn->close();
?>

