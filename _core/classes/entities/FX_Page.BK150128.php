<?php

class FX_Page extends FX_BasicCRUD{

	private $conn;

	public function __construct(){
		$this->conn = FX_DBConnection::getConnection();
		parent::__construct();
		$this->setTableInfo("fx_page", "fx_page_id");
	}

	public function __destruct(){}
	
	public function getAllPage()
	{
		$data = $this->conn->fetchAll("SELECT * FROM fx_page");
		return $data;	
	}

	public function getPageById($fx_page_id)
	{
		$data = $this->conn->fetchAssoc("SELECT * FROM fx_page WHERE fx_page_id = ?", array($fx_page_id));
		return $data;
	}

	/*public function getPageCountBySearch($keyword)
	{
		$data = $this->conn->fetchAssoc("SELECT COUNT(*) AS count FROM fx_page WHERE deleted = 0 AND (title LIKE '%$keyword%' OR title_key LIKE '%$keyword%' OR meta_title LIKE '%$keyword%' OR meta_keywords LIKE '%$keyword%' or meta_description LIKE '%keyword%')");
		return $data;
	}*/

	public function getPageCountBySearch($keyword)
	{
		$data = $this->conn->fetchAssoc("SELECT COUNT(*) AS count FROM fx_page WHERE deleted = 0 AND (title LIKE '%$keyword%' OR title_key LIKE '%$keyword%' OR meta_title LIKE '%$keyword%' OR meta_keywords LIKE '%$keyword%' or meta_description LIKE '%$keyword%')");
		return $data;
	}

	public function getPageCountBySection($section_id)
	{
		$data = $this->conn->fetchAssoc("SELECT COUNT(*) AS count FROM fx_page WHERE fx_section_id = ? AND deleted = 0", array($section_id));
		return $data;
	}

	public function getPageByKeyword($keyword, $limit)
	{
		$data = $this->conn->fetchAll("SELECT * FROM fx_page WHERE deleted = 0 AND (title LIKE '%$keyword%' OR title_key LIKE '%$keyword%' OR meta_title LIKE '%$keyword%' OR meta_keywords LIKE '%$keyword%' or meta_description LIKE '%$keyword%') $limit");
		return $data;
	}

	public function getPageBySection($section_id, $limit)
	{
		$data = $this->conn->fetchAll("SELECT * FROM fx_page WHERE fx_section_id = $section_id AND deleted = 0 $limit");
		return $data;
	}

	public function deleteAllPageBySectionId($fx_section_id)
	{
		/*$this->conn->fetchAll("UPDATE fx_page SET deleted = 1 WHERE fx_section_id = 10");
		exit();*/
		$data_page_id = $this->conn->fetchAll("SELECT fx_page_id FROM fx_page WHERE fx_section_id = ?", array($fx_section_id));

		$data_delete = array('deleted' => 1);
		foreach ($data_page_id as $key => $value) 
		{
			$this->update($data_delete, $value['fx_page_id']);
		}	
	}

	/*
	public function insertPage($data)
	{
		$this->conn->insert('fx_page', $data);
		$new_id = $this->conn->lastInsertId();
		return $new_id;
	}
	*/
	
	public function updatePage($data, $fx_section_id)
	{
		$data = $this->conn->update('fx_page', $data, array('fx_section_id'=> $fx_section_id));
		return $data;
	}

	public function getPageByName($title, $limit = "")
	{				
		$limit = $limit == "" ? " LIMIT 0, 5 ":$limit;
		$sql = "SELECT 
					fx_page_id , title
				FROM 
					`fx_page`";
		$record = $this->conn->fetchAll($sql, array("%".$title."%"));

		//$data = array();
		foreach ($record as $key => $value) 
		{
			$record[$key]['title'] = utf8_encode($value['title']);
		}
		//var_dump($data);
		/*var_dump($data);
		exit();*/
		return $record;
	}
}