<?php
include_once PATH_SYSTEM . '/config/config.php';
class FT_Model
{     
	public $conn = NULL;
	private $server = DB_HOST;
	private $dbName = DB_NAME;
	private $user = DB_USER;
	private $password = DB_PASSWORD;
        
        // Hàm kết nối CSDL
	public function __connect()
	{
		$this->conn = new mysqli($this->server, $this->user, $this->password, $this->dbName);

		if ($this->conn->connect_error) {
			printf($this->conn->connect_error);
			exit();
		}
		$this->conn->set_charset("utf8");
	}
        // Hàm đóng kết nối CSDL
        public function closeDatabase()
	{
		if ($this->conn) {
			$this->conn->close();
		}
	}
}