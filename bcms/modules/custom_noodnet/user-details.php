<?
	$r=new ReturnRecord();
	$r->AddTable("users");
	$r->AddSearchVar($_SESSION['membersID']);
	$Memb=$r->GetRecord();
?>
<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td width="16%"><iframe src="http://promotions.noodnet.com/ibanner.php?id=7" width="150" height="60" scrolling="no" frameborder="0"></iframe></td>
    <td width="68%"><h1 align="center" style="border: 1 solid #0080C0">&nbsp;</h1></td>
    <td width="16%" align="right"><iframe src="http://promotions.noodnet.com/ibanner.php?id=8" width="150" height="60" scrolling="no" frameborder="0"></iframe></td>
  </tr>
  <tr>
    <td colspan="2" valign="top">
      <p align="center"><a href="http://noodnet.com/cgi-bin/member-sell-details.pl"><font
size="4">Edit your items currently listed</font></a></p>
      <form method="POST" action="http://noodnet.com/cgi-bin/member-update-user.pl">
        <div align="center">
          <center>
            <table width="580" border="0" cellpadding="3" cellspacing="1" bgcolor="#97C8F9">
              <tr>
                <td width="157" align="right" bgcolor="#E6E6E6"><font size="2">Id Number :</font></td>
<td width='415' bgcolor="#FFFFFF"><?php print $Memb['id'];?></td>
              </tr>
              <tr>
                <td width="157" align="right" bgcolor="#E6E6E6"><font size="2">Login Alias :</font></td>
<td width='415' bgcolor="#FFFFFF"><input type='text' name='LoginAlias' size='15' value='<?php print $Memb['alias'];?>'></td>
              </tr>
              <tr>
                <td width="157" align="right" bgcolor="#E6E6E6"><font size="2">Name :</font></td>
<td width='415' bgcolor="#FFFFFF"><?php print $Memb['name'];?></td>
              </tr>
              <tr>
                <td width="157" align="right" bgcolor="#E6E6E6"><font size="2">Address :</font></td>
<td width='415' bgcolor="#FFFFFF"><?php print $Memb['address'];?></td>
              </tr>
              <tr>
                <td width="157" align="right" bgcolor="#E6E6E6"><font size="2">Suburb :</font></td>
<td width='415' bgcolor="#FFFFFF"><?php print $Memb['suburb'];?></td>
              </tr>
              <tr>
                <td width="157" align="right" bgcolor="#E6E6E6"><font size="2">State :</font></td>
<td width='415' bgcolor="#FFFFFF"><?php print $Memb['state'];?></td>
              </tr>
              <tr>
                <td width="157" align="right" bgcolor="#E6E6E6"><font size="2">Postcode :</font></td>
<td width='415' bgcolor="#FFFFFF"><?php print $Memb['postcode'];?></td>
              </tr>
              <tr>
                <td width="157" align="right" bgcolor="#E6E6E6"><font size="2">Approval Number :</font></td>
<td width='415' bgcolor="#FFFFFF"><?php print $Memb['approval_num'];?></td>
              </tr>
              <tr>
                <td width="157" align="right" bgcolor="#E6E6E6"><font size="2">ABN:</font></td>
<td width='415' bgcolor="#FFFFFF"><?php print $Memb['abn'];?></td>
              </tr>
              <tr>
                <td width="157" align="right" bgcolor="#E6E6E6"><font size="2">Phone Number :</font></td>
<td width='415' bgcolor="#FFFFFF"><?php print $Memb['phone'];?></td>
              </tr>
              <tr>
                <td width="157" align="right" bgcolor="#E6E6E6"><font size="2">Mobile Number :</font></td>
<td width='415' bgcolor="#FFFFFF"><?php print $Memb['mobile'];?></td>
              </tr>
              <tr>
                <td width="157" align="right" bgcolor="#E6E6E6"><font size="2">Fax Number :</font></td>
<td width='415' bgcolor="#FFFFFF"><?php print $Memb['fax'];?></td>
              </tr>
              <tr>
                <td width="157" align="right" bgcolor="#E6E6E6"><font size="2">Email Address :</font></td>
<td width='415' bgcolor="#FFFFFF"><?php print $Memb['email'];?></td>
              </tr>
              <tr>
                <td width="157" align="right" bgcolor="#E6E6E6"><font size="2">Web Site :</font></td>
<td width='415' bgcolor="#FFFFFF"><?php print $Memb['website'];?></td>
              </tr>
              <tr>
                <td width="157" align="right" bgcolor="#E6E6E6"><font size="2">Contact Pharmacist :</font></td>
<td width='415' bgcolor="#FFFFFF"><?php print $Memb['contact_name'];?></td>
              </tr>
              <tr>
                <td width="157" align="right" bgcolor="#E6E6E6"><font size="2">Type :</font></td>
<td bgcolor="#FFFFFF" witdh='415'><?php print $Memb['type'];?></td>
              </tr>
              <tr>
                <td width="157" align="right" bgcolor="#E6E6E6"><font size="2">Receive Nood Updates :</font></td>
<td width='415' bgcolor="#FFFFFF"><select name='EmailUpdates' size='1'>
<option value='1' <?=($Memb['email_notify']==1 ? "selected" : "");?>>Yes</option>
<option value='0' <?=($Memb['email_notify']!=1 ? "selected" : "");?>>No</option>
</select>
</td>
              </tr>
              <tr>
                <td width="157" align="right" bgcolor="#E6E6E6"><font size="2">Receive New Listings :</font></td>
<td width='415' bgcolor="#FFFFFF">
<input type='radio' value='0' checked name='email_listing'>Never
<input type='radio' name='email_listing' value='1'>Daily
</td>
              </tr>
              <tr>
                <td width="157" align="right" bgcolor="#E6E6E6"><font size="2">Comments to Purchasers :</font></td>
<td width='415' bgcolor="#FFFFFF"><input type='text' name='SaleComments' size='50'  value='<?=($Memb['sale_comment']==1 ? "selected" : "");?>'></td>
              </tr>
            </table>
          </center>
        </div>
        <div align="center">
          <center>
            <p>
              <input type="submit" value="Update Details"
  name="UpdateUserDetails">
            </p>
          </center>
        </div>
      </form>
      <p><font size="2">If you would like to<font color="#0080C0"> <strong>modify any other
        details</strong></font>, it is required that you send an email to 
    <td width='415'></td>
    </td>
    <td align="right" valign="top"><iframe src="http://promotions.noodnet.com/ibanner.php?id=9" width="150" height="300" scrolling="no" frameborder="0"></iframe>
        <br>
        <iframe src="http://promotions.noodnet.com/ibanner.php?id=10" width="150" height="300" scrolling="no" frameborder="0"></iframe></td>
  </tr>
  <tr>
    <td colspan="3" align="center"><iframe src="http://promotions.noodnet.com/ibanner.php?id=11" width="450" height="100" scrolling="no" frameborder="0"></iframe></td>
  </tr>
</table>