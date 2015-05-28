<?php

class FX_SysUserLog extends FX_BasicCRUD{

	private $conn;

	public function __construct(){
		$this->conn = FX_DBConnection::getConnection();
		parent::__construct();
		$this->setTableInfo("fxsysuser_log", "fxsysuser_log_id");
	}

	public function __destruct(){}

	/*public function insertUserLog($data)
	{
		$this->conn->insert('fxsysuser_log', $data);
		$new_id = $this->conn->lastInsertId();
		return $response;
	}*/

	public function getUserLogCount()
	{
		$data = $this->conn->fetchAssoc("SELECT COUNT(*) AS count FROM fxsysuser_log");
		return $data;
	}

	/*public function getUserLogAll($page, $records)
	{
		$data = $this->conn->fetchAll("SELECT * FROM fxsysuser_log ORDER BY fxsysuser_log_id DESC  LIMIT ".$page.",".$records."");
		return $data;
	}*/

	public function getUserLogAllbyPage($limit)
	{
		$data = $this->conn->fetchAll("SELECT * FROM fxsysuser_log ORDER BY fxsysuser_log_id DESC $limit");
		return $data;
	}
	
	/*
	public function updateUserLog($fxsysuser_log_id, $fxsysuser_id, $data)
	{
		$response = $this->conn->update('fxsysuser_log', $data, array('fxsysuser_log_id' => $fxsysuser_log_id, 'fxsysuser_id' => $fxsysuser_id));
		return $response;
	}
	*/
	
	public function getSysUserLogById($fxsysuser_log_id)
	{
		$data = $this->conn->fetchAssoc("SELECT * FROM fxsysuser_log WHERE fxsysuser_log_id = ?", array($fxsysuser_log_id));
		return $data;
	}
}