<?
    //print_r($_POST);
    //putenv('PATH=/usr/bin');
    //echo substr(sprintf('%o', fileperms('/usr/bin/certbot')), -4);
    //print "<br>";
    $domain="";
    if(isset($_POST['Submit'])){
        //echo "bb1";
        if(isset($_POST['domain'])){
            $domain=$_POST['domain'];
        }
        /*
        print $domain."<br>";
        //$server_commands="sudo certbot -d ".$domain." --manual --preferred-challenges dns certonly";
        $server_commands=" certbot --version ";
        //$server_commands="ls -l /usr/bin/certbot";
       // $server_commands="find -name certbot";
       //$server_commands="/usr/bin/certbot certonly";
        print $server_commands."<br>";
        exec($server_commands, $output, $retval);
        //$output = shell_exec($server_commands);
        print_r($output);
        print "<br>".$retval;
        
        $descriptorspec = array(
            0 => array("pipe", "r"),  // stdin is a pipe that the child will read from
            1 => array("pipe", "w"),  // stdout is a pipe that the child will write to
            2 => array("file", "./error-output.txt", "a") // stderr is a file to write to
         );
         
         $cwd = 'null';
         $env = array('some_option' => 'c');
         
         $process = proc_open('certbot certonly', $descriptorspec, $pipes, $cwd, $env);
         
         if (is_resource($process)) {
             // $pipes now looks like this:
             // 0 => writeable handle connected to child stdin
             // 1 => readable handle connected to child stdout
             // Any error output will be appended to /tmp/error-output.txt
         
             fwrite($pipes[0], 'c');
             fclose($pipes[0]);
         
             echo stream_get_contents($pipes[1]);
             fclose($pipes[1]);
         
             // It is important that you close any pipes before calling
             // proc_close in order to avoid a deadlock
             $return_value = proc_close($process);
         
             echo "command returned $return_value\n";
         }
         */
    }else{
        //echo "bb2";
        //print_r($_REQUEST);
    }

?>