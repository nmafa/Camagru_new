<?php
require_once './config/connection.php';
if(isset($_GET['galleryId']) && isset($_POST['comment'])) {
    
    $comment = htmlspecialchars($_POST['comment']);
    try {

        $galleryID = $_GET['galleryId'];
        $user_id = $_SESSION['id'];

        $userid = $_GET['userid'];

        $stmt2 = $conn->prepare("SELECT mail, username FROM users WHERE id = $userid");
        $stmt2->execute();
        if ($user = $stmt2->fetch(PDO::FETCH_ASSOC)){
            $mail = $user['mail'];
            $username = $user['username'];
        }

        $sql = "INSERT INTO `comment` (`userid`, `galleryid`, `comment`) VALUES ($user_id, $galleryID, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->execute([$comment]);
        $subject = "[CAMAGRU] - comment";
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $headers .= 'From: <nmafa@student.wethinkcode.co.za>' . "\r\n";

        $message = "
                            <html>
                                <head>
                                <title>$subject</title>
                                </head>
                                <body>
                                Hello $username</br>
                                   someone commented on your pic: <br> $comment
                                </body>
                            </html>";
        mail($mail, $subject, $message, $headers);

    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }

    $conn = null;

}
