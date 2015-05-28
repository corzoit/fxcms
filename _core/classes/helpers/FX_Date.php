<?php 

class FX_Date{

	private $conn;

	public function __construct(){
		$this->conn = FX_DBConnection::getConnection();
	}

	public function __destruct(){}

	public function convertToLocal($date, $date_only = false)
	{
		if($date == '0000-00-00 00:00:00' or $date == '00:00:00')
		{
			return '';
			if($date_only)
			{
				return '';
			}
		}
		else
		{
			$fxsys = $this->conn->fetchAssoc("SELECT * FROM fxsys");
			$format_to_use = $date_only ? $fxsys['d_format']:$fxsys['dt_format'];
			$date_obj = new DateTime($date, new DateTimeZone('UTC'));
			$date_obj->setTimeZone(new DateTimeZone($fxsys['timezone']));
			$local_dt = $date_obj->format($format_to_use);
			return $local_dt;	
		}
	}

	//daniel
	public function convertTzToUTC($date)
	{
		if($date)
		{
			date_default_timezone_set('UTC');
			$fxsys = $this->conn->fetchAssoc("SELECT * FROM fxsys");	
			$date = DateTime::createFromFormat($fxsys['dt_format'], $date);
			$date = $date->format('y-m-d H:i:s');
			$date = date('Y-m-d H:i:s', strtotime($date. $fxsys['timezone']));
			return $date;
		}
		else
		{
			return '0000-00-00 00:00:00';
		}
	}
	//daniel
	
	public function formatDate($date, $date_only = false)
	{
		$fxsys = $this->conn->fetchAssoc("SELECT * FROM fxsys");
		$format_to_use = $date_only ? $fxsys['d_format']:$fxsys['dt_format'];
		$date_obj = new DateTime($date);
		$local_dt = $date_obj->format($format_to_use);
		return $local_dt;
	}

}
?>