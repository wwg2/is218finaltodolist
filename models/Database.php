<?php
class Database {
	protected static $sql;
	private static $dsn = 'mysql:host=sql1.njit.edu;dbname=snh7';
	private static $username = "snh7";
	private static $password = "urku3NyPq";

		//PDO object is returned
		public function connect() {
			if(!isset(self::$sql)) {
				try {
					self::$sql = new PDO(self::$dsn, self::$username, self::$password);
				} catch (PDOException $e) {
					echo $e->getMessage();
					exit();
				}
			}
			return self::$sql;
		}

		//runs through query and returns result
		public function query($query) {
	        try {
	    		$sql = $this->connect();
	    		$statement = $sql->prepare($query);
	    		$statement->execute();
	    		$result = $statement->fetchAll();
	    		$statement->closeCursor();
	        } catch (PDOException $e) {
	            return $e;
	        }
			return $result;
		}
}
?>