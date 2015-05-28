<?php

class FX_SlideShow extends FX_BasicCRUD{

	private $conn;

	public function __construct(){
		$this->conn = FX_DBConnection::getConnection();
		parent::__construct();
		$this->setTableInfo("fx_slideshow", "fx_slideshow_id");
	}

	public function __destruct(){}
	
	public function getSlideShowById($fx_slideshow_id)
	{
		$data = $this->conn->fetchAssoc("SELECT * FROM fx_slideshow WHERE fx_slideshow_id = ?", array($fx_slideshow_id));
		return $data;
	}

	public function getAllData()
	{
		$data = $this->conn->fetchAll("SELECT * FROM fx_slideshow WHERE deleted = 0");
		return $data;
	}

	public function getSlideShowByCode($code)
	{
		$data = $this->conn->fetchAssoc("SELECT * FROM fx_slideshow WHERE code = ?", array($code));
		return $data;
	}

	public function getSlideShowBySectionId($fx_section_id)
	{
		$data = $this->conn->fetchAssoc("SELECT * FROM fx_slideshow WHERE fx_section_id = ?", array($fx_section_id));
		return $data;
	}

	public function getSlideShowDefault()
	{
		$data = $this->conn->fetchAssoc("SELECT * FROM fx_slideshow ORDER BY fx_slideshow_id desc");
		return $data;
	}

}