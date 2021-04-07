<?php
    require_once 'config/database.php';

    class Posts extends Database {
        
        public function userOfposts($userid){
            $sql = "SELECT DISTINCT username FROM users INNER JOIN `posts` ON users.id = posts.userid WHERE posts.userid = :userid";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['userid'=>$userid]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;
        }

        public function picOfuser($id){
            $sql = "SELECT profilpic FROM users WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;
        }

        public function addcomment($postid, $userid, $data){
            $sql = "INSERT INTO `comments` (`postid`, `userid`, `data`) VALUES (:postid, :userid, :data)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['postid'=>$postid, 'userid'=>$userid, 'data'=>$data]);
//            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return TRUE;
        }

        public function getPost($OFFSET){
            $sql = "SELECT * FROM `posts` ORDER BY creation_date DESC LIMIT 5 OFFSET :OFFSET ";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam('OFFSET', $OFFSET, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $row;
        }

        public function getUserToInform($postid){
            $sql = "SELECT email, username, `data` FROM `posts` INNER JOIN `users` ON posts.userid = users.id WHERE posts.id = :postid LIMIT 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['postid'=>$postid]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;
        }

        public function insertPost($userid, $data){
            $sql = "INSERT INTO `posts` (`userid`, `data`) VALUES (:userid , :data)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['userid'=>$userid, 'data'=>$data]);
//            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return TRUE;
        }

        public function getImageGalleryById($userid){
            $sql = "SELECT * from `posts` WHERE userid = :userid order by `creation_date` DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['userid'=>$userid]);
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $row;
        }

        public function deletePost($userid, $data){
            $sql = "DELETE FROM `posts` WHERE userid = :userid AND `data` = :data";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['userid'=>$userid, 'data'=>$data]);
//            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return TRUE;
        }

    }
?>