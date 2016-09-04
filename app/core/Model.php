<?php 

class Model
{
	private static $_instance = null;

	private $_pdo,
			$_query,
			$_error = false,	
			$_result,
			$_count = 0;

	private function __construct() {
		try {
			$this->_pdo = new PDO('mysql:host=' . Config::get('DB/host') . ';dbname=' . Config::get('DB/name') . ';charset=utf8', Config::get('DB/user'), Config::get('DB/password'));
		} catch(PDOException $e) {
			die($e->GetMessage());
		}
	}

	public static function getInstance() {
		if(is_null(self::$_instance)) {
			self::$_instance = new Model();
		}
		return self::$_instance;
	}

	public function query($sql, $params = array()) {
		$this->_error = false;
		if($this->_query = $this->_pdo->prepare($sql)) {
			if(count($params)) {
				$x = 1;
				foreach($params as $param) {
					$this->_query->bindValue($x, $param);
					$x++;
				}
			}
			if($this->_query->execute()) {
				$this->_result = $this->_query->fetchAll(PDO::FETCH_OBJ);
				$this->_count = $this->_query->rowCount();
			} else {
				$this->_error = true;
			}
		}
		return $this;
	}

	public function action($action, $table, $where = array()) {
		if(count($where)) {
			$operators = array('=', '>', '<', '>=', '<=');
			$field 		= $where[0];
			$operator 	= $where[1];
			$value		= $where[2];
			if(in_array($operator, $operators)) {
				$sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";
				if(!$this->query($sql, array($value))->error()) {
					return $this;
				}
			}
		}
		return false;
	}

	public function get($table, $where) {
		return $this->action("SELECT *", $table, $where);
	}

	public function insert($table, $fields = array()) {
		if(count($fields)) {
			$keys = array_keys($fields);
			$values = '';
			$x = 1;
			foreach($fields as $field) {
				$values .= '?';
				if($x < count($fields)) {
					$values .= ', ';
				}
				$x++;
			}
			$sql = "INSERT INTO {$table} (`". implode("`, `", $keys) ."`) VALUES ({$values})";
			if(!$this->query($sql, $fields)->error()) {
				return true;
			}
		}
		return false;
	}

	public function update($table, $id, $fields = array()) {
		$set = '';
		$x = 1;
		foreach($fields as $name => $value) {
			$set .= "{$name} = ?";
			if($x < count($fields)) {
				$set .= ", ";
			}
			$x++;
		}
		$sql = "UPDATE {$table} SET {$set} WHERE id = {$id}";
		if(!$this->query($sql, $fields)->error()) {
			return true;
		}
		return false;
	}

	public function delete($table, $where) {
		return $this->action("DELETE", $table, $where);
	}

	public function results() {
		return $this->_result;
	}

	public function first() {
		return $this->results()[0];
	}

	public function count() {
		return $this->_count;
	}

	public function error() {
		return $this->_error;
	}

	/*
	private static $_instance = null;
	private static $_pdo = null;

	public function __construct() {
		self::$_pdo = $this->getInstance();
	}

	public function getInstance() {
		if(is_null(self::$_instance))
			self::$_instance = new PDO('mysql:host=' . Config::get('DB/host') . ';dbname=' . Config::get('DB/name') . ';charset=utf8', Config::get('DB/user'), Config::get('DB/password'));
		return self::$_instance;
	}

	public function get($id) {
		$query = self::$_pdo->prepare("SELECT * FROM users WHERE user_id = :id");
		$query->bindParam(':id', $id);
		$query->execute();
		if ($query->rowCount() > 0)
			return $query->fetch(PDO::FETCH_OBJ);
		return false;
	}

	public function check($email, $password) {
		$table = static::$table;
		$mdpassword = md5($password);
		$query = self::$_pdo->prepare("SELECT user_id, email, first_name, last_name, status FROM {$table} WHERE email = :email AND password = :password LIMIT 1");
		$query->bindParam(':email', $email);
		$query->bindParam(':password', $mdpassword);
		$query->execute();
		if ($query->rowCount() === 1) {
			Session::put('user', $query->fetch(PDO::FETCH_ASSOC));
			return true;
		}
		return false;
	}

	public function insert() {
		$table = static::$table;
		$sql = "INSERT INTO {$table} (";
		$param = "";
		foreach ($this as $key => $value) {
			$sql .= $key . ", ";
			$param .= "?, ";	
		}
		$param = rtrim($param, ", ");
		$sql = rtrim($sql, ", ") . ") VALUES (" . $param . ")";
		$stmt = self::$_pdo->prepare($sql);
		$bind = 1;
		foreach ($this as $key => &$value) {
			$stmt->bindParam($bind, $value);
			$bind ++;
		}
		$stmt->execute();
		return true;
	}

	public function update() {

	}

	public function delete() {
		
	}

	public function getAll() {
		$table = static::$table;
		$query = self::$_pdo->query("SELECT * FROM {$table}");
		if ($query->rowCount() > 0)
			return $query->fetchAll(PDO::FETCH_ASSOC);
		return false;
	}
	*/


}