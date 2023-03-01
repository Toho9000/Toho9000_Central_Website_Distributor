<?
	if($_POST['Submit']){
		error_reporting(E_ALL);
		if(($_POST['URI']=="")||($_POST['URI']=="/news-item/example-page-address/")){
			$_POST['URI']="/news-item/".urlencode(eregi_replace(" ","-",$_POST['Title']))."/";
		}
		if($_POST['Meta_Title']=="") $_POST['Meta_Title']=$_POST['Title'];
		$m= new AddToDatabase();
		$m->AddPosts($_POST,$_FILES);
		$m->AddTable("content_pages");
		$m->AddExtraFields(array("languagesID"=>$app_data['LANGUAGESID']));
		$m->AddExtraFields(array("domainsID"=>$domain_data['id']));
		$m->AddExtraFields(array("templatesID"=>4));
		$m->AddExtraFields(array("module_viewsID"=>441));
		$m->AddExtraFields(array("Menu_Hide"=>"Yes"));
		
		
		if($_FILES['CSVFile']['name']){
			
			include("classes/csv/csv_reader.php");
			$read     =     new CSV_Reader;
			$read->strFilePath     =     $_FILES['CSVFile']['tmp_name'];
			$read->strOutPutMode   =     0;  // 1 will show as HTML 0 will return an array
			$read->setDefaultConfiguration();
			$read->readTheCsv();
			$_POST['content_text'].="<br><br><br>".$read->showTemplate();		/*	*/
		}
		
		
		
		$m->AddFunctions(array("Changed"=>"NOW()"));
		$m->DoStuff();
		$NewID=$m->ReturnID();
		$m= new AddToDatabase();
		$m->AddPosts($_POST,$_FILES);
		$m->AddTable("mod_news");
		$m->AddExtraFields(array("usersID"=>$_SESSION['membersID']));
		//$m->AddExtraFields(array("MNType"=>"Member"));
		$m->AddExtraFields(array("content_pagesID"=>$NewID));
		$m->DoStuff();
		
		$Simple="New promotion from user ".$_SESSION['membersID'];
			foreach($_POST as $key=>$val){
				$Simple.="\n $key=$val";	
			}
			
			
			$m=new SendMail();
			$m->Body($Simple,$Simple);
			$m->To(array("Noodnet Admin"=>"admin@noodnet.com"));
			$m->From("Noodnet Admin Bot","admin@noodnet.com");
			$m->Subject("User has created promotion");
			$m->Send();
		
		$Message="Promotion Added";
	};

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
<table width="399" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="399">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top"><form action="<?php print $_SERVER['REQUEST_URI'];?>"  method="post" enctype="multipart/form-data" name="form2"  >
      <table width="95%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><span class="RedText"><?php print $Message; ?></span></td>
          <td width="20%" align="right"><a href="/members/view-news/" class="buttonbacklist">Back To List </a></td>
        </tr>
      </table>
      <br>
      <span class="RedText"><strong>*</strong></span><strong> Mandatory Fields </strong>
      <table width="75%" border="0" cellpadding="3" cellspacing="1"  bgcolor="#97C8F9" id="table">
        <tr>
          <td width="201" bgcolor="#E6E6E6" class="tabletitle"><strong>News Title<span class="RedText">*</span></strong></td>
          <td width="270" bgcolor="#FFFFFF" class="tablewhite"><input name="Title" type="text" id="Title" value="Example News Item Title" size="50" onClick="ClearText(this)"></td>
        </tr>
        <tr>
          <td bgcolor="#E6E6E6" class="tabletitle"><strong>Heading Description</strong></td>
          <td bgcolor="#FFFFFF" class="tablewhite"><input name="description" type="text" id="description" value="" size="50" maxlength="150" /></td>
        </tr>
        <tr>
          <td bgcolor="#E6E6E6" class="tabletitle"><strong>Type Of Article</strong></td>
          <td bgcolor="#FFFFFF" class="tablewhite"><select name="MNType" id="MNType">
            <option value="Headline">Headline</option>
            <option value="Article">Article</option>
            <option value="Archive">Archive</option>
          </select></td>
        </tr>
        <tr>
          <td bgcolor="#E6E6E6" class="tabletitle"><strong>Can Public View</strong></td>
          <td bgcolor="#FFFFFF" class="tablewhite"><select name="NType" id="NType">
            <option value="Public">Yes</option>
            <option value="Member">No</option>
          </select></td>
        </tr>
        <tr>
          <td bgcolor="#E6E6E6" class="tabletitle"><strong>Specials CSV Upload</strong></td>
          <td bgcolor="#FFFFFF" class="tablewhite"><input type="file" name="CSVFile" id="CSVFile" /></td>
        </tr>
        <tr>
          <td colspan="2" bgcolor="#E6E6E6" class="tabletitle"><strong>Content<span class="RedText">*</span></strong></td>
        </tr>
        <tr>
          <td colspan="2" align="center" bgcolor="#FFFFFF" class="tablewhite"><textarea name="content_text" cols="60" rows="20" id="content_text"></textarea></td>
        </tr>
        <tr>
          <td colspan="2" align="right" bgcolor="#E6E6E6" class="tablewhite"><input name="Submit" type="submit"  class="formbuttons" id="Submit" value="Save" onclick="return confirmSubmit()" /></td>
        </tr>
      </table>
    </form></td>
  </tr>
</table>
