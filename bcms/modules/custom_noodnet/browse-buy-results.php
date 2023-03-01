<form action="modify.php"  method="post" name="form2" >
  <span class="RedText"><?php print $Message; ?></span><br>
  <br>
  <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#97C8F9" id="table">
    <tr >
      <td width="14%" bgcolor="#E6E6E6" ><strong> Item Name</strong></td>
      <td width="15%" bgcolor="#E6E6E6" ><strong>Strength</strong></td>
      <td width="13%" bgcolor="#E6E6E6" ><strong>Pack</strong></td>
      <td width="12%" bgcolor="#E6E6E6" ><strong>Qty</strong></td>
      <td width="13%" bgcolor="#E6E6E6" ><strong>Expiry</strong></td>
      <td width="12%" bgcolor="#E6E6E6" ><strong>Price/Pack</strong></td>
      <td width="18%" bgcolor="#E6E6E6" ><strong>Comments</strong></td>
      <td width="3%" align="center" bgcolor="#E6E6E6" class="tabletitle">&nbsp;</td>
    </tr>
    <?php
					  	$nood_group_id = 10435;
						$Count=0;
					 	$r=new ReturnRecord();
						if ($_POST)
					   {
						   $sortdirection = $_POST['AscDesc'];
						   $itemname = $_POST['name'];
						   $state = $_POST['state'];
						   $postcode = $_POST['postcode'];
						   $membershipType = $_POST['type'];
					   }
				
					   if ($membershipType == 0)
					   {
						 $membershipType = "%";
					   }
				
				
					   if (!$postcode)
					   {
						   $postcode = "%";
					   }
					   else
					   {
						   $postcode = $postcode . "%";
					   }
				
					   if ($state == "All States")
					   {
						   $state = "%";
					   }
				
					   if (!$itemname)
					   {
						   $itemname = "%";
					   }
					   else
					   {
						   $itemname = "%" . $itemname . "%";
					   }
						$sql="select items.item_id, LOWER(items.name), LOWER(items.strength), LOWER(items.pack_size), items.qty, items.exp_date, items.price, LOWER(items.comments) from items, users where seller_id != $nood_group_id AND stats>'4' AND items.seller_id=users.id AND users.state LIKE '$state' AND users.postcode LIKE '$postcode' AND users.type LIKE '$membershipType' AND items.name LIKE '$itemname' order by items.name $sortdirection";
						//print $sql;
						$sq2=$r->rawQuery($sql);  
						while ($myrow = $r->Fetch_Array($sq2)) {
						?>
    <tr class="<?=(($Count%2)==0 ? "row1" : "row2"); ?>">
      <td bgcolor="#FFFFFF"><?php print $myrow[1];?></td>
      <td bgcolor="#FFFFFF"><?php print $myrow[2];?></td>
      <td bgcolor="#FFFFFF"><?php print $myrow[3];?></td>
      <td bgcolor="#FFFFFF"><?php print $myrow[4];?></td>
      <td bgcolor="#FFFFFF"><?php print $myrow[5];?></td>
      <td bgcolor="#FFFFFF"><?php print $myrow[6];?></td>
      <td bgcolor="#FFFFFF"><?php print $myrow[7];?></td>
      <td bgcolor="#FFFFFF"><a href="modify-edit.php?id=<?php print $myrow[0];?>">Buy</a></td>
    </tr>
    <?
							$Count++;
						};
					?>
    <tr align="right" bgcolor="#B2C8D8">
      <td colspan="7" bgcolor="#E6E6E6">&nbsp;</td>
      <td align="center" bgcolor="#E6E6E6">&nbsp;</td>
    </tr>
  </table>
  <br>
</form>
