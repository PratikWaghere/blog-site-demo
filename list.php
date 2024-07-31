<?php
header("Content-Type: application/json");

require 'dp.php';

$sql = "SELECT id, title, subtitle, img, uploaddate FROM data";
$result = $con->query($sql);

if ($result === false) {
    echo json_encode(["error" => $con->error]);
    exit();
}

$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode($data);
?>
