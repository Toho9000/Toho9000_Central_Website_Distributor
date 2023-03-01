<?
  //$sql="SELECT name,address,suburb,state,postcode,phone,fax,website,business_description FROM users WHERE id='".$domain_user_data['id']."'";
  $sql="SELECT name,address,suburb,state,postcode,phone,fax,website,business_description FROM users WHERE id='".$_SESSION['membersID']."'";
  //print $sql;
  //print_R($_SESSION);
$rslt=$r->RawQuery($sql);
		while($myrow=$r->Fetch_Array($rslt)){
			?>
            
            <table width="480" border="0" align="center" cellpadding="4" cellspacing="1" id="DirectoryTable" bgcolor="#cdcdcd">
            <tr>
            <td width="266" rowspan="9" valign="top" bgcolor="#FFFFFF"><?php print $myrow[8]?></td>
            <td width="65" bgcolor="#FFFFFF"><strong>Name:</strong></td>
            <td width="121" bgcolor="#FFFFFF"><?php print $myrow[0]?></td>
			</tr>
            <tr>
              <td width="65" bgcolor="#FFFFFF"><strong>Address:</strong></td>
              <td width="121" bgcolor="#FFFFFF"><?php print $myrow[1]?></td>
            </tr>
            <tr>
              <td width="65" bgcolor="#FFFFFF"><strong>Suburb:</strong></td>
              <td width="121" bgcolor="#FFFFFF"><?php print $myrow[2]?></td>
            </tr>
            <tr>
              <td width="65" bgcolor="#FFFFFF"><strong>State:</strong></td>
              <td width="121" bgcolor="#FFFFFF"><?php print $myrow[3]?></td>
            </tr>
            <tr>
              <td width="65" bgcolor="#FFFFFF"><strong>Postcode:</strong></td>
              <td width="121" bgcolor="#FFFFFF"><?php print $myrow[4]?></td>
            </tr>
            <tr>
              <td width="65" bgcolor="#FFFFFF"><strong>Phone:</strong></td>
              <td width="121" bgcolor="#FFFFFF"><?php print $myrow[5]?></td>
            </tr>
            <tr>
              <td width="65" bgcolor="#FFFFFF"><strong>Fax:</strong></td>
              <td width="121" bgcolor="#FFFFFF"><?php print $myrow[6]?></td>
            </tr>
           <? 
				if(isset($myrow[7])){
					//if((preg_match(".",$myrow[7]))||($myrow[7]=="localhost"))){
			?>
            <tr>
              <td bgcolor="#FFFFFF"><strong>Website:</strong></td>
              <td bgcolor="#FFFFFF"><a href="http://<?php print $myrow[7]?>">
                <?php print $myrow[7]?>
              </a></td>
              </tr>
            <? 
					//};
				}; 
			?>
            
            
            </table>
<br>
            <br>
			<?	
		}
	?>