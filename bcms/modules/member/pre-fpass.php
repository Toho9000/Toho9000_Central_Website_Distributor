<?
	if(isset($_POST['Submit'])&&isset($_POST['email'])){
		$rslt=$r->RawQuery("SELECT password,name,email,id FROM users WHERE email='$_POST[email]'");
		if($rslt){
			$Simple="Dear Member here are the details you requested.\n";
			$m=new SendMail();
			while($data=$r->Fetch_Array($rslt)){
				$m->To(array($data[1]=>$data[2]));
				$Simple.="Your name is: $data[1] \n Your email is $data[2].\n Your password is $data[0] \n";
				$Simple.="------------------------------------------------------------------------------\n";
			}
			
			$m->Body($Simple,$Simple);
			
			$m->From(DOMAINNAME." Admin","admin@".DOMAINNAME);
			$m->Subject("Your password reminder");
			$m->Send();
			$Message="Password sent..";
		}else{
			$Message="Email not found";
		}
	}
?>