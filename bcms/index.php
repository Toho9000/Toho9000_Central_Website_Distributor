<?php
	



	//echo"000-----------------------------------------------------------------------------\n";
	
	$current_domain= str_replace("www.", "",$_SERVER['HTTP_HOST']);
	$tag_match_array=array("url"=>$current_domain);
	include("includes/start-of-header-functions.php");
	ob_start("callback");
	
	//echo"0001-----------------------------------------------------------------------------\n";
	
	
	
	

	
	//ob_start("callback"); now above
	
	//----------------------------------------------------------------
	// root data types
	//----------------------------------------------------------------
	$module_data=array();
	$domain_user_data=array();
	$domain_data=array();
	$app_data=array();
	$template_data=array();
	$content_data=array();
	$text_data=array();
	$bizcat_data=array();
	$sidebar_data=array();
	$news_data=array();
	$content_domain_data=array();
	//--------------------------------------------------
	$current_dir=pathinfo(__DIR__);
	$app_data['current_dir']=$current_dir;
	//print_r($current_dir);
	//echo"0001-----------------------------------------------------------------------------\n";
	//----------------------------------static asset files------------------------------
	$app_data['asset-severs'][0]='https://assets.w-d.biz/'; // linode server
	$app_data['asset-severs'][1]='https://spaces.auseo.net/'; // digital ocean custom server
	$app_data['asset-severs'][2]='https://static-cms.nyc3.cdn.digitaloceanspaces.com/'; // digital ocean cdn server
	$app_data['asset-severs'][3]='https://static-cms.nyc3.digitaloceanspaces.com/'; //digital ocean standard server
	$app_data['asset-severs'][4]='https://assets.ownpage.club/'; //asura standard server
	$app_data['asset-severs'][5]='https://assets.hostingdiscount.club/'; //asura reseller server
	$app_data['asset-severs'][6]='https://assets.icwl.me/'; //hostgator reseller server
	$app_data['asset-severs'][7]='https://static-assets.w-d.biz/'; //cloud unlimited server
	$app_data['asset-severs'][8]='https://assets.i-n.club/'; //ionos unlimited server

	$app_data['asset-sever']=$app_data['asset-severs'][0];
	//----------------------------------------------------------------
	//if(isset($_GET['cpid'])){
	$root_array=explode('/',$_SERVER['PHP_SELF']);
	//print_r($root_array);
	if($root_array[1]=="bcms"){
		$app_data['APPBASEDIR']='./';
		$app_data['ROOTDIR']='/bcms/';
	}else{
		$app_data['APPBASEDIR']='bcms/';
		$app_data['ROOTDIR']='/';
	}
	//echo"000101-----------------------------------------------------------------------------\n";
	$app_data['APPLICATIONSDIR']=$app_data['APPBASEDIR'].'apps';
	$app_data['MODULEBASEDIR']=$app_data['APPBASEDIR'].'modules/';
	$app_data['CLASSESBASEDIR']=$app_data['APPBASEDIR'].'classes/';
	$app_data['INCLUDESBASEDIR']=$app_data['APPBASEDIR'].'includes/';
	//----------------------------------------------------------------
	//print"xx-".$current_dir['dirname'];
	//define('SERVERBASEDIR',$current_dir['dirname'].'/');
	//$app_data=array();
	
	$filepath=$app_data['CLASSESBASEDIR']."clsLogger.php";
	//print $filepath;
	//echo"00010111-----------------------------------------------------------------------------\n";
	if(file_exists($filepath)){
		include_once($filepath);
	}else{
		exit("Error");
	}
	//echo"00010122-----------------------------------------------------------------------------\n";
	$log = new clsLog();
	$log->general("-aa app_content-".var_export($app_data,true),3);
	//define('APPBASEDIR','bcms/');
	//$filepath=APPBASEDIR."classes/clsLogger.php";
	
	//echo"xx2".$filepath;
	
	$log->general("To Train ",1);
	//echo"yyd";
	//echo"010-----------------------------------------------------------------------------\n";
	try{
		
		$log->general("First Constants",1);

		$log->general("-app_content-".var_export($app_data,true),3);
		
		$log->general("Logger Loaded",1);
		//session_start();
		if(isset($_SESSION['membersID'])){
			$membersID=$_SESSION['membersID'];
		}else{
			$membersID=0;
		}
		try{
			$log->general("-app_content-".var_export($app_data,true),3);
			$db_file=$app_data['CLASSESBASEDIR']."clsDataBase.php";
			$log->general("-db_file-".$db_file,3);
			include($db_file);
			$log->general("-clsDb-Done-",3);
		}catch(Exception $e){
			$log->general("-clsDb Not Loaded-",3);
			throw new Exception('clsDb Failure.');
		}
		
		$log->general("\n",1);
		//include("classes/clsDB.php");
		$log->general("db loaded",1);
		//$log_text.="-x2cbx-";
		$log->general("-start-",1);
		
		include($app_data['CLASSESBASEDIR']."clsMail.php");
		include($app_data['CLASSESBASEDIR']."clsVariables.php");
		
		include($app_data['INCLUDESBASEDIR']."config.inc.php");
		
		include($app_data['INCLUDESBASEDIR']."functions.inc.php");


		//include("./tools/pgsql.php");
		//test_pgsql_new();
		
		$vs=new clsVariables();
		$vs->Set_Log($log);
		$log->general("-clsVariables Loaded-",1);
		
		$r=new clsDatabaseInterface($log);
		$log->general("-clsDI Started-",1);
		$log->general("\n",1);
		$r->Set_Log($log);
		
		//test_pgsql();

		//echo"0-----------------------------------------------------------------------------\n";
		$log->general('Loading Create VS $r',1);
		$r->Set_Vs($vs);
		$log->general("\n",1);
		$log->general('Loading Create DB $r',1);
		//echo"11111-----------------------------------------------------------------------------\n";
		
		$log->general("\n",1);
		$r->CreateDB();
		//$r->test_pgsql();
		//$r->Initialise();
		$log->general("\n",1);
		
		//echo"--22222---------------------------------------------------------------------------\n";
		$log->general('Loading Set Vs Database $r',1);
		//$full_address=$r->current_dir;
		$log->general("\n",1);
		//$log->general("root_dir".$full_address);
		$log->general("\n",1);
		//echo"--33333---------------------------------------------------------------------------\n";
		
		//define('SITEFULLDIR',$full_address);
		$log->general("\n",1);
		$log->general("Set Root Dir",1);
		$log->general("\n",1);
		//$vs->AddReturnRecord($r);
		$log->general("Set DB Interface GUID->",1);
		//$vs->Look_GUID();
		$log->general("Loading Classes in index.php",1);
		//echo"--44444---------------------------------------------------------------------------\n";
		
		// all constants
		
		$log->general('Loading Modules ',1);
		
		$dest_file=$app_data['MODULEBASEDIR']."domain/init.php";
		$log->general("-Domain pre Load-".$dest_file,3);
		include($dest_file);
		$log->general("-Domain fin Load-".$dest_file,3);
		//////echo"--45---------------------------------------------------------------------------\n";
		//$log->general("-Applications-".$domain_data['applicationsID'],1);
		
		$log->general("-Domain init Finished Loaded-",1);
		//echo"--512334---------------------------------------------------------------------------\n";
		
		include($app_data['MODULEBASEDIR']."language/init.php");
		$log->general("\n",1);
		$log->general("-Language Loaded-",1);
		////echo"--5-5--------------------------------------------------------------------------\n";
		include($app_data['MODULEBASEDIR']."content/init.php");
		$log->general("-123-Content Loaded",1);
		////echo"--6---------------------------------------------------------------------------\n";
		include($app_data['MODULEBASEDIR']."template/init.php");
		//echo"\n\n-7--------------------------------------------------------\n\n";
		$log->general("667-Template Loaded-",1);
		//print_r($template_data);
		include($app_data['MODULEBASEDIR']."language/definitions.php");
		$log->general("-Language Defs Loaded-",1);
		$log->general("-Define Some more Constants-",1);
		$log->general("\n",1);
		//echo"\n\n-8--------------------------------------------------------\n\n";
		$log->general("vs-AddAllVariables");
		//$vs->AddAllVariables();
		//$vs->Set_Database(DOMAINSID);$domain_data
		//$vs->Set_Database($domain_data["db"]['id']);
		//$vs->AddAllVariables();
		
		
		$log->general("-Add all variables into session class-\n\n\n",1);
		//$vs->AddByRefVariables("Classes",'log',$log);
		//$vs->AddByRefVariables("Classes",'r',$r);
		//$vs->AddByRefVariables("Classes",'vs',$vs);
		$log->general("-Loaded all Major Variables Loaded-",1);
		$log->general("\n",1);
		
		
		try{
			//echo"\n\n-9--------------------------------------------------------\n\n";
			//print_r($template_data);
			//ob_end_flush();
			$log->general("-Start line-",3);
			//$log->general("-Loaded template const",1);
			//$load_file=TEMPLATEPATH."/index.php";
			
			$template_data['My_Dir']=$app_data['APPBASEDIR']."templates/".$template_data["db"]['dir'];
			$load_file=$template_data['My_Dir']."/index.php";
			$log->general("-End line-".$load_file,3);
			//print $load_file;
			$log->general("-ar Loading Template->".$load_file,3);
			//echo"\n\n-10----".$load_file."----------------------------------------------------\n\n";
			if(file_exists($load_file)){
				include($load_file);
			}else{
				throw new Exception('Template not loading.');
			}
			//echo"\n\n-11--------------------------------------------------------\n\n";
		}catch(Exception $e){
			$log->display_all();
	
			$log->general("-After Page is Loaded-".var_export($e,true),1);
		}
		$log->general("-After Page is Loaded-",1);
		
	}catch(Exception $e){
		
	}
	ob_end_flush();
	
?>