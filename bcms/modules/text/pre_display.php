<?php
	//$sql="SELECT content_text FROM mod_text WHERE content_pagesID=".PAGESID;
	$sql="SELECT content_text FROM mod_text WHERE content_pagesID=".$content_data["db"]['id'];
	//print $sql;
	$log->general("-yyy Text Display->".$sql,3);
	
	$rslt=$r->RawQuery($sql);
	$text_data["db"]=$r->Fetch_Assoc($rslt);
	//print_r($text_data);
	$log->general("-yx Text Display->".var_export($text_data["db"],true),3);
	
?>