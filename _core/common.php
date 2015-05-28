<?php
	$fxsys = new FX_Sys();
	$fx_sys_id = $_SESSION['fx_sys_id'] != null ? $_SESSION['fx_sys_id']: 1; // 1 == default first configuration ::: table fx_sys
	$fxsys_data = $fxsys->getSysById($fx_sys_id);
	
	define("LANG_SYS", $fxsys_data['lang_sys']);
	define("LANG_MAIN", $fxsys_data['lang_main']);
