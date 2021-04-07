<?php
    session_start();
    require_once 'classes/images.class.php';
    require_once 'classes/posts.class.php';
    $image = new Images();
    $post = new Posts();

    $id = $_SESSION['id'];
    $url = $_SERVER['HTTP_HOST'];
//    print_r($_POST);
//    exit();

    if (isset($_POST['photo']) && $_POST['photo'] != '' && isset($_POST['sticker']) && $_POST['sticker'] != ''){

    //Debug
//    print_r($_POST);
//    exit();
        //Sticker
//        $sticker = explode($url.'/camagru/', $_POST['sticker']);
//        $sticker = $sticker[1];

        //Camera Image == PNG image created FROM BASE64

        $image_parts = explode(";base64,", $_POST['photo']);
        $t = explode("image/", $image_parts[0]);


    $allowed = array('png','jpg','jpeg','gif');

    if (!in_array(strtolower($t[1]), $allowed)){
        echo 'You Have choose Something different of PNG/JPEG/GIF';
        exit();
    }

    $gen = $image->generateImage($_POST['photo']);
        list($width, $height) = getimagesize($gen);

//        if ($width > 614 && $height > 460){
//            $gen = $image->CresizeImage($gen, $width * 0.1, $height * 0.1);
//        }

        $image1 = imagecreatefromstring(file_get_contents($gen));


//        $image2 = imagecreatefromstring(file_get_contents($sticker));



        // MULTIPLE STICKERS
        $v = $_POST['sticker'];


        $p = explode(',', $v);


        $arr = array();
        $st = array();
        $n = count($p);
        $z = 0;
        while ($z < $n){
            $sticker = explode($url.'/camagru/', $p[$z]);
            array_push($arr, $sticker[1]);
            array_push($st , imagecreatefromstring(file_get_contents($arr[$z])));
            $z++;
        }


        unlink($gen);


        $z = 0;
        while ($z < count($arr)){

            list($swidth, $sheight) = getimagesize($arr[$z]);

            $index_x = rand(0, $swidth - 100);

            $index_y = rand(0, $sheight - 100);

//            echo $arr[$z];
            imagecopymerge($image1, $st[$z], $index_x, $index_y, 0, 0, $width ,$height, 100);
            $z++;
        }

//    imagecopymerge($image1, $image2, 10, 10, 0, 0, $width ,$height, 100);


//        header('Content-Type: image/png');
        $name = './images/' . uniqid() . '.png';
        imagepng($image1, $name);


        $v = explode('./images/', $name);

        $newpath = './img/' . $v[1];
//        echo $newpath;
//        exit();
        if($name)
        {
            $v = explode('./images/', $name);
            copy($name, $newpath);
            unlink($name);
        }
        $post->insertPost($id, $newpath);
        echo 'Image With Sticker Added Successfully';
        exit();
    }

    //Second Traitement without sticker
    if (isset($_POST['photo']) && $_POST['photo']){

        $image_parts = explode(";base64,", $_POST['photo']);
        $t = explode("image/", $image_parts[0]);


        $allowed = array('png','jpg','jpeg','gif');

        if (!in_array(strtolower($t[1]), $allowed)){
            echo 'You Have choose Something different of PNG/JPEG/GIF';
            exit();
        }

//       echo 'daz';
//       exit();
        $gen = $image->generateImage($_POST['photo']);
        list($width, $height) = getimagesize($gen);


        $image1 = imagecreatefromstring(file_get_contents($gen));


//        $sss = getimagesize($gen);
        unlink($gen);
        

        $name = './images/' . uniqid() . '.png';
        imagepng($image1, $name);

        $v = explode('./images/', $name);

        $newpath = './img/' . $v[1];
//        echo $newpath;
//        exit();
        if($name)
        {
            $v = explode('./images/', $name);
            copy($name, $newpath);
            unlink($name);
        }
        $post->insertPost($id, $newpath);
        echo 'Image Added Successfully';
        exit();
    }
    else {
        echo 'Please Take a Picture Or upload it';
//       exit();
    }

    ?>