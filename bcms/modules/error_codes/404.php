404 error, file not found.

<?php
    $url_text="";
    
    $site_map_page_data=array();
    $site_map_domain_data=array();
    if(count($DomainVariableArray)==0){
        if(isset($domain_data["db"]['id'])){
            $sql="SELECT * FROM content_pages WHERE (Exposure='Public' OR Exposure='Both') AND domainsID=".$domain_data["db"]['id'];
            //print $sql;
            $rslt=$r->RawQuery($sql);
            $num_rows=$r->NumRows($rslt);
            if($num_rows>0){
                while($content_pages["db"]=$r->Fetch_Assoc()){
                    $site_map_page_data["db"][]=$content_pages["db"];
                };
            }
        }else{
            //echo "domain not found";
        }
    }else{
        if(isset($domain_data["db"]['id'])){
            $sql="SELECT * FROM domains WHERE Name LIKE '%".$domain_data["db"]['Name']."'";
            //print $sql;
            $rslt=$r->RawQuery($sql);
            $num_rows=$r->NumRows($rslt);
            if($num_rows>0){
                while($domain_info=$r->Fetch_Assoc()){
                    $site_map_domain_data["db"][]=$domain_info;
                };
            }
        }else{
            //echo "domain not found";
        }
    }
    
	
    
    //print_r($site_map_page_data);

	if(count($site_map_page_data["db"])>0){
        $url_text="<br><br><h2>Pages on site: ".$domain_data["db"]['name']."</h2><br>";
        foreach($site_map_page_data["db"] as $key=>$val){
            $url="http://".$domain_data["db"]['name'].$val['uri'];
            $url_text.="<a href='".$url."'>".$url." -> ".$val['Title']."</a><br>\n";
        }
    }elseif(count($site_map_domain_data["db"])>0){
        $url_text="<br><br><h2>Domains referenced on site: ".$domain_data["db"]['name']."</h2><br>";
        foreach($site_map_domain_data["db"] as $key=>$val){
            $url="http://".$val['name'];
            $url_text.="<a href='".$url."'>".$url." -> ".$val['sitetitle']."</a><br>\n";
        }
    }
    
    echo $url_text;

?>