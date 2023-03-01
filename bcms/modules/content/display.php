<?php
	$log->general("-ab Text Display->",3);


	//echo"--600---------------------------------------------------------------------------\n";
	/*
	global $module_data;
	global $domain_user_data;
	global $r;
	*/
	//print_r($app_data);
	//print_r($module_data);
	$module_template_display=$app_data['MODULEBASEDIR'].$module_data["db"]['dir']."/".$module_data["db"]['filename'];
	//print $module_template_display;
	if(file_exists($module_template_display)){
		//echo"--621---------------------------------------------------------------------------\n";
		//$module_template_display=$app_data['MODULEBASEDIR'].$module_data["db"]['Dir']."/".$module_data["db"]['FileName'];
		//print $module_template_display;
		$log->general("-ar Text Display->".$module_template_display."-".var_export($module_data,true),3);
		//echo"--601---------------------------------------------------------------------------\n";
		/*
		if(file_exists($module_template_display)){
			include($module_template_display);
		}else{
			throw new Exception('Main Content not loading.');
		}
		*/
		include($module_template_display);
		//echo"--602---------------------------------------------------------------------------\n";
	}else{
		//echo var_export($app_data,true)."==".var_export($module_data,true);
		////echo"--603---------------------------------------------------------------------------\n";
	}
	//echo"--699---------------------------------------------------------------------------\n";
	
?>