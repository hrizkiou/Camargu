<?php
    session_start();
    if (!isset($_SESSION['email'])) {
        header("Location: login.php");
        die();
    }
    require_once 'classes/Auth.php';
    require_once 'classes/posts.class.php';
    require_once 'classes/comment.class.php';
    require_once 'classes/likes.class.php';
    require_once 'functions/mail.php';

    $user = new Auth();
    $post = new Posts();
    $like = new Likes();
    $email = $_SESSION['email'];
    $mail = new Mail();
    $id = $_SESSION['id'];

$currentuser = $user->CurrentUser($email);

    if (isset($_POST['comment'])){
        $userofpost = $post->getUserToInform($_POST['comment'][0]);
//        print_r($_POST['comment']);
        $comment = $user->test_input($_POST['comment'][1]);
        $post->addcomment($_POST['comment'][0], $id, $comment);
        echo '<li class="photo__comment">
                  <span class="photo__comment-author">'.ucwords($currentuser['username']).'</span>'.' '.$_POST['comment'][1].'
              </li>';
        //very Slow
//        $mail->CommentNotificationMail($userofpost['email'], $userofpost);
    }
    if (isset($_POST['like'])){
        $count = $like->alreadyLike($_POST['like'], $id);
        if (!$count['COUNT']) {
            if ($like->addlike($_POST['like'], $id)) {
                $countLike = $like->CountLikes($_POST['like']);
                echo '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                      </svg>,'.$countLike['COUNT'] . ' likes';
            }
        }
        else {
            if($like->deleteLike($_POST['like'], $id)){
                $countLike = $like->CountLikes($_POST['like']);
                echo '<svg fill="#262626" height="24" viewBox="0 0 48 48" width="24">
                        <path d="M34.6 6.1c5.7 0 10.4 5.2 10.4 11.5 0 6.8-5.9 11-11.5 16S25 41.3 24 41.9c-1.1-.7-4.7-4-9.5-8.3-5.7-5-11.5-9.2-11.5-16C3 11.3 7.7 6.1 13.4 6.1c4.2 0 6.5 2 8.1 4.3 1.9 2.6 2.2 3.9 2.5 3.9.3 0 .6-1.3 2.5-3.9 1.6-2.3 3.9-4.3 8.1-4.3m0-3c-4.5 0-7.9 1.8-10.6 5.6-2.7-3.7-6.1-5.5-10.6-5.5C6 3.1 0 9.6 0 17.6c0 7.3 5.4 12 10.6 16.5.6.5 1.3 1.1 1.9 1.7l2.3 2c4.4 3.9 6.6 5.9 7.6 6.5.5.3 1.1.5 1.6.5.6 0 1.1-.2 1.6-.5 1-.6 2.8-2.2 7.8-6.8l2-1.8c.7-.6 1.3-1.2 2-1.7C42.7 29.6 48 25 48 17.6c0-8-6-14.5-13.4-14.5z"></path></svg>,'.$countLike['COUNT'] .' likes';
            }
        }
    }
?>