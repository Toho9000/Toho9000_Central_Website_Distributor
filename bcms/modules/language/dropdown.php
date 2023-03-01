<select id="Languages_DropDown" name="LanguagesID" onchange="IW_Jump(this.value)">
<?php
	$rslt=$r->RawQuery("SELECT languages.id,URI,Name FROM languages,content_pages WHERE languages.id=content_pages.languagesID AND HomePage='Yes' AND content_pages.domainsID=".$domain_data['id']);
	while($data=mysql_fetch_array($rslt)){
		$tmp=(LANGUAGESID==$data[0] ? "selected" : "");
		?><option value="<?php print $data[1];?>" <?php print $tmp;?>><?php print $data[2];?></option><?
	}

?>
</select>