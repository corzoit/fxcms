<?php

class FX_Post extends FX_BasicCRUD{

	private $conn;

	public function __construct(){
		$this->conn = FX_DBConnection::getConnection();
		parent::__construct();
		$this->setTableInfo("fx_post", "fx_post_id");
	}

	public function __destruct(){}
	
	public function getPostById($fx_post_id)
	{
		$data = $this->conn->fetchAssoc("SELECT * FROM fx_post WHERE fx_post_id = ?", array($fx_post_id));
		return $data;
	}

	public function getLatestPost($limit = 5) 
	{
		$query = "  SELECT	* FROM `fx_post` p
					INNER JOIN fx_page pa ON p.fx_page_id = pa.fx_page_id					
					ORDER BY p.creation_dt DESC
					LIMIT $limit ";			
		$data = $this->conn->fetchAll($query);
		return $data;
	}

	public function getPostAll($search = "" ,$limit = 15)
	{
	
		$where = " ";	
		
		if(strlen(trim($search)))
		{			
			$where = " AND po.comments LIKE :q OR pa.title LIKE :q OR co.last_name LIKE :q OR co.first_name LIKE :q ";	
		}
		$query = "SELECT po.fx_post_id, po.creation_dt, po.comments, pa.title, CONCAT(co.last_name, ', ', co.first_name) AS name FROM fx_post po INNER JOIN fx_page pa ON po.fx_page_id = pa.fx_page_id 
					INNER JOIN fx_contact co ON po.fx_contact_id = co.fx_contact_id WHERE po.deleted = 0 ".$where." ORDER BY po.creation_dt DESC ". $limit;
		
		$params = array('q' => '%'.$search.'%');		
		
		$data = $this->conn->fetchAll($query, $params);
		return $data;
	}

	public function postCount()
	{
		$data = $this->conn->fetchColumn("SELECT count(*) AS total FROM fx_post");
		return $data;
	}

	public function updatePost($fx_post_id, $data)// Update column delete = 1 
	{
		$data = $this->conn->update("fx_post", $data ,array("fx_post_id"=>$fx_post_id));
		return $data;
	}
	
}
