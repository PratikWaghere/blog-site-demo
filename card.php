<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>card</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .card{
            width: 70%;
            margin: 0 auto;
            padding: 30px;
            margin-bottom: 20px;
        }
        img{
           width: 30%;
        }

    </style>

</head>
<body>


<?php
$server = "localhost";
$username = "root";
$password = "admin@1449";
$database = "blogdata";

$con = new mysqli($server, $username, $password, $database);

$sql = "SELECT id, title, subtitle, img, uploaddate FROM data";
$result = $con->query($sql);

if ($result === false) {
    die("Error: " . $con->error);
}

if (!empty($result) && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='card'>
                  <img src='" . ($row['img']) . "' alt='Image'>
                 <h5 class='card-header'>" . $row['title'] . "</h5>
                   <div class='card-body'>
                     <h5 class='card-title'>" . $row['subtitle'] . "</h5>
                     <h6 class='card-title'>" . $row['uploaddate'] . "</h6>
                     <a href='#' class='btn btn-primary'>View More</a>
                   </div>
              </div>";
    }
}
?>

</body>
</html>