<?php

class Post {
	private $db;
	
	public function __construct(){
		$this->db = new Database();
	}

	public function addPost($data){
		$this->db->query("INSERT INTO blogposts (title, summary, content, image) VALUES (:title, :summary, :content, :image)");
		$this->db->bind("title", $data["title"]);
		$this->db->bind("summary", $data["summary"]);
		$this->db->bind("content", $data["content"]);
		$this->db->bind("image", $data["image"]);

		if($this->db->execute()){
			return true;
		}else{
			return false;
		}
	}

	public function singlePost($id){
		$this->db->query("SELECT * FROM blogposts WHERE id = :id");
		$this->db->bind("id", $id);

		$post = $this->db->singleRow();

		return $post;
	}

	public function postThroughGallery($image){
		$this->db->query("SELECT * FROM blogposts WHERE image = :image");
		$this->db->bind("image", $image);

		$post = $this->db->singleRow();

		return $post;
	}

	public function editPost($data){
		$this->db->query("UPDATE blogposts SET title = :title, summary = :summary, content = :content WHERE id = :id");
		$this->db->bind("title", $data["title"]);
		$this->db->bind("summary", $data["summary"]);
		$this->db->bind("content", $data["content"]);
		$this->db->bind("id", $data["post"]["id"]);

		if($this->db->execute()){
			return true;
		}else{
			return false;
		}
	}

	public function deletePost($id){
		$this->db->query("DELETE FROM blogposts WHERE id = :id");
		$this->db->bind("id", $id);

		if($this->db->execute()){
			return true;
		}else{
			return false;
		}
	}

	public function addToGallery($data){
		$this->db->query("INSERT INTO gallery (image) VALUES (:image)");
		$this->db->bind("image", $data["image"]);

		if($this->db->execute()){
			return true;
		}else{
			return false;
		}
	}
}