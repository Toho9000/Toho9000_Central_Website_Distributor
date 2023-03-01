<?php


    //echo"db-file-0-------------------|-666-|----------------------------------------------------------\n\n";
			
    $DB=array();
    //$DB['server_type']="pgSQL";
    $DB['server_type']="MySQL";
    //$DB['server_type'] = "Sqlite";
		
    if($DB['server_type']=="MySQL"){
        /*
        $DB['server_tag']="db-default.php";
        $DB['server_desc']="Private Server";
        $DB['current_dir']="/var/www/html";
        $DB['server_number']=4;
        $DB['hostname']="localhost";
        $DB['usernamedb']="Edit This";
        $DB['passworddb']="Edit This";
        $DB['dbName']="bubblelite2";
        
        $DB['server_tag']="db-w-d.php";
        $DB['server_desc']="Cloud Server";
        $DB['current_dir']="/home1/cwy0ek0e/public_html";
        $DB['server_number']=1;
        $DB['hostname']="localhost";
        $DB['usernamedb']='cwy0ek0e_bubblel';
        $DB['passworddb']='DickSux5841';
        $DB['dbName']='cwy0ek0e_bubblelite2';
        $DB['dbNames']=array('cwy0ek0e_bubblelite2','cwy0ek0e_takebookings','cwy0ek0e_partnerspro','cwy0ek0e_smsg');
        */
        $DB['server_tag']="db-localhost.php";
        $DB['server_desc']="Xampp Localhost";
        $DB['current_dir']="D:\Documents\Projects\Easy Bubble CMS\GitHub\iCWLNet_Central_Administration";
        $DB['server_number']=0;
        $DB['hostname']="localhost";
        $DB['usernamedb']='cwy0ek0e_bubblel';
        $DB['passworddb']='DickSux5841';
        $DB['dbName']='bubblelite2';
        //$DB['dbNames']=array('cwy0ek0e_bubblelite2','cwy0ek0e_takebookings','cwy0ek0e_partnerspro','cwy0ek0e_smsg');
        
    }
    

    if($DB['server_type']=="pgSQL"){
        $DB['server_tag']="db-pgSQL.php";
        $DB['server_desc']="pgSQL";
        $DB['current_dir']="/var/www/html";
        $DB['server_number']=2;
        $DB['hostname']="localhost";
        $DB['usernamedb']="postgres";
        $DB['passworddb']="DickSux5841";
        $DB['dbName']="cwy0ek0e_bubblelite2";
    }


    if($DB['server_type'] == "Sqlite") {
        $DB['server_tag'] = "db-sqlite3.php";
        $DB['server_desc'] = "Sqlite3";
        $DB['current_dir'] = "/var/www/html";
        $DB['server_number'] = 2;
        $DB['hostname'] = "none";
        $DB['usernamedb'] = "none";
        $DB['passworddb'] = "none";
        $DB['dbName'] = './db/bubblelite.db';
    }

    $DB['dbNames']=array($DB['dbName']);

    $server_DB=array('current_db_type'=>$DB['server_type'],'server_tag'=>$DB['server_tag'],'server_desc'=>$DB['server_desc']
    ,'current_dir'=>$DB['current_dir'],'server_number'=>$DB['server_number'],
    'hostname'=>$DB['hostname'],'usernamedb'=>$DB['usernamedb'],'passworddb'=>$DB['passworddb'],
    'dbName'=>$DB['dbName'],'dbNames'=>$DB['dbNames']);

    $server_login[$DB['server_tag']]=$server_DB;
    //echo"db-file-9-------------------|-".var_export($server_login,true)."-|----------------------------------------------------------\n\n";
	
?>