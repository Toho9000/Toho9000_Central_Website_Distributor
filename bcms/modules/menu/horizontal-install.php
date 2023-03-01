<?php
	$first=true;
	//if(count($domain_user_data)==0){
		/*
		if(isset($_SESSION['membersID'])){
			if($_SESSION['membersID']){
				$sql="SELECT URI,MenuTitle FROM content_pages WHERE Menu_Hide='No' AND (Exposure='Member' OR Exposure='Both') AND languagesID=".LANGUAGESID." AND (domainsID=".$domain_data['id']." OR domainsID=0) ORDER BY Sort_Order";
			}else{
				$sql="SELECT URI,MenuTitle FROM content_pages WHERE Menu_Hide='No' AND (Exposure='Public' OR Exposure='Both') AND module_viewsID IN (SELECT module_viewsID FROM module_views_menu WHERE Exposure='Public' OR Exposure='Both') AND languagesID=".LANGUAGESID." AND (domainsID=".DOMAINSID." OR domainsID=0) ORDER BY Sort_Order";
			}
		}else{
			$sql="SELECT URI,MenuTitle FROM content_pages WHERE Menu_Hide='No' AND (Exposure='Public' OR Exposure='Both') AND module_viewsID IN (SELECT module_viewsID FROM module_views_menu WHERE Exposure='Public' OR Exposure='Both') AND languagesID=".LANGUAGESID." AND (domainsID=".DOMAINSID." OR domainsID=0) ORDER BY Sort_Order";
		}*/
		if($_SESSION['membersID']>0){
			
			$sql="SELECT URI,MenuTitle FROM content_pages WHERE Menu_Hide='No' AND (Exposure='Member' OR Exposure='Both')";
			$sql.=" AND languagesID=".$app_data['LANGUAGESID']." AND (domainsID=".$domain_data['id']." OR domainsID=0) ORDER BY Sort_Order";
			
		}else{
			$sql="SELECT URI,MenuTitle FROM content_pages WHERE Menu_Hide='No' AND (Exposure='Public' OR Exposure='Both')";
			$sql.=" AND module_viewsID IN (SELECT module_viewsID FROM module_views_menu WHERE Exposure='Public' OR Exposure='Both')";
			$sql.=" AND languagesID=".$app_data['LANGUAGESID']." AND (domainsID=".$domain_data['id']." OR domainsID=0) ORDER BY Sort_Order";
		}
		//print $sql."\n";	
		$rslt=$r->RawQuery($sql);
		while($data=$r->Fetch_Array($rslt)){
			if(!$first){
				?> | <?
			}else{
				$first=false;
			}
			?><a href="/install.php?uri=<?php print urlencode($data[0]);?>"><?php print $data[1];?></a><?
		}
		//print $sql."\n";
		/*
	}else{
		?><a href="http://<? print $domain_data['Name']; ?>/index.php?uri=<?php print urlencode("/");?>">Directory Home</a><?	
	}
	*/

?>