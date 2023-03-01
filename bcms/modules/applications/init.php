<?
    $log->general("za Apps->".$_SERVER['REQUEST_URI'],1); 
    $sql="SELECT id,Name,Base_Dir FROM applications WHERE id='".$domain_data['applicationsID']."' LIMIT 0,1";
    $log->general("Loading Applications->".$sql,1);
    $rslt2=$r->RawQuery($sql);
    $data=$r->Fetch_Array($rslt2);
    //print_r($myrow);
    //flush();
    $app_data['APPLICATIONSBASEDIR']=$app_data['APPLICATIONSDIR'].$data[2];
    $log->general("gg Apps Dir->".$app_data['APPLICATIONSBASEDIR']."/includes/header.php",1);
    $log->general("Application Found->".var_export($data,true),1);
    if($data[0]!=0){
        $server_file=$app_data['APPLICATIONSBASEDIR'].$_SERVER['REQUEST_URI'];
        $log->general("zb Apps->".$server_file,1);
        //print $server_file;
        if(substr($server_file, -4, 4)=='.php'){
            $log->general("xx Application File Include->".$server_file,1);
            include($server_file);
            $log->display_all();
	        ob_end_flush();
            exit();

        }else{
            
           
            if(file_exists($server_file)){
                $log->general("dd Application Failure->".$server_file,1);
                //$ContType=exec("file -bi '$server_file'");
                //header("Content-Type: $server_file");
                //print file_get_contents($server_file);
                $fstring="/".$server_file;
                /*
                $urr=explode("/",$_SERVER['REQUEST_URI']);
                for($x=2;$x<=count($urr);$x++){
                    $fstring.="/".$urr[$x];
                }
                */
                $log->general("yy Application Images->".$fstring,1);
                header('Location: '.$fstring);
                
                //$log->display_all();
                ob_end_flush();
                exit();
            }else{
                $log->general("gg Application Failure->".$server_file,1);
            }
        }
        
        /*
        if(file_exists($server_file)){
            $log->general("Application File Include->".$server_file,1);
            include($server_file);
            exit();
        };
        */
    }
?>