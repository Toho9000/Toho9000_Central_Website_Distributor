<?
	/*
	define('DOMAINNAME',eregi_replace("www\.","",$_SERVER['HTTP_HOST']));
	
	$rslt=$r->RawQuery("SELECT * FROM domains WHERE Name='".DOMAINNAME."'");
	$domain_data=$r->Fetch_Assoc($rslt);
	define('DOMAINSID',$domain_data['id']);
	*/
	if(isset($_GET['dcmshost'])){
		$TargetHost=$_GET['dcmshost'];
	}else{
		$TargetHost=$_SERVER['HTTP_HOST'];
	}
	
	//$TotalDomainName=preg_replace("www\.","",$TargetHost);
	$TotalDomainName=str_replace("www\.", "", $TargetHost);
	define('TOTALDOMAINNAME',$TotalDomainName);
	$DomainVariableArray=array();
	$csearch=true;
	while($csearch){
		$sql="SELECT * FROM domains WHERE Name='".$TotalDomainName."'";
		//print $sql."<br>";
		$rslt=$r->RawQuery($sql);
		if($rslt){
			if($r->NumRows($rslt)>0){
				$csearch=false;
				define('DOMAINNAME',$TotalDomainName);
				
				$domain_data["db"]=$r->Fetch_Assoc($rslt);
				//define('DOMAINSID',$domain_data['id']);
				
			}else{
				$TArr=explode('\.',$TotalDomainName);
				$DomainVariableArray[]=$TArr[0];
				$TotalDomainName="";
				for($x=1;$x<count($TArr);$x++){
					$tmp=($x!=1 ? '.':""); 
					$TotalDomainName.=$tmp.$TArr[$x];
				}
				
				//if(!preg_match("\.",$TotalDomainName)){
				if(!isset($TotalDomainName)){
					exit("Invalid Domain Name");
				}
			};
		}else{
			exit("Invalid Domain");
		}
		//print $TotalDomainName;
		//flush();
		
		
	};
	$domain_user_data=array();
	if(count($DomainVariableArray)>0){
		$DName=$DomainVariableArray[0];
		
		$sql="SELECT * FROM users WHERE subdomain='".$DName."' ";
		//print $sql;
		$rslt=$r->RawQuery($sql);
		if($r->NumRows($rslt)>0){
			$continue=true;
			while($myrow=$r->Fetch_Assoc($rslt)){
					$sql="SELECT domainsID FROM mod_business_categories WHERE id='".$myrow['mod_business_categoriesID']."'";
					$rslt2=$r->RawQuery($sql);
					$data=$r->Fetch_Array($rslt2);
					//print_r($myrow);
					//flush();
					if($data[0]==$domain_data["db"]['id']){
						$domain_user_data=$myrow;
					}
					
			}
			
			//print $domain_user_data['id'];
		}
	}
?>