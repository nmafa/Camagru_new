<?php
session_start();
echo $_SESSION['error'];
$_SESSION['error'] = '';
include './includes/header.php';
include './config/connection.php';
?>

<html>

<head>
  <title>Imaging</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>

  <form action="functions/fileUpload_func.php" method="post" enctype="multipart/form-data">
    <h4>Select image to upload:</h4><br>
    <input type="file" name="fileToUpload" id="fileToUpload" required>
    <input type="submit" value="Upload Image" name="upload">
  </form>

  <h4>Take a Picture</h4>
  <div class="">
    <video id="video" width="400" height="300" autoplay></video>
    <canvas id="canvas" width="400" height="300"></canvas>
  </div>

  <form action="functions/fileUpload_func.php" method="post">
    <input type="hidden" id="img" name="img">
    <input type="submit" id="cam_pic" name="cam_pic" value="Upload taken picture">
  </form>

  <input type="submit" id="capture" name="capture" value="Capture">
  <input type="submit" id="clear" name="clear" value="Clear">

  <div>
    <h4>Pictures</h4>
    <?php


    try {

      $stmt = $conn->prepare("SELECT img FROM gallery ORDER BY id DESC ");
      $stmt->execute();
      $i = 0;
      if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          extract($row); ?>
          <!--- div for the pictures to -->

          <img src="<?php echo $row['img'] ?>"><br><br>
    <?php
        }
      }
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
    $conn = null;
    ?>
  </div>

  <script src="js/camera.js"></script>
</body>

</html>