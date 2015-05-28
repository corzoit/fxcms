<?php

class FX_Page{

	private $conn;

	public function __construct(){
		$this->conn = FX_DBConnection::getConnection();
	}

	public function __destruct(){}
	
	public function getPageById($fx_page_id)
	{
		$data = $this->conn->fetchAssoc("SELECT * FROM fx_page WHERE fx_page_id = ?", array($fx_page_id));
		return $data;
	}

	public function getPageByKeyword($keyword, $page, $records)
	{
		$data = $this->conn->fetchAll("SELECT * FROM fx_page WHERE title LIKE '%$keyword%' OR title_key LIKE '%$keyword%' OR meta_title LIKE '%$keyword%' OR meta_keywords LIKE '%$keyword%' or meta_description LIKE '%keyword%' LIMIT ".$page.",".$records."");
		return $data;
	}

	public function getPageCountBySearch($keyword)
	{
		$data = $this->conn->fetchAssoc("SELECT count(*) as count FROM fx_page WHERE title LIKE '%$keyword%' OR title_key LIKE '%$keyword%' OR meta_title LIKE '%$keyword%' OR meta_keywords LIKE '%$keyword%' or meta_description LIKE '%keyword%'");
		return $data;
	}

	public function getPageBySection($section_id)
	{
		$data = $this->conn->fetchAll("SELECT * FROM fx_page WHERE fx_section_id = ?", array($section_id));
		return $data;
	}
}