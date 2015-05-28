<?php

class FX_Menu extends FX_BasicCRUD{

	private $conn;

	public function __construct(){
		$this->conn = FX_DBConnection::getConnection();
		parent::__construct();
		$this->setTableInfo("fx_menu", "fx_menu_id");
	}

	public function __destruct(){}
	
	/*
	public function getAllMenu()
	{
		$data = $this->conn->fetchAll("SELECT * FROM fx_menu WHERE deleted = 0");
		return $data;	
	}
	*/

	public function getMenuById($fx_menu_id)
	{
		$data = $this->conn->fetchAssoc("SELECT * FROM fx_menu WHERE fx_menu_id = ?", array($fx_menu_id));
		return $data;
	}

	public function insert($data)
	{
		$this->conn->insert('fx_menu', $data);
		//$new_id = $this->conn->lastInsertId();
	}
	public function getAllMenu()
	{
		$data = $this->conn->fetchAll("SELECT * FROM fx_menu WHERE deleted = 0");
		return $data;
	}

	public function getPositionMenu($key_menu)
	{
		$data = $this->conn->fetchAssoc("SELECT * FROM fx_menu WHERE key_menu = ? ORDER BY fx_menu_id DESC LIMIT 1", array($key_menu));
		return $data;
	}

	

}