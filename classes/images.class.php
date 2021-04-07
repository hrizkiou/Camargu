<?php
    require_once 'config/database.php';
    class Images extends Database {

        public function generateImage($img){
            $image_parts = explode(";base64,", $img);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $folderPath = "images/";
            $image_base64 = base64_decode($image_parts[1]);
            $file = $folderPath . uniqid() . '.' . $image_type;
            file_put_contents($file, $image_base64);
            return $file;
        }

        public function resizeImage($path){
            $dest = "./images/" . uniqid() . '.jpg';
            $info = getimagesize($path);
            if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($path);
            elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($path);
            elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($path);
            imagejpeg($image, $dest, 10);
            return $dest;
        }

        function CresizeImage($filename, $newwidth, $newheight){
            list($width, $height) = getimagesize($filename);
            if($width > $height && $newheight < $height){
                $newheight = $height / ($width / $newwidth);
            } else if ($width < $height && $newwidth < $width) {
                $newwidth = $width / ($height / $newheight);
            } else {
                $newwidth = $width;
                $newheight = $height;
            }
            $thumb = imagecreatetruecolor($newwidth, $newheight);
            $source = imagecreatefromjpeg($filename);
            imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
            $name = './images/' . uniqid() . '.jpg';
            imagejpeg($thumb, $name);
            return $name;
        }

        function insertProfilPic($id, $profilpic){
            $sql = "UPDATE `users` SET `profilpic` = :profilpic WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['profilpic'=>$profilpic, 'id'=>$id]);
//        $stmt->fetch(PDO::FETCH_ASSOC);
            return true;
        }

        function getPreviousProfilPic($id){
            $sql = "SELECT `profilpic` FROM `users` WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;
        }
    }