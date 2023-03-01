<?
	$log->general("News Items",1);
	if(!isset($news_data['usersID'])){
		$news_data['usersID']=false;
	}
	if(!isset($domain_user_data['id'])){
		$domain_user_data['id']=false;
	}	
	if($news_data['usersID']||$domain_user_data['id']){

?>
<script>
SHTextSpan[0]="ShowHideArticles";
SHPrefix[0]="SHPRow";
SHHiddenText[0]="Show Articles";
SHVisibleText[0]="Show Archives";
SHRowCount[0]=1;

SHTextSpan[1]="ShowHideArchives";
SHPrefix[1]="SHARow";
SHHiddenText[1]="&nbsp;";
SHVisibleText[1]="&nbsp;&nbsp;";
SHRowCount[1]=1;

	function SwitchArticleTypes(){
		ShowHide(1);
		ShowHide(0);
		/*
		var t1=document.getElementById("SHPRow0");
		var t2=document.getElementById("SHARow0");
		if(t1.style.display=="none"){
			t1.style.display="";
			t2.style.display="none";
		}else{
			t2.style.display="";
			t1.style.display="none";
		}
		*/
	}

</script>
<div align="center">
<a href="javascript:SwitchArticleTypes();"><span id="ShowHideArticles">Show Articles</span></a><span id="ShowHideArchives">&nbsp;&nbsp;</span>
<br /><br />

</div>
<div id="SHPRow0" style="display:none">
<?
		
	};
	$NType="";
	if(isset($domain_user_data['id'])){
		if($domain_user_data['id']){ // if on users subdomain
			$NMemID=$domain_user_data['id'];
			$NType=" AND NType='Public' "; // show public articles only
			// use domain client id and show headline and articles, if on news item page hide that article
			$NUSText=" AND usersID=$NMemID AND (MNType='Headline' OR MNType='Article')".($news_data['usersID'] ? " AND mod_news.id<>$news_data[id] ":""); 
			// show noodnet main news
			//include("modules/news/list-admin-news.php");
		}elseif($news_data['usersID']){ // if on news item page not on sub domain
			$NMemID=$news_data['usersID'];//use users id of news item
			// use news item users id and show headline and articles, hide current article
			$NUSText=" AND usersID=$NMemID AND (MNType='Headline' OR MNType='Article')  AND mod_news.id<>$news_data[id]";
			$NType="";
			
		}else{// if on member homepage or buy page
			$NUSText=" AND usersID<>0 AND MNType='Headline' ";
		}
	}elseif(isset($news_data['usersID'])){ // if on news item page not on sub domain
			$NMemID=$news_data['usersID'];//use users id of news item
			// use news item users id and show headline and articles, hide current article
			$NUSText=" AND usersID=$NMemID AND (MNType='Headline' OR MNType='Article')  AND mod_news.id<>$news_data[id]";
			$NType="";
			
	}else{
		$NUSText=" AND usersID<>0 AND MNType='Headline' ";
		$NType="";
	}
	include($app_data['APPBASEDIR']."modules/news/list-admin-news.php");	
		
	$sql="SELECT Title,URI,description FROM content_pages,mod_news WHERE content_pages.id=mod_news.content_pagesID  AND languagesID=".LANGUAGESID." $NUSText AND Approved='Yes' AND domainsID=".$domain_data['id']." $NType ORDER BY SOrder,mod_news.id DESC";
	//print $sql;
	$rslt=$r->RawQuery($sql);
	while($news_items["db"]=$r->Fetch_Assoc($rslt)){
		?>
        	<a href="http://<?=TOTALDOMAINNAME.$news_items["db"]['URI'];?>"><strong><?php print $news_items["db"]['Title'];?></strong></a><br />

			<?=substr(strip_tags($news_items["db"]['description']),0,150);?>.. <a href="http://<?=TOTALDOMAINNAME.$news_items["db"]['URI'];?>">more</a>
            <br /><br /><div align="center"><hr /></div><br /><br />
            
		<?
	}
	if(isset($news_data['usersID'])){
		if($news_data['usersID']||$domain_user_data['id']){ // if on a news article page
?>
</div>
<div id="SHARow0" style="display:none">
	<?
        if(!$news_data['id']) $news_data['id']=0;//on homepage
		$sql="SELECT Title,URI,description FROM content_pages,mod_news WHERE content_pages.id=mod_news.content_pagesID  AND languagesID=".LANGUAGESID."  AND MNType='Archive' AND usersID=$NMemID AND mod_news.id<>$news_data[id] AND Approved='Yes' AND domainsID=".$domain_data['id']." $NType ORDER BY SOrder,mod_news.id DESC";
        //print $sql;
        $rslt=$r->RawQuery($sql);
		if($r->NumRows($rslt)==0){
			?>
            	Sorry! No Archived Articles Available.
            <?
		}else{
			while($news_items["db"]=$r->Fetch_Assoc($rslt)){
				?>
					<a href="http://<?=TOTALDOMAINNAME.$news_items['URI'];?>"><strong><?php print $news_items['Title'];?></strong></a><br />
		
					<?=substr(strip_tags($news_items["db"]['description']),0,150);?>.. <a href="http://<?=TOTALDOMAINNAME.$news_items["db"]['URI'];?>">more</a>
					<br /><br /><div align="center"><hr /></div><br /><br />
					
				<?
			}
		}
    ?>
</div>
<script>
<?
	if($news_data['MNType']=='Archive'){
		?>
			ShowHide(1);
		<?
	}else{
		?>
			ShowHide(0);
		<?
	}
	
?>
</script>
<?
		};
	};
?>