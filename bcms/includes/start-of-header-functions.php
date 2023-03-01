<?php
    
	//echo $current_dir;
	session_start();
	ini_set( 'display_errors', '1' );
	//------------------------------------------------
	if(isset($_SESSION["administratorsID"])){
		$loc="Location: main/logged-in/index.php";
		header($loc);
		ob_end_flush();
		exit();
	}

	//----------------------------------------------------------------
	if(isset($_GET['dcmsuri'])){
		//print "--".$_GET['dcmshost']."--"."--".$_GET['dcmsuri'];
		if(substr($_GET['dcmsuri'],strlen($_GET['dcmsuri'])-1)!="/"){
			//$DisplayFile=".".$_GET['dcmsuri'];
			$DisplayFile=$_GET['dcmsuri'];
			//print "\n -| ".$DisplayFile." |- \n";
			if(file_exists($DisplayFile)){
				$ForbiddenExtensions=array("php");
				$ShowFile=true;
				if(strlen($DisplayFile)>3){
					if(in_array(substr($DisplayFile,strlen($DisplayFile)-3),$ForbiddenExtensions)){
						$ShowFile=false;	
					}else{
						$ShowFile=true;
					}	
				}else{
					$ShowFile=false;	
				}
				if($ShowFile){
					//$ContType=exec("file -bi '$DisplayFile'");
					$ContType=mime_content_type($DisplayFile);
					$head="Content-Type: $ContType";
					header($head);
					print $head;
					print file_get_contents($DisplayFile);
					//ob_end_flush();
					exit();
				}else{
					//ob_end_flush();
					exit();	
				}
			}else{
				//print $DisplayFile." - 404 File Not Found";
				//header("HTTP/1.1 404 Not Found");
				http_response_code(404);
			}
		}
	}
	

	//----------------------------------------------------------------
	function callback($buffer)
	{
		// replace all the apples with oranges
		//return (str_replace("Yamba", "oranges", $buffer));
		//$buffer="\n".$buffer;
		//$buffer = trim($buffer," \t\n\r"););
		global $tag_match_array;
		//print_r($tag_match_array);

		$sub_string_total="xx";
		$match_array=array();
		$inner_array=array();
		$search=0;
		$buffer_size=strlen($buffer);
		$query="";
		$str_match="";
		$cur_match=""; 
		$inner_match="";
		$start_count=0;
		$end_count=0;
		while($search<=$buffer_size){
		
		//while($search<=150){
			$sub_string = substr($buffer, $search, 1);
			if($sub_string=="{"){
				$start_count++;
				$cur_match.=$sub_string;
			}elseif($sub_string=="}"){
				$end_count++;
				$cur_match.=$sub_string;
			}else{
				if($start_count>0){
					$cur_match.=$sub_string;
					$inner_match.=$sub_string;
				}
			}
			if(($start_count==2)&&($end_count==2)){
				$match_array[]=$cur_match;
				$inner_array[]=$inner_match;
				$cur_match="";
				$inner_match="";
				$start_count=0;
				$end_count=0;
			}

			
			//$query.=" ".$search;
			/*
			if($sub_string==" "){
				$sub_string_total.=$sub_string."\n".$query;
			}else{
				$sub_string_total.=$sub_string.$query;
			}
			*/
			//$sub_string_total.=$sub_string;
			//$query.="+".$sub_string."-|->".$search." \n";
			//$query.=$sub_string;
			$search++;
		}
		/*
		foreach($match_array as $key=>$val){
			//str_replace($val, "oranges", $buffer)

		}
		*/
		//$buffer="--".$search."-".$buffer_size."-".$buffer;
		
		for($x=0;$x<count($match_array);$x++){
			if(isset($tag_match_array[$inner_array[$x]])){
				$query.="| ".$x." |\n ".$inner_array[$x]."\n--".$match_array[$x]."=>".$tag_match_array[$inner_array[$x]];//var_export($tag_match_array[$inner_array[$x]],true);
				$buffer=str_replace($match_array[$x], $tag_match_array[$inner_array[$x]], $buffer);
			}else{
				$buffer=str_replace($match_array[$x], "", $buffer);
			}
			
			//.$inner_array[$x]."\n--".$tag_match_array[$x]."\n--".$match_array[$x]."\n-------------------\n";
			
			/*
			if(array_key_exists($inner_array[$x], $tag_match_array)){
				//$buffer=str_replace($match_array[$x], $tag_match_array[$x], $buffer);
				//$buffer="| ".$x." |\n ".var_export($match_array,true)."\n--".var_export($inner_array,true)."\n--".var_export($tag_match_array,true)."\n--".$buffer;
				
			}else{
				$buffer=str_replace($match_array[$x], $tag_match_array[$x], $buffer);
			}
			*/
			
		}
		
		//$buffer=$query."--".$buffer;
		$pos = strpos($buffer, "<");
		$buffer=substr($buffer, $pos);
		//$buffer=$pos.$buffer;
		//$buffer = trim($buffer);
		return $buffer;
	}
?>