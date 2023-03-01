<?php
	$VArray=array_reverse($VariableArray);
  //echo"--88800---------------------------------------------------------------------------\n";
	if(count($VariableArray)==0){
    //echo"--88900---------------------------------------------------------------------------\n";
		//$sql="SELECT DISTINCT CategoryTitle,mod_business_categories.SubDomain FROM mod_business_categories,users WHERE users.mod_business_categoriesID=mod_business_categories.id AND domainsID=".$domain_data["db"]['id']." ORDER BY CategoryTitle";
    $sql="SELECT DISTINCT CategoryTitle,mod_business_categories.SubDomain FROM mod_business_categories,users WHERE users.mod_business_categoriesID=mod_business_categories.id  ORDER BY CategoryTitle";
		//print $sql;
		$rslt=$r->RawQuery($sql);
		if($rslt){
			while($myrow=$r->Fetch_Array($rslt)){
				?><a href="<?php print TOTALPAGENAME.str_replace(" ","-",$myrow[1]);?>/"><?php print $myrow[0]?></a> <br><?php	
			}
		}
	}elseif(count($VariableArray)==1){
		//$sql="SELECT name,address,suburb,state,postcode,phone,fax,website,business_description,users.subdomain FROM users,mod_business_categories WHERE users.mod_business_categoriesID=mod_business_categories.id AND  mod_business_categories.SubDomain='$VariableArray[0]' AND domainsID=".$domain_data["db"]['id']." ORDER BY users.id";
    $sql="SELECT name,address,suburb,state,postcode,phone,fax,website,business_description,users.subdomain FROM users,mod_business_categories WHERE users.mod_business_categoriesID=mod_business_categories.id AND  mod_business_categories.SubDomain='$VariableArray[0]'  ORDER BY users.id";
		///print $sql;
		$rslt=$r->RawQuery($sql);
		while($myrow=$r->Fetch_Array($rslt)){
			?>
            
            <table width="425" border="0" align="center" cellpadding="2" cellspacing="1" id="DirectoryTable" bgcolor="#cdcdcd">
            <tr>
            <td width="88" bgcolor="#6495ED">			Name:</td>
            <td width="326" bgcolor="#6495ED"><?php print $myrow[0]?></td>
			</tr>
            <tr>
              <td bgcolor="#6495ED">Address:</td>
              <td width="326" bgcolor="#6495ED"><?php print $myrow[1]?></td>
            </tr>
            <tr>
              <td bgcolor="#6495ED">Suburb:</td>
              <td width="326" bgcolor="#6495ED"><?php print $myrow[2]?></td>
            </tr>
            <tr>
              <td bgcolor="#6495ED">State:</td>
              <td width="326" bgcolor="#6495ED"><?php print $myrow[3]?></td>
            </tr>
            <tr>
              <td bgcolor="#6495ED">Postcode:</td>
              <td width="326" bgcolor="#6495ED"><?php print $myrow[4]?></td>
            </tr>
            <tr>
              <td bgcolor="#6495ED">Phone:</td>
              <td width="326" bgcolor="#6495ED"><?php print $myrow[5]?></td>
            </tr>
            <tr>
              <td bgcolor="#6495ED">Fax:</td>
              <td width="326" bgcolor="#6495ED"><?php print $myrow[6]?></td>
            </tr>
            <?php
			  	if(($myrow[8]!="")||($myrow[7]!="NULL")){
			  ?>
            <tr>
              <td bgcolor="#6495ED">Website:</td>
              <td width="326" bgcolor="#6495ED">
              <?php
			  	if($myrow[8]!=""){
			  ?>
              <a href="http://<?php print $myrow[9].".".$domain_data["db"]['Name'];?>"><?php print $myrow[0]?></a>
              <?php
				}elseif($myrow[7]!="NULL"){
			  ?>
              <a href="http://<?php print $myrow[7]?>"><?php print $myrow[0]?></a>
              <?php
				}
			  ?>
              </td>
            </tr>
            <?php
				};
				?>
            </table>
            <br>
            <br>
			<?php
		}
	}
	//echo"--88800----------".$sql."-----------------------------------------------------------------\n";
	

?>