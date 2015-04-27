<?php

class DatabaseConnection{

	private static $instance = null ;
	private $username = "root";
	private $password = "";
	private $dbname = "coupondunia";
	private $servername = "localhost";
	private $conn =null;

private function __construct(){

	//echo "in DATABASeConnection constructor  <br> ";
	$this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

	// Check connection
	if ($this->conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
	} 
	else{
		//echo "<br> connection established <br>" ;
	}
	//echo smething

}

public static function getinstance(){
	if(self:: $instance == null){
		return new DatabaseConnection();
	}
	return self::$instance ;
}
public function getconnection(){
	if($this->conn !=null){
		return $this->conn ;
	}
	else {
		return setconnection();
	}
}


public function setconnection(){
	$this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

	// Check connection
	if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
	} 
	else{
		return $this->conn ;
	}
}





}
?>