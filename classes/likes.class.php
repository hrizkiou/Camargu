<?php
    require_once 'config/database.php';

    class Likes extends Database {
        
        public function userOflikes($userid, $postid)
        {
            $sql = "INSERT INTO `likes` (`postid`, `userid`) VALUES (:postid, :userid);";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['postid'=>$postid,'userid' => $userid]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return TRUE;
        }

        public function nbrOfLikes($postid){
            $sql = "SELECT COUNT(postid) AS NBRLIKES FROM likes WHERE postid = :postid";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['postid'=>$postid]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;
        }

        public function addlike($postid, $userid){
            $sql = "INSERT INTO `likes` (`postid`, `userid`) VALUES (:postid, :userid)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['postid'=>$postid, 'userid'=>$userid]);
//            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return TRUE;
        }

        public function deleteLike($postid, $userid){
            $sql = "DELETE FROM `likes` WHERE postid = :postid AND userid = :userid";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['postid'=>$postid, 'userid'=>$userid]);
//            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return TRUE;
        }

        public function alreadyLike($postid, $userid){
            $sql = "SELECT COUNT(*) AS `COUNT` FROM `likes` WHERE postid = :postid AND userid = :userid";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['postid'=>$postid, 'userid'=>$userid]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;
        }

        public function CountLikes($postid){
            $sql = "SELECT COUNT(*) AS `COUNT` FROM `likes` WHERE postid = :postid";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['postid'=>$postid]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;
        }
    }?>