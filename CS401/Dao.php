<?php

require_once "User.php";

class Dao {

  private $host = "us-cdbr-east-03.cleardb.com";
  private $db = "heroku_0786dd9b80b10d8";
  private $user = "b0c1e19fab3d8e";
  private $pass = "174dd4db";

  public function getConnection () {
    return
      new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user,
          $this->pass);
  }

  public function getConnectionStatus()
	{
		$conn = $this->getConnection();
		return $conn->getAttribute(constant("PDO::ATTR_CONNECTION_STATUS"));
	}

    public function getUsers(){
		$conn = $this->getConnection();
		$statement = $conn->query("SELECT email, name FROM user");
		return $tmt->fetchAll();
	}

	public function getUserByEmail($email){
		$conn = $this->getConnection();
		$query = "SELECT email, name FROM user WHERE email = :email";
		$statement = $conn->prepare($query);
		$statement->bindParam(':email', $email);
		$statement->execute();
		return $statement->fetchAll();
	}

	public function userExists($email){
		$conn = $this->getConnection();
		$statement = $conn->prepare("SELECT * FROM user WHERE email = :email");
		$statement->bindParam(':email', $email);
		$statement->execute();
		if($statement->fetch()){
			return true;
		}else{
			return false;
		}
	}

	public function addUser($email, $password, $name){
		
		$conn = $this->getConnection();

		//Password hashing for safety
		$digest = password_hash($password, PASSWORD_DEFAULT);
		if(!$digest){
			throw new Exception("Password could not be hashed");
		}

		$query = "INSERT INTO user (email, pass, name)
								values(:email, :password, :name)";
		$statement = $conn->prepare($query);
		$statement->bindParam(':email', $email);
		$statement->bindParam(':password', $password);
		$statement->bindParam(':name', $name);

		try{
			$statement->execute();
			return true;
		}catch(PDOException $e){
			return false;
		}
	}

	public function validateUser($email, $password){

		$conn = $this->getConnection();
		$statement = $conn->prepare("SELECT * FROM user 
								WHERE email = :email 
								AND pass = :password");
		$statement->bindParam(':email', $email);
		$statement->bindParam(':password', $password);
		$statement->execute();

		$row = $statement->fetch();
		$digest = $row['password'];
        return $row;
	}

	public function saveComment($user, $comment){
		$conn = $this->getConnection();
		$query = "INSERT INTO comments (userName, commentPost) VALUES (:userName, :commentPost)";
		$statement = $conn->prepare($query);
		$statement->bindParam(":userName", $user);
		$statement->bindParam(":commentPost", $comment);
		return $statement->execute();
	}

	public function getComments(){
		$conn = $this->getConnection();
		$statement = $conn->query("SELECT * FROM comments");
		return $statement->fetchAll();
	}
}