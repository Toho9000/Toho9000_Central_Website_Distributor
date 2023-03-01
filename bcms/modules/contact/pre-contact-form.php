<?

	if($_POST['Submit']){
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
		
		
		
		if($continue){
			$sql="SELECT SiteTitle,AEmail FROM domains WHERE id=".$domain_data['id'];
			$rslt=$r->RawQuery($sql);
			$domdata=mysql_fetch_array($rslt);
			$From['name']=$domdata[0]." Message Bot";
			$From['email']=$domdata[1];
			$Subject=$domdata[0]." Contact Form Message";
			$To=$From;
			if(is_numeric($_GET['mid'])){
				$sql="SELECT name,email FROM users WHERE id=$_GET[mid]";
				$rslt=$r->RawQuery($sql);
				$data=mysql_fetch_array($rslt);
				$To['name']=$data[0];
				$To['email']=$data[1];
			}
			
			
			$Simple="";
			foreach($_POST as $key=>$val){
				$key=mysql_real_escape_string($key);
				$val=mysql_real_escape_string($val);
				$Simple.="\n $key=$val";	
			}
			
			
			
			$m=new SendMail();
			$m->Body($Simple,$Simple);
			$m->To(array($To['name']=>$To['email']));
			//$m->To(array("dan"=>"dan@iwebbiz.com.au"));
			$m->From($From['name'],$From['email']);
			$m->Subject($Subject);
			$m->Send();
			$message="Message Sent";
				
			
		}
	}


?>