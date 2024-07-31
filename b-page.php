<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main page</title>
    <style>
        .card{
            margin: 0 auto;
            padding: 30px;
            margin-bottom: 20px;
        }
        img{
           width: 50%;
        }
    </style>
</head>
<body>
    <?php
         require 'dp.php';
         $id = $_GET['id'];
         $sql = "SELECT id, title, subtitle, img, uploaddate , content FROM data where id = $id"; 

         $result = $con->query($sql);

         if (!empty($result) && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='card'>
                  <img src='" . ($row['img']) . "' alt='Image'>
                 <h5 class='card-header'>" . $row['title'] . "</h5>
                   <div class='card-body'>
                     <h5 class='card-title'>" . $row['subtitle'] . "</h5>
                     <h6 class='card-title'>" . $row['uploaddate'] . "</h6>
                     <p>".$row['content']."</p>
                   </div>
              </div>";
            }

         }

     
    ?>
    
</body>
</html>