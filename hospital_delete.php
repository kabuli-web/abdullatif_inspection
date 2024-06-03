<?php
include 'includes/session.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Prepare a DELETE statement
    $stmt = $conn->prepare("DELETE FROM hospital WHERE id = ?");
    if ($stmt) {
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $_SESSION['success'] = 'تم حذف المستشفى بنجاح';
        } else {
            $_SESSION['error'] = $stmt->error;
        }

        $stmt->close();
    } else {
        $_SESSION['error'] = 'خطأ في إعداد قاعدة البيانات';
    }
} else {
    $_SESSION['error'] = 'خطأ في الحصول على بيانات المستشفى';
}

header('location: hospital.php');
?>
