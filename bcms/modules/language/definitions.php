<?php
	
	$log->general("-Language Start-",1);
	
	$template_defs=array();
	
	//$query="SELECT Code,Definition FROM languages_definition WHERE languagesID=".LANGUAGESID." AND templatesID=".TEMPLATESID
	$query="SELECT Code,Definition FROM languages_definition WHERE languagesID=".$app_data['LANGUAGESID']." AND templatesID=".$content_data["db"]['templatesid']
	
	/*
	$rslt=$r->RawQuery($query);
	$log->general("-Language Query-".$query,1);
	while($data=$r->Fetch_Array($rslt)){
		$template_defs[$data[0]]=$data[1];
	}
	*/
?>