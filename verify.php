<?php
session_start();
require_once 'classes/Auth.php';
require_once 'functions/mail.php';
$user = new Auth();
$mail = new Mail();
$userLogged = $user->login($_SESSION['email']);

if (!isset($_GET['email']) && $_GET['email'] == '' || !isset($_GET['token']) && $_GET['token'] == ''){
    header('Location: index.php');
}


if (isset($_GET['email']) && $_GET['email'] != '' && isset($_GET['token']) && $_GET['token'] != ''){

    $checkVerification =  $mail->CheckTokenVerification($_GET['email'], $_GET['token']);

    $protocol = "http://";
    $url = $protocol . $_SERVER['HTTP_HOST'];

    if ($checkVerification != NULL){
        $active = $mail->verify($_GET['email'], $_GET['token']);
//        print_r($active);
//        exit();
        if($active != NULL){
//        echo 'Your account has been Verified Successfully!';
            echo '<script>alert("Your account has been Verified Successfully");</script>';
            echo '<script>setTimeout(function() {
              location.href = "/camagru/index"
            }, 500);</script>';
//            echo '<script>console.log(location.href);</script>';
        }
        else {
            echo '<script>alert("Your account has NOT been Verified");</script>';
            echo '<script>setTimeout(function() {
              location.href = "/camagru/index"
            }, 500);</script>';
        }
    }
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<div class="container">

    <?php

    if ($userLogged['active'] == 0) {
        echo '<div class="jumbotron">
				<h1 class="text-center"> Your Account is Not Verified</h1>
				<p class="text-center">Check Your Email</p>
			  </div>';
    }
    ?>
</div>
</body>
</html>
