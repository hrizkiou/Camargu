<?php
    session_start();
    if (!isset($_SESSION['email'])) {
        header("Location: login.php");
        die();
    }

    require_once 'classes/Auth.php';
    require_once 'classes/posts.class.php';
    require_once 'functions/mail.php';

    $user = new Auth();
    $post = new Posts();
    $email = $_SESSION['email'];
    $mail = new Mail();


    if (isset($_POST['inform'])){
        $userofpost = $post->getUserToInform($_POST['inform']);
//        print_r($userofpost);
//        $disableNotif = $mail->userWithoutNotification($email);
        $notification = $user->userinfo($userofpost['email']);
        if ($notification['notification'] == 1){
            $mail->CommentNotificationMail($userofpost['email'], $_SESSION['username'] ,$userofpost['data']);
        }

    }
