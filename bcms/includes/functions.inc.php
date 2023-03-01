<?php

    function is_base64($str){
         if($str === base64_encode(base64_decode($str))){
             return true;
         }
         return false;
     }    


function exceptions_error_handler($severity, $message, $filename, $lineno) {
    throw new ErrorException($message, 0, $severity, $filename, $lineno);
}

//set_error_handler('exceptions_error_handler');

function strip_capitals($var_array=array()){
	$output_array=array();
	foreach($var_array as $key=>$val){
		$key=strtolower($key);
		$output_array[$key]=$val;
	}
	$output_array= array_merge($output_array, $var_array);

	return $output_array;
}

function dirify($text)
{
	$text=strtolower($text);
	$code_entities_match = array(' ','--','&quot;','!','@','#','$','%','^','&','*','(',')','_','+','{','}','|',':','"','<','>','?','[',']','\\',';',"'",',','.','*','+','~','`','=');
	$code_entities_replace = array('-','-','','','','','','','','','','','','','','','','','','','','','','','');
	$text = str_replace($code_entities_match, $code_entities_replace, $text);
	return $text;
} 
/*
function dirify($s) {
     $s = convert_high_ascii($s);  ## convert high-ASCII chars to 7bit.
     $s = strtolower($s);           ## lower-case.
     $s = strip_tags($s);       ## remove HTML tags.
     $s = preg_replace('!&[^;\s]+;!','',$s);         ## remove HTML entities.
     $s = preg_replace('![^\w\s.]!','',$s);           ## remove non-word/space/period chars.
     $s = preg_replace('!\s+!','-',$s);               ## change space chars to dashes.
     return $s;    
}
*/
function convert_high_ascii($s) {
 	$HighASCII = array(
 		"!\xc0!" => 'A',    # A`
 		"!\xe0!" => 'a',    # a`
 		"!\xc1!" => 'A',    # A'
 		"!\xe1!" => 'a',    # a'
 		"!\xc2!" => 'A',    # A^
 		"!\xe2!" => 'a',    # a^
 		"!\xc4!" => 'Ae',   # A:
 		"!\xe4!" => 'ae',   # a:
 		"!\xc3!" => 'A',    # A~
 		"!\xe3!" => 'a',    # a~
 		"!\xc8!" => 'E',    # E`
 		"!\xe8!" => 'e',    # e`
 		"!\xc9!" => 'E',    # E'
 		"!\xe9!" => 'e',    # e'
 		"!\xca!" => 'E',    # E^
 		"!\xea!" => 'e',    # e^
 		"!\xcb!" => 'Ee',   # E:
 		"!\xeb!" => 'ee',   # e:
 		"!\xcc!" => 'I',    # I`
 		"!\xec!" => 'i',    # i`
 		"!\xcd!" => 'I',    # I'
 		"!\xed!" => 'i',    # i'
 		"!\xce!" => 'I',    # I^
 		"!\xee!" => 'i',    # i^
 		"!\xcf!" => 'Ie',   # I:
 		"!\xef!" => 'ie',   # i:
 		"!\xd2!" => 'O',    # O`
 		"!\xf2!" => 'o',    # o`
 		"!\xd3!" => 'O',    # O'
 		"!\xf3!" => 'o',    # o'
 		"!\xd4!" => 'O',    # O^
 		"!\xf4!" => 'o',    # o^
 		"!\xd6!" => 'Oe',   # O:
 		"!\xf6!" => 'oe',   # o:
 		"!\xd5!" => 'O',    # O~
 		"!\xf5!" => 'o',    # o~
 		"!\xd8!" => 'Oe',   # O/
 		"!\xf8!" => 'oe',   # o/
 		"!\xd9!" => 'U',    # U`
 		"!\xf9!" => 'u',    # u`
 		"!\xda!" => 'U',    # U'
 		"!\xfa!" => 'u',    # u'
 		"!\xdb!" => 'U',    # U^
 		"!\xfb!" => 'u',    # u^
 		"!\xdc!" => 'Ue',   # U:
 		"!\xfc!" => 'ue',   # u:
 		"!\xc7!" => 'C',    # ,C
 		"!\xe7!" => 'c',    # ,c
 		"!\xd1!" => 'N',    # N~
 		"!\xf1!" => 'n',    # n~
 		"!\xdf!" => 'ss'
 	);
 	$find = array_keys($HighASCII);
 	$replace = array_values($HighASCII);
 	$s = preg_replace($find,$replace,$s);
     return $s;
}
//echo"xxx";
function GetModulesPermissions(){
	//echo"yyy";
	//$r=new ReturnRecord();
    global $r;
	$RetArr=array();
	$sql="SELECT modulesID FROM domains_modules WHERE domainsID=$_SESSION[domainsID]";
	//print $sql;
	$rslt=$r->RawQuery($sql);
	while($myrow=$r->Fetch_Array()){
		$RetArr[]=$myrow[0];
	}	
	return $RetArr;
}

// Connecting, selecting database
/*
function test_pgsql(){
	
	$dbconn = pg_connect("host=localhost dbname=cwy0ek0e_bubblelite2 user=postgres password=DickSux5841")
    or die('Could not connect: ' . pg_last_error());
	
	// Performing SQL query
	$query = 'SELECT * FROM administrators';
	echo"43210000101-------------------|-".$query."-|----------------------------------------------------------\n\n";
	
	$result = pg_query($query);// or die('Query failed: ' . pg_last_error());
	echo $query;
	echo"432100001-------------------|-".$query."-|----------------------------------------------------------\n\n";
	// Printing results in HTML
	echo "<table>\n";
	while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
		echo "\t<tr>\n";
		foreach ($line as $col_value) {
			echo "\t\t<td>$col_value</td>\n";
		}
		echo "\t</tr>\n";
	}
	echo "</table>\n";

	// Free resultset
	pg_free_result($result);

	// Closing connection
	pg_close($dbconn);
	
	
}
*/

?>