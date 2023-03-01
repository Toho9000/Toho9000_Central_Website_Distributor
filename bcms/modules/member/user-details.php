<?
	$membersID=$_SESSION['membersID'];
    //$r=new ReturnRecord();
	$r->AddTable("users");
  
	$r->AddSearchVar($_SESSION['membersID']);
	$Memb=$r->GetRecord();
	
	//print_r($Memb);
?>
<form method="post" action="<?php print $_SERVER['REQUEST_URI'];?>">
  <div align="center">
    <center>
    <?php print $Message;?>
      <table width="391" border="0" alig-="left" cellpadding="3" cellspacing="1" bgcolor="#97C8F9">
        <tr>
          <td width="179" align="right" bgcolor="#E6E6E6"><font size="2">Name :</font></td>
          <td width='197' bgcolor="#FFFFFF"><input name="name" type="text" id="name" value="<?php print $Memb['name'];?>" /></td>
        </tr>
        <tr>
          <td width="179" align="right" bgcolor="#E6E6E6"><font size="2">Address :</font></td>
          <td width='197' bgcolor="#FFFFFF"><input name="address" type="text" id="address" value="<?php print $Memb['address'];?>" /></td>
        </tr>
        <tr>
          <td width="179" align="right" bgcolor="#E6E6E6"><font size="2">Suburb :</font></td>
          <td width='197' bgcolor="#FFFFFF"><input name="suburb" type="text" id="suburb" value="<?php print $Memb['suburb'];?>" /></td>
        </tr>
        <tr>
          <td width="179" align="right" bgcolor="#E6E6E6"><font size="2">State :</font></td>
          <td width='197' bgcolor="#FFFFFF"><input name="state" type="text" id="state" value="<?php print $Memb['state'];?>" /></td>
        </tr>
        <tr>
          <td width="179" align="right" bgcolor="#E6E6E6"><font size="2">Postcode :</font></td>
          <td width='197' bgcolor="#FFFFFF"><input name="postcode" type="text" id="postcode" value="<?php print $Memb['postcode'];?>" /></td>
        </tr>
        <tr>
          <td width="179" align="right" bgcolor="#E6E6E6"><font size="2">ABN:</font></td>
          <td width='197' bgcolor="#FFFFFF"><input name="abn" type="text" id="abn" value="<?php print $Memb['abn'];?>" /></td>
        </tr>
        <tr>
          <td width="179" align="right" bgcolor="#E6E6E6"><font size="2">Phone Number :</font></td>
          <td width='197' bgcolor="#FFFFFF"><input name="phone" type="text" id="phone" value="<?php print $Memb['phone'];?>" /></td>
        </tr>
        <tr>
          <td width="179" align="right" bgcolor="#E6E6E6"><font size="2">Mobile Number :</font></td>
          <td width='197' bgcolor="#FFFFFF"><input name="mobile" type="text" id="mobile" value="<?php print $Memb['mobile'];?>" /></td>
        </tr>
        <tr>
          <td width="179" align="right" bgcolor="#E6E6E6"><font size="2">Fax Number :</font></td>
          <td width='197' bgcolor="#FFFFFF"><input name="fax" type="text" id="fax" value="<?php print $Memb['fax'];?>" /></td>
        </tr>
        <tr>
          <td width="179" align="right" bgcolor="#E6E6E6"><font size="2">Email Address :</font></td>
          <td width='197' bgcolor="#FFFFFF"><input name="email" type="text" id="email" value="<?php print $Memb['email'];?>" /></td>
        </tr>
        <tr>
          <td width="179" height="24" align="right" bgcolor="#E6E6E6"><font size="2">Web Site :</font></td>
          <td width='197' bgcolor="#FFFFFF">
            http://            
            <input name="website" type="text" id="website" value="<?php print $Memb['website'];?>" /></td>
        </tr>
        <tr>
          <td width="179" align="right" bgcolor="#E6E6E6"><font size="2">Contact Name :</font></td>
          <td width='197' bgcolor="#FFFFFF"><input name="contact_name" type="text" id="contact_name" value="<?php print $Memb['contact_name'];?>" /></td>
        </tr>
        <tr>
          <td align="right" bgcolor="#E6E6E6">Password :</td>
          <td bgcolor="#FFFFFF"><input name="password" type="text" id="password" value="<?php print $Memb['password'];?>" /></td>
        </tr>
        <tr>
          <td colspan="2" align="center" bgcolor="#E6E6E6">Directory Description</td>
        </tr>
        <tr>
          <td colspan="2" align="center" bgcolor="#E6E6E6"><textarea name="business_description" cols="50" rows="5" id="business_description"><?php print $Memb['business_description'];?></textarea></td>
        </tr>
      </table>
    </center>
  </div>
  <div align="center">
    <center>
      <p>
        <input type="submit" value="Update Details"
  name="Submit" id="Submit" />
      </p>
    </center>
  </div>
</form>
