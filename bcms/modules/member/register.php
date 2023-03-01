<script type="text/javascript">
<!--
function CheckAgree(){
	var target=document.getElementById("IAgree");
	if(target.checked){
		return true;
	}else{
		alert("You must agree to the terms and conditions");
		return false;
	}
}


function MM_validateForm() { //v4.0
  if (document.getElementById){
    var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
    for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
      if (val) { nm=val.name; if ((val=val.value)!="") {
        if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
          if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
        } else if (test!='R') { num = parseFloat(val);
          if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
          if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
            min=test.substring(8,p); max=test.substring(p+1);
            if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
      } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
    } if (errors) alert('The following error(s) occurred:\n'+errors);
    document.MM_returnValue = (errors == '');
} }
//-->
</script>
<form action="<?php print $_SERVER['REQUEST_URI']?>" method="post" name="form1" onSubmit="MM_validateForm('name','','R','address','','R','suburb','','R','postcode','','R','approval_number','','R','abn','','R','phone','','R','mobile','','R','fax','','R','email','','RisEmail','contact_name','','R');return document.MM_returnValue">
  <?php print $Message;?>
  <br>
<table width="434" border=0 align="center" cellpadding=2 cellspacing="1" bgcolor="#97C8F9" id="table">
    <tr>
      <td colspan="2" align="center" bgcolor="#E6E6E6"><strong>All Fields Are Mandatory</strong></td>
    </tr>
    <tr>
      <td width="184" bgcolor="#E6E6E6"><strong>Business&nbsp; Name</strong></td>
      <td width="240" bgcolor="#FFFFFF">
        <INPUT NAME="name" TYPE="text" id="name" value="<?php print $_POST['name'];?>" SIZE="26">
       </td>
    </tr>
    <tr>
      <td width="184" bgcolor="#E6E6E6"> <strong>Business Address</strong> </td>
      <td width="240" bgcolor="#FFFFFF"> 
        <INPUT NAME="address" TYPE="text" id="address" value="<?php print $_POST['address'];?>" SIZE="40">
       </td>
    </tr>
    <tr>
      <td width="184" bgcolor="#E6E6E6"> <strong>Suburb / Town / City</strong> </td>
      <td width="240" bgcolor="#FFFFFF"> 
        <INPUT NAME="suburb" TYPE="text" id="suburb" value="<?php print $_POST['suburb'];?>" SIZE="26">
       </td>
    </tr>
    <tr>
      <td width="184" bgcolor="#E6E6E6"> <strong>State</strong> </td>
      <td width="240" bgcolor="#FFFFFF"> 
        <SELECT NAME="state" id="state">
          <OPTION SELECTED VALUE="Queensland">Queensland
            <OPTION VALUE="New South Wales">New South Wales
            <OPTION VALUE="Victoria">Victoria
            <OPTION VALUE="South Australia">South Australia
            <OPTION VALUE="Western Australia">Western Australia
            <OPTION VALUE="Tasmania">Tasmania
            <OPTION VALUE="Australian Capital Territory">Australian Capital Territory
            <OPTION VALUE="Northern Territory">Northern Territory
          </SELECT>
      </td>
    </tr>
    <tr>
      <td width="184" bgcolor="#E6E6E6"> <strong>Postcode </strong> </td>
      <td width="240" bgcolor="#FFFFFF"> 
        <INPUT NAME="postcode" TYPE="text" id="postcode"
  onChange="digitvalidation(this, 3, 4,'You MUST enter a 4 digit Australian Postcode','Integer')" value="<?php print $_POST['postcode'];?>" SIZE="8">
       </td>
    </tr>
    <tr>
      <td width="184" bgcolor="#E6E6E6"> <strong>ABN</strong></td>
      <td width="240" bgcolor="#FFFFFF"> 
        <INPUT NAME="abn" TYPE="text" id="abn" value="<?php print $_POST['abn'];?>" SIZE="20">
       </td>
    </tr>
    <tr>
      <td width="184" bgcolor="#E6E6E6"> <strong>Phone Number</strong> </td>
      <td width="240" bgcolor="#FFFFFF"> 
        <INPUT NAME="phone" TYPE="text" id="phone" value="<?php print $_POST['phone'];?>" SIZE="20">
       </td>
    </tr>
    <tr>
      <td width="184" bgcolor="#E6E6E6"> <strong>Mobile Number</strong> </td>
      <td width="240" bgcolor="#FFFFFF"> 
        <INPUT NAME="mobile" TYPE="text" id="mobile" value="<?php print $_POST['mobile'];?>" SIZE="20">
       </td>
    </tr>
    <tr>
      <td width="184" bgcolor="#E6E6E6"> <strong>Fax Number</strong> </td>
      <td width="240" bgcolor="#FFFFFF"> 
        <INPUT NAME="fax" TYPE="text" id="fax" value="<?php print $_POST['fax'];?>" SIZE="20">
       </td>
    </tr>
    <tr>
      <td width="184" bgcolor="#E6E6E6"> <strong>E-mail Address</strong> </td>
      <td width="240" bgcolor="#FFFFFF"> 
        <INPUT NAME="email" TYPE="text" id="email"
  onChange="emailvalidation(this,'Invalid Email Address')" value="<?php print $_POST['email'];?>" SIZE="40">
       </td>
    </tr>
    <tr>
      <td width="184" bgcolor="#E6E6E6"> <strong>Web Site</strong> </td>
      <td width="240" bgcolor="#FFFFFF"> 
        http://
        <INPUT NAME="website" TYPE="text" id="website" value="<?php print $_POST['website'];?>" SIZE="30">
       </td>
    </tr>
    <tr>
      <td width="184" bgcolor="#E6E6E6"> <strong>Contact Person</strong> </td>
      <td width="240" bgcolor="#FFFFFF"> 
        <INPUT NAME="contact_name" TYPE="text" id="contact_name" value="<?php print $_POST['contact_name'];?>" SIZE="26">
       </td>
    </tr>
    <tr>
      <td bgcolor="#E6E6E6"><strong>Password</strong></td>
      <td bgcolor="#FFFFFF"><input name="password" type="text" id="password" value="<?php print $_POST['password'];?>" size="26" /></td>
    </tr>
    <tr>
      <td width="184" bgcolor="#E6E6E6"> <strong>Business Category</strong> </td>
      <td width="240" bgcolor="#FFFFFF">
       
        <SELECT NAME="mod_business_categoriesID" id="mod_business_categoriesID">
          <?php
					  	$Count=0;
					 	//$r=new ReturnRecord();
						$sq2=$r->rawQuery("SELECT id,CategoryTitle FROM mod_business_categories WHERE domainsID=".$domain_data["db"]['id']." OR domainsID=0 ORDER BY CategoryTitle");  
						while ($myrow = $r->Fetch_Array($sq2)) {
							print "<option value='$myrow[0]'>$myrow[1]</option>";
						};
						?>
        </SELECT>
      </td>
    </tr>
    <tr>
      <td height="24" bgcolor="#E6E6E6"><p><strong>You Agree To <br />
      </strong><strong><a href="/terms-and-conditions/" target="_blank">Terms &amp; Conditions</a></strong></p></td>
      <td bgcolor="#FFFFFF"><input name="IAgree" type="checkbox" id="IAgree" value="1"></td>
    </tr>
    
    <tr>
      <td colspan="2" align="right" bgcolor="#E6E6E6"><input type="submit" name="Submit" id="Submit" value="Submit" onClick="return CheckAgree()"></td>
    </tr>
  </table>
</form>
