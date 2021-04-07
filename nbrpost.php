<?php
session_start();
//
//if (!isset($_SESSION['email'])) {
//    http_response_code(404);
//    die();
//}

require_once 'classes/Auth.php';
require_once 'classes/posts.class.php';
require_once 'classes/comment.class.php';
require_once 'classes/likes.class.php';
require_once 'functions/time.php';

$user = new Auth();
$post = new Posts();
$comment = new Comments();
$like = new Likes();


$id = $_SESSION['id'];
$email = $_SESSION['email'];
$currentuser = $user->userinfo($email);

if (isset($_POST['offset'])) {
    $val = intval($_POST['offset']);
    $nbrofpost =  $val;
    $gallery = $post->getPost($nbrofpost);
    foreach ($gallery as $key => $value) {
        $userofpost = $post->userOfposts($value['userid']);
        $picofuser = $post->picOfuser($value['userid']);
        $nbrlikes = $like->nbrOfLikes($value['id']);

        echo '<div data-id=' . $value['id'] . ' class="photo">
                <header class="photo__header">
                    <img src="' . $picofuser['profilpic'] . '" class="photo__avatar" />
                    <div class="photo__user-info">
                        <span class="photo__author">' . ucwords($userofpost['username']) . '</span>
                        <span class="photo__location">' . time_elapsed_string($value['creation_date']) . '</span>
                    </div>
                </header>
                <img src="' . $value['data'] . '" alt="" width="614" height="auto"/>
                <div class="photo__info">
                    <div class="photo__actions">';
        if (isset($_SESSION['email'])){
            echo '   <span id="photo__likes" class="photo__action" onclick="addlikes(this)">
                       ';}
        $count = $like->alreadyLike($value['id'], $id);
        if (intval($count['COUNT']) != 0) {
            echo '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
</svg>';
        } else {
            echo '<svg fill="#262626" height="24" viewBox="0 0 48 48" width="24">
                        <path d="M34.6 6.1c5.7 0 10.4 5.2 10.4 11.5 0 6.8-5.9 11-11.5 16S25 41.3 24 41.9c-1.1-.7-4.7-4-9.5-8.3-5.7-5-11.5-9.2-11.5-16C3 11.3 7.7 6.1 13.4 6.1c4.2 0 6.5 2 8.1 4.3 1.9 2.6 2.2 3.9 2.5 3.9.3 0 .6-1.3 2.5-3.9 1.6-2.3 3.9-4.3 8.1-4.3m0-3c-4.5 0-7.9 1.8-10.6 5.6-2.7-3.7-6.1-5.5-10.6-5.5C6 3.1 0 9.6 0 17.6c0 7.3 5.4 12 10.6 16.5.6.5 1.3 1.1 1.9 1.7l2.3 2c4.4 3.9 6.6 5.9 7.6 6.5.5.3 1.1.5 1.6.5.6 0 1.1-.2 1.6-.5 1-.6 2.8-2.2 7.8-6.8l2-1.8c.7-.6 1.3-1.2 2-1.7C42.7 29.6 48 25 48 17.6c0-8-6-14.5-13.4-14.5z"></path></svg>';
        }
        echo '
                       </span>
                        <span id="photo__comment" class="photo__action">
                        <svg aria-label="Comment" class="_8-yf5 " fill="#262626" height="24" viewBox="0 0 48 48" width="24"><path clip-rule="evenodd" d="M47.5 46.1l-2.8-11c1.8-3.3 2.8-7.1 2.8-11.1C47.5 11 37 .5 24 .5S.5 11 .5 24 11 47.5 24 47.5c4 0 7.8-1 11.1-2.8l11 2.8c.8.2 1.6-.6 1.4-1.4zm-3-22.1c0 4-1 7-2.6 10-.2.4-.3.9-.2 1.4l2.1 8.4-8.3-2.1c-.5-.1-1-.1-1.4.2-1.8 1-5.2 2.6-10 2.6-11.4 0-20.6-9.2-20.6-20.5S12.7 3.5 24 3.5 44.5 12.7 44.5 24z" fill-rule="evenodd"></path></svg>
                        </span>
                    </div>
                    <span class="photo__likes">' . $nbrlikes['NBRLIKES'] . ' likes</span>
                    <ul class="photo__comments">';

        $comments = $comment->getCommentbyPostid($value['id']);
        //Comment Begin From Here
        foreach ($comments as $k => $vc) {
            $userofcomment = $comment->userOfcomment($vc['COMMENTED_USERS']);
            // print_r($userofcomment);
            echo '<li class="photo__comment" id="' . $value['id'] . '">
                            <span class="photo__comment-author">' . $userofcomment['username'] . '</span> ' . $vc['data'] . '
                        </li>';
        }
        echo '</ul>
                    <span class="photo__time-ago">' . time_elapsed_string($value['creation_date']) . '</span>
                    <div class="photo__add-comment-container">
                    ';
        if (isset($_SESSION['email'])) {
            echo '<textarea name="comment" placeholder="Add a comment..." onkeypress="addComment(event, this)" autocomplete="off" autocorrect="off"></textarea>
                        <i class="fa fa-ellipsis-h"></i>';
        }
        echo ' </div>
                </div>
            </div>';

        // echo $value['userid'] . ' ' . $value['data'] . "<br>";
    }
}
?>