<?php 


class Posts extends Controller {

	public function __construct() {
		$this->postModel = $this->model("Post");
	}

	public function add(){

		//dont forget to check for admin
		if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add"])){

			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			$data = [
				"image" => "",
				"title" => htmlentities($_POST["title"]),
				"summary" => htmlentities($_POST["summary"]),
				"content" => htmlentities($_POST["content"]),
				"title_err" => "",
				"summary_err" => "",
				"content_err" => ""
			];

			// validate
			if(empty($data["title"])){
				$data["title_err"] = "Please enter a title";
			}

			if(empty($data["summary"])){
				$data["summary_err"] = "Please enter a summary";
			}

			if(empty($data["content"])){
				$data["content_err"] = "Please enter some content. Don't rush. Make it good";
			}

			// upload image
			$file = $_FILES["image"];

			$file_name = $file["name"];
			$file_size = $file["size"];
			$file_tmp = $file["tmp_name"];
			$file_err = $file["error"];
			$file_type = $file["type"];

			$fileExt = explode(".", $file_name);
			$fileActualExt = strtolower(end($fileExt));

			$allowed = array("jpg", "jpeg", "png");

			if(in_array($fileActualExt, $allowed)){
				if($file_err == 0){
					if($file_size < 5000000){
						$fileNameNew = uniqid('', true).".".$fileActualExt;
						$fileDestination = "uploads/".$fileNameNew;
						move_uploaded_file($file_tmp, $fileDestination);
						$data["image"] = $fileNameNew;

						// enter into database
						if(empty($data["title_err"]) && empty($data["summary_err"]) && empty($data["content_err"])){
							if($this->postModel->addPost($data)){
								header("location:".URLROOT);
							}else{
								die("something went wrong");
							}
						}else{
							$this->view("add", $data);
						}

					}else{
						echo "Image is too big";
					}
				}else{
					$data = [
						"image" => "",
						"title" => $_POST["title"],
						"summary" => $_POST["summary"],
						"content" => $_POST["content"],
						"title_err" => "",
						"summary_err" => "",
						"content_err" => ""
					];					
				
					$this->view("add", $data);
				}
			}else{
				echo "Image format not allowed";
			}
			

		}else{
			$this->view("add");
		}
	}


	public function singlepost($id){

		$post = $this->postModel->singlePost($id);

		$data = [
			"post" => $post
		];

		$this->view("post", $data);
	}

}