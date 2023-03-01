<?php
	$log->general("-yxz Text Display->",3);
	/*
	if(is_base64($text_data['content_text'])){
		print base64_decode($str);
	}else{
		print $text_data['content_text'];
	}
	*/
	//echo"xx";
	
	$str=$text_data["db"]['content_text'];
	//$str = ltrim($str," \t\n\r");
	//print $str;
	
	/*$ContType=mime_content_type($str);
		$head="Content-Type: $ContType";
		header($head);
		//print $head;
	*/
	//print base64_decode($str);
	print $str;
	/*//if(is_base64($str)){
		$ContType=mime_content_type($DisplayFile);
		$head="Content-Type: $ContType";
		header($head);
		print $head;
		print base64_decode($str);
	}else{
		//print "xx1";
		print base64_decode($str);
		//print $str;
	}*/
	
?>