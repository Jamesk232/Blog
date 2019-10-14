<?php

class User {
	private $db;

	public function __construct(){
		$this->db = new Database();
	}

	public function register($data){
		$this->db->query("INSERT INTO admin (fname, lname, password, permission) VALUES (:fname, :lname, :password, :permission)");
		$this->db->bind("fname", $data["fname"]);
		$this->db->bind("lname", $data["lname"]);
		$this->db->bind("password", $data["password"]);
		$this->db->bind("permission", $data["permission"]);


		if($this->db->execute()){
			return true;
		}else{
			return false;
		}
	}

	//find user by email
	public function findUserByEmail($email){
		$this->db->query("SELECT * FROM users WHERE email = :email");
		$this->db->bind("email", $email);
		$result = $this->db->single();

		return $result;
	}

	//get user by id
	public function getUserById($id){
		$this->db->query("SELECT * FROM users WHERE id = :id");
		$this->db->bind("id", $id);
		$row = $this->db->singleRow();
		return $row;
	}

	//login
	function login($fname, $password){
		$this->db->query("SELECT * FROM admin WHERE fname = :fname");
		$this->db->bind("fname", $fname);
		$row = $this->db->singleRow();

		$hashed_password = $row["password"];

		// if($hashed_password == $password){
		// 	return $row;
		// }else{
		// 	return false;
		// }

		if(password_verify($password, $hashed_password)){
			return $row;
		}else{
			return false;
		}
	}

	//get editor
	public function getAdmins(){
		$this->db->query("SELECT * FROM admin WHERE permission = :permission");
		$this->db->bind("permission", "Admin");
		$result = $this->db->resultSet();
		return $result;
	}

	// find user by first name
	public function findUserByFname($data){
		$this->db->query("SELECT * FROM admin WHERE fname = :fname");
		$this->db->bind("fname", $data);

		$result = $this->db->singleRow();

		return $result;
	}
}