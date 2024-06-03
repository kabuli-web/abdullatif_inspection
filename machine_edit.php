<?php
include 'includes/session.php';

if (isset($_POST['edit'])) {
    $id = $_POST['machine_id'];
    $serial_number = $_POST['serial_number'];
    $machine_type_id = $_POST['machine_type_id'];
    $hospital_id = $_POST['hospital_id'];

    // Prepare an UPDATE statement
    $stmt = $conn->prepare("UPDATE machine SET serial_number = ?, hospital_id = ?, machine_type_id = ? WHERE id = ?");
    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("siii", $serial_number, $hospital_id, $machine_type_id, $id);

        // Execute the statement
        if ($stmt->execute()) {
            $_SESSION['success'] = 'تم تحديث الماكينة بنجاح';
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

header('location: machine.php');
