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
				
					$sql="SELECT URI,MenuTitle,content_pages.id AS content_pagesID FROM content_pages WHERE Menu_Hide='No' AND (Exposure='Member' OR Exposure='Both')";
					$sql.=" AND languagesID=".$app_data['LANGUAGESID']." AND (domainsID=".$domain_data['db']['id']." OR domainsID=0) ORDER BY Sort_Order";
					
				}else{
					$sql="SELECT URI,MenuTitle,content_pages.id AS content_pagesID FROM content_pages WHERE Menu_Hide='No' AND (Exposure='Public' OR Exposure='Both')";
					$sql.=" AND module_viewsID IN (SELECT module_viewsID FROM module_views_menu WHERE Exposure='Public' OR Exposure='Both')";
					$sql.=" AND languagesID=".$app_data['LANGUAGESID']." AND (domainsID=".$domain_data['db']['id']." OR domainsID=0) ORDER BY Sort_Order";
				}
			}
			
			//print $sql."\n";
			$log->general("8 Loading New Current Menu->".$sql,3);
			$rslt=$r->RawQuery($sql);
			while($data=$r->Fetch_Assoc()){
				$log->general("9 Menu output->".var_export($data,true),3);
				if(!$first){
					?> | <?php
				}else{
					$first=false;
				}
				//echo'<a href="http://'.$domain_data['db']['Name'].$data[0].'"><span>'.$data[1].'</span></a>';
				//print_r($data);
				$menu_data["db"][]=$data;
				//print_r($content_data);
				
				//if($content_data["content_pagesID"]>0){
					//print_r($domain_data);
				if($domain_data["db"]["SEOFriendly"]=="No"){
					//print $sql."\n";
					/*
					?><a id="link-item-id"  class="link-item-cl" href="http://<?php print $domain_data["db"]['Name'].$app_data['ROOTDIR']."index.php?cpid=".$data["content_pagesID"];?>"><?php print $data["MenuTitle"];?></a><?php
					
					echo"-1-|--";
					print_r($domain_data);
					echo"-2-|--";
					print_r($app_data);
					echo"-3-|--";
					print_r($data);
					echo"-4-|--";
					*/
					$link_data='<a id="link-item-id"  class="link-item-cl" href="http://'.$domain_data["db"]['Name'].$app_data['ROOTDIR'].'index.php?cpid='.$data["content_pagesID"].'">'.$data["MenuTitle"].'</a>';
					/*
					?><a id="link-item-id"  class="link-item-cl" href="http://<?php print $domain_data["db"]['Name'].$app_data['ROOTDIR']."index.php?cpid=".$data["content_pagesID"];?>"><?php print $data["MenuTitle"];?></a><?php
					*/
					print $link_data;
				}else{
					?><a id="link-item-id"  class="link-item-cl" href="http://<?php print $domain_data["db"]['Name'].$data["URI"];?>"><?php print $data["MenuTitle"];?></a><?php
				}
				
			}
		}else{
			?><a href="http://<? print $domain_data['db']['Name']; ?>"><span>Directory Home</span></a><?php	
		}
	}
	
?>