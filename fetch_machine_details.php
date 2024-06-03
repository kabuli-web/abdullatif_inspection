<?php
include 'includes/session.php';

$response = ['success' => false];

if (isset($_GET['machine_id'])) {
    $machine_id = $_GET['machine_id'];

    // Fetch machine details including all columns from machine_type
    $machine_sql = "SELECT machine.*, machine_type.* 
                    FROM machine 
                    JOIN machine_type ON machine.machine_type_id = machine_type.id 
                    WHERE machine.id = ?";
    $stmt = $conn->prepare($machine_sql);
    if (!$stmt) {
        $response['message'] = 'Prepare statement failed: ' . $conn->error;
        echo json_encode($response);
        exit;
    }
    $stmt->bind_param("i", $machine_id);
    $stmt->execute();
    $machine_result = $stmt->get_result();
    if (!$machine_result) {
        $response['message'] = 'Execute statement failed: ' . $stmt->error;
        echo json_encode($response);
        exit;
    }
    $machine = $machine_result->fetch_assoc();

    // Fetch hospital details
    $hospital_sql = "SELECT hospital.* 
                     FROM machine 
                     JOIN hospital ON machine.hospital_id = hospital.id 
                     WHERE machine.id = ?";
    $stmt = $conn->prepare($hospital_sql);
    if (!$stmt) {
        $response['message'] = 'Prepare statement failed: ' . $conn->error;
        echo json_encode($response);
        exit;
    }
    $stmt->bind_param("i", $machine_id);
    $stmt->execute();
    $hospital_result = $stmt->get_result();
    if (!$hospital_result) {
        $response['message'] = 'Execute statement failed: ' . $stmt->error;
        echo json_encode($response);
        exit;
    }
    $hospital = $hospital_result->fetch_assoc();

    // Fetch inspection details
    $inspection_sql = "SELECT inspection_date, next_inspection_date, inspection_type 
                       FROM inspection 
                       WHERE machine_id = ? 
                       ORDER BY inspection_date DESC";
    $stmt = $conn->prepare($inspection_sql);
    if (!$stmt) {
        $response['message'] = 'Prepare statement failed: ' . $conn->error;
        echo json_encode($response);
        exit;
    }
    $stmt->bind_param("i", $machine_id);
    $stmt->execute();
    $inspection_result = $stmt->get_result();
    if (!$inspection_result) {
        $response['message'] = 'Execute statement failed: ' . $stmt->error;
        echo json_encode($response);
        exit;
    }
    $inspections = [];
    while ($row = $inspection_result->fetch_assoc()) {
        $inspections[] = $row;
    }

    $response['success'] = true;
    $response['data'] = [
        'machine' => $machine,
        'hospital' => $hospital,
        'inspections' => $inspections
    ];
} else {
    $response['message'] = 'Machine ID not provided.';
}

echo json_encode($response);
?>
