<?php
include 'includes/session.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $logo = $_FILES['logo']['name'];
    $target = "images/" . basename($logo);

    if (empty($logo)) {
        // Update without changing the logo
        $stmt = $conn->prepare("UPDATE hospital SET name = ?, address = ?, phone = ? WHERE id = ?");
        if ($stmt) {
            $stmt->bind_param("sssi", $name, $address, $phone, $id);
        }
    } else {
        // Update with changing the logo
        $stmt = $conn->prepare("UPDATE hospital SET name = ?, address = ?, phone = ?, logo = ? WHERE id = ?");
        if ($stmt) {
            $stmt->bind_param("ssssi", $name, $address, $phone, $logo, $id);
        }
    }

    if ($stmt) {
        if ($stmt->execute()) {
            if (!empty($logo)) {
                // Upload file if logo is changed
                if (!move_uploaded_file($_FILES['logo']['tmp_name'], $target)) {
                    $_SESSION['error'] = 'فشل تحميل الشعار';
                }
            }
            $_SESSION['success'] = 'تم تحديث المستشفى بنجاح';
        } else {
            $_SESSION['error'] = $stmt->error;
        }

        $stmt->close();
    } else {
        $_SESSION['error'] = 'خطأ في إعداد قاعدة البيانات';
    }
} else {
    $_SESSION['error'] = 'يرجى تعبئة الخانات المطلوبة';
}

header('location: hospital.php');
?>
