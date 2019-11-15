<html>

<h4>Pictures</h4>
<?php session_start();
include "./includes/header.php"; ?>
<br>

</html>
<?php
include_once "./functions/like.php";
include_once "./functions/comment.php";

$servername = "localhost";
$username = "root";
$password = "240498";
$dbname = "camagru";


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT img, id, userid FROM gallery ORDER BY id DESC ");
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row); ?>
            <!-- feching images from the database displaying them -->
            <img src="<?php echo $row['img'] ?>" <br />
            <!-- like button with a form-->
            <br><br>

            <form action="<?php echo $_SERVER['PHP_SELF'] . "?galleryId=" . $row['id'] . "&userid=" . $row['userid'] ?>" method="post">
                <input type="text" name="comment" placeholder="Comment..." />
                <input type="submit" name="submit" value="comment">
            </form>


            <form action="<?php echo $_SERVER['PHP_SELF'] . "?like=" . $row['id'] . "&userid=" . $row['userid'] ?>" method="POST">
                <input type="submit" value="like" name='like' />
            </form>
<?php
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>