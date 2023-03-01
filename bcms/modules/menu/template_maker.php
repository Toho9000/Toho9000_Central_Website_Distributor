<?php
	$first=true;
	$is_member=false;
    $member_page=false;
    $item_array=array();
	if(isset($domain_user_data)){
        if(count($domain_user_data)>0){
            $member_page=true;
        }
    }
    if(!$member_page){
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
		}
	}else{
        $data[0]=DOMAINNAME;
        $data[0]="Directory Home";
        $item_array[]=$data;
	}

?>