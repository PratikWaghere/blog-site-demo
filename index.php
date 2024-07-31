<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .form-data {
            width: 70%;
            margin: 0 auto;
            text-align: center;
        }

        form {
            width: 50%;
            margin: 0 auto;
            padding: auto;
        }

        h2 {
            text-align: center;
        }
    </style>
    <title>Admin-Blog-solace</title>
</head>

<body>
    <div class="from-data">

        <h2>Fill data for Blog</h2>

        <form action="admin.php" method="post" enctype="multipart/form-data">
            <label for="title" class="label-control">Title:</label>
            <input type="text" id="title" class="form-control" name="title" required>
            <label for="sub-title" class="label-control">Sub Title:</label>
            <input type="text" id="sub-title" class="form-control" name="sub-title" required>
            <label for="image" class="label-control">Image:</label>
            <input type="file" id="image" class="form-control" name="image" accept="image/*">
            <label for="content" class="label-control">Content:</label>
            <textarea name="blog-data" class="form-control" id="blog-data" cols="30" rows="10"></textarea>
            <br>
            <input type="submit" class="btn btn-primary" value="Upload data">
        </form>

    </div>

    <?php
$servername = "localhost";
$username = "root";
$password = "admin@1449";
$dbname = "blogdata";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

$title = $_POST['title'];
$sub = $_POST['sub-title'];
$content = $_POST['blog-data'];

$target_dir = "blog_images/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);

echo $target_file;

$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

echo $imageFileType;


if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
    } else {
        echo "File is not an image.";
        exit;
    }
}


// if (file_exists($target_file)) {
//     echo "Sorry, file already exists.";
//     exit;
// }


if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    exit;
}

if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
} else {
    echo "Sorry, there was an error uploading your file.";
    exit;
}

$sql = "INSERT INTO `data` (title, subtitle, img, content, uploaddate)
        VALUES ('$title', '$sub', '$target_file', '$content', current_timestamp())";

if ($conn->query($sql) === TRUE) {
    echo "<br>New record created successfully";
    echo '<script>alert("Data Upload Successfully")</script>';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>


   
</body>

</html>