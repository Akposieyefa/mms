<?php
namespace app\config;
/**
 * class Connection
 *
 * @author BobLewis <boblewisu@gmail.com>
 * @package app\config
 *
 */

class Connection {
	
	private $pdo;
	private $dsn;

	// DB credentials.
	private $DB_HOST = "localhost";
	private $DB_USER = "root";
	private $DB_PASSWORD = "";
	private $DB_NAME = "meeting_db";
	private $charset = "utf8";
	
	function __construct() {
		$this->dsn = "mysql:host=".$this->DB_HOST.";dbname=".$this->DB_NAME.";charset=".$this->charset."";
		$this->open_connection();
	}
	
	 /**
     * Run a database connection.
     *
     * @return PDO
     */

	public function open_connection() {
		$opt = [
		    \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
		    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
		    \PDO::ATTR_EMULATE_PREPARES   => false,
		];
		$this->pdo = new \PDO($this->dsn, $this->DB_USER, $this->DB_PASSWORD, $opt);
		if(!$this->pdo){
			echo "Problem in database connection! Contact administrator!";
			exit();
		}
		return $this->pdo;
	}

	 /**
     * Run a raw query statement against the database.
     *
     * @param  string  $query
     * @return bool
     */

	public function query($sql="") 
	{
		return $this->pdo->query($sql);
	}

	/**
     * Run a prepared query statement against the database.
     *
     * @param  string  $sql
     * @param  array  $args
     * @return array
     */

	public function preparedStatement($sql, $args = NULL)
	{
	    if (!$args)
	    {
	         return $this->query($sql);
	    }
	    $stmt = $this->pdo->prepare($sql);
	    $stmt->execute($args);
	    return $stmt;
	}

	public function getFieldsOnOneTable( $tbl_name ) {
	
		$rows = $this->query("DESC ".$tbl_name)->fetchAll();
		//$rows = $this->loadResultList();
		
		$f = array();
		for ( $x=0; $x<count( $rows ); $x++ ) {
			$f[] = $rows[$x]->Field;
		}
		
		return $f;
	}

	/**
     * Sinle Result query statement against the database.
     *
     * @param  string  $sql
     * @param  array  $args
     * @return object
    */

	public function singleResultList($sql, $args = NULL)
	{
		return $this->preparedStatement($sql, $args)->fetchObject();
	}

	/**
     * Result list query statement against the database.
     *
     * @param  string  $sql
     * @param  array  $args
     * @return object
    */

	public function loadResultList($sql, $args = NULL)
	{
		return $this->preparedStatement($sql, $args)->fetchAll();
	}

	/**
     * Num row query statement against the database.
     *
     * @param  string  $sql
     * @return int
     */

	public function numberOfRows($sql) 
	{
		return $this->query($sql)->fetchColumn();
	}

	/**
     * getting the number of affected rows from DELETE/UPDATE/INSERT.
     *
     * @param  string  $sql
     * @param  array  $args
     * @return int
    */

	public function rowCount($sql, $args = NULL)
	{
		return $this->preparedStatement($sql, $args)->rowCount();
	}

}
