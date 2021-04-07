<?php
    require_once 'config/database.php';

    class Comments extends Database {

        public function getPostComment(){
            $sql = "SELECT `userid`, `data`, `creation_date` FROM `comments` ORDER by creation_date DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $row;
        }
        
        public function userOfcomment($userid){
            $sql = "SELECT DISTINCT username FROM users INNER JOIN `comments` ON users.id = comments.userid WHERE comments.userid = :userid";
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

        public function getCommentbyPostid($postid){
            $sql = "SELECT posts.id AS 'POSTS',posts.userid AS 'USER_OF_POST', comments.userid AS 'COMMENTED_USERS', comments.data, comments.creation_date FROM posts INNER JOIN comments ON posts.id = comments.postid WHERE postid = :postid";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['postid'=>$postid]);
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $row;
        }
    }
?>