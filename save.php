<?php

include 'connection.php';

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST' || $method === 'OPTIONS') {
    $data = json_decode(file_get_contents('php://input'), true);
    $status = $data['status'];

    if ($status === 'OFF' || $status === 'ON') {
        saveDataToDb($status);
        http_response_code(200);
        echo json_encode(['message' => 'Data saved successfully']);
    } else {
        http_response_code(400);
        echo json_encode(['message' => 'Invalid status. Only "ON" or "OFF" are allowed']);
    }
} else {
    http_response_code(405);
    echo json_encode(['message' => 'Method Not Allowed']);
}

function saveDataToDb($status) {
    
    include 'connection.php';
    $query = "SELECT * FROM freedb_oti_light_switching.mavericks_oti_light where device_name = '$bulb_name' ";
    $result = $link->query($query);
    if($result->num_rows < 1){
        $stmt = $link->prepare("INSERT INTO freedb_oti_light_switching.mavericks_oti_light(device_name, status) VALUES (?, ?)");
        $stmt->bind_param("ss", $bulb_name, $status);
        $stmt->execute();
        $stmt->close();
    }
    else {
        $update_query = $link->prepare("UPDATE freedb_oti_light_switching.mavericks_oti_light SET status = ? WHERE device_name = ?");
        $update_query->bind_param("ss", $status, $bulb_name);
    
        // Execute the query
        $update_query->execute();
    }

    $link->close();
}

?>
