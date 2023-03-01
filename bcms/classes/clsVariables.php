<?php 

class clsVariables
{

	var $guid="";
	var $domainsID=0;
	public $var_save=array();
	var $total_list=array();
	var $SessionCode="";
	var $DBFile="db-local.php";
	var $default_db="bubblelite2";
	var $siteuserclientID=0;
	var $Refresh_Time=0;
	var $m;
	var $r;
	var $links;
	var $rslt;
	var $location_data;
	public $log="";
		
	function __construct(){
		//exit("00");
		/*
		$this->m = new ConnectDbase();
		$this->links = $this->m->Connect($this->DBFile);
		if($this->links->connect_error) {
			die("Connection failed: " . $this->links->connect_error);
		}
		*/
		//$this->r = new ReturnRecord($this->DBFile);
		

		
		//$this->AddAllVariables();
		/*
		$this->Set_Database(DOMAINSID,$this->guid);
		*/
	}

	function make_guid ($length=32) 
	{ 
		if (function_exists('com_create_guid') === true)
        {
                return trim(com_create_guid(), '{}');
        }else{
            $key="";    
            $minlength=$length;
			$maxlength=$length;
			$charset = "abcdefghijklmnopqrstuvwxyz"; 
			$charset .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ"; 
			$charset .= "0123456789"; 
			if ($minlength > $maxlength) $length = mt_rand ($maxlength, $minlength); 
			else                         $length = mt_rand ($minlength, $maxlength); 
			for ($i=0; $i<$length; $i++) $key .= $charset[(mt_rand(0,(strlen($charset)-1)))]; 
			return $key;
        }	
	}

	public function Look_GUID(){
		$this->log->general("Start Look GUID".$this->guid,1);
		if($this->guid==""){
			$guid=$this->GetGUIDFromDB($_SERVER['REMOTE_ADDR'],$_SERVER['HTTP_HOST']);	
			$this->log->general("GUID From DB=".$guid,1);
			if($guid==""){
				$guid=$this->SetGUID($this->make_guid());
				$this->log->general("Make GUID".$guid,1);
			}
		}
		$this->guid=$guid;
		$this->log->general("Set Look GUID->".$this->guid,1);
		$this->log->general("\n",1);
		return $this->guid;
	}
	
	public function AddAllVariables(){
		$this->log->general("Add All Vars",1);
		/*
		$gvr=array();
		if(count($this->var_save)==0){
			//$gvr=$this->GetVarsFromDB($this->guid);
			if(count($gvr)>0){
				$this->var_save=$gvr;
			}
		}
		*/
		//$this->var_save['GLOBALS']=$GLOBALS;
		$this->var_save['SERVER']=$_SERVER;
		
		$this->var_save['GET']=$_GET;
		$this->var_save['POST']=$_POST;
		$this->var_save['FILES']=$_FILES;
		$this->var_save['COOKIE']=$_COOKIE;
		//$this->var_save['SESSION']=$_SESSION;
		$this->var_save['REQUEST']=$_REQUEST;
		$this->var_save['ENV']=$_ENV;
		$this->var_save['clsVars']['guid']=$this->guid;
		$this->total_list=$this->var_save;
		//print_r($this->var_save);
		$this->log->general("Add All Vars->".var_export($this->var_save,true),3);
	}

	
	public function AddReturnRecord(&$r){
		$this->r = $r;
	}

	public function AddVariables($var_type,$var_name,$var_val){
		$this->var_save[$var_type][$var_name]=$var_val;
	}
	
	public function AddByRefVariables($var_type,$var_name,&$var_val){
		$this->var_save[$var_type][$var_name]=$var_val;
	}

	
	public function UnpackSessionCode($SessCode){
		$SessVars=explode($SessCode,'`-`');
		$clientIP=$SessVars[0];
		$domainID=$SessVars[1];
		$guid=$SessVars[2];
		$sc=array($clientIP,$domainID,$guid);
		/*
		if(isset($this->var_save['clsVars']['SessionCode'])) $sc=$this->var_save['clsVars']['SessionCode'];
		else $sc=base64_encode($clientIP.'`-`'.$domainID.'`-`'.$this->GetGUID());
		if($sc!=""){
			$this->var_save['clsVars']['SessionCode']=$sc;
		}else{
			$sc=false;
		}
		*/
		return $sc;
	}

	public function GetSessionCode($clientIP,$domainID){
		$sc="";
		if(isset($this->var_save['clsVars']['SessionCode'])) $sc=$this->var_save['clsVars']['SessionCode'];
		else $sc=base64_encode($clientIP.'`-`'.$domainID.'`-`'.$this->GetGUID());
		if($sc!=""){
			$this->var_save['clsVars']['SessionCode']=$sc;
		}else{
			$sc=false;
		}
		$this->SessionCode=$sc;
		return $sc;
	}

	public function GetVariables($var_type=false,$var_name=false){
	/*	
	if(isset($this->var_save[$var_type][$var_name])){
			return $this->var_save[$var_type][$var_name];
		}else{
			return false;
		}
		*/
		$ret_val=false;	
		if(($var_type)&&($var_name)){
			if(isset($this->var_save[$var_type][$var_name])){
				$ret_val=$this->var_save[$var_type][$var_name];
			}else{
				$ret_val="";
			}
		}elseif(($var_type)&&(!$var_name)){
			if(isset($this->var_save[$var_type])){
				$ret_val=$this->var_save[$var_type];
			}else{
				$ret_val="";
			}
		}else{
			if(isset($this->var_save)){
				$ret_val=$this->var_save;
			}else{
				$ret_val="";
			}
		}
		return $ret_val;
	}
	
	public function SetVariables($var_type=false,$var_name=false,$var_value=false){
	/*	
	if(isset($this->var_save[$var_type][$var_name])){
			return $this->var_save[$var_type][$var_name];
		}else{
			return false;
		}
		*/
		$ret_val=false;	
		if(($var_type)&&($var_name)&&($var_value)){
			$this->var_save[$var_type][$var_name]=$var_value;
		}elseif(($var_type)&&($var_name)&&(!$var_value)){
			$ret_val=$this->var_save[$var_type][$var_name];
		}elseif(($var_type)&&(!$var_name)){
			$ret_val=$this->var_save[$var_type];
		}else{
			$ret_val=$this->var_save;
		}
		return $ret_val;
	}
	
	public function gv($var_type=false,$var_name=false,$var_value=false){
		$ret_val=false;	
		if(($var_type)&&($var_name)&&($var_value)){
			$this->SetVariables($var_type,$var_name,$var_value);
		}elseif(($var_type)&&($var_name)){
			$ret_val=$this->GetVariables($var_type,$var_name);
		}elseif(($var_type)&&(!$var_name)){
			$ret_val=$this->GetVariables($var_type);
		}else{
			$ret_val=$this->GetVariables();
		}
		return $ret_val;
	}

	
	public function SetGUID($guid){
		$this->guid=$guid;
		return $this->guid;

	}
	
	function Set_Log(&$log){
		$this->log=$log;
		$this->log->general('Boot Success: $r->');
				
	}

	
	public function GetGUID(){
		if($this->guid==""){
			$ra=$this->gv('SERVER','REMOTE_ADDR');
			$hh=$this->gv('SERVER','HTTP_HOST');
			if($ra&&$hh){
				$tguid=$this->GetGUIDFromDB($ra,$hh);
			}
			
		}else{
			$tguid=$this->guid;
		}
		$this->var_save['clsVars']['guid']=$tguid;
		return $tguid;
	}
	
	public function GetGUIDFromDB($clientIP=false,$domainName=false){
		$this->log->general("Get GUID From DB-> ".$clientIP."->".$domainName,1);
		if(!$clientIP) $clientIP=$this->gv('SERVER','REMOTE_ADDR');
		if(!$domainName) $domainName=$this->gv('SERVER','HTTP_HOST');
		$timenow = date('H:i:s', time());	
		//$query="SELECT guid FROM siteuserclient,site_variables WHERE TO_DAYS(TIMEDIFF(siteuserclient.timenow,'".$timenow."'))<1 AND domains.id=siteuserclient.domainsID AND siteuserclient.id=site_variables.siteuserclient_id LEFT JOIN ON (var_type='SERVER' AND var_name='".$clientIP."' AND domains.Name='".$domainName."')";	
		$query="SELECT guid,MINUTE(siteuserclient.timenow)-MINUTE(NOW()) AS TD,domains.id,siteuserclient.id FROM domains,siteuserclient LEFT JOIN site_variables ON (siteuserclient.id=site_variables.siteuserclient_id)";
		$query.=" WHERE domains.id=siteuserclient.domainsID AND domains.Name='".$domainName."'";
		$query.=" AND ((var_type='SERVER' AND var_name='REMOTE_ADDR' AND var_value='".$clientIP."') OR (var_type='SERVER' AND var_name='HTTP_HOST' AND var_value='".$domainName."'))";
		$query.=" AND domains.Name='".$domainName."' LIMIT 0,1;";
		
		//print $query ;
		try{
			$this->rslt=$this->r->rawQuery($query);
			$this->log->general("GUID query-> ".$query,1);
			//$this->log->general('GUID Success: $rslt->'.var_export($this->rslt,true));
			if(isset($this->rslt)){
				$this->log->general("\n",1);
				$nrows=$this->r->NumRows();
				$this->log->general("Rows-> ".$nrows."-",1);
				
				if($nrows>0){
					//print("exit-data");
					$this->log->general("Get GUID From DB after query-> ".$query,1);
					while($data=$this->r->Fetch_Array()){
						$guid=$data[0];
						$Refresh_Time=$data[1];
						$domainsID=$data[2];	
						$siteuserclientID=$data[3];
						$this->log->general('Data Success: $data->'.var_export($data,true));
					}
				}else{
					$guid="";
					$Refresh_Time=0;
					$domainsID=$this->GetDomainsID($domainName);	
					$siteuserclientID=0;
				}
				
				/*
				if($data[1]>600){
					$this->siteuserclientID=$this->Set_Database($data[2],$data[0]);
				}
				*/
			}else{
				$guid="";
				$Refresh_Time=0;
				$domainsID=$this->GetDomainsID($domainName);	
				$siteuserclientID=0;
			}
			$this->guid=$guid;
			$this->Refresh_Time=$Refresh_Time;
			$this->domainsID=$domainsID;	
			$this->siteuserclientID=$siteuserclientID;

			return $this->guid;
		}catch(mysqli_sql_exception $e){
			$this->log->general("MySQL Exception->".var_export($e,true)." ".$query);
		}
	}

	
	public function GetVarsFromDB($guid){
		$vars=array();
		$timenow = date('H:i:s', time());	
		//$query="SELECT site_variables.var_type,site_variables.var_name,site_variables.var_value,site_variables_big.var_value FROM site_variables,siteuserclient LEFT JOIN ON(siteuserclient.id=site_variables_big.siteuserclient_id) WHERE guid='".$guid."' AND siteuserclient.id=site_variables.siteuserclient_id)";	
		$query="SELECT guid,MINUTE(NOW())-MINUTE(siteuserclient.timenow) AS TD,var_type,var_name,var_value FROM domains,siteuserclient LEFT JOIN site_variables ON (siteuserclient.id=site_variables.siteuserclient_id)";
		$query.=" WHERE domains.id=siteuserclient.domainsID AND guid='".$guid."';";
		//print $query ;
		$this->rslt=$this->r->rawQuery($query);
		while($myrow=$this->r->Fetch_Array($this->rslt)){
			$vars[$myrow[2]][$myrow[3]]=$myrow[4];	
			/*if($myrow[3]!=""){
				$vars[$myrow[2]][$myrow[3]]=$myrow[4];
			}else{
				$vars[$myrow[2]][$myrow[3]]=base64_decode($myrow[4]);
			};
			*/
		}
		
		return $vars;
	}
	
	public function GetDomainsID($domainName){
		$vars=array();
		$domainsID=0;
		$this->domainsID=0;
		$timenow = date('H:i:s', time());	
		//$query="SELECT site_variables.var_type,site_variables.var_name,site_variables.var_value,site_variables_big.var_value FROM site_variables,siteuserclient LEFT JOIN ON(siteuserclient.id=site_variables_big.siteuserclient_id) WHERE guid='".$guid."' AND siteuserclient.id=site_variables.siteuserclient_id)";	
		$query="SELECT domains.id FROM domains WHERE domains.Name='".$domainName."'";
		//print $query ;
		try{
			$this->rslt=$this->r->rawQuery($query);
			$this->log->general('DomainsID Success: $rslt->'.var_export($this->rslt,true));
			if(isset($this->rslt)){
				if($this->r->NumRows()>0){
					$data=$this->r->Fetch_Array();
					$domainsID=$data[0];
					$this->log->general('Data Success: $data->'.var_export($data,true));
				}else{
					$domainsID=0;	
					$this->log->general('Data Failure: ->');
				}
				
				/*
				if($data[1]>600){
					$this->siteuserclientID=$this->Set_Database($data[2],$data[0]);
				}
				*/
			}else{
				$this->log->general('rslt-error: ');
				//$this->guid=$this->make_guid();
			}
			$this->domainsID=$domainsID;

			return $domainsID;
		}catch(mysqli_sql_exception $e){
			$this->log->general("domainsID MySQL Exception->".var_export($e,true)." ".$query);
			return false;
		}
	}

	public function Convert_IP($IPaddr){
		if ($IPaddr == "")
		{
			return 0;
		} else {
			$ips = explode(".", $IPaddr);
			return ($ips[3] + $ips[2] * 256 + $ips[1] * 256 * 256 + $ips[0] * 256 * 256 * 256);
		}
	}
	
	public function Get_Country($IPaddr){
		/*
		$this->log->general("Get_Location vs->");
		$long_ip=$this->Convert_IP($IPaddr);
		$query="SELECT * FROM ip2location WHERE start_range<".$long_ip." AND end_range>".$long_ip;
		$this->log->general("Set Location Database->".$query,3);
		
		$this->r->rawQuery($query);
		if($this->r->NumRows()>0){
			$this->location_data=$this->r->Fetch_Assoc();
		
		}else{
			$this->location_data=array();
		}
		return $this->location_data;
		*/
	}

	public function Set_Database($domainsID=false,$guid=false){
		
		//$this->log->general("Set_Database vs->");
		//$this->log->general($this->var_save);
		/* ====================================================================-
		if(!$guid) $guid=$this->guid;
		if(!$domainsID) $domainsID=$this->domainsID;
		$ip_address=$this->gv('SERVER','REMOTE_ADDR');
		$user_agent=$this->gv('SERVER','HTTP_USER_AGENT');
		$HTTP_SEC_CH_UA=$this->gv('SERVER','HTTP_SEC_CH_UA');
		$HTTP_SEC_CH_UA_MOBILE=$this->gv('SERVER','HTTP_SEC_CH_UA_MOBILE');
		$HTTP_SEC_CH_UA_PLATFORM=$this->gv('SERVER','HTTP_SEC_CH_UA_PLATFORM');
		$UNIQUE_ID=$this->gv('SERVER','UNIQUE_ID');

		$loc_data=$this->Get_Country($ip_address);

		$this->log->general("\n\n Set_Database Vars vs->".$guid." | ".$domainsID." | ".$ip_address." | ".$user_agent." \n\n");
		$query="INSERT INTO siteuserclient (timenow, guid, domainsID,ip,user_agent,HTTP_SEC_CH_UA,HTTP_SEC_CH_UA_MOBILE";
		$query.=",HTTP_SEC_CH_UA_PLATFORM,UNIQUE_ID)";
		$query.=" VALUES (NOW(), '".$guid."', '".$domainsID."','".$ip_address."','".$user_agent."'";	
		$query.=",'".$HTTP_SEC_CH_UA."','".$HTTP_SEC_CH_UA_MOBILE."','".$HTTP_SEC_CH_UA_PLATFORM."','".$UNIQUE_ID."')";
		$this->log->general("Set Variables Database->".$query);
		
		$this->r->rawQuery($query);
		$siteuserclientID=$this->r->Insert_Id();
		$this->siteuserclientID=$siteuserclientID;
		//=============================================================
		*/
		/*
		foreach($this->total_list as $super_key=>$val_keys){
			foreach($val_keys as $var_key=>$var_val){
				if(strlen($var_val)<255){
					$query="INSERT INTO `site_variables` (`siteuserclient_id`, `var_type`, `var_name`, `var_value`) VALUES ('".$siteuserclientID."', '".$super_key."', '".$var_key."', '".$var_val."');";	
					$this->r->rawQuery($query);
				}else{
					$query="INSERT INTO `site_variables_big` (`siteuserclient_id`, `var_type`, `var_name`, `var_value`) VALUES ('".$siteuserclientID."', '".$super_key."', '".$var_key."', '".base64_encode($var_val)."');";	
					$this->r->rawQuery($query);
				}

			}

		}
		return $siteuserclientID;
		*/
	}

	/*
	public function Get_Vars_Database($REMOTE_ADDR,$REMOTE_HOST){
	$timenow = date('H:i:s', time());	
	$query="SELECT siteuserclient.id,guid,var_type, var_name, var_value FROM siteuserclient,site_variables,domains WHERE TO_DAYS(TIMEDIFF(siteuserclient.timenow,'".$timenow."))<1 AND 'domains.id=siteuserclient.domainsID AND siteuserclient.id=site_variables.siteuserclient_id LEFT JOIN ON (var_type='SERVER' AND var_name='"."$REMOTE_ADDR.""' AND domains.Name='REMOTE_HOST')";	
		print $query ;
		//$r->rawQuery($query);
		//$siteuserclientID=$r->Insert_Id();
		/*
		foreach($this->total_list as $super_key=>$val_keys){
			foreach($val_keys as $var_key=>$var_val){
				if(strlen($var_val)<255){}
					$query="INSERT INTO `site_variables` (`siteuserclient_id`, `var_type`, `var_name`, `var_value`) VALUES ('".$siteuserclientID.""', '".$super_key.""', '".$var_key.""', '".$var_val.""');";	
					$r->rawQuery($query);
				}else{
					$query="INSERT INTO `site_variables_big` (`siteuserclient_id`, `var_type`, `var_name`, `var_value`) VALUES ('".$siteuserclientID.""', '".$super_key.""', '".$var_key.""', '".base64_encode($var_val).""');";	
					$r->rawQuery($query);
				}

			}

		}
	}*/
	

}