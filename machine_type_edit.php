<?php
include 'includes/session.php';

if (isset($_POST['edit'])) {
    $id = $_POST['machine_type_id'];
    $name = $_POST['name'];
    $model = $_POST['model'];
    $manufacturer_name = $_POST['manufacturer_name'];
    $hospital_id = $_POST['hospital_id'];
    $image = $_FILES['image']['name'];

    // Handle image upload
    if (!empty($image)) {
        $targetDir = 'images/';
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $imageName = 'machine_type_' . time() . '.' . $imageFileType;
        $targetPath = $targetDir . $imageName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            $imagePath = $targetPath;
        } else {
            $_SESSION['error'] = 'خطأ في رفع الملف';
            header('location: machine_type.php');
            exit();
        }

        // Prepare an UPDATE statement with image
        $stmt = $conn->prepare("UPDATE machine_type SET name = ?, hospital_id = ?, model = ?, manufacturer_name = ?, image = ? WHERE id = ?");
        if ($stmt) {
            $stmt->bind_param("sisssi", $name, $hospital_id, $model, $manufacturer_name, $imagePath, $id);
        } else {
            $_SESSION['error'] = 'خطأ في إعداد قاعدة البيانات';
            header('location: machine_type.php');
            exit();
        }
    } else {
        // Prepare an UPDATE statement without image
        $stmt = $conn->prepare("UPDATE machine_type SET name = ?, hospital_id = ?, model = ?, manufacturer_name = ? WHERE id = ?");
        if ($stmt) {
            $stmt->bind_param("sissi", $name, $hospital_id, $model, $manufacturer_name, $id);
        } else {
            $_SESSION['error'] = 'خطأ في إعداد قاعدة البيانات';
            header('location: machine_type.php');
            exit();
        }
    }

    // Execute the statement
    if ($stmt->execute()) {
        $_SESSION['success'] = 'تم تحديث موديل الماكينة بنجاح';
    } else {
        $_SESSION['error'] = $stmt->error;
    }

    $stmt->close();
} else {
    $_SESSION['error'] = 'يرجى تعبئة الخانات المطلوبة';
}

header('location: machine_type.php');
?>
