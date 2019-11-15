<?php
session_start();
require_once '../config/connection.php';
$user_id = $_SESSION["id"];

//check if the uploaded image is a real file
if (isset($_POST["upload"])) {

    //create random number to make image names unique
    $timestamp = new DateTime();
    $timestamp = $timestamp->getTimestamp();

    //get image file type of the uploaded image
    $imageFileType = strtolower(pathinfo(basename($_FILES["fileToUpload"]["name"]), PATHINFO_EXTENSION));

    //create a temporary name for our pic inserting file type
    $tmp_name = 'img' . $timestamp . "." . $imageFileType;

    //path to where the image is goin to be uploaded
    $pic_path = "../pictures/";

    //name to be submitted to the database
    $pic_name = $pic_path . $tmp_name;

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

    if ($check === false) {
        $_SESSION['error'] = "File is not an image.";
        header("location: ../camera.php");
    }

    //check if image already exist in the destination path
    if (file_exists($pic_name)) {
        $_SESSION['error'] = "File already exists";
        header("location: ../fileUpload.php");
    }

    //check if the image size is less than 5MB
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        $_SESSION['error'] = "Sorry, your file is too large";
        header("location: ../camera.php");
    }

    // check if the image file type is the allowed one
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        $_SESSION['error'] = "Sorry, only JPG, JPEG, PNG files are allowed.";
        header("location: ../camera.php");
    }

    //upload image to uploads folder and to database
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $pic_name)) {
        upload_image("Photo", $pic_name);
        $_SESSION['error'] = "The file " . $pic_name . " has been uploaded.";
    } else {
        $_SESSION['error'] = "Sorry, there was an error uploading your file.";
    }
}

//upload images taken with the cam to the database
if (isset($_POST["cam_pic"]) && !empty($_POST['img'])) {
    $image_parts = explode(";base64,", $_POST['img']);
    $image_type_aux = explode("image/", $image_parts[0]);
    $imageFileType = $image_type_aux[1];
    $image_base64 = base64_decode($image_parts[1]);
    $pic_name = "../pictures/" . uniqid() . '.png';
    $photoName = trim($pic_name, "../");
    echo file_put_contents($pic_name, $image_base64);

    try {
        $sql = "INSERT INTO `gallery` (`userid`, `img`) VALUES ('$user_id', '$photoName')";
        $conn->exec($sql);
        $_SESSION['error'] = "The file" . $pic_name . " has been uploaded!.";
    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
}

header("location: ../camera.php");
