<?php
	
	class FX_DateTime
	{
	    public static function getMktime($date, $y=0, $m=0, $d=0, $h=0, $i=0, $s=0)
	    {
	        if (strlen($date) == 10)
	        {
	            $date_obj = mktime(0, 0, 0, substr($date, 5, 2)+$m, substr($date, 8, 2)+$d, substr($date, 0, 4)+$y);
	            return $date_obj;
	        }
	        else if (strlen($date) == 19)
	        {
	            $date_obj = mktime(substr($date, 11, 2)+$h, substr($date, 14, 2)+$i, substr($date, 17, 2)+$s,
	                substr($date, 5, 2)+$m, substr($date, 8, 2)+$d, substr($date, 0, 4)+$y);
	            return $date_obj;
	        }
	        else
	        {
	            return null;
	        }
	    }
	}