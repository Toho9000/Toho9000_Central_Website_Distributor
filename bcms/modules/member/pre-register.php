<?php
	if(!isset($_POST['name'])) $_POST['name']="";
	if(!isset($_POST['address'])) $_POST['address']="";
	if(!isset($_POST['suburb'])) $_POST['suburb']="";
	if(!isset($_POST['abn'])) $_POST['abn']="";
	if(!isset($_POST['phone'])) $_POST['phone']="";
	if(!isset($_POST['mobile'])) $_POST['mobile']="";
	if(!isset($_POST['fax'])) $_POST['fax']="";
	if(!isset($_POST['email'])) $_POST['email']="";
	if(!isset($_POST['website'])) $_POST['website']="";
	if(!isset($_POST['contact_name'])) $_POST['contact_name']="";
	if(!isset($_POST['password'])) $_POST['password']="";
	if(!isset($_POST['postcode'])) $_POST['postcode']="";
	
	
	
	if(isset($_POST['Submit'])){
		if($_POST['Submit']){
			/*
			if ($_SESSION['code'] == $_POST['code'] && !empty($_SESSION['code'])) 
			{
				unset($_SESSION['code']);
				$continue=true;
			}
			else
			{
				$message = "Security Code Wrong.";
				$continue=false;
			}
			*/
			$continue=true;
			
			
			if($continue){
				$log->general('Member Resister',1);
				$subdomain=dirify(trim(str_replace(" ","-",$_POST['name'])));
				$sql="INSERT INTO users VALUES ('NULL', '$_POST[name]', '$_POST[address]', '$_POST[suburb]', '$_POST[state]', '$_POST[postcode]', '$subdomain', '$_POST[phone]', '$_POST[mobile]', '$_POST[fax]', '$_POST[email]', '$_POST[website]', '$_POST[contact_name]', '$_POST[password]',  '1', '0', '$_POST[abn]', '', '$_POST[mod_business_categoriesID]','New')";
				print $sql;
				$rslt=$r->RawQuery($sql);
				if($rslt){
					if($domain_data['AEmail']!=""){
						$Simple="New user id is ".$r->Insert_Id();
						foreach($_POST as $key=>$val){
							$Simple.="\n $key=$val";	
						}
						
						$sql="SELECT id FROM users WHERE email='$_POST[email]'";
						$rslt=$r->RawQuery($sql);
						if($r->NumRows($rslt)>0){
							$data=$r->Fetch_Array($rslt);
							$Simple.="\n WARNING DUPLICATE Email FOUND ON USER $data[0]";
						}
						
						$m=new SendMail();
						$m->Body($Simple,$Simple);
						$m->To(array("BCMSL Admin"=>$domain_data['AEmail']));
						$m->From("BCMSL Bot","info@".DOMAINNAME);
						$m->Subject("New User Has Registered on ".DOMAINNAME);
						$m->Send();
						$Message="Success";
					}
					
					header("Location: /Registration-Complete/");
				}else{
					print "error ".$r->Error();	
				}
			}
		}
	}
	
?>