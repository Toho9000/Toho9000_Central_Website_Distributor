<?
	//$sql="SELECT content_text,usersID,MNType,id  FROM mod_news WHERE content_pagesID=".PAGESID;
	$sql="SELECT content_text,usersID,MNType,id  FROM mod_news WHERE content_pagesID=".$content_data['id'];
	//print $sql;
	$rslt=$r->RawQuery($sql);
	$news_data["db"]=$r->Fetch_Assoc($rslt);
?>