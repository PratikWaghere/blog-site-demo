<?php
header("Content-Type: application/json");

require 'dp.php';
$id = $_GET['id'];
$sql = "SELECT id, title, subtitle, img, uploaddate , content FROM data where id = $id";
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
