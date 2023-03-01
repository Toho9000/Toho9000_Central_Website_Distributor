<?php
	$log->general("Loading Templates->",1);
	//echo"--888---------------------------------------------------------------------------\n";
	// page defaults to domain template
	$log->general("-Template Loading-".var_export($content_data,true),1);
	//print_r($content_data);
	//print_r($domain_data);
	
	//set sql result non capitalized
	if(isset($content_data["db"]['templatesID'])){
		$templatesID=$content_data["db"]['templatesID'];
	}else{
		$templatesID=$content_data["db"]['templatesid'];
	}
	if(isset($domain_data["db"]['templatesID'])){
		$domains_templatesID=$domain_data["db"]['templatesID'];
	}else{
		$domains_templatesID=$domain_data["db"]['templatesid'];
	}
	//if content page has a custom template then overwrite the domain template
	if($templatesID==0){
		$Current_Template=$domains_templatesID;
	}else{
		$Current_Template=$templatesID;
	}
	$sql="SELECT * FROM templates WHERE id='".$Current_Template."'";
	//echo"--88800---------------------------------------------------------------------------\n";
	//$sql="SELECT * FROM templates WHERE id='".$template_data['id']."'";
	//print "-<>-".$sql."-<>-\n\n";
	$rslt=$r->RawQuery($sql);
	$template_data["db"]=$r->Fetch_Assoc($rslt);
	
	$template_data["db"] = strip_capitals($template_data["db"]);
	if(count($template_data["db"])==0){
		$error_message="No template found=>".$sql;
		//echo $error_message;
		$log->general($error_message,3);
	}
	//print_r($template_data);
	//$template_data['TEMPLATEPATH']=$app_data['APPBASEDIR']."templates/".$template_data['Dir'];
	/*
	if(isset($template_data["db"]['Dir'])){
		$template_dir=$template_data["db"]['Dir'];
	}else{
		$template_dir=$template_data["db"]['dir'];
	}
	*/
	/*
	if(isset($template_data['TEMPLATEPATH'])){
		$template_path=$template_data['TEMPLATEPATH'];
	}else{
		$template_dir=$template_data["db"]['dir'];
	}
	*/
	$template_data['TEMPLATEPATH']=$app_data['APPBASEDIR']."templates/".$template_data["db"]['dir'];
	$template_data['TEMPLATEDIR']=$template_data['TEMPLATEPATH'];
	//define('TEMPLATEPATH',$app_data['APPBASEDIR']."templates/".$template_data['Dir']);
	//define('TEMPLATESID',$template_data['id']);
	//print_r($template_data);
	$log->general("Loading Templates->",1);
?>