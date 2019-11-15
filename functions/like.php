<?php
require_once './config/connection.php';

if (isset($_GET['like'])) {

    try {
        $galleryID = $_GET['like'];
        $user_id = $_SESSION['id'];

        $userid = $_GET['userid'];

        $stmt2 = $conn->prepare("SELECT mail, username FROM users WHERE id = $userid");
        $stmt2->execute();
        if ($user = $stmt2->fetch(PDO::FETCH_ASSOC)) {
            $mail = $user['mail'];
            $username = $user['username'];
        }

        $sql = "INSERT INTO `like` (`userid`, `galleryid`, `type`) VALUES ($user_id, $galleryID, '1')";

        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $subject = "[CAMAGRU] - like";
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $headers .= 'From: <nmafa@student.wethinkcode.co.za>' . "\r\n";

        $message = '
                            <html>
                                <head>
                                <title>' . $subject . '</title>
                                </head>
                                <body>
                                Hello ' . htmlspecialchars($username) . ' </br>
                                    Someone liked your picture;
                                </body>
                            </html>';
        mail($mail, $subject, $message, $headers);
    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }

    $conn = null;
}
