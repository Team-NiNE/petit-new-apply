<?php
/**
 * Database.php
 *
 * @author Lee Sung Jae <me@lsj.pink>
 * @copyright 2018 Lee Sung Jae
 */
// Copied from Cocoard Repository.

class Database {

	private $_db;

	public function __construct(Array $dbSettings) {
		if (!$dbSettings) {
			die('Class Database called with missing argument.');
		}

		$this->db = new PDO("mysql:host=$dbSettings[host];charset=utf8", $dbSettings['user'], $dbSettings['key'], [
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		]);

		try {
			$this->db->exec("use $dbSettings[name]");
		} catch (PDOException $e) {
			if($e->getCode() == 42000) {
				$this->_createDatabase($dbSettings['name']);
				$this->db->exec("use $dbSettings[name]");
			} else throw $e;
		}
	}

	private function _createDatabase(String $dbName) {
		$tables = [ 'board', 'document', 'user', 'file', 'revision' ];

		$this->db->query('set sql_mode = "no_auto_value_on_zero";');
		$this->db->query('set time_zone = "+00:00";');

		if($this->db->exec("create database if not exists `$dbName` default character set utf8 collate utf8_general_ci;") === false && $this->db->errorInfo()[0] != '00000') die($this->db->errorInfo()[2]);
		if($this->db->exec("use `$dbName`;") === false && $this->db->errorInfo()[0] != '00000') die($this->db->errorInfo()[2]);

		foreach($tables as $table) {
			$this->_createTable($table);
		}
	}

	private function _createTable(String $tableName) {
		if($this->db->exec(file_get_contents(__DIR__."/structure/table_$tableName.sql")) === false && $this->db->errorInfo()[0] != '00000') die($this->db->errorInfo()[2]);
	}

	/**
	 * SQL query function.
	 *
	 * @param String $sql
	 * @param array $params
	 * @return Boolean|array
	 */
	public function query(String $sql, $params = []) {
		if(!is_array($params)) $params = [$params]; // If $params not array
		if(!$query = $this->db->prepare($sql)) die();
		if(!$query->execute($params)) die();

		if($query->errorInfo() != [ 00000, null, null ]) { // Return false info when error info not no error
			return false;
		}

		if(strtolower(substr($sql, 0, 6)) == 'select') { // To return fetch result when sql query is select
			if($fetch = $query->fetchAll()) {
				// if(count($fetch) == 0) return false; // If fetch result array has no element, return false
				/* If fetch result array has just one element, return only that
				* If fetch result array has just one element and that object element has just one element, return only that */
				return (count($fetch) == 1) ? (count(get_object_vars($fetch[0])) == 1) ? array_values(get_object_vars($fetch[0]))[0] : $fetch[0] : $fetch;
			} else { // Query fetch failed
				return false;
			}
		} else { // If sql query not select and query success
			return true;
		}
	}

	public function lastInsertId() {
		return $this->db->lastInsertId();
	}

}
