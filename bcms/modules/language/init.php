<?php
	
	if(isset($_POST['LanguagesID'])){
		if($_POST['LanguagesID']){
			$_SESSION['LanguagesID']=$_POST['LanguagesID'];
			$LanguagesID=$_POST['LanguagesID'];
		}elseif(!$_SESSION['LanguagesID']){
			$_SESSION['LanguagesID']=1;
			$LanguagesID=1;
		}
	}else{
		$_SESSION['LanguagesID']=1;
		$LanguagesID=1;
	}
	$app_data['LANGUAGESID']=$LanguagesID;
	//define('LANGUAGESID',$LanguagesID);
?>