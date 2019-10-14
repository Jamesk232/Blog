<?php 


class Posts extends Controller {

	public function __construct() {
		$this->postModel = $this->model("Post");

		// function that checks if input field is empty

	}

	// add a post
	public function add(){
		if(isset($_SESSION["user"])){
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
				"content_err" => "",
				"image_err" => ""
			];

			// validate
			if(empty($data["title"])){
				$data["title_err"] = "Please enter a title";
			}

			if(empty($data["summary"])){
				$data["summary_err"] = "Please summarize this post";
			}

			if(empty($data["content"])){
				$data["content_err"] = "Please add content";
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

						// enter into database
						if(empty($data["title_err"]) && empty($data["summary_err"]) && empty($data["content_err"]) && empty($data["image_err"])){

							$fileNameNew = uniqid('', true).".".$fileActualExt;
							// send image to uploads folder 
							$fileDestination = "uploads/".$fileNameNew;
							// send image to gallery folder
							$fileDestination2 = "gallery/".$fileNameNew;
							move_uploaded_file($file_tmp, $fileDestination);
							move_uploaded_file($file_tmp, $fileDestination2);
							$data["image"] = $fileNameNew;

							if($this->postModel->addPost($data)){
								if($this->postModel->addToGallery($data)){
									header("location:".URLROOT);
								}
							}else{
								die("something went wrong");
							}
						}else{

							$this->view("add", $data);
						}

				}else{
					$data = [
						"image" => "",
						"title" => $_POST["title"],
						"summary" => $_POST["summary"],
						"content" => $_POST["content"],
						"title_err" => "",
						"summary_err" => "",
						"content_err" => "",
						"image_err" => "The file exceeds the maximum upload size. Please try again with another image."
					];					
				
					$this->view("add", $data);
				}
			}else{

				$data["image_err"] = "Couldn't upload image. Please upload jpg, jpeg or png files only";

				$this->view("add", $data);
			}
			

		}else{
			$data = [
				"image" => "",
				"title" => "",
				"summary" => "",
				"content" => "",
				"title_err" => "",
				"summary_err" => "",
				"content_err" => "",
				"image_err" => ""
			];

			$this->view("add", $data);
		}
	}else{
		header("location:".URLROOT);
	}
	}

	// get a single row from blogpost table in database
	public function singlepost($id){

		$post = $this->postModel->singlePost($id);

		$data = [
			"post" => $post
		];

		$this->view("post", $data);
	}

	// open post associated with image in gallery
	public function fromgallery($image){
		$post = $this->postModel->postThroughGallery($image);

		$data = [
			"post" => $post
		];

		$this->view("post", $data);
	}

	// edit post
	public function edit($id){
		// get the post to be edited
		$post = $this->postModel->singlePost($id);

		// update post
		if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit"])){
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			$data = [
				"post" => $post,
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
				$data["summary_err"] = "Please summarize this post";
			}

			if(empty($data["content"])){
				$data["content_err"] = "Please add content";
			}

			// edit post in database
			if(empty($data["title_err"]) && empty($data["summary_err"]) && empty($data["content_err"])){

				if($this->postModel->editPost($data)){
					header("Location:".URLROOT);
				}else{
					echo "Edit failed";
				}
			}

		}else{
			$data = [
				"post" => $post,
				"title" => htmlentities($post["title"]),
				"summary" => htmlentities($post["summary"]),
				"content" => htmlentities($post["content"]),
				"title_err" => "",
				"summary_err" => "",
				"content_err" => ""
			];

			$this->view("edit", $data);
		}
	}

	// delete post
	public function delete($id){
		if($this->postModel->deletePost($id)){
			header("Location:".URLROOT);
		}else{
			die("something went wrong deleting that post");
		}
	}

	// add image into gallery
	public function addimage() {
		if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["upload"])){

			$data = [
				"image" => "",
				"image_err" => ""
			];

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

					$fileNameNew = uniqid('', true).".".$fileActualExt;
					// send image to gallery folder
					$fileDestination = "uploads/".$fileNameNew;
					move_uploaded_file($file_tmp, $fileDestination);
					$data["image"] = $fileNameNew;

					if($this->postModel->addToGallery($data)){
							header("location:".URLROOT);
					}
				}else{
					header("Location:".URLROOT."/pages/gallery");
				}
			}else{
				$this->view("add", $data);
			}
			
		}else{
			header("Location:".URLROOT."/pages/gallery");
		}
	}

}