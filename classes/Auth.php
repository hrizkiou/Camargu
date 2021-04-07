<?php
    require_once 'config/database.php';

class Auth extends Database
{

	public function test_input($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	public function register($full_name, $email, $username, $password, $token)
	{
		$sql = "INSERT INTO users (full_name, email, username, password, token, active, deleted) VALUES (:full_name, :email, :username, :password, :token, 0, 1)";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['full_name' => $full_name, 'email' => $email, 'username' => $username, 'password' => $password, 'token' => $token]);
		return true;
	}

	public function user_exist($username)
	{
		$sql = "SELECT username FROM users WHERE username = :username";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['username' => $username]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	public function email_exist($email)
	{
		$sql = "SELECT email FROM users WHERE email = :email";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['email' => $email]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	public function login($email)
	{
		$sql = "SELECT id, email, username, password, active FROM users WHERE email = :email AND deleted != 0";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['email' => $email]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}

	//Return id of logged User
	public function CurrentUser($email)
	{
		$sql = "SELECT id, username FROM users WHERE email = :email AND deleted != 0";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['email' => $email]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}


	///Get User informations
	public function userinfo($email)
	{
		$sql = "SELECT * FROM users WHERE email = :email AND deleted != 0";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['email' => $email]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}

	public function reset($userid, $token)
	{
		$sql = "INSERT INTO forgotpassword (userid, token, token_expire) VALUES (:userid, :token, (date_add(now() , interval 5 MINUTE))) ON DUPLICATE KEY UPDATE userid = :userid, token = :token";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['userid' => $userid, 'token' => $token]);
		// $stmt->fetchAll(PDO::FETCH_ASSOC);
		return true;
	}

	public function verifyuser($email)
	{
		$sql = "UPDATE users SET token = '', active = 1 WHERE email = :email AND deleted != 0";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['email' => $email]);
		$stmt->fetch(PDO::FETCH_ASSOC);
		return true;
	}

	//Update informations off logged user
	public function updateuserinfo($full_name, $email, $username, $newpass)
	{
		$sql = "UPDATE users SET full_name = :email, email = :email, username = :username, password = :newpass WHERE email = :email AND deleted != 0";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute([]);
		$stmt->fetch(PDO::FETCH_ASSOC);
		return true;
	}


	// Worked
	public function changePassword($password, $email)
    {
	    $sql = "UPDATE `users` SET `password` = :password WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['password'=>$password, 'email'=>$email]);
//        $stmt->fetch(PDO::FETCH_ASSOC);
        return true;
    }

    public function ChangeProfil($id, $full_name, $email, $username){
        $sql = "UPDATE `users` SET `full_name` = :full_name , `email` = :email , `username` = :username WHERE `id` = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['full_name'=>$full_name, 'email'=>$email, 'username'=>$username, 'id'=>$id]);
//        $stmt->fetch(PDO::FETCH_ASSOC);
        return true;
    }

	public function getProfileimg($id)
	{
		$sql = "SELECT `profilpic` FROM users WHERE id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['id' => $id]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}


	public function getImageGallery(){
		$sql = "SELECT `id`, `userid`, `data`, `creation_date` FROM `posts` ORDER by creation_date DESC LIMIT 5";
		// $sql1 = "SELECT `userid`, `data`, `creation_date` FROM `posts` ORDER by creation_date DESC";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}

	public function insertimage($fileName){
		$sql = "INSERT into images (file_name, uploaded_on) VALUES ('".$fileName."', NOW())";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['fileName' => $fileName]);
		$stmt->fetch(PDO::FETCH_ASSOC);
		return true;
	}

	public function checkToken($email){
	    $sql = 'SELECT email, forgotpassword.token FROM users INNER JOIN forgotpassword ON users.id = forgotpassword.userid WHERE email = :email';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email'=>$email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
	}

}
