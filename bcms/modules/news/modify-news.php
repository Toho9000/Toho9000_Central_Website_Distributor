<?php
	
	
	if($_POST['Submit']){
		$m= new UpdateDatabase();
		$m->AddPosts($_POST,$_FILES);
		$m->AddSkip(array("id"));
		$m->AddTable("content_pages");
		$m->AddFunctions(array("Changed"=>"NOW()"));
		$m->AddID($_POST['id']);
		$m->DoStuff();
		$m= new UpdateDatabase();
		$m->AddPosts($_POST,$_FILES);
		$m->AddSkip(array("id"));
		$m->AddTable("mod_news");
		$m->AddID($_POST['id']);
		$m->ChangeAutoInc("content_pagesID");
		$m->DoStuff();
		
		
		$Message="Promotion Updated";
		
		$Simple="Updated promotion from user ".$_SESSION['membersID'];
			foreach($_POST as $key=>$val){
				$Simple.="\n $key=$val";	
			}
			
			
			$m=new SendMail();
			$m->Body($Simple,$Simple);
			$m->To(array("Noodnet Admin"=>"admin@noodnet.com"));
			$m->From("Noodnet Admin Bot","admin@noodnet.com");
			$m->Subject("User has updated promotion");
			$m->Send();
		
		
	};
	
	if($_GET['id']) $id=$_GET['id'];
	elseif ($_POST['id']) $id=$_POST['id'];
	
	
	
	
	$r->AddTable("content_pages");
	$r->AddSearchVar($id);
	$Insert=$r->GetRecord();
	$r->AddTable("mod_news");
	$r->AddSearchVar($id);
	$r->ChangeTarget("content_pagesID");
	$TInsert=$r->GetRecord();
	

?>
<script language="javascript" type="text/javascript" src="/tinymce/jscripts/tiny_mce/tiny_mce_src.js"></script>
<script language="javascript" type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme : "advanced",
		plugins : "table,advhr,advlink,searchreplace,paste,directionality,noneditable,contextmenu,iespell",
		theme_advanced_buttons1_add_before : "",
		theme_advanced_buttons1_add : "fontselect,fontsizeselect",
		theme_advanced_buttons2_add : "separator,forecolor,backcolor,search,replace",
		theme_advanced_buttons2_add_before: "cut,copy,paste,pastetext,pasteword,separator",
		theme_advanced_buttons3_add_before : "tablecontrols,separator",
		theme_advanced_buttons3_add : "advhr,separator,ltr,rtl,iespell",
		
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		content_css : "/templates/noodnet_general/css/general.css",
	    plugin_insertdate_dateFormat : "%Y-%m-%d",
	    plugin_insertdate_timeFormat : "%H:%M:%S",
		extended_valid_elements : "hr[class|width|size|noshade]",
		external_link_list_url : "example_link_list.js",
		external_image_list_url : "example_image_list.js",
		flash_external_list_url : "example_flash_list.js",
		file_browser_callback : "fileBrowserCallBack",
		paste_use_dialog : false,
		theme_advanced_resizing : true,
		theme_advanced_resize_horizontal : false,
		theme_advanced_link_targets : "_something=My somthing;_something2=My somthing2;_something3=My somthing3;"
	});
	
	var FileWindow;
	
	
</script>
<table width="451" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="451">&nbsp;</td>
  </tr>
  <tr>
    <td align="right" valign="top"><form action="<?php print $_SERVER['REQUEST_URI'];?>"  method="post" enctype="multipart/form-data" name="form2" >
      <table width="95%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><span class="RedText"><?php print $Message; ?></span></td>
          <td width="20%" align="right"><a href="/members/view-news/" class="buttonbacklist">Back To List </a></td>
        </tr>
      </table>
      <br>
      <span class="RedText"><strong>*</strong></span><strong> Mandatory Fields </strong>
      <table width="69%" border="0" cellpadding="3" cellspacing="1" id="table" bgcolor="#97C8F9" >
        <tr>
          <td width="229" bgcolor="#E6E6E6" class="tabletitle"><strong>Promotion Title<span class="RedText">*</span></strong></td>
          <td width="270" bgcolor="#FFFFFF" class="tablewhite"><input name="Title" type="text" id="Title" value="<?php print $Insert['Title'];?>" size="50"></td>
        </tr>
        <tr>
          <td bgcolor="#E6E6E6" class="tabletitle"><strong>Heading Description</strong></td>
          <td bgcolor="#FFFFFF" class="tablewhite"><input name="description" type="text" id="description" value="<?php print $TInsert['description'];?>" size="50" maxlength="150" /></td>
        </tr>
        <tr bgcolor="#97C8F9">
          <td bgcolor="#E6E6E6" class="tabletitle"><strong>Type Of Article</strong></td>
          <td bgcolor="#FFFFFF" class="tablewhite"><select name="MNType" id="MNType">
            <option value="Headline" <?=($TInsert['MNType']=="Headline" ? "selected" : "");?>>Headline</option>
            <option value="Article" <?=($TInsert['MNType']=="Article" ? "selected" : "");?>>Article</option>
            <option value="Archive" <?=($TInsert['MNType']=="Archive" ? "selected" : "");?>>Archive</option>
          </select></td>
        </tr>
        <tr bgcolor="#97C8F9">
          <td bgcolor="#E6E6E6" class="tabletitle"><strong>Can Public View</strong></td>
          <td bgcolor="#FFFFFF" class="tablewhite"><select name="NType" id="NType">
            <option value="Public" <?=($TInsert['NType']=="Public" ? "selected" : "");?>>Yes</option>
            <option value="Member" <?=($TInsert['NType']=="Member" ? "selected" : "");?>>No</option>
          </select></td>
        </tr>
        <tr>
          <td colspan="2" bgcolor="#E6E6E6" class="tabletitle"><strong>Content<span class="RedText">*</span></strong></td>
        </tr>
        <tr>
          <td colspan="2" align="center" bgcolor="#FFFFFF" class="tablewhite"><textarea name="content_text" cols="60" rows="20" id="content_text"><?php print $TInsert['content_text'];?>
                </textarea></td>
        </tr>
      </table>
      <input name="Submit" type="submit"  class="formbuttons" id="Submit3" value="Save" onClick="return confirmSubmit()">
      <input name="id" type="hidden" id="id" value="<?php print $id; ?>">
    </form></td>
  </tr>
</table>
