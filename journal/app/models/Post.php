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
}