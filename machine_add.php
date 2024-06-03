<?php
include 'includes/session.php';

if (isset($_POST['add'])) {
    $serial_number = $_POST['serial_number'];
    $machine_type_id = $_POST['machine_type_id'];
    $hospital_id = $_POST['hospital_id'];

    // Prepare an INSERT statement
    $stmt = $conn->prepare("INSERT INTO machine (serial_number, hospital_id, machine_type_id) VALUES (?, ?, ?)");
    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("sii", $serial_number, $hospital_id, $machine_type_id);

        // Execute the statement
        if ($stmt->execute()) {
            $_SESSION['success'] = 'تم إضافة  الماكينة بنجاح';
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
