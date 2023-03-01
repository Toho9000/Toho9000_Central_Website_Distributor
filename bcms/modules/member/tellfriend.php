<?
	if($_POST['Submit']){
		$err=true;
		$rslt=$r->RawQuery("SELECT COUNT(*) FROM users WHERE email='$_POST[email]'");
		$myrow=mysql_fetch_array($rslt);
		if($myrow[0]==0){
			$rslt=$r->RawQuery("SELECT COUNT(*) FROM invites WHERE Email='$_POST[email]'");
			$myrow=mysql_fetch_array($rslt);
			if($myrow[0]==0){
				$membersID=$_SESSION['membersID'];
				$r=new ReturnRecord();
				$r->AddTable("users");
				$r->AddSearchVar($_SESSION['membersID']);
				$Memb=$r->GetRecord();
				
				$rslt=$r->RawQuery("INSERT INTO invites (usersID,Name,Email) VALUES ($_SESSION[membersID],'$_POST[name]','$_POST[email]')");
				$myrow=mysql_fetch_array($rslt);
				
				$HTMLItems="Your friend $Memb[name] has invited you to Noodnet.com with this message:-<br>\n ".$_POST['message'];
				$rslt=$r->RawQuery("SELECT content_text FROM mod_text WHERE id=17 LIMIT 0,1");
				$myrow=mysql_fetch_array($rslt);
				$HTMLItems.="<br><br>\n\n$myrow[0]<br /><br>\n\n";
				
				$HTMLItems.="<a href='http://".$_SERVER['HTTP_HOST']."/?cp=$Memb[id]'>Click Here To Check Out Noodnet.com</a><br>\n\n Use Coupon Code ".$Memb['id']." To Get Your Free Credit"; 
				$m=new SendMail();
				$m->Body(strip_tags($HTMLItems),strip_tags($HTMLItems),$HTMLItems);
				//$m->To(array("Noodnet Admin"=>"admin@noodnet.com"));
				$m->To(array($_POST['name']=>$_POST['email']));
				$m->From($Memb['name'],$Memb['email']);
				$m->Subject("Message For A Friend");
				$m->Send();
				$err=false;
			};
		};
	};
	if($err){
		$Message="Sorry that person is already known to us. Thanks anyway!!";	
	}else{
		$Message="Email Sent. Thank you for spreading the message of Noodnet!!";
	}

?>
<p>Enter the details of a Pharmacy you would like to invite to Noodnet. Every colleague you invite who signs up will get some nood credit and you get some too.</p>
<form name="form1" method="post" action="<?php print $_SERVER['REQUEST_URI'];?>"><?php print $Message;?>
  <table width="487" border="0" align="center" cellpadding="3" cellspacing="1"  bgcolor="#97C8F9" id="table">
    <tr>
      <td bgcolor="#FFFFFF">Your Message To Them :</td>
      <td bgcolor="#FFFFFF"><textarea name="message" id="message" cols="45" rows="5"></textarea></td>
    </tr>
    <tr>
      <td width="177" bgcolor="#FFFFFF">Their Name :</td>
      <td width="295" bgcolor="#FFFFFF"><input name="name" type="text" id="name" size="40"></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF">Their Email :</td>
      <td bgcolor="#FFFFFF"><input name="email" type="text" id="email" size="40"></td>
    </tr>
    <tr>
      <td colspan="2" align="right" bgcolor="#E6E6E6"><input type="submit" name="Submit" id="Submit" value="Send Invite"></td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>