<?
	//if(SIDEBAR){
		if(count($sidebar_data)>0){
			include($app_data['MODULEBASEDIR'].$sidebar_data['Dir']."/".$sidebar_data['FileName']);
		}
		
	//}

?>