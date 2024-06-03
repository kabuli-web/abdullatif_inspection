<?php
include 'includes/session.php';

if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $logo = $_FILES['logo']['name'];
    $target = "images/" . basename($logo);

    // Prepare an INSERT statement
    $stmt = $conn->prepare("INSERT INTO hospital (name, address, phone, logo) VALUES (?, ?, ?, ?)");
    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("ssss", $name, $address, $phone, $logo);

        // Execute the statement
        if ($stmt->execute()) {
            // Upload file
            if (move_uploaded_file($_FILES['logo']['tmp_name'], $target)) {
                $_SESSION['success'] = 'تم إضافة المستشفى بنجاح';
            } else {
                $_SESSION['error'] = 'فشل تحميل الشعار';
            }
        } else {
            $_SESSION['error'] = $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        $_SESSION['error'] = 'خطأ في إعداد قاعدة البيانات';
    }
} else {
    $_SESSION['error'] = 'يرجى تعبئة الخانات المطلوبة';
}

header('location: hospital.php');
?>
