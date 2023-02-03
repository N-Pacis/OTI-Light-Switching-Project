<?php 
include './connection.php';
$query = "SELECT * FROM freedb_oti_light_switching.mavericks_oti_light where device_name = '$bulb_name' ";
$result = $link->query($query);
if($result->num_rows >0 ){
    $rowData = mysqli_fetch_assoc($result);
    if($rowData['status'] == 'ON'){
        http_response_code(200);
        echo 'ON';
    }
    else{
        http_response_code(200);
        echo 'OFF';
    }
}
else{
    http_response_code(200);
    echo 'OFF';
}
?>