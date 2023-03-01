<?
	$user = "icwl0738";
    $token = "8FZ5OAJ05NVTV2NG5JV67U6OBGM3B27H";
    //$host="127.0.0.1";
    $host="secure.icwl.me";
    //$query = "https://".$host.":2087/json-api/listaccts?api.version=1";
    $query = "https://".$host.":2087/json-api/listpkgs?api.version=1";
    //echo"xx";
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);

    $header[0] = "Authorization: whm $user:$token";
    curl_setopt($curl,CURLOPT_HTTPHEADER,$header);
    curl_setopt($curl, CURLOPT_URL, $query);

    $result = curl_exec($curl);
    $packagelist=Array();
    $packagesuper=Array();
    $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if ($http_status != 200) {
        echo "[!] Error: " . $http_status . " returned\n";
    } else {
        $json = json_decode($result);
        //echo "[+] Current Packages:\n";
        $pcount=0;
        $scount=0;
        foreach ($json->{'data'}->{'pkg'} as $packages) {
            //echo "\t" . $packages->{'name'} . "\n";
            $name=explode("_",$packages->{'name'});
            $name=$name[1];
            //print $packages->{'BWLIMIT'};
            if($name!="default"){
                if($packages->{'MAXADDON'}=="unlimited"){
                    $packagesuper[$scount]["name"]=$name;
                    $packagesuper[$scount]["bandwidth"]=$packages->{'BWLIMIT'};
                    $packagesuper[$scount]["ssh"]=$packages->{'HASSHELL'};
                    $packagesuper[$scount]["max_domains"]=$packages->{'MAXADDON'};
                    $packagesuper[$scount]["max_databases"]=$packages->{'MAXSQL'};
                    $packagesuper[$scount]["max_subdomains"]=$packages->{'MAXSUB'};
                    $packagesuper[$scount]["max_disk_space"]=$packages->{'QUOTA'};
                    $scount++;
                }else{
                    $packagelist[$pcount]["name"]=$name;
                    $packagelist[$pcount]["bandwidth"]=$packages->{'BWLIMIT'};
                    $packagelist[$pcount]["ssh"]=$packages->{'HASSHELL'};
                    $packagelist[$pcount]["max_domains"]=$packages->{'MAXADDON'};
                    $packagelist[$pcount]["max_databases"]=$packages->{'MAXSQL'};
                    $packagelist[$pcount]["max_subdomains"]=$packages->{'MAXSUB'};
                    $packagelist[$pcount]["max_disk_space"]=$packages->{'QUOTA'};
                    $pcount++;
                }
            }
        }
    }

    curl_close($curl);
    function cmp($a, $b)
    {
        $a["bandwidth"]=(int)$a["bandwidth"];
        $b["bandwidth"]=(int)$b["bandwidth"];
        return ($a["bandwidth"]>$b["bandwidth"]);
    }
    usort($packagesuper, "cmp");
    usort($packagelist, "cmp");

?>