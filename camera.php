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
    <div>
      <h4>Select image to upload:</h4><br>
      <input type="file" name="fileToUpload" id="fileToUpload" required>
      <input type="submit" value="Upload Image" name="upload">
  </form>
  </div>


  <h4>Take a Picture</h4>
  <div class="canvas">
    <video id="video" width="400" height="300" autoplay></video>
    <canvas id="canvas" width="400" height="300"></canvas>
  </div>

  <form action="functions/fileUpload_func.php" method="post">
    <input type="hidden" id="img" name="img">
    <input type="submit" id="cam_pic" name="cam_pic" value="Upload taken picture">
  </form>
  <input type="submit" id="capture" name="capture" value="Capture">
  <input type="submit" id="clear" name="clear" value="Clear">


  <div class="booth">
    <img class="stickers" src="./img/s1.png" alt="" id="s1" onclick = "addSticker('s1', 0, 0)">
    <img class="stickers" src="./img/s2.png" alt="" id="s2" onclick = "addSticker('s2', 300, 0)">
    <img class="stickers" src="./img/s3.png" alt="" id="s3" onclick = "addSticker('s3', 0, 200)">
    <img class="stickers" src="./img/s4.png" alt="" id="s4" onclick= "addSticker('s4', 300, 200)">
  </div>

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
          <div class="canvas">
            <img src="<?php echo $row['img'] ?>"><br><br>
          </div>
    <?php
        }
      }
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
    $conn = null;
    ?>
  </div>

  <!-- <script src="./js/camera.js"></script> -->
  <script>
      var canvas = document.getElementById('canvas'),
      context = canvas.getContext('2d'),
      video = document.getElementById('video'),
      capture = document.getElementById('capture'),
      pic = document.getElementById('img');

    // (function () {

    navigator.getMedia = navigator.getUserMedia ||
      navigator.webkitGetUserMedia ||
      navigator.mozGetUserMedia ||
      navigator.msGetUserMedia;

    navigator.getMedia({
      video: true,
      audio: false
    }, function (stream) {
      video.srcObject = stream;
      video.play();
    }, function (error) {
      //An error occurred
      console.log('Camera not available');
    });

    capture.addEventListener('click', function () {
      context.drawImage(video, 0, 0, 400, 300);
      pic.value = canvas.toDataURL('image/png');
    }, false);

    document.getElementById('clear').addEventListener('click', function () {
      context.clearRect(0, 0, canvas.width, canvas.height);
    });
    // })

    function addSticker(id, xvalue, yvalue) {
      let img = document.getElementById(id);
      context.drawImage(img, xvalue, yvalue, 100, 100);
      pic.value = canvas.toDataURL('image/png');
    }
  </script>
</body>

</html>