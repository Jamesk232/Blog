<?php

class Page {
	private $db;
	public function __construct(){
		$this->db = new Database();
	}

	// This function returns all posts
	public function getAllPosts(){

		//query the database for all rows and have the results in descending order
		$this->db->query("SELECT * FROM blogposts ORDER BY id DESC");
		$results = $this->db->allRows();
		return $results;
	}
}