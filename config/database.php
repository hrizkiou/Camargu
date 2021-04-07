<?php
	//Docker
	$dsn = "mysql:host=db;";
	$dbuser = "root";
	$dbpasswd = "test";


	class Database {
		

		public $conn;

		public function __construct($isdbname = TRUE){
			global $dsn;
			global $dbuser;
			global $dbpasswd;
			// $this->dsn = $dsn;
			// $this->dbuser = $dbuser;
			// $this->dbpasswd = $dbpasswd;
			try {
				if ($isdbname == false)
					$this->conn = new PDO($dsn, $dbuser, $dbpasswd);
				else
					$this->conn = new PDO($dsn . 'dbname=camagru;', $dbuser, $dbpasswd);

				// set the PDO error mode to exception
				$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				// echo "Connected successfully";
			  } catch(PDOException $e) {
				echo "Connection failed: " . $e->getMessage();
			  }
			  return $this->conn;
		}
	}
	// $user = new Database();
?>