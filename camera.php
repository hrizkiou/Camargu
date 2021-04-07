<?php
session_start();
// print_r($_SESSION);

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    die();
}

require_once 'classes/posts.class.php';
$post = new Posts();

if (isset($_POST['dimage']) && $_POST['dimage'] != ''){
    $data = './' . $_POST['dimage'];
    $dpost = $post->deletePost($_SESSION['id'], $data);
    if ($dpost != NULL){
        echo 'Your post is deleted';
        unlink($data);
        exit();
    }
    echo 'Something Be Wrong!';
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1.0">
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Camera - Camagru</title>
<!--    <link type="text/css" rel="stylesheet" href="style/bootstrap.css" />-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link href="style/index.css" rel="stylesheet">
    <link href="style/profile.css" rel="stylesheet">
</head>
<body>
<?php include_once './inc/header.php'; ?>
<div class="col-md-6 col-md-offset-3 well text-center">

    <video id="video" width="100%" height="100%" autoplay></video>

    <div class="center"  style="margin: 10px 20px;">
        <button id="photo-button" style="width: 100%;" class="btn" >
            Snap
        </button>
    </div>

    <div class="center" style="margin: 10px 20px;">
        <button id="clear-button" style="width: 100%;" class="btn">Clear</button>
    </div>

    <h1>
        <small>Preview</small></h1>

    <hr>

    <div class="center" style="margin: 10px auto; width: 100%">
        <div id="all" style="margin: 10px auto; position: relative; height:375px; width: 500px;">
            <canvas id="canvas" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%"></canvas>
        </div>
    </div>
    <div id="stickers" class='btn-group' style="overflow-x: auto; margin: 20px auto;">
            <?php
            if ($stickersfolder = opendir('img/stickers')) {
                while (false !== ($sticker = readdir($stickersfolder))) {
                    if ($sticker != "." && $sticker != "..") {
                        echo "<div style='display: inline-block;' onclick='addSticker(\"$sticker\")'><figure class=''><img  height='35px' class='' src='img/stickers/".$sticker."'></figure></div>";
                    }
                }
                echo "<div id='clearsticker' style='display: block;' onclick='del()'>clear</div>";
                closedir($stickersfolder);
            }
            ?>
    </div>

        <div>
            <button id="photo-save" style="width: 100%;" class="btn">
                Save
            </button>
        </div>
        <div class="custom-file" style="margin: 10px auto;">
            <input type="file" id="upload" value="upload" class="btn"/>
        </div>

         <div id="photos" style="margin: 10% 0;">
             <?php
             $gallery = $post->getImageGalleryById($_SESSION['id']);
             foreach ($gallery as $key => $value) {
                 echo '<img src="'.$value['data'].'" onclick="f(this)" style="margin: 2%;" width="200" height="200">';
             }
             ?>
        </div>
    </div>
</div>
<script src="js/camera.js"></script>
<script>
    function f(obj) {
        var image = obj.src;
        var url = location.host;
        var s = image.split(url + '/camagru/');
        var xhr = new XMLHttpRequest();
        var data = new FormData;
        if (confirm("Are You Sure To delete this Post!")) {
            xhr.open('POST', 'camera.php');
            data.append('dimage', s[1]);
            xhr.onload = function (){
                obj.remove();
                alert(xhr.responseText);
            }
            xhr.send(data);
        }
    }

</script>
</body>
</html>