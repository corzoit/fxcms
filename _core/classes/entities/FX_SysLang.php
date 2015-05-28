<?php

class FX_SysLang extends FX_BasicCRUD{

	private $conn;

	public function __construct(){
		$this->conn = FX_DBConnection::getConnection();
		parent::__construct();
		$this->setTableInfo("fxsyslang", "fxsyslang_id");
	}

	public function __destruct(){}
	
	public function createLangRecords($table_name, $pk)
	{
		//select a los registros de fxsyslang y en base a eso crear en la tabla
	}

	public function getAllLanguage()
	{
		$all_language = array();
		/* Query :: 2015 - 04 -21
			$data = $this->conn->fetchAll("SELECT * FROM
		  	fxsys s INNER JOIN fxsyslang sl ");
		*/
		$data = $this->conn->fetchAll("SELECT * FROM fxsys s INNER JOIN fxsyslang sl on sl.fxsys_id = s.fxsys_id WHERE s.status = 1"); // Update Mario
		
		foreach ($data as $key => $value) 
		{			
			array_push($all_language, $value['lang']);
		}
		
		return $all_language;
	}
}