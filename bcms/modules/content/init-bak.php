<?
	
	$log->general("-Content init Start->",1);
	if(!isset($_SESSION['membersID'])) $_SESSION['membersID']=0;
	if(isset($_GET['dcmsuri'])){
		if($_GET['dcmsuri']){
			$PArr=explode("\?",$_GET['dcmsuri']);
		}else{
			$PArr=explode("\?",$_SERVER['REQUEST_URI']);
		}
	}else{
		$PArr=explode("\?",$_SERVER['REQUEST_URI']);
	}
	
	$log->general("-Content Loading->",1);
	$TotalPageName=$PArr[0];
	define('TOTALPAGENAME',$TotalPageName);
	
	$OriginalPageName=$TotalPageName;
	if(substr($TotalPageName,strlen($TotalPageName)-1)!="/"){
		$TotalPageName.="/";
	}
	$VariableArray=array();
	$csearch=true;
	$notfound=true;
	$content_data=array();
	$bizcat_data=array();
	$log->general("-Content Biz Cats-",1);
	if(isset($domain_user_data)>0){
		if(count($domain_user_data)>0){
			$sql="SELECT * FROM content_pages WHERE module_viewsID='25' AND domainsID=".DOMAINSID." AND languagesID=".$_SESSION['LanguagesID']." LIMIT 0,1";
			//print $sql;
			//print_r($domain_user_data);
			//exit();
			$rslt=$r->RawQuery($sql);
			if($r->NumRows($rslt)>0){
				$csearch=false;
				$notfound=false;
				define('PAGENAME',$TotalPageName);
				$content_data["db"]=$r->Fetch_Assoc($rslt);	
				
				$sql="SELECT * FROM mod_business_categories WHERE id=".$domain_user_data['mod_business_categoriesID'];
			//print $sql;
				$rslt=$r->RawQuery($sql);
				$bizcat_data=$r->Fetch_Assoc(rslt);	
				
				$content_data['Meta_Title']=$domain_user_data['name']." - ".$bizcat_data['CategoryTitle']." - ".$content_data['Meta_Title'];
			}
		}
	}
	

	/*
	if($_SESSION['membersID']>0){
		$sql="SELECT * FROM content_pages WHERE URI='".$OriginalPageName."' AND (domainsID=0 OR domainsID=".DOMAINSID.")";
		$sql.=" AND languagesID=".$_SESSION['LanguagesID']." AND (Exposure='Member' OR Exposure='Both') LIMIT 0,1";
	
	}else{
		$sql="SELECT * FROM content_pages WHERE URI='".$OriginalPageName."' AND (domainsID=0 OR domainsID=".DOMAINSID.")";
		$sql.=" AND languagesID=".$_SESSION['LanguagesID']." AND (Exposure='Public' OR Exposure='Both') LIMIT 0,1";
	
	}
	*/
	

	//print $sql;
	/*
	$log->general("0 Page Search->".$sql,1);
	$rslt=$r->RawQuery($sql);
	if($r->NumRows($rslt)>0){
		
		$content_data=$r->Fetch_Assoc($rslt);
		$log->general("9 Page Found Search-> / |".$content_data['Exposure']."|".$_SESSION['membersID'],3);
		if(($_SESSION['membersID']==0)&&($content_data['Exposure']=="Member")){

			$sql_run=$sql.$sql_languages.$sql_uri.$exposure.$sql_limit;
			//$sql="SELECT * FROM content_pages WHERE URI='/' AND (domainsID=0 OR domainsID=".DOMAINSID.")";
			//$sql.=" AND (Exposure='Public' OR Exposure='Both') AND languagesID=".$_SESSION['LanguagesID']." LIMIT 0,1";
			$log->general("Page Search-> / |".$sql_run,3);
			$rslt=$r->RawQuery($sql);
			if($r->NumRows($rslt)>0){
				$content_data=$r->Fetch_Assoc($rslt);
				define('PAGENAME',"/");
			}
		}else{
			define('PAGENAME',$OriginalPageName);
		}
		$notfound=false;
		$csearch=false;
	}
	*/
	$csearch=true;
	//$notfound=true;
	$segment=0;
	while($csearch){
		
		/*
		if($r->NumRows($rslt)==0){
			if($_SESSION['membersID']>0){
				$sql="SELECT * FROM content_pages WHERE URI='".PAGENAME."' AND (domainsID=".DOMAINSID." OR domainsID=0)";
				$sql.=" AND (Exposure='Member' OR Exposure='Both') LIMIT 0,1";
			}else{
				$sql="SELECT * FROM content_pages WHERE URI='".PAGENAME."'  AND (domainsID=".DOMAINSID." OR domainsID=0)";
				$sql.=" AND (Exposure='Public' OR Exposure='Both') LIMIT 0,1";
			}
			$rslt=$r->RawQuery($sql);
			if($r->NumRows($rslt)=0){
				$sql="SELECT * FROM content_pages WHERE HomePage='Yes' AND languagesID=".$_SESSION['LanguagesID'];
				$sql.=" AND (domainsID=".DOMAINSID." OR domainsID=0)";
			}
		}
		*/
		


		$sql="SELECT * FROM content_pages WHERE (domainsID=".$domain_data['id']." OR domainsID=0)";
		$sql_home="SELECT * FROM content_pages WHERE HomePage='Yes' AND (domainsID=".$domain_data['id']." OR domainsID=0)";
		$sql_languages=" AND languagesID=".$_SESSION['LanguagesID'];
		$sql_uri="AND URI='/'";
		$sql_uri_page="AND URI='".$TotalPageName."'";
		$sql_limit=" LIMIT 0,1";
		if($_SESSION['membersID']>0){
			$exposure=" AND (Exposure='Member' OR Exposure='Both')";
		}else{
			$exposure=" AND (Exposure='Public' OR Exposure='Both')";
		}
		if($segment==0){
			$sql_run=$sql.$sql_languages.$sql_uri_page.$exposure.$sql_limit;
		}elseif($segment==1){
			$sql_run=$sql_home.$sql_languages.$sql_uri_page.$exposure.$sql_limit;
		}
		/*
		if(($TotalPageName=="/")&&($segment==0)){
			$rslt=$r->RawQuery($sql);
			if($r->NumRows($rslt)>0){
				
			}else{
				$segment=1;
			}
		}else{
			
		}
		*/
		$rslt=$r->RawQuery($sql_run);
		if($r->NumRows($rslt)>0){
			$csearch=false;
			//$notfound=false;
			//define('PAGENAME',$TotalPageName);
			$content_data["db"]=$r->Fetch_Assoc($rslt);	
		
		}else{
			if($TotalPageName=="/"){
				$csearch=false; // put 404 for domain
				$segment=1;
			}else{
				$TArr=explode('/',$TotalPageName);
				$VariableArray[]=$TArr[count($TArr)-2];
				$TotalPageName="";
				for($x=0;$x<(count($TArr)-2);$x++){
					$TotalPageName.=$TArr[$x]."/";
				}
				$csearch=true;
			}
			/*	
			if(!$csearch){
				define('PAGENAME',$TotalPageName);
			}
			*/		
		};
		/*
		if(($_SESSION['membersID']==0)&&($content_data['Exposure']=="Member")){
			$log->general("-5 Do Bounce User From Member Only Page->".$_SESSION['membersID']."|".$content_data['Exposure'],3);
			//header("Location: /");
			$TotalPageName="/";
			$csearch=true;
		}
		*/
		if(!$csearch){
			define('PAGENAME',$TotalPageName);
		}
	};
	
	/*
	if($notfound){
		//$log->general("Page Not Found->".$notfound."-".var_dump($content_data),1);
		$log->general("Page Not Found->".$notfound."-",1);
		if($_SESSION['membersID']>0){
			$sql="SELECT * FROM content_pages WHERE URI='".PAGENAME."' AND (domainsID=".DOMAINSID." OR domainsID=0)";
			$sql.=" AND (Exposure='Member' OR Exposure='Both') LIMIT 0,1";
		}else{
			$sql="SELECT * FROM content_pages WHERE URI='".PAGENAME."'  AND (domainsID=".DOMAINSID." OR domainsID=0)";
			$sql.=" AND (Exposure='Public' OR Exposure='Both') LIMIT 0,1";
		}
		$rslt=$r->RawQuery($sql);
		if($r->NumRows($rslt)==0){// cant find page so load homepage for language/site
			$sql="SELECT * FROM content_pages WHERE HomePage='Yes' AND languagesID=".$_SESSION['LanguagesID'];
			$sql.=" AND (domainsID=".DOMAINSID." OR domainsID=0)";
			$rslt=$r->RawQuery($sql);
			$content_data=$r->Fetch_Assoc($rslt);
		}else{ //found page but not right language
			$content_data=$r->Fetch_Assoc($rslt);
			$_SESSION['LanguagesID']=$content_data['languagesID'];
		};
	};
	*/
	//define('LANGUAGESID',$_SESSION['LanguagesID']);
	//$log->general("Content Found Page Search->".var_dump($content_data,true),1);
	$log->general("Content Found Page Search->",1);
	if(!isset($content_data)){
		throw new Exception('No Content Data Loaded.');
	}elseif(count($content_data)==0){
		throw new Exception('No Content Data Loaded.');
	}
	define('TEMPLATESID',$content_data['templatesID']);
	define('PAGESID',$content_data['id']);
	define('MODULEVIEWSID',$content_data['module_viewsID']);
	$sql="SELECT Dir,Pre_FileName,FileName FROM modules,module_views WHERE modules.id=module_views.modulesID AND module_views.id=".MODULEVIEWSID;
	//print $sql;
	$log->general("Module Load ->".$sql,1);
	
	$rslt=$r->RawQuery($sql);
	if(!$rslt){
		
		$log->general("Nothing Found Module Load ->",1);
		header("Location: /");
	}else{
		
		$module_data=$r->Fetch_Assoc($rslt);
		//$log->general("New Module Found 1->".var_dump($module_data,true),1);
		$log->general("New Module Found 1->",1);
		if($module_data['Pre_FileName']!=""){
			$module_file_name=$app_data['MODULEBASEDIR'].$module_data['Dir']."/".$module_data['Pre_FileName'];
			$log->general("New Module Include 1->".$module_file_name,1);
			include($module_file_name);
		}
		$log->general("Pre Module File Included->",3);
		// check for member session
		$log->general("\n",1);
		$log->general("\n",1);
		//$log->general("-0 Bounce User From Member Only Page->".$_SESSION['membersID']."--".$content_data['Exposure']."-".var_dump($content_data,true),3);
		$log->general("-Check Bounce User From Member Only Page->",3);
		$log->general("\n",1);
		$log->general("\n",1);
		//$log->general("-1 Bounce User From Member Next->".$_SESSION['membersID']."--".$content_data['Exposure']."-".var_dump($content_data,true),3);
		/*	
		if(($_SESSION['membersID']==0)&&($content_data['Exposure']=="Member")){
			$log->general("-Do Bounce User From Member Only Page->".$_SESSION['membersID']."|".$content_data['Exposure'],3);
			header("Location: /");
		}
		*/
		//$log->general("-3 New End Content init->".var_dump($content_data,true),1);
		$log->general("-3 New End Content init->",1);
		// get side bar data if set
		
		if(isset($content_data['sidebar_module_viewsID'])){
			if($content_data['sidebar_module_viewsID']!=0){
				define('SIDEBAR',true);
				$sql="SELECT Dir,Pre_FileName,FileName FROM modules,module_views WHERE modules.id=module_views.modulesID AND module_views.id=".$content_data['sidebar_module_viewsID'];
				$rslt=$r->RawQuery($sql);
				$sidebar_data=$r->Fetch_Assoc($rslt);
				//$log->general("-sidebar init->".var_dump($sidebar_data,true)."-".$sql,1);
				$log->general("-sidebar init->",1);
				if($sidebar_data['Pre_FileName']!=""){
					include($app_data['MODULEBASEDIR'].$sidebar_data['Dir']."/".$sidebar_data['Pre_FileName']);
				}
			}else{
				define('SIDEBAR',false);
			}
		}
	}
	
	$log->general("-End Content init->",1);
?>