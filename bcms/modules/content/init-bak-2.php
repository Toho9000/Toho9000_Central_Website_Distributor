<?
	//echo"xxx";
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
	
	if(!defined("TOTALPAGENAME")){
		define('RESET',true);
		$log->general("-Content Loading->",1);
		$TotalPageName=$PArr[0];
		define('TOTALPAGENAME',$TotalPageName);
	}
	//echo"--65---------------------------------------------------------------------------\n";
	
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
	//echo"--70---------------------------------------------------------------------------\n";
	
	if(isset($domain_user_data)>0){
		if(count($domain_user_data)>0){
			$sql="SELECT * FROM content_pages WHERE module_viewsID='25' AND domainsID=".$domain_data['id']." AND languagesID=".$_SESSION['LanguagesID']." LIMIT 0,1";
			$rslt=$r->RawQuery($sql);
			if($r->NumRows($rslt)>0){
				$csearch=false;
				$notfound=false;
				if(!defined("PAGENAME")){
					define('PAGENAME',$TotalPageName);
				}
				
				$content_data["db"]=$r->Fetch_Assoc($rslt);	
				
				$sql="SELECT * FROM mod_business_categories WHERE id=".$domain_user_data['mod_business_categoriesID'];
			
				$rslt=$r->RawQuery($sql);
				$bizcat_data=$r->Fetch_Assoc(rslt);	
				
				$content_data["db"]['Meta_Title']=$domain_user_data["db"]['name']." - ".$bizcat_data["db"]['CategoryTitle']." - ".$content_data["db"]['Meta_Title'];
			}
		}
	}

	//$sql="SELECT * FROM content_pages WHERE URI='".$OriginalPageName."' AND domainsID=0 AND languagesID=".$_SESSION['LanguagesID']." LIMIT 0,1";
	$sql="SELECT * FROM content_pages WHERE URI='".$OriginalPageName."' AND domainsID=0 AND languagesID=".$_SESSION['LanguagesID']."";
	//print $sql;
	$rslt=$r->RawQuery($sql);
	if($r->NumRows($rslt)>0){
		
		define('PAGENAME',$OriginalPageName);
		$content_data["db"]=$r->Fetch_Assoc($rslt);
		$notfound=false;
		$csearch=false;
	}

	$log->general("-Content Search-",1);
	$csearch=true;
	$segment=0;// times we go around
	while($csearch){
		//echo"--76---------------------------------------------------------------------------\n";
	
		$log->general("-Content Round-",1);
		
		//echo"--7701--------------------------------------------------------------------------\n".var_export($domain_data,true);
		$sql_multi="SELECT * FROM content_pages WHERE domainsID=0";
		//echo"--771---------------------------------------------------------------------------\n";
		$log->general("dd-Content sql-".$sql_multi,1);

		$sql="SELECT * FROM content_pages WHERE domainsID=".$domain_data['id']."";
		//echo"--771---------------------------------------------------------------------------\n";
		$log->general("dd-Content sql-".$sql,1);
		$sql_home="SELECT * FROM content_pages WHERE HomePage='Yes' AND domainsID=".$domain_data['id']." ";
		//$sql_languages=" AND languagesID=".$domain_data['LanguagesID'];
		//echo"--77---------------------------------------------------------------------------\n";
		$sql_languages="";
		$exposure="";
		$sql_uri=" AND URI='/'";
		$sql_uri_page=" AND URI='".$TotalPageName."'";
		$sql_limit=" LIMIT 0,1";
		$log->general("-Content sql-",1);
		//echo"--77111---------------------------------------------------------------------------\n";
		
		//echo"--80--------------------------------------------------------------------".$sql_run."-------\n";
		$log->general("-Content segment-".$segment,1);
		if($segment==0){
			$sql_run=$sql.$sql_languages.$sql_uri_page.$exposure.$sql_limit;
			$log->general("-Content Seg 0 Search-".$sql_run,1);
		}elseif($segment==1){
			$sql_run=$sql_home.$sql_languages.$sql_uri_page.$exposure.$sql_limit;
			$log->general("-Content Seg 1 Search-".$sql_run,1);
		}elseif($segment==2){
			$sql_run=$sql_multi.$sql_languages.$sql_uri_page.$exposure.$sql_limit;
			$log->general("-Content Seg 1 Search-".$sql_run,1);
		}
		$log->general("-Content Run Search-".$sql_run,1);
		//print $sql_run."\n";
		//echo"--85--------------------------------------------------------------------".$sql_run."-------\n";
	
		$rslt=$r->RawQuery($sql_run);
		$nrows=$r->NumRows($rslt);
		if($nrows>0){
			$csearch=false;
			$content_data["db"]=$r->Fetch_Assoc($rslt);	
			//echo"--85--------------------------------------------------------------------".$sql_run."----".$nrows."---\n";
		}else{
			if($TotalPageName=="/"){
				$csearch=false; // put 404 for domain
				$segment=1;
				if($segment==1) $segment++;
			}else{
				$TArr=explode('/',$TotalPageName);
				$VariableArray[]=$TArr[count($TArr)-2];
				$TotalPageName="";
				for($x=0;$x<(count($TArr)-2);$x++){
					$TotalPageName.=$TArr[$x]."/";
				}
				$csearch=true;
			}	
		};
		
		if(!$csearch){
			if(!defined("PAGENAME")){
				define('PAGENAME',$TotalPageName);
			}
			$content_data["PAGENAME"]=$TotalPageName;
		}
	};
	
	
	$log->general("Content Found Page Search->",1);
	if(!isset($content_data["db"])){
		throw new Exception('No Content Data Loaded.');
	}elseif(count($content_data["db"])==0){
		throw new Exception('No Content Data Loaded.');
	}
	if(!defined("TEMPLATESID")){
		define('TEMPLATESID',$content_data["db"]['templatesID']);
		define('PAGESID',$content_data["db"]['id']);
		define('MODULEVIEWSID',$content_data["db"]['module_viewsID']);
	}
	//echo"--8501----------------------------------------------------".$sql_run."----------------".var_export($content_data,true)."-------\n";
	//$sql="SELECT Dir,Pre_FileName,FileName FROM modules,module_views WHERE modules.id=module_views.modulesID AND module_views.id=".MODULEVIEWSID;
	if($content_data["db"]['module_viewsID']>0){
		$sql="SELECT Dir,Pre_FileName,FileName FROM modules,module_views WHERE modules.id=module_views.modulesID AND module_views.id=".$content_data["db"]['module_viewsID'];
		//print $sql;
		//echo"--8511--------------------------------------------------------------------".$sql."-------\n";
		
		$log->general("Module Load ->".$sql,1);
		
		$rslt=$r->RawQuery($sql);
		//echo"--8512--------------------------------------------------------------------".var_export($rslt,true)."-------\n";
	}else{
		$rslt=false;
	}
	//echo"--8513--------------------------------------------------------------------".var_export($rslt,true)."-------\n";
	if(!$rslt){
		//echo"--95--------------------------------------------------------------------".$sql_run."-------\n";
		$log->general("Nothing Found Module Load ->",1);
		//header("Location: /");
		exit("404");
	}else{
		//echo"--8514--------------------------------------------------------------------".var_export($rslt,true)."-------\n";
		$nrows=$r->NumRows();
		//echo"--8514--------------------------------------------------------------------".$nrows."-------\n";
		if($nrows>0){
			$module_data["db"]=$r->Fetch_Assoc($rslt);
			//$log->general("New Module Found 1->".var_dump($module_data,true),1);
			$log->general("New Module Found 2->".var_export($module_data,true),1);
			//echo"--196--------------------------------------------------------------------".var_export($module_data,true)."-------\n";
			if($module_data["db"]['Pre_FileName']!=""){
				$log->general("New Module Found 3->".var_export($app_data,true),1);
				if(isset($app_data['MODULEBASEDIR'])&&(isset($module_data["db"]['Dir']))&&(isset($module_data["db"]['Pre_FileName']))){
					$module_file_name=$app_data['MODULEBASEDIR'].$module_data["db"]['Dir']."/".$module_data["db"]['Pre_FileName'];
					$log->general("New Module Include 1->".$module_file_name,1);
					
					if(file_exists($module_file_name)){
						include($module_file_name);
					}else{
						throw new Exception('Pre Content not loading.');
					}
				}else{
					//echo"--206--------------------------------------------------------------------".$module_file_name."-------\n";
				}
				
			}
		}else{
			$log->general("No Content Found->",3);
		}
		
		//echo"--120--------------------------------------------------------------------".$sql_run."-------\n";
	
		$log->general("Pre Module File Included->",3);
		// check for member session
		$log->general("\n",1);
		$log->general("\n",1);
		//$log->general("-0 Bounce User From Member Only Page->".$_SESSION['membersID']."--".$content_data['Exposure']."-".var_dump($content_data,true),3);
		$log->general("-Check Bounce User From Member Only Page->",3);
		$log->general("\n",1);
		$log->general("\n",1);
		
		$log->general("-3 New End Content init->".var_export($content_data,true),3);
		// get side bar data if set
		$sidebar_data=array();
		$log->general("-4 New End Content init->".var_export($content_data,true),3);
		/*
		if(isset($content_data['sidebar_module_viewsID'])){
			if($content_data['sidebar_module_viewsID']!=0){
				/*
				if(!defined("SIDEBAR")){
					define('SIDEBAR',true);
				};
				*//*
				$content_data['SIDEBAR']=true;
				$sql="SELECT Dir,Pre_FileName,FileName FROM modules,module_views WHERE modules.id=module_views.modulesID AND module_views.id=".$content_data['sidebar_module_viewsID'];
				$rslt=$r->RawQuery($sql);
				$sidebar_data=$r->Fetch_Assoc($rslt);
				//$log->general("-sidebar init->".var_dump($sidebar_data,true)."-".$sql,1);
				$log->general("-sidebar init->",1);
				if($sidebar_data['Pre_FileName']!=""){
					include($app_data['MODULEBASEDIR'].$sidebar_data['Dir']."/".$sidebar_data['Pre_FileName']);
				}
			}else{
				/*
				if(!defined("SIDEBAR")){
					define('SIDEBAR',false);
				}
				
				*//*
				$content_data['SIDEBAR']=false;
			}
		}
		*/
		$log->general("5-End Content init->",3);
	}
	//echo"--130--------------------------------------------------------------------".$sql_run."-------\n";
	
	
?>