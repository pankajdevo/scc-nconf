<?php
include 'config.php';

// Check if a file is uploaded
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['report']) && isset($_POST['id'])) {
    $sample_id = $_POST['id'];
    $file = $_FILES['report'];

    // Check for errors
    if ($file['error'] === 0) {
        $file_name = $file['name'];
        $file_tmp = $file['tmp_name'];

        // Define the destination path
        $upload_dir = 'uploads/reports/';
        $file_path = $upload_dir . basename($file_name);

        // Move the uploaded file to the desired directory
        if (move_uploaded_file($file_tmp, $file_path)) {
            // Update the database with the file path
            $sql = "UPDATE sample_registration SET report_pdf = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $file_name, $sample_id);

            if ($stmt->execute()) {
                echo "File uploaded successfully!";
                 echo "<script>
                        setTimeout(function() {
                            window.location.href = 'sample-list.php';
                        }, 5000);
                      </script>";
            } else {
                echo "Failed to update database.";
            }
        } else {
            echo "Failed to upload file.";
        }
    } else {
        echo "Error in file upload.";
    }
} else {
    echo "No file or sample ID provided.";
}
?>
