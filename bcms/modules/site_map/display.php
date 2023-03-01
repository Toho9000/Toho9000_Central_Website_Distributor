
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"><?php
    /*
    print_r($site_map_page_data);
	if(count($site_map_page_data)>0){
        foreach($site_map_page_data as $key=>$val){
        $link="<a href='".$val['URI']."'>".$val['URI']." - ".$val['Title']."</a><br>";
            echo $link;
        }
    }
    */

    $site_map_page_data=array();
	$sql="SELECT * FROM content_pages WHERE (Exposure='Public' OR Exposure='Both') AND domainsID=".$domain_data['id'];
	//print $sql;
	$rslt=$r->RawQuery($sql);
	$num_rows=$r->NumRows($rslt);
	if($num_rows>0){
		while($content_data["db"]=$r->Fetch_Assoc()){
			$site_map_page_data["db"][]=$content_data["db"];
		};
	}

	/*
	$sql="SELECT * FROM content_pages WHERE domainsID=0";
	//print $sql;
	$rslt=$r->RawQuery($sql);
	$num_rows=$r->NumRows($rslt);
	if($num_rows>0){
		while($content_data=$r->Fetch_Assoc()){
			$site_map_page_data[]=$content_data["db"];
		};
	}
    */
    $url_text="";
    //print_r($site_map_page_data);
	if(count($site_map_page_data)>0){
        foreach($site_map_page_data as $key=>$val){
            //$link="<a href='".$val['URI']."'>".$val['URI']." - ".$val['Title']."</a><br>";
            $url_text.="\n<url>\n";
            $url="http://".$domain_data['Name'].$val['URI'];
            
            $url_text.="<loc>".$url."</loc>\n";
            $url_text.="<lastmod>".$val['Changed']."</lastmod>\n";
            $url_text.="<changefreq>monthly</changefreq>\n";
            $url_text.="<priority>0.8</priority>\n";
            $url_text.="</url>\n";
            //print $url_text;
            //echo $link;
        }
    }
    echo $url_text;
?></urlset>