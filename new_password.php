<?php
// new_password.php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['token'])) {
    $token = $_GET['token'];

    // Check if the token is valid
    $sql = "SELECT * FROM password_resets WHERE token = ? AND expires_at > NOW()";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Token is valid, show the form to set a new password
        echo '<form action="new_password.php" method="POST">
                <input type="hidden" name="token" value="'.$token.'">
                <div class="form-group">
                    <label for="password">New Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Reset Password</button>
              </form>';
    } else {
        echo "Invalid or expired token.";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['token']) && isset($_POST['password'])) {
    $token = $_POST['token'];
    $newPassword = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Verify token again and update password
    $sql = "SELECT email FROM password_resets WHERE token = ? AND expires_at > NOW()";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $email = $row['email'];

        // Update the user's password
        $sql = "UPDATE users SET password = ? WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $newPassword, $email);
        if ($stmt->execute()) {
            echo "Password has been reset.";
            
            // Delete the token
            $sql = "DELETE FROM password_resets WHERE token = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('s', $token);
            $stmt->execute();
        } else {
            echo "Failed to reset password.";
        }
    } else {
        echo "Invalid or expired token.";
    }
}
?>
