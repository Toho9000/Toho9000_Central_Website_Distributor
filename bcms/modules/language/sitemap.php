<?php
	$rslt=$r->RawQuery("SELECT Name,URI FROM languages,content_pages WHERE languages.id=content_pages.languagesID AND HomePage='Yes' AND content_pages.domainsID=".DOMAINSID);
	while($data=mysql_fetch_array($rslt)){
		?><a href="<?php print $data[1];?>"> <?php print $data[0];?></a> | <?
	}

?>