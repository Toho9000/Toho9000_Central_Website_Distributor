<?
if(!isset($Message)) $Message="";

?>
<form name="form1" method="post" action="<?php print $_SERVER['REQUEST_URI'];?>" class="contact-form">
  <?php print $Message;?>
  <table width="90%" border="0" align="center" cellpadding="2" cellspacing="1" id="contact-table">
    <tr align="center" bgcolor="#FFFFFF">
      <td colspan="2">
      <?
	  	if(isset($_GET['mid'])){
			if(is_numeric($_GET['mid'])){
				$sql="SELECT name FROM users WHERE id=$_GET[mid]";
				$rslt=$r->RawQuery($sql);
				$data=$r->Fetch_Array($rslt);
				print "Contacting Member: ".$data[0];
			}else{
				print "Contacting Admin";
			}
		}
		
	  ?>
      </td>
    </tr>
    <tr align="center" >
      <td colspan="2"><strong>Please enter your details</strong> <br>
<?php print $Message;?></td>
    </tr>
    <tr>
      <td><strong>Name:</strong></td>
      <td><input name="name" type="text" id="name" size="50"></td>
    </tr>
    <tr>
      <td width="131"><strong>Email:</strong></td>
      <td width="366"><input name="email" type="text" id="email" size="50"></td>
    </tr>
    <tr>
      <td><strong>Phone:</strong></td>
      <td><input name="phone" type="text" id="phone" size="50"></td>
    </tr>
    <tr>
      <td><strong>Comments:</strong></td>
      <td><textarea name="comments" cols="50" rows="7" id="comments"></textarea></td>
    </tr>
    <tr align="center">
      <td colspan="2"><img src="/classes/captcha/captcha.class.php?length=4&font=&size=24&angel=5&file="><br />
      <strong>Please Enter Security Code:</strong>        <input type="text" name="code" size="35" id="code" /></td>
    </tr>
    <tr>
      <td colspan="2" align="right"><input type="submit" name="Submit" id="Submit" value="Submit"></td>
    </tr>
  </table>
</form>