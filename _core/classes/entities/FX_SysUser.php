<?php

class FX_SysUser extends FX_BasicCRUD{

	private $conn;

	public function __construct(){
		$this->conn = FX_DBConnection::getConnection();
		parent::__construct();
		$this->setTableInfo("fxsysuser", "fxsysuser_id");
	}

	public function __destruct(){}
	
	/*public function getSysUserById($fxsysuser_id)
	{
		$data = $this->conn->fetchAssoc("SELECT * FROM fxsysuser WHERE fxsysuser_id = ?", array($fxsysuser_id));
		return $data;
	}*/

	/*public function loginAdmin($username, $password)
	{
		$data = $this->conn->fetchAssoc("SELECT * FROM fxsysuser WHERE email = ? AND password = ?", array($username, $password));
		return $data;
	}*/

	/*
	public function getIdByEmail($email)
	{
		$data = $this->conn->fetchAssoc("SELECT * FROM fxsysuser WHERE email = ?", array($email));
		return $data;
	}
	*/

	public function updateUser($fxsysuser_id, $data)
	{
		$record = $this->conn->update('fxsysuser', $data, array('fxsysuser_id'=> $fxsysuser_id));
		return $record;
	}
	
	/*
	public function updateUserPassword($fxsysuser_id, $data)
	{
		$record = $this->conn->update('fxsysuser', $data, array('fxsysuser_id'=> $fxsysuser_id));
		return $record;
	}
	*/
 }