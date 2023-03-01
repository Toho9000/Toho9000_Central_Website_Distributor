<?php
	
	
	if($_POST['Delete']=="Delete"){
		if(is_array($_POST['DFiles'])){
			$m= new DeleteFromDatabase();
			$m->AddIDArray($_POST['DFiles']);
			$m->AddTable("content_pages");
			$Errors=$m->DoDelete();
			if($Errors==""){
				$Message="Promo Deleted";
			}else{
				$Message=$Errors;
			};
		}else{
			$Message="No Promos Selected To Delete";
		};
	};
	
	
?>
<table width="650" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="right"><a href="/members/add-news/">Add New News Item</a></td>
  </tr>
  <tr>
    <td><form action="<?php print $_SERVER['REQUEST_URI'];?>"  method="post" name="form2" >
      <span class="RedText"><?php print $Message; ?></span><br>
      <br>
      <table width="100%" border="0" cellpadding="3" cellspacing="1"  bgcolor="#97C8F9" id="table">
        <tr bgcolor="#363E57" id="tablecell">
          <td bgcolor="#E6E6E6" class="tabletitle">Title</td>
          <td width="8%" align="center" bgcolor="#E6E6E6" class="tabletitle">Modify</td>
          <td width="9%" align="center" bgcolor="#E6E6E6" class="tabletitle">Delete</td>
        </tr>
        <?php
					  	$Count=0;
					 	$r=new ReturnRecord();
						$sql="SELECT content_pages.id,URI,content_pages.Title,NType FROM content_pages,mod_news WHERE content_pages.id=mod_news.content_pagesID AND usersID=$_SESSION[membersID] AND module_viewsID=441";
						//print $sql;
						$sq2=$r->rawQuery($sql);  
						while ($myrow = $r->Fetch_Array($sq2)) {
						?>
        <tr class="<?=(($Count%2)==0 ? "row1" : "row2"); ?>">
          <td bgcolor="#FFFFFF"><?php print $myrow[2];?></td>
          <td align="center"  bgcolor="#FFFFFF"><a href="/members/modify-news/?id=<?php print $myrow[0];?>">modify</a></td>
          <td bgcolor="#FFFFFF"><div align="center">
            <input type="checkbox" name="DFiles[]" value="<?php print $myrow[0];?>">
          </div></td>
        </tr>
        <?
							$Count++;
						};
					?>
        <tr align="right" bgcolor="#B2C8D8">
          <td colspan="2" bgcolor="#E6E6E6">&nbsp;</td>
          <td align="center" bgcolor="#E6E6E6"><input name="Delete" type="submit" class="formbuttons" id="Delete" value="Delete" onClick="return confirmSubmit()"></td>
        </tr>
      </table>
      <br>
    </form></td>
  </tr>
</table>
