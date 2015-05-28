<?php

class FX_BasicCRUD{

	private $conn;
	
	protected $tbl_name;
	protected $tbl_pk;

	public function __construct(){
		$this->conn = FX_DBConnection::getConnection();
	}

	public function __destruct(){}

	public function setTableInfo($tname, $tpk)
	{
		$this->tbl_name = $tname;
		$this->tbl_pk = $tpk;
	}

	public function getAll(){ 
		return $this->conn->fetchAll("SELECT * FROM `".$this->tbl_name."`");
	}

	public function getById($id){
		return $this->conn->fetchAssoc("SELECT * FROM `".$this->tbl_name."` WHERE `".$this->tbl_pk."` = ?", 
			array($id));
	}

	public function getByFilter($filter = array(), $order = "", $limit = false)
	{
		$where_sql = "";
		$limit_sql = "";
		$order_sql = "";
		$where_arr = array();

		if(is_array($filter) && count($filter) > 0)
		{
			$where_sql .= " WHERE ";

			$fe_counter = 0;
			foreach($filter as $field => $value)
			{
				if($fe_counter > 0)
				{
					$where_sql .= " AND ";
				}

				$where_sql .= " `".$field."` = ? ";
				array_push($where_arr, $value);

				$fe_counter++;
			}
		}

		if($order)
		{
			$order_sql = " ORDER BY ".$order." DESC ";
		}

		if($limit == '' OR $limit > 1)
		{
			$limit_sql = '';
			if($limit > 1)
			{
				$limit_sql = " LIMIT ".$limit;
			}
			$res = $this->conn->fetchAll("SELECT * FROM `".$this->tbl_name."` ".$where_sql.$order_sql.$limit_sql, 
			$where_arr);
			if(is_array($res) and !array_key_exists(0, $res))
			{
				$res = array($res);	
				//print_r($res);
				if($res[0] == array())
				{
					$res = false;
				}
			}
		}
		else
		{
			$res = $this->conn->fetchAssoc("SELECT * FROM `".$this->tbl_name."` ".$where_sql.$order_sql, $where_arr);
		}
		return $res;
	}

	public function insert($data)
	{
		$this->conn->insert($this->tbl_name, $data);
		return $this->conn->lastInsertId();
	}

	public function update($data, $id)
	{
		$this->conn->update($this->tbl_name, $data, array($this->tbl_pk => $id));
		return true;
	}

	public function updateByFilfer($data, $filter = array())
	{
		$this->conn->update($this->tbl_name, $data, $filter);
		return true;
	}

	public function delete($id)
	{
		$this->conn->delete($this->tbl_name, array($this->tbl_pk => $id));
		return true;
	}

	public function deleteByFilfer($filter = array())
	{
		$this->conn->delete($this->tbl_name, $filter);
		return true;
	}	
}
