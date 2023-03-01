<?php
    try{
		$connect = array('hostname'=>'localhost','usernamedb'=>'bubblelite','passworddb'=>'DickSux5841','dbName'=>'bubblelite2');
		print_r($connect );
		$links = new mysqli($connect['hostname'], $connect['usernamedb'], $connect['passworddb'],$connect['dbName']);
		//$links->select_db($connect['dbName']);
		// Check connection
		if($links->connect_error) {
			//die("Connection failed: " . $links->connect_error);

			print("Connection failed: " . $links->connect_error);
		}else{
			print("Connected successfully: " .var_export($connect,true));

		}
		echo 'Connected successfully';
		$query='SELECT * FROM domains LIMIT 0,1';
		$result = $links->query($query);
		$myrow=$result->fetch_row();
		print_r($myrow);
	}catch(MySQLException $e){
		print_r($e);
	}
?>