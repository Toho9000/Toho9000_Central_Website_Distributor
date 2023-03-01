<?php
	//echo"yyy";
	if(isset($_POST['Submit'])){
		if($_POST['Submit']){
			//$sql="SELECT users.id,password FROM users,mod_business_categories WHERE users.mod_business_categoriesID=mod_business_categories.id AND domainsID=".$domain_data['id']." AND email='$_POST[email]' AND password='$_POST[password]'";
			$sql="SELECT users.id,password FROM users,mod_business_categories WHERE users.mod_business_categoriesID=mod_business_categories.id AND email='$_POST[email]' AND password='$_POST[password]'";
			$log->general('Member Pre Login-'.$sql,1);
			//print $sql;
			$rslt=$r->RawQuery($sql);
			if($rslt){
				$data=$r->Fetch_Array();
				if(isset($data)){
					if(is_array($data)){
						//$log->general('Member Pre Login-'.var_dump($data,true),1);
						$log->general('Member Pre Login-',1);
						if(($data[0]>0)&&($data[1]==$_POST['password'])){
							//$log->general('Member Login Checked-'.var_dump($data,true),1);
							$log->general('Member Login Checked-',1);
							$_SESSION['membersID']=$data[0];
							$membersID=$data[0];
							$log->general('Member Done-'.$_SESSION['membersID']."\n\n",1);
							header("Location: /members/home/");
							//$TotalPageName="/member/home/";
							//include($app_data['MODULEBASEDIR']."content/init.php");
						}else{
							$Message="Incorrect Email Or Password";
						}
					}else{
						$Message="Incorrect Email Or Password";
					}
				}else{
					$Message="Incorrect Email Or Password";
				}
			}else{
				$Message="Incorrect Email Or Password";
			}
		}
	}else{
		$Message="Incorrect Email Or Password";
	}


?>