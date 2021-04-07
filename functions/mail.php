<?php
    require_once 'config/database.php';

    class Mail extends Database {
        public function sendVerificationEmail($email, $token){
            $protocol = "http://";
            $url = $protocol . $_SERVER['HTTP_HOST'] . '/camagru/verify.php';
            $to = $email;
            $subject = "Account Verification";
            $message = '<!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <title>Camagru Account Verification</title>
      <style>
        body {
        padding: 0px;
        background: #dddde2;
          }
        .main-container {
            margin: 0;
            top: 5%;
            left: 5%;
            background: white;
        }
        .main-container .content {
            margin: 40px 60px 30px;
            text-align: center;
        }
        .main-container .content h1 {
            
            font-weight: 900;
            color: #333335;
            letter-spacing: -0.01em;
            font-size: 3em;
        }
        .main-container .content p {
            
            color: #333335;
            font-size: 2em;
        }
    </style>
    </head>

    <body>
      <div class="main-container">
        <div class="content">
          <h1>[CAMAGRU][REGISTER]</h1>
            <p class="para">Thank you for signing up on our site. Please click on the link below to verify your account:</p>
              <a href="'.$url.'?email='.$email. '&token=' . $token . '">Verify Email!</a>
        </div>
      </div>
    </body>

    </html>';


// Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";


            mail($to,$subject,$message,$headers);
        }

        //check token if true

        public function CheckTokenVerification($email, $token){
            $sql = "SELECT email, token FROM `users` WHERE email = :email AND token = :token";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['email'=>$email, 'token'=>$token]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;
        }


        public function verify($email, $token){
            $sql = "UPDATE `users` SET `active` = 1 WHERE email = :email AND token = :token";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['email'=>$email, 'token'=>$token]);
//            $row = $stmt->fetch(PDO::FETCH_ASSOC);
//            return $row;
            return TRUE;
        }

        public function CommentNotificationMail($receiver, $owner, $post){

            $myimage = $this->compressImageForMail($post);
            $type = pathinfo($myimage, PATHINFO_EXTENSION);
            $data = file_get_contents($myimage);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

            $to = $receiver;
            $subject = "Comment Notification";
            $message = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Camagru Comment Notification</title>
    <style>
        body {
        padding: 0px;
        background: #dddde2;
          }
        .main-container {
            margin: 0;
            top: 5%;
            left: 5%;
            background: white;
        }
        .main-container .content {
            margin: 40px 60px 30px;
            text-align: center;
        }
        .main-container .content h1 {
            
            font-weight: 900;
            color: #333335;
            letter-spacing: -0.01em;
            font-size: 3em;
        }
        .main-container .content p {
            
            color: #333335;
            font-size: 2em;
        }
    </style>
</head>

<body>
<div class="main-container">
    <div class="content">
        <h1>[CAMAGRU][COMMENT]</h1>
        <img src="'.$base64.'" width="617px" height="auto">
        <p>'.ucwords($owner).' Commented on your post</p>
    </div>
</body>

</html>';

// Always set content-type when sending HTML email

            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            mail($to,$subject,$message,$headers);
        }

        public function disableNotification($email){
            $sql = "UPDATE `users` SET `notification` = 0 WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['email'=>$email]);
            return true;
        }

        public function enableNotification($email){
            $sql = "UPDATE `users` SET `notification` = 1 WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['email'=>$email]);
            return true;
        }

        public function userWithoutNotification($email){
            $sql = "SELECT `deleted` FROM `users` WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['email'=>$email]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;
        }

        public function compressImageForMail($path){
                $dest = "./images/" . uniqid() . '.jpg';
                $info = getimagesize($path);
                if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($path);
                elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($path);
                elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($path);
                imagejpeg($image, $dest, 10);
                return $dest;
        }

        public function resetViaToken($email, $token){
            $protocol = "http://";
            $url = $protocol . $_SERVER['HTTP_HOST'] . '/camagru/reset-pass.php';
            $to = $email;
            $subject = "Account Reset";
            $message = '<!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <title>Camagru Account Reset</title>
      <style>
        body {
        padding: 0px;
        background: #dddde2;
          }
        .main-container {
            margin: 0;
            top: 5%;
            left: 5%;
            background: white;
        }
        .main-container .content {
            margin: 40px 60px 30px;
            text-align: center;
        }
        .main-container .content h1 {
            
            font-weight: 900;
            color: #333335;
            letter-spacing: -0.01em;
            font-size: 3em;
        }
        .main-container .content p {
            
            color: #333335;
            font-size: 2em;
        }
    </style>
    </head>

    <body>
      <div class="main-container">
        <div class="content">
          <h1>[CAMAGRU][RESET]</h1>
            <p class="para">Please click on the link below to Reset your account:</p>
              <a href="'.$url.'?email='.$email. '&token=' . $token . '">Reset Email!</a>
        </div>
      </div>
    </body>

    </html>';


// Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";


            mail($to,$subject,$message,$headers);
        }
    }


