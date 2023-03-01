<?php
	//echo"--730001---------------------------------------------------------------------------\n";
	$sql="SELECT DISTINCT * FROM domains WHERE Name='localhost'";
	//print $sql."\n\n<br><br>999\n\n";
	$rslt=$r->RawQuery($sql);
	$row = $r->Fetch_Array();
	//$row =array();
	//print_r($row);
	//echo"--73001---------------------------------------------------------------------------\n";
	$log->general("-Domain Module Loading-",1);
	//echo"--73---------------------------------------------------------------------------\n";
	//$current_domain=eregi_replace("www\.","",$_SERVER['HTTP_HOST']);
	$current_domain= str_replace("www.", "",$_SERVER['HTTP_HOST']);
	//$current_domain=$_SERVER['HTTP_HOST'];
	$log->general("-Domain Loading-".$current_domain."|",1);
	//define('DOMAINNAME',$current_domain);
	
	if(isset($_GET['dcmshost'])){
		$TargetHost=$_GET['dcmshost'];
	}else{
		$TargetHost=$current_domain;
	}
	//print $TargetHost;
	$content_data["TargetHost"]=$TargetHost;
	$content_data["original_domain"]=$current_domain;
	$TotalDomainName=str_replace("www\.", "", $TargetHost);
	$content_data["TOTALDOMAINNAME"]=$TotalDomainName;
	define('TOTALDOMAINNAME',$TotalDomainName);
	$log->general("\n-",1);
	$log->general("-Domain Total Loading 2-".$TargetHost,1);
	
	$DomainVariableArray=array();
	$domain_user_data=array();
	$csearch=true;
	$totalcount=0;
	$num_rows=0;
	$log->general("1 In Domain Counting Down->".$csearch."->".$TotalDomainName,3);
	//echo"--4411108-------------------------".$csearch."--------------------------------------------------\n";
	while($csearch){
		if($totalcount>10){
			$csearch=false;
		}	
		if(strlen($TotalDomainName)==0){
			$csearch=false;
		}
		$totalcount++;
		if($TotalDomainName!=""){
			//echo"\n\n--22222-------------------------".$csearch."--------------------------------------------------\n";
			
			//$sql="SELECT DISTINCT * FROM domains WHERE Name='".$TotalDomainName."' LIMIT 0,1";
			$sql="SELECT DISTINCT * FROM domains WHERE Name='".$TotalDomainName."'";
			//$sql="SELECT DISTINCT * FROM clients";
			//$sql="SELECT COUNT(*) AS total FROM content_pages";
			//print $sql."\n\n<br><br>999\n\n";
			//$csearch=false;
			$log->general("1 In Domain Counting Down->".$sql,3);
			$rslt=$r->RawQuery($sql);
			$row = $r->Fetch_Assoc();
			$domain_data["db"]=$row;
			/*
			while ($row = $r->Fetch_Array()) {
				//echo "{$row['id']} {$row['name']} {$row['email']} \n";
				$num_rows++;
				$domain_data["db"]=$row;
				echo"yyy";
				print_r($row);
			}
			*/
			//$num_rows=$r->NumRows($rslt);
			
			
			//echo"\n\n778xxx-nr->".$num_rows;
			$log->general("Domain Counting Down->".$sql,3);
			//echo"--4432-------------------------".$csearch."--------------------------------------------------\n";
		}else{
			//echo"\n\n--22222112-------------------------".$csearch."--------------------------------------------------\n";
			$num_rows=0;
			$csearch=false;
		}
		//echo"--4412345-------------------------".$csearch."--------------------------------------------------\n";
		//if($rslt){
		if($num_rows>0){
			//$domain_data["db"]=$r->Fetch_Assoc();//reset to mirror site details
			
			//print_r($domain_data);
			//echo"--44321-------------------------".$csearch."--------------------------------------------------\n";
			//$num_rows=$r->NumRows($rslt);
			//echo"11nr->".$num_rows;
			$log->general("Domain Found->".$num_rows,3);
			//if($num_rows>0){
			//$domain_data["db"]=$r->Fetch_Assoc();//reset to mirror site details
			$csearch=false;
			$log->general("Domain cr->".$num_rows,3);
			//if(!defined(DOMAINNAME)) define('DOMAINNAME',$TotalDomainName);
			$log->general("Domain ar->".$num_rows,3);
			//$domain_data["db"]=$r->Fetch_Assoc();
			//print_r($domain_data);
			$log->general("Domain xr->".var_export($domain_data,true),3);
			//echo"--44666-------------------------".$csearch."--------------------------------------------------\n";
			if(isset($domain_data["db"]['mirrorID'])){
				// if domain is mirrored reset domain_data to domain referenced
				if($domain_data["db"]['mirrorID']>0){
					$log->general("Domain Mirror->",3);
					$sql="SELECT * FROM domains WHERE id=".$domain_data["db"]['mirrorID'];
					$rslt=$r->RawQuery($sql);
					$num_rows=$r->NumRows($rslt);
					if($num_rows>0){
						$domain_data["db"]=$r->Fetch_Assoc();//reset to mirror site details
						$log->general("Domain zr->".var_export($domain_data,true),3);
					}
				}
			}
			
			$log->general("Domain br->".var_export($domain_data,true),3);
				
				//if(!defined(DOMAINSID)) define('DOMAINSID',$domain_data['id']);
			//}	
		}else{
			$TArr=explode('.',$TotalDomainName);
			//print_r($TArr);
			if(count($TArr)>2){
				for($x=0;$x<(count($TArr)-2);$x++){
					$domain_user_data["sub_domain_items"][$x]=$TArr[$x];
					//$domain_user_data["sub_domain_total"].=($x==0 : '.' ? '').$TArr[$x];
				}
			}
			
			$TotalDomainName="";
			for($x=1;$x<count($TArr);$x++){
				$tmp=($x!=1 ? '.':""); 
				$TotalDomainName.=$tmp.$TArr[$x];
			}
			////echo"--".$TotalDomainName;
			//if($TotalDomainName!="localhost"){
			$count=strpos($TotalDomainName,".");
			//print_r($matches);
			if($count==0){
			//if(strpos($TotalDomainName,"\.")==false){
				//if(!pre($TotalDomainName)){
				//exit($count."Invalid Domain Name->".$TotalDomainName);
				$log->general("Invalid Domain Count DownName->".$sql." ".$TotalDomainName."|",3);
			}
			//	}
		};
	}
		//}else{
//		$log->general("Invalid Domain Name None Found->".$sql."  ".$TotalDomainName,3);
	//}
	
	$domain_data["TotalDomainName"]=$TotalDomainName;
	$domain_data["DomainVariableArray"]=$DomainVariableArray;
	//echo"--744------------------------------";//.var_export($DomainVariableArray,true)."---------------------------------------------\n";
	$log->general("Domain Ending->",3);
	$log->general("Sub Domain Check->".var_export($DomainVariableArray,true),3);
	
	
	if(count($DomainVariableArray)>0){
		//echo $sql."--405---------------------------------------------------------------------------\n";
		//$DName=$DomainVariableArray[0];
		$DName=$domain_user_data["sub_domain_total"];
		$sql="SELECT * FROM users WHERE subdomain='".$DName."' LIMIT 0,1";

		$rslt=$r->RawQuery($sql);
		$domain_count=$r->NumRows($rslt);
		//echo $domain_count."--405---------------------------------------------------------------------------\n";
		if($domain_count>0){
			$continue=true;
			//while($myrow=$r->Fetch_Assoc($rslt)){
			$myrow=$r->Fetch_Assoc($rslt);
			$sql="SELECT domainsID FROM mod_business_categories WHERE id='".$myrow['mod_business_categoriesID']."'";
			$rslt2=$r->RawQuery($sql);
			$data=$r->Fetch_Array($rslt2);
			//print_r($myrow);
			//flush();
			if($data[0]==$domain_data["db"]['id']){
				$domain_user_data["db"]=$myrow;
			}
			//}
		}else{
			// show 404 error
			
			$sql="SELECT * FROM content_pages WHERE  module_viewsID='801'";
			//echo "--414----------".$sql."--------------------------------454---------------------------------\n";
			$rslt=$r->RawQuery($sql);
			$content_domain_data["db"]=$r->Fetch_Assoc($rslt);
			//echo "--404----------".$sql."-----------------".var_export($content_domain_data,true)."---------------414---------------------------------\n";
		}
		//echo $sql."--405---------------------------------------------------------------------------\n";
	}else{
		//echo $sql."--2222---------------------------------------------------------------------------\n";
	}
	//echo "--888---------------------------------".var_export($content_domain_data,true)."------------------------------------------\n";
	////echo"-333-".$TotalDomainName."--".var_export($content_data,true)."-123-".var_export($domain_data,true)."--".var_export($content_domain_data,true);
	//echo"-222-".var_export($content_domain_data,true)."--22--";;
	$log->general("Domain Complete->",3);
	$log->general("\n",3);
	//echo "--8887654321---------------------------------".var_export($content_domain_data,true)."------------------------------------------\n";
	//print_r($domain_data);
?>