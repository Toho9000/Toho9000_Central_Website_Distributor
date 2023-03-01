<?php
	/*
	include(MODULEBASEDIR."/menu/template_maker.php");
	if(count($domain_user_data)==0){
		$item_template='<a href="%a"><span>%b</span></a>';
		//$normal_item=sprintf($item_template,$href,$link_text);
		$directory_home='<a href="http://'.DOMAINNAME.'"><span>Directory Home</span></a>';
		$spacer=' | ';
		$start_tag='<ul class="list-menu" id="list-menu-id">';
		$end_tag='/ul>';
	}else{
		print $directory_home=;
	}
	$link_count=0
	foreach($item_array as $key=>$val){
		if($link_count!=0){
			print $spacer;
		}
		$normal_item=sprintf($item_template,$val[0],$val[1]);
		print $normal_item;
		$link_count++;
	}
	*/

	$log->general("7 Loading Current Menu->",3);
	$first=true;
	if(isset($domain_user_data)){
		if(count($domain_user_data)==0){
			if(isset($_SESSION['membersID'])){
				if($_SESSION['membersID']>0){
				
					$sql="SELECT URI,MenuTitle FROM content_pages WHERE Menu_Hide='No' AND (Exposure='Member' OR Exposure='Both')";
					$sql.=" AND languagesID=".$app_data['LANGUAGESID']." AND (domainsID=".$domain_data['id']." OR domainsID=0) ORDER BY Sort_Order";
					
				}else{
					$sql="SELECT URI,MenuTitle FROM content_pages WHERE Menu_Hide='No' AND (Exposure='Public' OR Exposure='Both')";
					$sql.=" AND module_viewsID IN (SELECT module_viewsID FROM module_views_menu WHERE Exposure='Public' OR Exposure='Both')";
					$sql.=" AND languagesID=".$app_data['LANGUAGESID']." AND (domainsID=".$domain_data['id']." OR domainsID=0) ORDER BY Sort_Order";
				}
			}
			
			//print $sql."\n";
			$log->general("8 Loading New Current Menu->".$sql,3);
			$rslt=$r->RawQuery($sql);
			while($data=$r->Fetch_Array($rslt)){
				$log->general("9 Menu output->".var_export($data,true),3);
				if(!$first){
					?> | <?
				}else{
					$first=false;
				}
				echo'<a href="http://'.$domain_data['Name'].$data[0].'"><span>'.$data[1].'</span></a>';
			}
		}else{
			?><a href="http://<? print $domain_data['Name']; ?>"><span>Directory Home</span></a><?	
		}
	}
	
?>