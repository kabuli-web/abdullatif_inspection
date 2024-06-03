<?php
include 'includes/session.php';

if (isset($_POST['delete'])) {
  $id = $_POST['id'];

  $sql = "DELETE FROM inspection WHERE id = '$id'";
  if ($conn->query($sql)) {
    $_SESSION['success'] = 'تم حذف الفحص بنجاح';
  } else {
    $_SESSION['error'] = $conn->error;
  }
} else {
  $_SESSION['error'] = 'حدد فحصاً للحذف';
}

header('location: inspection.php');
?>
