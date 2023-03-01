<?php
	//echo"xxx";
	//echo"0xxx-----------------------------------------------------------------------------\n";
	//echo"--7334---------------------------------------------------------------------------\n";
	// if pre set
	//---------------------------------------------------------------
	if(isset($content_domain_data["db"])){
		if(count($content_domain_data["db"])>0){
			$content_data["db"]=$content_domain_data["db"];
		}
	}
	
	
	//---------------------------------------------------------------
	//echo"--5555---------------------------------------------------------------------------\n";
	$log->general("-Content init Start->",1);
	if(!isset($_SESSION['membersID'])) $_SESSION['membersID']=0;
	$original_page=$_SERVER['REQUEST_URI'];
	$content_data["original_uri"]=$original_page;
	//echo"--5555444332211---------------------------------------------------------------------------\n";
	
	if(isset($_GET['dcmsuri'])){
		//echo"--555544433-----------------------|-".$_GET['dcmsuri']."-|--------------------------------------------------\n";
		//echo"--555544433-----------------------|-0-|--------------------------------------------------\n";
		
		if($_GET['dcmsuri']){
			$PArr=explode("\?",$_GET['dcmsuri']);
		}else{
			$PArr=explode("\?",$original_page);
		}
		
	}else{
		//echo"--55554443321-----------------------|-".$original_page."-|--------------------------------------------------\n";
		$PArr=explode("\?",$original_page);
	}
	
	//echo"--65555----------------------------------".$_GET['cpid']."-----------------------------------------\n";
	//echo"--6555533399---------------------------------------------------------------------------\n";
	$content_data["URI"]="";
	//if($domain_data["db"]["SEOFriendly"]=="No"){
		if(isset($_GET['cpid'])){
			//echo"--dddd------------------".$_GET['cpid']."---------------------------------------------------------\n";
			$content_data["content_pagesID"]=$_GET['cpid'];
			
			$sql="SELECT DISTINCT URI FROM content_pages WHERE id=".$content_data["content_pagesID"]." LIMIT 0,1";
			//$sql="SELECT * FROM content_pages";
			$rslt=$r->RawQuery($sql);
			$content_data_uri=$r->Fetch_Assoc();
			//echo"--gggg------------------------".var_export($content_data_uri,true)."---------------------------------------------------\n";	
			//print_r($content_data_uri);
			$content_data["URI"]=$content_data_uri['URI'];
			$content_data["uri"]=$content_data["URI"];

			//echo"--000000---------------------------------------------------------------------------\n";
		}else{
			$content_data["content_pagesID"]=0;
		}
		
	//}else{
		//$content_data["content_pagesID"]=0;
	//}
	//echo"--656565---------------------------------------------------------------------------\n";
	//print_r($domain_data);
			//print_r($content_data);
			//echo"--656565---------------------------------------------------------------------------\n";
	$content_data["uri_split_array"]=$PArr;
	if(!defined("TOTALPAGENAME")){
		define('RESET',true);
		$log->general("-Content Loading->",1);
		$TotalPageName=$PArr[0];
		define('TOTALPAGENAME',$TotalPageName);
		$content_data["TOTALPAGENAME"]=$TotalPageName;
	}
	//echo"--65-----------------------|-".var_export($content_data,true)."-|--------------------------------------------------\n";
	//print_r($content_data);
	/*
	if($domain_data["db"]["SEOFriendly"]=="Yes"){
		$content_data["URI"]=$content_data["TOTALPAGENAME"];
		
	}else{
		$sql="SELECT URI FROM content_pages WHERE id=".$content_data["content_pagesID"]." LIMIT 0,1";
		$rslt=$r->RawQuery($sql);
		$content_data_uri=$r->Fetch_Assoc($rslt);	
		$content_data["URI"]=$content_data_uri['URI'];
	}
	*/
	//echo"--654321----------".$sql."--------------".var_export($content_data,true)."------------------".var_export($content_data_uri,true)."---------------------------------\n";

	$OriginalPageName=$TotalPageName;
	if(substr($TotalPageName,strlen($TotalPageName)-1)!="/"){
		$TotalPageName.="/";
	}
	$VariableArray=array();
	$csearch=true;
	$notfound=true;
	//$content_data=array();
	//$bizcat_data=array();
	$csearch=true;
	$segment=0;// times we go around
	$log->general("-Content Biz Cats-",1);
	//echo"--70---------------------------------------------------------------------------\n";
	//if(isset($content_domain_data["db"])){
		//echo"--72---------------------------------------------------------------------------\n";
		//if(count($content_domain_data["db"])==0){
			if(isset($domain_user_data)>0){
				if(count($domain_user_data)>0){
					
					$sql="SELECT * FROM content_pages WHERE module_viewsID='25' AND domainsID=".$domain_data['id']." AND languagesID=".$_SESSION['LanguagesID']." LIMIT 0,1";
					$rslt=$r->RawQuery($sql);
					if($r->NumRows($rslt)>0){
						$csearch=false;
						$notfound=false;
						if(!defined("PAGENAME")){
							define('PAGENAME',$TotalPageName);
							$content_data["PAGENAME"]=$TotalPageName;
						}
						
						$content_data["db"]=$r->Fetch_Assoc($rslt);	
						
						$sql="SELECT * FROM mod_business_categories WHERE id=".$domain_user_data['mod_business_categoriesID'];
					
						$rslt=$r->RawQuery($sql);
						$bizcat_data["db"]=$r->Fetch_Assoc(rslt);	
						
						$content_data['Meta_Title']=$domain_user_data['name']." - ".$bizcat_data['CategoryTitle']." - ".$content_data['Meta_Title'];
					}
				}
			}
			//echo"--66---------------------------------------------------------------------------\n";
			//print_r($domain_data);
			//print_r($content_data);
			//print "-|-".$domain_data["db"]["SEOFriendly"]."-|-";
			if($domain_data["db"]["SEOFriendly"]=="No"){
				if($content_data["content_pagesID"]>0){
					$sql="SELECT * FROM content_pages WHERE id='".$content_data["content_pagesID"]."' LIMIT 0,1";
				}else{
					$sql="SELECT * FROM content_pages WHERE HomePage='Yes' LIMIT 0,1";
				}
			}elseif($domain_data["db"]["SEOFriendly"]=="Yes"){
				//print_r($content_data["URI"]);
				//$sql="SELECT DISTINCT * FROM content_pages WHERE URI='".$content_data["URI"]."'  LIMIT 0,1";
				$sql="SELECT DISTINCT * FROM content_pages WHERE URI='".$content_data["URI"]."'";
				
			}
			//$sql="SELECT * FROM content_pages WHERE URI='".$OriginalPageName."' AND domainsID=0 AND languagesID=".$_SESSION['LanguagesID']." LIMIT 0,1";
			//print "-i-|-".$sql."--|-";
			$rslt=$r->RawQuery($sql);
			$content_data['db']=$r->Fetch_Assoc($rslt);
			$num_rows=$r->NumRows($rslt);
			/*
			if($r->NumRows($rslt)>0){
				
				define('PAGENAME',$OriginalPageName);
				$content_data['PAGENAME']=$OriginalPageName;
				$content_data['db']=$r->Fetch_Assoc($rslt);
				$content_data["content_pagesID"]=$content_data['db']['id'];
				$notfound=false;
				$csearch=false;
			}*/

			$log->general("-Content Search-",1);
			
			//echo"--67---------y-|-".$csearch."-|------------|--".var_export($content_data,true)."-|-----------------------------------------------end--\n";
			while($csearch){
				//echo"--67yy------|-".$TotalPageName."-|-------------------------------------------------------------------\n";
				//$sql="SELECT * FROM content_pages WHERE URI='".$TotalPageName."' AND domainsID=".$domain_data['db']['id']." AND languagesID=".$_SESSION['LanguagesID']." LIMIT 0,1";
				$sql="SELECT * FROM content_pages WHERE URI='".$TotalPageName."' AND domainsID=".$domain_data['db']['id']." AND languagesID=".$_SESSION['LanguagesID']."";
				//$sql="SELECT * FROM content_pages WHERE 
				//print_r($domain_data);
				//URI='".$TotalPageName."' AND domainsID=".DOMAINSID." AND languagesID=".$_SESSION['LanguagesID']." LIMIT 0,1";
				//$sql="='".$TotalPageName."' AND domainsID=".$domain_data["db"]["id"]." AND languagesID=".$_SESSION['LanguagesID']." LIMIT 0,1";
				//$domain_user_data['name']
				//echo"--6701------|-".$sql."-|-------------------------------------------------------------------\n";
				
				//echo"--672-------".$sql."--------------------------------------------------------------------\n";
				$rslt=$r->RawQuery($sql);
				$num_rows=$r->NumRows($rslt);
				//echo"--67211-------".$sql."------".$num_rows."--------------------------------------------------------------\n";
				if($num_rows>0){
					$csearch=false;
					$notfound=false;
					define('PAGENAME',$TotalPageName);
					$content_data['PAGENAME']=$OriginalPageName;
					$content_data['db']=$r->Fetch_Assoc($rslt);	
					
				}else{
					//print $TotalPageName;
					$TArr=explode('/',$TotalPageName);
					$VariableArray[]=$TArr[count($TArr)-2];
					$TotalPageName="";
					for($x=0;$x<(count($TArr)-2);$x++){
						$TotalPageName.=$TArr[$x]."/";
					}
					if($TotalPageName=="/"){
						$csearch=false;
						$content_data['PAGENAME']=$OriginalPageName;
						define('PAGENAME',TOTALPAGENAME);
					}else{
						$csearch=true;
					}
				};
			};
			//print_r($content_data);
			//68-------".$sql."-----[".$notfound."]---------------------------------------------------------------\n";
			if($notfound){
						
				//$sql="SELECT * FROM content_pages WHERE URI='".$content_data['PAGENAME']."' AND domainsID=".$domain_data["db"]['id']." LIMIT 0,1";
				$sql="SELECT * FROM content_pages WHERE URI='".$content_data['PAGENAME']."' AND domainsID=".$domain_data["db"]['id']."";
				$rslt=$r->RawQuery($sql);
				//69111-------".$sql."--------------------------------------------------------------------\n";
				////echo"--691---------------------------------------------------------------------------\n";
				if($r->NumRows($rslt)==0){// cant find page so load homepage for language/site
					////echo"--692---------------------------------------------------------------------------\n";
					//print_r($content_data);
					if($content_data["original_uri"]=="/"){
						// on homepage
						$sql="SELECT * FROM content_pages WHERE HomePage='Yes' AND languagesID=".$_SESSION['LanguagesID']." AND domainsID=".$domain_dat["db"]['id'];
					}else{
						// when no page has been created
						$sql="SELECT * FROM content_pages WHERE  module_viewsID='801'";
					}
					
					//print $sql;
					$rslt=$r->RawQuery($sql);
					$content_data['db']=$r->Fetch_Assoc($rslt);
				}else{ //found page but not right language
					////echo"--693---------------------------------------------------------------------------\n";
					$content_data['db']=$r->Fetch_Assoc($rslt);
					$_SESSION['LanguagesID']=$content_data['languagesID'];
				};
			};
			//echo"--69---------------------------------------------------------------------------\n";
			//define('LANGUAGESID',$_SESSION['LanguagesID']);
			/*
			define('TEMPLATESID',$content_data['templatesID']);
			define('PAGESID',$content_data['id']);
			define('MODULEVIEWSID',$content_data['module_viewsID']);
			*/
			//$sql="SELECT Dir,Pre_FileName,FileName FROM modules,module_views WHERE modules.id=module_views.modulesID AND module_views.id=".$content_data['module_viewsID'];
			
		//}
	//}else{
	//	//echo"--7221---------------------------------------------------------------------------\n";
	//}
	//echo"--691100-------".$sql."--------------------------------------------------------------------\n";		
	//print_r($content_data);
	
	$content_data["db"] = strip_capitals($content_data["db"]);
	/*
	if(isset($content_data['db']['module_viewsID'])){
		$module_viewsID=$content_data["db"]['module_viewsID'];
	}else{
		$module_viewsID=$content_data["db"]['module_viewsid'];
	}
	*/
	
	$content_data["db"] = strip_capitals($content_data["db"]);
	$sql="SELECT * FROM modules,module_views WHERE modules.id=module_views.modulesID AND module_views.id=".$content_data['db']['module_viewsid'];
	//$sql="SELECT * FROM modules,module_views WHERE modules.id=module_views.modulesID AND module_views.id=".$module_viewsID;
	//echo"--6911-------".$sql."--------------------------------------------------------------------\n";		
		//$sql="SELECT * FROM modules AS Modules,module_views AS Module_Vies WHERE modules.id=module_views.modulesID AND module_views.id=".$content_data['module_viewsID'];
		//print $sql;
		$rslt=$r->RawQuery($sql);
		$num_rows=$r->NumRows($rslt);
		//echo"--67211-------".$sql."------".$num_rows."--------------------------------------------------------------\n";
		if($num_rows==0){
			header("Location: /");
		}else{
			$module_data["db"]=$r->Fetch_Assoc($rslt);
			$module_data["db"] = strip_capitals($module_data["db"]);
			//print_r($module_data);
			//if($module_data["db"]['Pre_FileName']!=""){
				$pre_file=$module_data["db"]['pre_filename'];
			if($pre_file!=""){
				$lfile=$app_data['MODULEBASEDIR'].$module_data["db"]['Dir']."/".$pre_file;
				print $lfile;
				if (file_exists($lfile)) {
					include($lfile);
				}else{

					echo"error";
				}
			}
			// check for member session
			if(!isset($_SESSION['membersID'])&&($content_data['Exposure']=="Member")){
				header("Location: /");
			}
			//echo"--705551-------------------------------------------------------------------------\n";
			// get side bar data if set
			/*
			if(isset($content_data['sidebar_module_viewsID'])){
				if($content_data['sidebar_module_viewsID']!=0){
					define('SIDEBAR',true);
					$sql="SELECT Dir,Pre_FileName,FileName FROM modules,module_views WHERE modules.id=module_views.modulesID AND module_views.id=".$content_data['sidebar_module_viewsID'];
					$rslt=$r->RawQuery($sql);
					$sidebar_data["db"]=$r->Fetch_Assoc($rslt);
					if($sidebar_data["db"]['Pre_FileName']!=""){
						include(MODULEBASEDIR.$sidebar_data["db"]['Dir']."/".$sidebar_data["db"]['Pre_FileName']);
					}
				}else{
					define('SIDEBAR',false);
				}
			}
			*/
		}
	//print_r($content_data);
	//else{
		//echo"--7066---------------------------------------------------------------------------\n";
	//}
	$content_data["content_pagesid"]=$content_data["content_pagesID"];
	$log->general("-End Content init->",1);
	
?>