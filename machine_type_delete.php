<?php
include 'includes/session.php';

if (isset($_POST['delete'])) {
    $id = $_POST['machine_type_id'];

    // Prepare a DELETE statement
    $stmt = $conn->prepare("DELETE FROM machine_type WHERE id = ?");
    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("i", $id);

        // Execute the statement
        if ($stmt->execute()) {
            $_SESSION['success'] = 'تم حذف موديل الماكينة بنجاح';
        } else {
            $_SESSION['error'] = $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        $_SESSION['error'] = 'خطأ في إعداد قاعدة البيانات';
    }
} else {
    $_SESSION['error'] = 'يرجى تحديد الماكينة المراد حذفها';
}

header('location: machine_type.php');
