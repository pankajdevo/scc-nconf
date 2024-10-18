<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader (if you're using Composer)
require 'vendor/autoload.php';

// Or manually include PHPMailer (if not using Composer)
// require 'path_to_phpmailer/PHPMailer/src/Exception.php';
// require 'path_to_phpmailer/PHPMailer/src/PHPMailer.php';
// require 'path_to_phpmailer/PHPMailer/src/SMTP.php';

// Include database configuration
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Check if the email exists
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Generate reset token and expiration time
        $token = bin2hex(random_bytes(50));
        $expiry = date("Y-m-d H:i:s", strtotime("+1 hour")); // Token valid for 1 hour

        // Insert token into password_resets table
        $sql = "INSERT INTO password_resets (email, token, expires_at) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sss', $email, $token, $expiry);
        $stmt->execute();

        // Setup PHPMailer to send the reset email
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com'; // Set the SMTP server
            $mail->SMTPAuth   = true;
            $mail->Username   = 'your_email@gmail.com'; // Your Gmail address
            $mail->Password   = 'your_app_password'; // Your Gmail app password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Recipients
            $mail->setFrom('your_email@gmail.com', 'Your Name');
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Password Reset Request';
            $resetLink = "http://yourwebsite.com/new_password.php?token=" . $token;
            $mail->Body    = "Click the following link to reset your password: <a href='$resetLink'>$resetLink</a>";

            $mail->send();
            echo 'Password reset instructions have been sent to your email.';
        } catch (Exception $e) {
            echo "Failed to send reset email. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Email does not exist.";
    }
}
