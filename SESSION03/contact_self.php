<?php
// Khởi tạo biến
$success = false;
$error = "";

$fullname = $email = $phone = $message = "";

// Detect form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Lấy dữ liệu + trim
    $fullname = trim($_POST['fullname']);
    $email    = trim($_POST['email']);
    $phone    = trim($_POST['phone']);
    $message  = trim($_POST['message']);

    // Validate dữ liệu
    if (empty($fullname) || empty($email) || empty($phone) || empty($message)) {
        $error = "Missing Data";
    } else {
        // Sanitize dữ liệu
        $fullname = htmlspecialchars($fullname);
        $email    = htmlspecialchars($email);
        $phone    = htmlspecialchars($phone);
        $message  = htmlspecialchars($message);

        // Đánh dấu submit thành công
        $success = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact (Self Processing)</title>
</head>
<body>

<h2>Contact Form</h2>

<?php if ($success): ?>

    <!-- Sau khi submit thành công -->
    <h3>Thank You!</h3>
    <p>Your message has been received.</p>

<?php else: ?>

    <!-- Hiển thị lỗi nếu có -->
    <?php
    if ($error) {
        echo "<p style='color:red;'>$error</p>";
    }
    ?>

    <!-- Hiển thị form -->
    <form method="post">
        <label>Full Name:</label><br>
        <input type="text" name="fullname" value="<?php echo $fullname; ?>"><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="<?php echo $email; ?>"><br><br>

        <label>Phone Number:</label><br>
        <input type="text" name="phone" value="<?php echo $phone; ?>"><br><br>

        <label>Message:</label><br>
        <textarea name="message"><?php echo $message; ?></textarea><br><br>

        <button type="submit">Send</button>
    </form>

<?php endif; ?>

</body>
</html>
