<?php
header("Content-Type: application/json");

require 'dp.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $sub = $_POST['subtitle'];
    $content = $_POST['content'];

    $target_dir = "blog_images/";
    $target_file = $target_dir . basename($_FILES["img"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
        $sql = "INSERT INTO `data` (title, subtitle, img, content, uploaddate)
                VALUES ('$title', '$sub', '$target_file', '$content', current_timestamp())";

        if ($con->query($sql) === TRUE) {
            echo json_encode(["message" => "New record created successfully"]);
        } else {
            echo json_encode(["error" => "Error: " . $sql . "<br>" . $con->error]);
        }
    } else {
        echo json_encode(["error" => "Sorry, there was an error uploading your file."]);
    }
} else {
    echo json_encode(["error" => "Invalid request method."]);
}

$con->close();
?>
