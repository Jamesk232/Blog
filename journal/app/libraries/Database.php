<?php

class Database {
	private $host = DB_HOST;
	private $user = DB_USER;
	private $pass = DB_PASS;
	private $dbname = DB_NAME;
	private $charset = CHARSET;

	private $dbh;
	private $stmt;
	private $error;

	public function __construct(){
		//set DSN
		$dsn = "mysql:host=".$this->host.";dbname=".$this->dbname.";charset=".$this->charset."";

		$options = [
			PDO::ATTR_PERSISTENT => true,
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES => false
		];

		// create a pdo instance
		try{
			$this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
		}catch(PDOException $e){
			$this->error = $e->getMessage();
			echo $this->error;
		}
	}

	// prepare statement with query
	public function query($sql){
		$this->stmt = $this->dbh->prepare($sql);
	}

	// bind the values
	public function bind($param, $value, $type = null){
		if(is_null($type)){
			switch(true){
				case is_int($value):
					$type = PDO::PARAM_INT;
					break;
				case is_bool($value):
					$type = PDO::PARAM_BOOL;
					break;
				case is_null($value):
					$type = PDO::PARAM_NULL;
					break;
				default:
					$type = PDO::PARAM_STR;
			}
		}
		$this->stmt->bindValue($param, $value, $type);
	}

	// execute prepared statement
	public function execute(){
		return $this->stmt->execute();
	}

	// fetch a single row;
	public function singleRow(){
		$this->execute();
		return $this->stmt->fetch();
	}

	// fetch all rows
	public function allRows(){
		$this->execute();
		return $this->stmt->fetchAll();
	}


}