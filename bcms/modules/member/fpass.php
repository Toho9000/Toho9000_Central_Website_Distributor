<form name="form1" method="post" action="<?php print $_SERVER['REQUEST_URI'];?>">
  <?php print $Message;?>
  <table width="334" border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#97C8F9" id="table">
    <tr>
      <td colspan="2" align="center" bgcolor="#FFFFFF"><strong>Please enter your email and click Submit and we will email you your password:-</strong></td>
    </tr>
    <tr>
      <td width="131" bgcolor="#E7E7E7"><strong>Email:</strong></td>
      <td width="192" bgcolor="#FFFFFF"><input type="text" name="email" id="email"></td>
    </tr>
    <tr>
      <td colspan="2" align="right" bgcolor="#E7E7E7"><input type="submit" name="Submit" id="Submit" value="Submit"></td>
    </tr>
  </table>
</form>
