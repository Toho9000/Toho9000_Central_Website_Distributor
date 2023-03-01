<p align="center">&nbsp;</p>
<p><font size="2">To <strong><span class="Morone">update your password</span></strong> simply type in your current password, and then type in your new password twice. This will
  ensure that you did not mis-type your new password.</font></p>
<form action="<?php print $_SERVER['REQUEST_URI'];?>"  method="post" name="form2" id="form2" >
  <span class="RedText"><?php print $Message; ?></span><br />
  <br />
  <table width="70%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#97C8F9" id="table">
    <tr>
      <td width="295" bgcolor="#FFFFFF"><strong> Current Password</strong></td>
      <td width="241" bgcolor="#FFFFFF"><input name="cpassword" type="password" class="formfield1" id="cpassword" /></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF"><strong>New Password</strong></td>
      <td bgcolor="#FFFFFF"><input name="password" type="password" class="formfield1" id="password" /></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF"><strong>Retype New Password</strong></td>
      <td bgcolor="#FFFFFF"><input name="password2" type="password" class="formfield1" id="password2" /></td>
    </tr>
    <tr>
      <td colspan="2" align="right" bgcolor="#E6E6E6"><input name="Submit" type="submit" class="formbuttons" value="Save" onclick="return confirmSubmit()" /></td>
    </tr>
  </table>
</form>
<p><font size="2">Note:&nbsp; If you would like <strong><span class="Morone">to update
  your User Details</span></strong> you will need to send an email to <a href="mailto:admin@noodnet.com">admin@noodnet.com</a> with your new details and a Nood
  Network Administrator will update your details.</font></p>
