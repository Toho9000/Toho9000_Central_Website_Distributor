<?php

	//include("includes/start-of-header-functions.php");
	ini_set( 'display_errors', '1' );
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
	//--------------------------------------------------
	$current_dir=pathinfo(__DIR__);
	$app_data['current_dir']=$current_dir;
	//----------------------------------------------------------------
	$app_data['APPBASEDIR']='./';
	$app_data['APPLICATIONSDIR']='/apps';
	$app_data['MODULEBASEDIR']=$app_data['APPBASEDIR'].'modules/';
	$app_data['CLASSESBASEDIR']=$app_data['APPBASEDIR'].'classes/';
	$app_data['INCLUDESBASEDIR']=$app_data['APPBASEDIR'].'includes/';
	//----------------------------------------------------------------
	$filepath=$app_data['CLASSESBASEDIR']."clsLogger.php";
	include_once($filepath);
	$log = new clsLog();


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
	$r=new clsDatabaseInterface($log);
	$r->Set_Log($log);
	$r->CreateDB();
	
	$sql="SELECT * FROM domains WHERE Name='".$_SERVER['HTTP_HOST']."'";
	//print $sql;
	$rslt=$r->RawQuery($sql);
	$num_rows=$r->NumRows($rslt);
	if($num_rows>0){
		$domain_data["db"]=$r->Fetch_Assoc();
		if($domain_data["db"]['mirrorID']>0){
			$sql="SELECT * FROM domains WHERE id='".$domain_data["db"]['mirrorID']."'";
			$rslt=$r->RawQuery($sql);
			$num_rows=$r->NumRows($rslt);
			if($num_rows>0){
				$domain_data["db"]=$r->Fetch_Assoc();
			}
		}
	}
	//print_r($domain_data);

	$page_array=array();
	$sql="SELECT * FROM content_pages WHERE domainsID=".$domain_data["db"]['id'];
	//print $sql;
	$rslt=$r->RawQuery($sql);
	$num_rows=$r->NumRows($rslt);
	if($num_rows>0){
		while($content_data["db"]=$r->Fetch_Assoc()){
			$page_array[]=$content_data["db"];
		};
	}

	
	$sql="SELECT * FROM content_pages WHERE domainsID=0";
	//print $sql;
	$rslt=$r->RawQuery($sql);
	$num_rows=$r->NumRows($rslt);
	if($num_rows>0){
		while($content_data["db"]=$r->Fetch_Assoc()){
			$page_array[]=$content_data["db"];
		};
	}

	//print_r($page_array);

	foreach($page_array as $key=>$val){

	
		//print_r($val);
		$link="<a href='".$val['URI']."'>".$val['URI']." - ".$val['Title']."</a><br>";
		echo $link;
	}
?>