<?php
    if(isset($_POST['Submit'])){
        //echo"10-----------------------------------------------------------------------------";

        //-----------------------------------------------------------
        // Create Client Account
        //-----------------------------------------------------------
        if($_POST['contact_name']!=""){
          $client_name=$_POST['contact_name'];
        }else{
          $client_name=$_POST['name'];
        }
        
        $sql="INSERT INTO clients (Name) VALUES  ('".$client_name."')";
        //echo"11-----------------------------------------------------------------------------";
        //print $sql;
        $rslt=$r->RawQuery($sql);
        $Insert_Id=$r->Insert_Id();
        $clientsID=$Insert_Id;
        //-----------------------------------------------------------
        // Create Initial Administer Account
        //-----------------------------------------------------------
        $hash=md5($_POST['UserName'].$_POST['password']);
        $sql="INSERT INTO administrators (name,email,username,password,administratorActive,SU,clientsID,hash) VALUES  ('".$_POST['contact_name']."','".$_POST['email']."'";
        $sql.=",'".$_POST['UserName']."','".$_POST['password']."','0','Yes','".$Insert_Id."','".$hash."')";
        
        //print $sql;
        $rslt=$r->RawQuery($sql);
        //$Insert_Id=$r->Insert_Id();
        //echo"10-----------------------------------------------------------".var_export($r,true)."------------------";
        /*
        if($_POST['domain']==""){
          $_POST['subdomain']=str_replace(" ","-",$client_name);
        }else{
          $_POST['subdomain']=str_replace(" ","-",$_POST['domain']);
        }*/

        //-----------------------------------------------------------
        // Create Initial Website
        //-----------------------------------------------------------
        $sql="INSERT INTO domains (Name,SiteTitle,ClientsID,AEmail,templatesID,serversID)";
        $sql.=" VALUES  ('".$_POST['domain']."','".$_POST['name']."'";
        $sql.=",'".$clientsID."','".$_POST['email']."','20','2')";
        $rslt=$r->RawQuery($sql);
        $domains_id=$r->Insert_Id();
        //-----------------------------------------------------------
        // Create Initial Website Page
        //-----------------------------------------------------------
        //$sql="SELECT * FROM content_pages WHERE HomePage='Yes' AND languagesID=".$_SESSION['LanguagesID']." AND domainsID=".$domain_data['id'];
        $sql="INSERT INTO content_pages (URI,Title,MenuTitle,domainsID,HomePage)";
        $sql.=" VALUES  ('/','New Website','Home','".$domains_id."','Yes')";
        
        $rslt=$r->RawQuery($sql);
        $content_pages_id=$r->Insert_Id();
        //-----------------------------------------------------------
        // Create Initial Website Page Text
        //-----------------------------------------------------------
        $sql="INSERT INTO mod_text (content_pagesID,content_text)";
        $sql.=" VALUES  ('".$content_pages_id."','Under Constructon')";
        
        $rslt=$r->RawQuery($sql);
        
        //-----------------------------------------------------------
        // Create Profile Account
        //-----------------------------------------------------------

        //echo"12-----------------------------------------------------------------------------\n";
        $atd= new AddToDatabase($log);
        //echo"688-----------------------------------------------------------".var_export($r,true)."------------------";
        
       // $atd->Set_Log($log);
        $atd->Set_Database($r);
        //echo"689-----------------------------------------------------------".var_export($r,true)."------------------";
        
        $atd->Set_Vs($vs);
        $atd->AddPosts($_POST,$_FILES);
       // echo"690-----------------------------------------------------------".var_export($r,true)."------------------";
       //echo"13-----------------------------------------------------------------------------\n";
        $atd->AddTable("users");
        //echo"691-----------------------------------------------------------".var_export($r,true)."------------------";
        //echo"134-----------------------------------------------------------------------------\n";
        //$FieldArray=array("clientsID"=>$Insert_Id,"STATUS"=>"New","administratorActive"=>0,"subdomain"=>$_POST['domain']);
        $FieldArray=array("clientsID"=>$Insert_Id,"STATUS"=>"New","subdomain"=>$_POST['domain']);
        //echo"135-----------------------------------------------------------------------------\n";
        $atd->AddExtraFields($FieldArray);
        //echo"136-----------------------------------------------------------------------------\n";
        $atd->DoStuff();
        $NewID=$atd->ReturnID();
        //echo"14----------------------------------------------------------------------------\n-";
        $econtent="\n\n Welcome to iCWLNet website builder. \n";
        $econtent.="You must activate your account. Please follow the below link \n";
        $econtent.="https://sitemanage.info/index.php?hash=".$hash." \n";
        $econtent.="Contact Us: https://creativeweblogic.net \n";
        $to      = $_POST['email'];
        $subject = 'New User Register';
        $message = $econtent;
        $headers = array(
            'From' => 'admin@sitemanage.info',
            'Reply-To' => 'admin@sitemanage.info',
            'X-Mailer' => 'PHP/' . phpversion()
        );
    
        mail($to, $subject, $message, $headers);
        //echo"15-----------------------------------------------------------------------------\n";
      }

?>


Customer Details Recieved.<br>
Please Check Your Email:- <?php print $_POST['email']; ?><br>
To validate your login.<br>
<br>
Your website should be running at:-<br>
<a href='http://<?php print $_GET['LocalServer'];?>'><?php print $_GET['LocalServer'];?></a>
<?php
/*
    print_r($_GET);
    print_r($_POST);
    */
?>
<br><br>
{{message}}


<?php
    //echo"xxx:-".$_POST['domain'];


?>