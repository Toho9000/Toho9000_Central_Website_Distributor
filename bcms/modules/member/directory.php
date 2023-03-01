<?php
	$VArray=array_reverse($VariableArray);
	if(count($VariableArray)==0){
		$sql="SELECT DISTINCT state FROM users ORDER BY state";
    $rslt=$r->RawQuery($sql);
		while($myrow=$r->Fetch_Array($rslt)){
			?><a href="<?=TOTALPAGENAME.eregi_replace(" ","-",$myrow[0]);?>/"><?php print $myrow[0]?></a> <br><?php
		}
	}elseif(count($VariableArray)==1){
		?><table width="90%" border="0" align="center" cellpadding="2" cellspacing="1" id="DirectoryTable" bgcolor="#cdcdcd"><?php
		$count=0;
		$numcols=4;
    $sql="SELECT DISTINCT suburb FROM users WHERE state='".eregi_replace("-"," ",$VariableArray[0])."' ORDER BY suburb";
		$rslt=$r->RawQuery($sql);
		while($myrow=$r->Fetch_Array($rslt)){
			if($count==0){
				?><tr><?php
				
			};
			?>
            <td align="center">
            <a href="<?=TOTALPAGENAME.eregi_replace(" ","-",$myrow[0]);?>/"><?=strtolower($myrow[0])?></a> <br>
			</td>
			<?php
				
			$count++;
			if($count==$numcols){
				?></tr><?
				$count=0;
			};
			
		};
		?></table><?php
	}elseif(count($VariableArray)==2){
    $sql="SELECT name,address,suburb,state,postcode,phone,fax,website,seller_description FROM users WHERE suburb='".eregi_replace("-"," ",$VariableArray[0])."' ORDER BY suburb";
		$rslt=$r->RawQuery($sql);
		while($myrow=$r->Fetch_Array($rslt)){
			?>
            
            <table width="425" border="0" align="center" cellpadding="2" cellspacing="1" id="DirectoryTable" bgcolor="#cdcdcd">
            <tr>
            <td width="88" bgcolor="#FFFFFF">			Name:</td>
            <td width="326" bgcolor="#FFFFFF"><?php print $myrow[0]?></td>
			</tr>
            <tr>
              <td bgcolor="#FFFFFF">Address:</td>
              <td width="326" bgcolor="#FFFFFF"><?php print $myrow[1]?></td>
            </tr>
            <tr>
              <td bgcolor="#FFFFFF">Suburb:</td>
              <td width="326" bgcolor="#FFFFFF"><?php print $myrow[2]?></td>
            </tr>
            <tr>
              <td bgcolor="#FFFFFF">State:</td>
              <td width="326" bgcolor="#FFFFFF"><?php print $myrow[3]?></td>
            </tr>
            <tr>
              <td bgcolor="#FFFFFF">Postcode:</td>
              <td width="326" bgcolor="#FFFFFF"><?php print $myrow[4]?></td>
            </tr>
            <tr>
              <td bgcolor="#FFFFFF">Phone:</td>
              <td width="326" bgcolor="#FFFFFF"><?php print $myrow[5]?></td>
            </tr>
            <tr>
              <td bgcolor="#FFFFFF">Fax:</td>
              <td width="326" bgcolor="#FFFFFF"><?php print $myrow[6]?></td>
            </tr>
            <?
			  	if(($myrow[8]!="")||($myrow[7]!="NULL")){
			  ?>
            <tr>
              <td bgcolor="#FFFFFF">Website:</td>
              <td width="326" bgcolor="#FFFFFF">
              <?php
			  	if($myrow[8]!=""){
			  ?>
              <a href="http://<?=urlencode(strtolower(eregi_replace(" ","-",$myrow[0]))).".".DOMAINNAME;?>"><?php print $myrow[0]?></a>
              <?php
				}elseif($myrow[7]!="NULL"){
			  ?>
              <a href="http://<?php print $myrow[6]?>"><?php print $myrow[0]?></a>
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
	//echo"--99900----------".$sql."-----------------------------------------------------------------\n";
	

?>