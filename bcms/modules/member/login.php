<?
	if(isset($_SESSION['membersID'])){
		if($_SESSION['membersID']){
			$membersID=$_SESSION['membersID'];
			$loggin=true;
		}else{
			$loggin=false;
		}
	}else{
		$loggin=false;
	}

	if($loggin){
?>
You are now logged in!!!

<?
		}else{
?>
<?php print $Message;?>
<form name="form1" method="post" action="/login/">
  <table width="300" border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#97C8F9" id="table">
    <tr>
      <td bgcolor="#E6E6E6"><strong>Email:</strong></td>
      <td bgcolor="#FFFFFF"><input type="text" name="email" id="email"></td>
    </tr>
    <tr>
      <td bgcolor="#E6E6E6"><strong>Password:</strong></td>
      <td bgcolor="#FFFFFF"><input type="password" name="password" id="password"></td>
    </tr>
    <tr>
      <td colspan="2" align="right" bgcolor="#E6E6E6"><a href="/forgot-password/">Forgotten Your Details?</a>        <input type="submit" name="Submit" id="Submit" value="Submit"></td>
    </tr>
  </table>
</form>
<? 		};

	
 ?>
