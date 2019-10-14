<?php 


class Pages extends Controller {
	public function __construct(){
		$this->pagesModel = $this->model("Page");
	}

	// This function gets all posts from the database and sends them to the homepage to be displayed
	public function index(){
		$allPosts = $this->pagesModel->getAllPosts();

		//Get all the posts retrieved from database in a variable to send to views
		$data = [
			"posts" => $allPosts
		];

		$this->view("index", $data);
	}

	public function gallery(){
		$allImages = $this->pagesModel->getAllImages();

		$data = [
			"images" => $allImages
		];

		$this->view("gallery", $data);
	}

}