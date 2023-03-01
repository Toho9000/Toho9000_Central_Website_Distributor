<?
	if(isset($_SESSION['membersID'])){
		$MPText=($_SESSION['membersID'] ? "Member" : "Public");
	}else{
		$MPText="Public";
	}
	$rslt=$r->RawQuery("SELECT Title,URI,description FROM content_pages,mod_news WHERE content_pages.id=mod_news.content_pagesID AND NType='$MPText' AND languagesID=".LANGUAGESID." AND usersID=0 AND domainsID=".$domain_data['id']);
	while($news_items["db"]=$r->Fetch_Assoc($rslt)){
		?>
        	<a href="http://<?=DOMAINNAME.$news_items["db"]['URI'];?>"><strong><?php print $news_items["db"]['Title'];?></strong></a><br />

			<?=substr(strip_tags($news_items["db"]['description']),0,150);?>.. <a href="http://<?php print $domain_data['Name'].$news_items["db"]['URI'];?>">more</a>
            <br /><br /><div align="center"><hr /></div><br /><br />
            
		<?
	}
?>