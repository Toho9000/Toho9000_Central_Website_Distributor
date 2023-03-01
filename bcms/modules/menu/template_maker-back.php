<?
	$first=true;
	$is_member=false;
    $item_array=array();
	if(count($domain_user_data)==0){
		if(isset($_SESSION['membersID'])){
			if($_SESSION['membersID']>0){
				$is_member=true;
				
			}else{
				$is_member=false;
			}
			
		}else{
			$is_member=false;
		}
		if($is_member){
			$sql="SELECT URI,MenuTitle FROM content_pages WHERE Menu_Hide='No' AND (Exposure='Member' OR Exposure='Both') AND languagesID=".LANGUAGESID." AND (domainsID=".$domain_data['id']." OR domainsID=0) ORDER BY Sort_Order";
		}else{
			$sql="SELECT URI,MenuTitle FROM content_pages WHERE Menu_Hide='No' AND (Exposure='Public' OR Exposure='Both') AND module_viewsID IN (SELECT module_viewsID FROM module_views_menu WHERE Exposure='Public' OR Exposure='Both') AND languagesID=".LANGUAGESID." AND (domainsID=".$domain_data['id']." OR domainsID=0) ORDER BY Sort_Order";
		}
       
		$rslt=$r->RawQuery($sql);
		while($data=$r->Fetch_Array($rslt)){
			$item_array[]=$data;
            /*
            if(!$first){
				?> | <?
			}else{
				$first=false;
			}
			?><a href="<?php print $data[0];?>"><span><?php print $data[1];?></span></a><?
            */
		}
	}else{
        $data[0]=DOMAINNAME;
        $data[0]="Directory Home";
        $item_array[]=$data;
		/*
        ?><a href="http://<? print DOMAINNAME; ?>"><span>Directory Home</span></a><?	
        */
	}

?>