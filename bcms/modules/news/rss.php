<?
	
	//error_reporting(E_All);
	require("classes/rss/rss_generator.inc.php");

	if($domain_user_data['id']){
		$NMemID=$domain_user_data['id'];
		
		$r->AddTable("users");
		$r->AddSearchVar($NMemID);
		$Memb=$r->GetRecord();
		$rss_channel = new rssGenerator_channel();
		$rss_channel->atomLinkHref = '';
		$rss_channel->title = $Memb['name'].' News on Noodnet.com';
		$rss_channel->link = 'http://'.TOTALDOMAINNAME;
		$rss_channel->description = 'Medical and Pharmacutical News';
		$rss_channel->language = 'en-us';
		$rss_channel->generator = 'Noodnet Feed Generator';
		$rss_channel->managingEditor = 'john.marshall@noodnet.com';
		$rss_channel->webMaster = 'dan@managewebsites.com.au';
	}else{
		$NMemID=0;
		$rss_channel = new rssGenerator_channel();
		$rss_channel->atomLinkHref = '';
		$rss_channel->title = 'Nood News';
		$rss_channel->link = 'http://'.TOTALDOMAINNAME;
		$rss_channel->description = 'Medical and Pharmacutical News';
		$rss_channel->language = 'en-us';
		$rss_channel->generator = 'Noodnet Feed Generator';
		$rss_channel->managingEditor = 'john.marshall@noodnet.com';
		$rss_channel->webMaster = 'dan@managewebsites.com.au';
	}

	
  
  	
  
		
	
		
	$sql="SELECT Title,URI,content_text,Changed FROM content_pages,mod_news WHERE content_pages.id=mod_news.content_pagesID AND NType='Public' AND usersID='$NMemID' AND Approved='Yes' ORDER BY SOrder,mod_news.id DESC";
	//print $sql;
	$rslt=$r->RawQuery($sql);
	while($news_items=$r->Fetch_Assoc($rslt)){
		
		$item = new rssGenerator_item();
		$item->title = $news_items['Title'];
		$item->description = substr(html_entity_decode(xstrip_tags($news_items['content_text']),0,150));
		$item->link = "http://".$_SERVER['HTTP_HOST'].$news_items['URI'];
		$item->guid = "http://".$_SERVER['HTTP_HOST'].$news_items['URI'];
		$item->pubDate = $news_items['Changed'];
		$rss_channel->items[] = $item;		
		
	}
	
	$rss_feed = new rssGenerator_rss();
	$rss_feed->encoding = 'UTF-8';
	$rss_feed->version = '2.0';
	header('Content-Type: text/xml');
	echo $rss_feed->createFeed($rss_channel);
?>