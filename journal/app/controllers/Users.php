<?php

class Users extends Controller {
	public function __construct(){
		$this->userModel = $this->model("User");
	}

	//index
	public function index(){

	}

	//register
	public function register(){

		//sanitize post
		$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		if($_SERVER["REQUEST_METHOD"] == "POST"){

			$data = [
				"fname" => htmlentities($_POST["fname"]),
				"lname" => htmlentities($_POST["lname"]),
				"password" => htmlentities($_POST["password"]),
				"confirm_password" => htmlentities($_POST["confirm_password"]),
				"permission" => htmlentities($_POST["permission"]),
				"fname_error" => "",
				"lname_error" => "",
				"password_error" => "",
				"confirm_password_error" => ""
			];


			//validate first name
			if(empty($data["fname"])){
				$data["fname_error"] = "Please enter your first name";
			}

			//validate last name
			if(empty($data["lname"])){
				$data["lname_error"] = "Please enter your last name";
			}

			//validate password
			if(empty($data["password"])){
				$data["password_error"] = "Please enter a password";
			}else{
				if(strlen($data["password"]) < 6){
					$data["password_error"] = "Password must have 6 characters or more. No spaces.";
				}
			}

			//confirm password
			if(empty($data["confirm_password"])){
				$data["confirm_password_error"] = "Please re-enter your password";
			}else{
				if($data["password"] != $data["confirm_password"]){
					$data["confirm_password_error"] = "Password does not match";
				}
			}


			//check there are no errors
			if(empty($data["fname_error"]) && empty($data["lname_error"]) && empty($data["password_error"]) && empty($data["confirm_password_error"])){
				//hash password
				$data["password"] = password_hash($data["password"], PASSWORD_DEFAULT);

				if($this->userModel->register($data)){
					header("Location:".URLROOT."/users/login");
				}else{
					die("something went wrong");
				}
			}else{
				$this->view("register", $data);
			}


		}else{
			//redirect to register with empty fields
			$data = [
				"fname" => "",
				"lname" => "",
				"password" => "",
				"confirm_password" => "",
				"permission" => "",
				"fname_error" => "",
				"lname_error" => "",
				"password_error" => "",
				"confirm_password_error" => "" 			
			];

			$this->view("register", $data);
		}
	}

	//login
	public function login(){

		if(isset($_SESSION["user_permission"]) && $_SESSION["user_permission"] == "supreme"){
			header("location:".URLROOT);
		}

		$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		if($_SERVER["REQUEST_METHOD"] == "POST"){

			$data = [
				"fname" => htmlentities($_POST["fname"]),
				"password" => htmlentities($_POST["password"]),
				"fname_error" => "",
				"password_error" => ""
			];

			//validate
			if(empty($data["fname"])){
				$data["fname_error"] = "first name is required";
			}else{
				if(!filter_var($data["fname"], FILTER_SANITIZE_STRING)){
					$data["fname_error"] = "Please enter a valid first name";
				}else{
					//check if fname exists
					$row = $this->userModel->findUserByFname($data["fname"]);

					if($data["fname"] != $row["fname"]){
						$data["fname_error"] = "No users with that first name found";
					}
				}
			}

			//validate password
			if(empty($data["password"])){
				$data["password_error"] = "Password is required to log in";
			}

			//check there are no errors
			if(empty($data["fname_error"]) && empty($data["password_error"])){
				$loggedin = $this->userModel->login($data["fname"], $data["password"]);
				if($loggedin){
					$this->createSession($loggedin);

				}else{
					$data["password_error"] = "Wrong password";
					$this->view("login", $data);
				}
				
			}else{
				$this->view("login", $data);
			}

		}else{
			//load log in page empty
			$data = [
				"fname" => "",
				"password" => "",
				"fname_error" => "",
				"password_error" => ""
			];

			$this->view("login", $data);
		}
	}

	//user session
	public function createSession($user){
		$_SESSION["user"] = $user["fname"];
		$_SESSION["user_permission"] = $user["permission"];


		header("location:".URLROOT);
	}

	//logged in
	public function isLoggedIn(){
		if(isset($_SESSION["user"])){
			return true;
		}else{
			return false;
		}
	}

	//logout
	public function logout(){
		unset($_SESSION["user"]);
		unset($_SESSION["user_permission"]);

		session_destroy();
		header("location:".URLROOT);
	}
}