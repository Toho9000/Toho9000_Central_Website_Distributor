<?php
	//-----------------------------------------------------------------------------------------------------------
	
	class clsDatabaseInterface{
		var $SQL;
		var $Table;
		var $TargetField="id";
		var $SearchVar;
		var $NewSearchVar=array();
		public $m;
		var $vs;
		var $links;
		var $result;
		var $DBFile="db-local.php";
		var $default_db="bubblelite2";
		public $log="";
		var $log_text="";
		var $db_type_list=array("MySQL","Sqlite","pgSQL");
		//var $current_db_type="MySQL";
		//var $current_db_type="Sqlite";
		var $current_db_type="pgSQL";
		var $num_rows=0;
	
	
		
		
		function __construct(&$log=false){
			if($log){
				$this->log=$log;
			}
		}
		
		public function Set_Log(&$log){
			$this->log=$log;
			$this->log->general('M Log Success:',1);
				
		}
		
		public function Set_Vs(&$vs=false){
			$this->vs=$vs;
			//$this->log->general('Vs Success: ".var_export($this->vs,true),1);
				
		}

		public function test_pgsql(){
			
						
			$dbconn = pg_connect("host=localhost dbname=cwy0ek0e_bubblelite2 user=postgres password=DickSux5841");
			// Performing SQL query
			$query = 'SELECT * FROM administrators';
			//$result = pg_query($query) or die('Query failed: ' . pg_last_error());
			//echo"43210000555-------------------|-".var_export($dbconn,true)."-|----------------------------------------------------------\n\n";
			$result = pg_query($query);
			//echo"432100001-------------------|-".$query."-|----------------------------------------------------------\n\n";
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
		
		public function CreateDB(){
			
			//try{
				//echo"3-----------------------------------------------------------------------------\n\n";
				$this->log->general("CreateDB Start Success: ",1);
					
				$this->m = new clsDatabaseConnect($this->log);
				//$this->m->Set_Log($this->log);
				$this->log->general("CreateDB M Success: ",1);
				
				//$this->m->Startup();
				//echo"3-------------------".$this->current_db_type."----------------------------------------------------------\n\n";
				//$this->links = $this->m->Connect($this->DBFile);
				$this->log->general("\n\n\n\nCurrent Position\n\n\n\n");
				//$this->m->test_pgsql();
				echo"321-------------------".$this->current_db_type."----------------------------------------------------------\n\n";
				$this->links = $this->m->Connect("",$this->current_db_type);
				
				/*
				$res = pg_query("SELECT * FROM administrators");
				
				while ($row = $res->fetchArray()) {
					echo "{$row['id']} {$row['name']} {$row['email']} \n";
				}
				*/
				
				//echo"987654321-------------------|-".$this->current_db_type."-|----------------------------------------------------------\n\n";
				if($this->current_db_type=="MySQL"){
					if(isset($this->links->connect_error)) {
						$this->log->general("Connection failed: " . $this->links->connect_error,3);
					}else{
						$this->log->general("m->Connection Success: ".var_export($this->links,true),1);
					}
				}elseif($this->current_db_type=="Sqlite"){
					//echo"987654321-0-----------------------------------------------------------------------------";
				}elseif($this->current_db_type=="pgSQL"){
					//echo"987654321-1------------------------------|-".$this->current_db_type."-|-----------------------------------------------\n\n";
					
					//$this->test_pgsql();
				}
				
				//$this->m->Set_Log("clsDBCon Success: ",1);
				//echo"5-----------------------------------------------------------------------------";
			//}catch(MySQLErrorException $e){
			//	$this->log->general("MySQL Connection Error: ".var_export($e,true),3);
			//}
			
			
		}
		
		function Reset(){
			$this->Table="";
			$this->TargetField="id";
			$this->SearchVar="";
			$this->NewSearchVar=array();
		}
		
		function AddTable($Table){
			$this->Table=$Table;
		}
		function ChangeTarget($to){
			$this->TargetField=$to;
		}
		function AddSearchVar($id){
			$this->SearchVar=$id;
		}
		function AddNewSearchVar($key,$id){
			$this->NewSearchVar[$key]=$id;
		}
		function GetRecord(){
			//print "ll";
			if(!$this->links) $this->CreateDB();
			$m_arg = "SELECT * FROM $this->Table where $this->TargetField='$this->SearchVar'";
			
			foreach($this->NewSearchVar as $key=>$val){
				$m_arg .= " AND $key='$val'";
			}
			
			//print("d11d");
			$this->SQL=$m_arg;
			//$result=$this->rawQuery($m_arg);
			$this->result = $this->rawQuery($this->SQL);
			if($this->result){
				$m_rows = $this->Fetch_Assoc();
				//print_r($m_rows);
				if(is_array($m_rows)){
					foreach($m_rows as $key => $value){
						$m_rows[$key]=stripslashes($m_rows[$key]);
					};
				};
				//print("ddd");
				return $m_rows;
			}else{
				$this->log->general("Multi MySQL Error->".var_export($this->result,true)." ".$query,3);
				//print "ERROR: $m_arg";
			}
		}
		function GetMultiRecord(){
			if(!$this->links) $this->CreateDB();
			$m_arg = "SELECT * FROM $this->Table where $this->TargetField='$this->SearchVar'";
			
			$this->result=$this->rawQuery($m_arg);
			if($this->result){
				while($m_rows = $this->Fetch_Array());
				{
					if(is_array($m_rows)){
						foreach($m_rows as $key => $value){
							$m_rows[$count][$key]=stripslashes($m_rows[$key]);
						};
					};
					$count++;
				}
			}else{
				$this->log->general("Multi MySQL Error->".var_export($this->result,true)." ".$query,3);
				//print "ERROR: $m_arg";
			}
			return $m_rows;
		}
		
		function rawQuery($query)
		{
			//echo"9-----------------------".$query."------------------------------------------------------\n\n";
			if(!$this->links) $this->CreateDB();
			try{
				//if($this->current_db_type=="MySQL"){
					//echo"ooo----------------------------".$query."-------------------------------------------------\n\n";
					$this->SQL=$query;
					if(isset($this->links)){
						if($this->current_db_type=="pgSQL"){
							$this->result = pg_query($query);
							

						}else{
							$this->result = $this->links->query($query);
						}
						if(!$this->result){
							$this->log->general("No MySQL Result->".$query,3);
							return false;
						}else{
							return $this->result;
						}
					}else{
						$this->log->general("No MySQL Session->".$query,3);
					}
					/*
				}elseif($this->current_db_type=="Sqlite"){
					echo"454-----------------------------------------------------------------------------";
				}
				*/
				
				
			}catch(MySQLException $e){
				$this->log->general("MySQL Exception->".var_export($e,true)." ".$query,3);
			
			}
		}
		
		function NumRows(){
			try{
				//$this->log->general("Start Num Rows->",3);
				
				//$this->log->general("Row Count->".$num_rows,3);
				//$this->log->general("\n",3);
				$this->num_rows=0;
				if($this->current_db_type=="MySQL"){
					$this->log->general("Connection failed: " . $this->links->connect_error,3);
					$this->log->general("m->Connection Success: ".var_export($this->links,true),1);
					$this->result->reset();
					$this->num_rows=$this->result->num_rows;
				}elseif($this->current_db_type=="Sqlite"){
					
					//$this->num_rows=$this->result->num_rows;
					$this->result->reset();
					$nrows = 0;
					
					while ($this->Fetch_Array()){
						$nrows++;
					}
						
					$this->result->reset();
					$this->num_rows=$nrows;
					//return $nrows;
				}elseif($this->current_db_type=="pgSQL"){
					$this->num_rows = pg_num_rows($this->result);
				}
				
				//echo"454-----------------%-".$this->num_rows."-%----------------------------------------------------------";
				return $this->num_rows;
			}catch(Exception $e){
				$this->log->general("MySQL NumRows Exception->".var_export($e,true)." ".$this->SQL,3);
				return 0;
			}
		}
		
		function Fetch_Array()
		{
			$row=array();
			try{
				if($this->current_db_type=="MySQL"){
					$row = $this->result->fetch_array(MYSQLI_NUM);
					if(!$this->NumRows()>0){
						$row=array();	
					}
				}elseif($this->current_db_type=="Sqlite"){
					$row = $this->result->fetchArray();
				}elseif($this->current_db_type=="pgSQL"){
					$row = pg_fetch_array($this->result, 0, PGSQL_NUM);
					//$row = $this->result->fetchArray();
				}
			}catch(Exception $e){
				$this->log->general("MySQL Fetch Array Exception->".var_export($e,true),3);
				$row=array();
			}
			$this->log->general("667 =>\n".var_export($row,true)."<================================\n\n".$this->SQL,3);
			//echo"2211-----------------------------------------------------------".var_export($row,true)."----xx--------------";
			return $row;
			
		}
		
		function Fetch_Assoc()
		{
			//echo"fff-----------------------------------------------------------------------------";
			$row=array();
			if($this->current_db_type=="MySQL"){
				$row = $this->result->fetch_array(MYSQLI_NUM);
				
			}elseif($this->current_db_type=="Sqlite"){
				$row = $this->result->fetchArray(SQLITE3_ASSOC);
			}elseif($this->current_db_type=="pgSQL"){
				$row =pg_fetch_assoc($this->result);
				//$row = $this->result->fetchArray();
			}
			/*
			if(!$this->NumRows()>0){
				$row=array();	
			}
			*/
			/*
			$row=array();
			if($this->NumRows()>0){
				$row = $this->result->fetch_assoc();
			}
			*/
			//echo"2233----------------------------------------------------------|-".var_export($row,true)."-|-----------------";
			return $row;
			
		}
		
		function Error()
		{
			$er = $this->result->error;
			return $er;
			
		}
		
		
		function Escape($string)
		{
			//echo"20-----------------------------------------------------------".var_export($this->links,true)."------------------";
			
			if(isset($string)){
				if(strlen($string)>0){
					$st = $this->links->real_escape_string($string);
				}else{
					$st="";
				}
			}else{
				$st="";
			}
			
			return $st;
			
		}
		
		function Insert_Id(){
			try{
				$InsertID = $this->links->insert_id;
				return $InsertID;
			}catch(MySQLErrorException $e){
				$this->log->general("-Insert_Id failed--".var_export($e,true),3);
			}
		}
		
		function rawQueryX($query)
		{
			
			$temp = $this->rawQuery($query);
			return $temp;
		}
		
		function otherRawQuery($query)
		{
			
			
			$temp = $this->rawQuery($query);
			return $temp;
		}
		
		function returnDBLink()
		{
			return $this->links;
		}
		
	}
	
	//-----------------------------------------------------------------------------------------------------------
	
	class BulkDBChange{
		var $Table;
		var $RecordArray=array();
		var $MultiArray=array();
		var $WhatToChange;
		var $WhatToChangeTo;
		var $Target="id";
		var $Errors;
		var $DBFile="db-local.php";
		var $default_db="bubblelite2";
		var $m;
		var $r;
		var $links;
		
		function __construct(&$log=false){
			if($log){
				$this->log=$log;
			}
		}
		
		function Set_Database(&$r){
			$this->r=$r;
		}
		
		
		function AddTable($Table){
			$this->Table=$Table;
		}
		function AddIDMultiArray($DFiles){
			$this->MultiArray=$DFiles;
		}
		function AddIDArray($DFiles){
			$this->RecordArray=$DFiles;
		}
		function WhatToChange($var,$to=""){
			$this->WhatToChange=$var;
			$this->WhatToChangeTo=$to;
		}
		function ChangeTarget($var){
			$this->Target=$var;
			
		}
		
		function DoChange(){
			if(count($this->RecordArray)>0){
				foreach($this->RecordArray as $key => $value){
					
					$query= "UPDATE $this->Table SET $this->WhatToChange='$this->WhatToChangeTo' WHERE $this->Target='$value'";
					
					$result = $this->r->rawQuery($query);
					
				}
			}elseif(count($this->MultiArray)>0){
				//print_r($this->MultiArray);
				foreach($this->MultiArray as $key => $value){
					
					$query= "UPDATE $this->Table SET $this->WhatToChange='$this->WhatToChangeTo' WHERE $this->Target='$value'";
					
					$result = $this->r->rawQuery($query);
				}
			}else{
				$this->Errors.="No Items Selected";
			}
			return $this->Errors;
		}
	}
	
	//-----------------------------------------------------------------------------------------------------------
	
	class DeleteFromDatabase{
		var $Table;
		var $RecordArray=array();
		var $WhatToDelete="id";
		var $Errors;
		var $DBFile="db-local.php";
		var $default_db="bubblelite2";
		var $m;
		var $r;
		var $links;
		
		
		function __construct(&$log=false){
			if($log){
				$this->log=$log;
			}
		}

		function Set_Database(&$r){
			//print "654->->".var_export($this->r,true);
			$this->r=$r;
			
						
		}
		
		function AddTable($Table){
			$this->Table=$Table;
		}
		
		function AddIDArray($DFiles){
			$this->RecordArray=$DFiles;
		}
		function AltDeleteVar($var){
			$this->WhatToDelete=$var;
		}
		
		function DeletePhotos($Photos){
			if(is_array($Photos)){
				foreach($Photos as $field => $path){
					foreach($this->RecordArray as $key => $value){
						$query= "SELECT $field FROM $this->Table WHERE $this->WhatToDelete='$value'";
						$result = $this->r->rawQuery($query);
						
						while($myrow=$result->fetch_row()){
							if($myrow[0]!=""){
								if(file_exists($path.$myrow[0])){
									unlink($path.$myrow[0]);
								}
							}
						}
					}
				}
			}
		}
		
		function DoDelete(){
			try{
				$this->Errors="";
				if(is_array($this->RecordArray)){
					foreach($this->RecordArray as $key => $value){
						
						$query= "DELETE FROM $this->Table where $this->WhatToDelete='$value'";
						//print "432->".$query."->".var_export($this->r,true);
						$result = $this->r->rawQuery($query);
						if(!$result){
							//print $query;
						}else{
							//print $query."->".var_export($result,true);
						}
					}
				}else{
					$this->Errors.="No Items Selected";
				}
				return $this->Errors;
			}catch(MySQLException $e){
				throw new Exception("143 Do Delete Failed=>".var_export($e,true));
			}
			
			
		}
	}
	
	//-----------------------------------------------------------------------------------------------------------
	
	class AddToDatabase{
		var $SQL;
		var $SQLFields;
		var $SQLData;
		var $Table;
		var $PostArray=array();
		var $FileArray=array();
		var $SkipArray=array();
		var $ValidArray=array();
		var $MoveArray=array();
		var $MoveToArray=array();
		var $Errors;
		var $NoDupes=array();
		var $DBFile="db-local.php";
		var $default_db="bubblelite2";
		var $FirstRun=true;
		var $InsertType="Insert";
		
		var $ExtraFields=array();
		
		var $ImageArray=array();
		var $ImageToArray=array();
		var $ImageSizeArray=array();
		var $ImageChangeTo=array();
		
		var $KImageArray=array();
		var $KSmallToArray=array();
		var $KBigToArray=array();
		var $KSmallDBArray=array();
		var $KBigDBArray=array();
		var $KImageSizeArray=array();
		var $FunctionArray=array();
		var $AutoIncrement="id";
		var $AutoIncVal=0;
		var $m;
		var $r;
		var $links;
		var $log;
		var $vs;
		
		
		function __construct(&$log=false){
			if($log){
				$this->log=$log;
			}
		}
		
		function Set_Database(&$r){
			$this->r = $r;
			//echo"233-----------------------------------------------------------".var_export($this->r,true)."------------------";
		
		}
		
		public function Set_Log(&$log){
			$this->log=$log;
			$this->log->general('Set Log Boot Success: $r->',1);
				
		}
		
		public function Set_Vs(&$vs){
			$this->vs=$vs;
			$this->log->general('Set Log vs->db Success: $r->',1);
				
		}
				
		function Reset(){
			$this->FirstRun=true;
			$this->SQLFields="";
			$this->SQLData="";
			$this->ExtraFields=array();
			$this->FunctionArray=array();
			$this->ValidArray=array();
			$this->AutoIncVal=0;
		}
		
		function str_makerand ($length) 
		{ 
			$minlength=$length;
			$maxlength=$length;
			$charset = "abcdefghijklmnopqrstuvwxyz"; 
			$charset .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ"; 
			$charset .= "0123456789"; 
			if ($minlength > $maxlength) $length = mt_rand ($maxlength, $minlength); 
			else                         $length = mt_rand ($minlength, $maxlength); 
			for ($i=0; $i<$length; $i++) $key .= $charset[(mt_rand(0,(strlen($charset)-1)))]; 
			return $key; 
		} 
		
		function ChangeInsertType($to){
			$this->InsertType=$to;
		}
		
		function ChangeDBFile($db){
			
		}
		
		function AddNoDupe($NoDupe){
			$this->NoDupes=$NoDupe;
		}
		
		function AddID($id){
			$this->AutoIncVal=$id;
		}
		function AddFunctions($FunctionArray){
			$this->FunctionArray=$FunctionArray;
		}
		function AddExtraFields($FieldArray){
			$this->ExtraFields=array_merge($this->ExtraFields,$FieldArray);
		}
		function MoveFile($VarName,$MoveTo){
			$this->MoveArray[]=$VarName;
			$this->MoveToArray[]=$MoveTo;
		}
		function ResizeImage($VarName,$MoveTo,$Size,$ChangeTo=""){
			$this->ImageArray[]=$VarName;
			$this->ImageToArray[]=$MoveTo;
			$this->ImageSizeArray[]=$Size;
			$this->ImageChangeTo[]=$ChangeTo;
		}
		function KeepAndResizeImage($VarName,$DBSmall,$DBBig,$MoveToSmall,$MoveToBig,$Size){
			$this->KImageArray[]=$VarName;
			$this->KSmallDBArray[]=$DBSmall;
			$this->KBigDBArray[]=$DBBig;
			$this->KSmallToArray[]=$MoveToSmall;
			$this->KBigToArray[]=$MoveToBig;
			$this->KImageSizeArray[]=$Size;
		}
		
		function AddPosts($PArray,$FArray){
			$this->PostArray=$PArray;
			$this->FileArray=$FArray;
		}
		function AddSkip($SArray){
			$this->SkipArray=$SArray;
		}
		function AddTable($Table){
			
			$this->Table=$Table;
			$this->SetValid();
		}
		function ChangeAutoInc($to){
			$this->AutoIncrement=$to;
		}
		
		function ReturnID(){
			return $this->AutoIncVal;
		}
		function GetNextID(){
			if($this->AutoIncVal==0){
				
				$query= "SHOW TABLE STATUS LIKE '$this->Table'";
				$sq2 = $this->r->rawQuery($query);
				$result = $this->r->Fetch_Assoc();
				$this->AutoIncVal=$result['Auto_increment'];
			};
		}
		function IsDupes(){
			$RetVal=false;
			if(is_array($this->NoDupes)){
				foreach($this->NoDupes as $val){
					if($this->PostArray[$val]){
						$SQL="SELECT id FROM $this->Table WHERE $val='".$this->PostArray[$val]."'";
						//print $SQL;
						$sq2 = $this->r->rawQuery($SQL);
						while ($myrow = $this->r->Fetch_Array($sq2)) {
							$RetVal=true;
							$this->Errors.="Duplicate field on $val ";
						};
					}
				};
			};
			return $RetVal;
		}
		
		
		function SetValid(){
			try{
				
				$sql="SHOW COLUMNS FROM ".$this->Table;
			//print $sql;
			$m_arg = $this->r->rawQuery($sql);
			//$this->ValidArray = mysql_fetch_array(mysql_query($m_arg));
			while ($myrow = $this->r->Fetch_Array($m_arg)) {
				//print_r($myrow);
				$this->ValidArray[]=$myrow[0];
			};
				

			}catch(Exception $e){
				throw new Exception('677 clsDb Failure.=>'.var_export($e,true));
			}
			
		}
		
		
		
		function DoStuff(){
			//echo"123-----------------------------------------------------------------------------\n";
			
			if(!$this->IsDupes()){
				if($this->FirstRun){
					$First=true;
					$this->GetNextID();
					foreach($this->PostArray as $key => $value){
						//echo"key=$key -value=$value<br>";
						if((!in_array($key,$this->SkipArray))&&(in_array($key,$this->ValidArray))){
							if($First){
								$this->SQLFields.="$key";
								if(is_string($value)){
									$value=$this->r->Escape(stripslashes($value));
								};
								$this->SQLData="'$value'";
							}else{
								$this->SQLFields.=",$key";
								if(is_string($value)){
									$value=$this->r->Escape(stripslashes($value));
								};
								$this->SQLData.=",'$value'";
							};
							//print $this->SQLData;
							$First=false;
						};
					};
					//echo"1234-----------------------------------------------------------------------------\n";
					//print $this->SQLData;
					//echo"==============FILES===========";
					if(isset($this->FileArray)){
						if(is_array($this->FileArray)){
							foreach($this->FileArray as $key => $value){
								//echo"key=$key----------------<br>";
								
								$value['name']=eregi_replace(" ","_",$value['name']); //get rid of spaces
								
								$MoveToKey=array_search($key,$this->MoveArray);
								//$ImageKey=array_search($key,$this->ImageArray);
								$ImageKeys=array_keys($this->ImageArray,$key);
								$KImageKey=array_search($key,$this->KImageArray);
								//echo"--$MoveToKey--";
								if(is_numeric($MoveToKey)){
									//echo"<br>Send File To ".$this->MoveToArray[$MoveToKey]." <br>";
									if($First){
										$this->SQLFields.="$key";
										$this->SQLData="'".$value['name']."'";
									}else{
										$this->SQLFields.=",$key";
										$this->SQLData.=",'".$value['name']."'";
									};
									copy($value['tmp_name'],$this->MoveToArray[$MoveToKey].$value['name']);
									if (file_exists($value['tmp_name'])) unlink($value['tmp_name']);
									$First=false;
								}elseif(is_array($ImageKeys)){
									//echo"<br>Send File To ".$this->ImageToArray[$ImageKey]." and Resize To ".$this->ImageSizeArray[$ImageKey]."<br>";
									foreach($ImageKeys as $IKey =>$IVal){
										//$value['name']=$this->str_makerand(5).$value['name'];
										if($value['name']!="") $value['name']=$this->str_makerand(5).$value['name'];
										$value['name'] = ereg_replace("[^A-Za-z0-9]", "", $value['name'] );
										//print $value['name'];
										if($value['name']!="") $value['name']=$this->str_makerand(5).$value['name'];
										if($value['tmp_name']!="") $ImgData=getimagesize($value['tmp_name']);
										if($ImgData['channels']==4){
											exec("convert -colorspace RGB -resize ".$this->ImageSizeArray[$IVal]." ".$value['tmp_name']." ".$this->ImageToArray[$IVal].$value['name']);
										}else{
											exec("convert -resize ".$this->ImageSizeArray[$IVal]." ".$value['tmp_name']." ".$this->ImageToArray[$IVal].$value['name']);
										}
										
										if($this->ImageChangeTo[$IVal]!="") $key=$this->ImageChangeTo[$IVal];
										if($First){
											$this->SQLFields.="$key";
											$this->SQLData="'".$value['name']."'";
										}else{
											$this->SQLFields.=",$key";
											$this->SQLData.=",'".$value['name']."'";
										};
										$First=false;
									}
									if (file_exists($value['tmp_name'])) unlink($value['tmp_name']);
									
								}elseif(is_numeric($KImageKey)){
									//echo"<br>Send Small File To ".$this->KSmallToArray[$KImageKey]." and Insert FileName into".$this->KSmallDBArray[$KImageKey]." and Resize To ".$this->KImageSizeArray[$KImageKey]."<br>";
									//echo"<br>Send Big File To ".$this->KBigToArray[$KImageKey]." and Insert FileName into".$this->KBigDBArray[$KImageKey]." <br>";
									if($value['name']!="") $value['name']=$this->str_makerand(5).$value['name'];
									$value['name'] = ereg_replace("[^A-Za-z0-9]", "", $value['name'] );
										
									$SmallFileName="Small-".$value['name'];
									$BigFileName="Big-".$value['name'];
									copy($value['tmp_name'],$this->KBigToArray[$KImageKey].$BigFileName);
									if($value['tmp_name']!="") $ImgData=getimagesize($value['tmp_name']);
									if($ImgData['channels']==4){ //CMYK Image
										exec("convert -colorspace RGB -resize ".$this->KImageSizeArray[$KImageKey]." ".$value['tmp_name']." ".$this->KSmallToArray[$KImageKey].$SmallFileName);
									}else{
										exec("convert -resize ".$this->KImageSizeArray[$KImageKey]." ".$value['tmp_name']." ".$this->KSmallToArray[$KImageKey].$SmallFileName);
									}
									if (file_exists($value['tmp_name'])) unlink($value['tmp_name']);
									if($First){
										$this->SQLFields.=$this->KSmallDBArray[$KImageKey];
										$this->SQLData="'".$SmallFileName."'";
									}else{
										$this->SQLFields.=",".$this->KSmallDBArray[$KImageKey];
										$this->SQLData.=",'".$SmallFileName."'";
									}
									$this->SQLFields.=",".$this->KBigDBArray[$KImageKey];
									$this->SQLData.=",'".$BigFileName."'";
									$First=false;
								}
								//foreach($value as $key2 => $value2){
									//echo"key=$key2 -value=$value2<br>";
								//};
							};
						};
					}
					//echo"12345-----------------------------------------------------------------------------\n";
					if(isset($this->ExtraFields)){
						foreach($this->ExtraFields as $key => $value){
							if($First){
								$this->SQLFields.="$key";
								if(is_string($value)){
									$value=$this->r->Escape(stripslashes($value));
								};
								$this->SQLData="'$value'";
							}else{
								$this->SQLFields.=",$key";
								if(is_string($value)){
									$value=$this->r->Escape(stripslashes($value));
								};
								$this->SQLData.=",'$value'";
							};
							//print $this->SQLData;
							$First=false;
						}
					}
					if(isset($this->FunctionArray)){
						foreach($this->FunctionArray as $key => $value){
							if($First){
								$this->SQLFields.="$key";
								if(is_string($value)){
									$value=$this->r->Escape(stripslashes($value));
								};
								$this->SQLData="$value";
							}else{
								$this->SQLFields.=",$key";
								if(is_string($value)){
									$value=$this->r->Escape(stripslashes($value));
								};
								$this->SQLData.=",$value";
							};
							$First=false;
							//print $this->SQLData;
						}
					}
					$this->FirstRun=false;
					//echo"123456-----------------------------------------------------------------------------\n";
				}
				//echo"1234567-----------------------------------------------------------------------------\n";
				if($this->AutoIncVal>0){
					$this->SQL="$this->InsertType INTO $this->Table ($this->SQLFields,$this->AutoIncrement) VALUES ($this->SQLData,$this->AutoIncVal)";
					//echo"1234567711------------------------------------".$this->SQL."-----------------------------------------\n";
				}else{
					$this->SQL="$this->InsertType INTO $this->Table ($this->SQLFields) VALUES ($this->SQLData)";
				}
				$result = $this->r->rawQuery($this->SQL);
				if(!$result){
					//echo"error-$this->SQL"; 
				}else{
					//echo"123456778------------------------------------".$this->SQL."-----------------------------------------\n";
				}
			}
			//print $this->SQL."<br>";
			//echo"1234568-----------------------------------------------------------------------------\n";
			return $this->Errors;
			
		}
	}
	
	//-----------------------------------------------------------------------------------------------------------
	
	class UpdateDatabase{
		var $SQL;
		var $SQLData;
		var $Table;
		var $ID;
		var $PostArray=array();
		var $FileArray=array();
		var $SkipArray=array();
		var $MoveArray=array();
		var $MoveToArray=array();
		var $MoveToChange=array();
		var $ValidArray=array();
		var $Errors;
		var $NoDupes=array();
		var $FirstRun=true;
		var $ExtraFields=array();
		var $FunctionArray=array();
		
		var $PrimaryKey="id";		
		var $ImageArray=array();
		var $ImageToArray=array();
		var $ImageSizeArray=array();
		var $ImageChangeTo=array();
		
		var $KImageArray=array();
		var $KSmallToArray=array();
		var $KBigToArray=array();
		var $KSmallDBArray=array();
		var $KBigDBArray=array();
		var $KImageSizeArray=array();
		var $DBFile="db-local.php";
		var $default_db="bubblelite2";
		var $m;
		var $r;
		var $log;
		var $links;
		
		function __construct(&$log){
			$this->log=$log;
		}
		
		function Set_Database(&$r){
			$this->r = $r;
			//print_r($this->r);
		}
		
		
		public function Set_Log(&$log){
			$this->log=$log;
			$this->log->general('Set Log Boot Success: $r->',1);
				
		}
		
		function Reset(){
			$this->FirstRun=true;
			$this->SQLFields="";
			$this->SQLData="";
			$this->ExtraFields=array();
			$this->FunctionArray=array();
			$this->ValidArray=array();
			$this->AutoIncVal=0;
		}
		
		function str_makerand ($length) 
		{ 
			$minlength=$length;
			$maxlength=$length;
			$charset = "abcdefghijklmnopqrstuvwxyz"; 
			$charset .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ"; 
			$charset .= "0123456789"; 
			if ($minlength > $maxlength) $length = mt_rand ($maxlength, $minlength); 
			else                         $length = mt_rand ($minlength, $maxlength); 
			for ($i=0; $i<$length; $i++) $key .= $charset[(mt_rand(0,(strlen($charset)-1)))]; 
			return $key; 
		} 
		
		function AddFunctions($FunctionArray){
			$this->FunctionArray=$FunctionArray;
		}
		
		function AddNoDupe($NoDupe){
			$this->NoDupes=$NoDupe;
		}
		function AddExtraFields($FieldArray){
			$this->ExtraFields=array_merge($this->ExtraFields,$FieldArray);
		}
		function MoveFile($VarName,$MoveTo,$ChangeTo=""){
			$this->MoveArray[]=$VarName;
			$this->MoveToArray[]=$MoveTo;
			$this->MoveToChange[]=$ChangeTo;
		}
		function ResizeImage($VarName,$MoveTo,$Size,$ChangeTo=""){
			$this->ImageArray[]=$VarName;
			$this->ImageToArray[]=$MoveTo;
			$this->ImageSizeArray[]=$Size;
			$this->ImageChangeTo[]=$ChangeTo;
		}
		function KeepAndResizeImage($VarName,$DBSmall,$DBBig,$MoveToSmall,$MoveToBig,$Size){
			$this->KImageArray[]=$VarName;
			$this->KSmallDBArray[]=$DBSmall;
			$this->KBigDBArray[]=$DBBig;
			$this->KSmallToArray[]=$MoveToSmall;
			$this->KBigToArray[]=$MoveToBig;
			$this->KImageSizeArray[]=$Size;
		}
		
		function AddPosts($PArray,$FArray){
			$this->PostArray=$PArray;
			$this->FileArray=$FArray;
		}
		function AddDefaultCheckBoxes($CArray){
			foreach($CArray as $key => $value){
				if(!isset($this->PostArray[$value])){
					$this->PostArray[$value]="";
				}
			};
		}
		
		function AddSkip($SArray){
			$this->SkipArray=$SArray;
		}
		function ChangeAutoInc($newkey){
			$this->PrimaryKey=$newkey;
		}
		function AddTable($Table){
			$this->Table=$Table;
			$this->SetValid();
		}
		function AddID($id){
			$this->ID=$id;
		}
		function SetValid(){
			$sql="SHOW COLUMNS FROM ".$this->Table;
			//print $sql;
			$m_arg = $this->r->rawQuery($sql);
			//$this->ValidArray = mysql_fetch_array(mysql_query($m_arg));
			if($this->r->NumRows()>0){
				while ($myrow = $this->r->Fetch_Array()) {
					//print_r($myrow);
					$this->ValidArray[]=$myrow[0];
				};
				//print $sql."444 SetValid Success =>".var_export($this->ValidArray,true);
			}else{
				$this->ValidArray=array();
				//print $sql." 445 SetValid Failure=>".var_export($this->ValidArray,true);
			}
			
			//print "<= Valid =>".count($this->ValidArray)."<=>";
		}
		
		function IsDupes(){
			$RetVal=false;
			if(is_array($this->NoDupes)){
				foreach($this->NoDupes as $val){
					$sq2 = $this->r->rawQuery("SELECT id FROM $this->Table WHERE $val='".$this->PostArray[$val]."'");
					while ($myrow = $this->links->Fetch_Array($sq2)) {
						if($this->ID!=$myrow[0]){
							$RetVal=true;
							$this->Errors.="Duplicate field on $val ";
						};
					};
				};
			};
			return $RetVal;
		}
		
		function CheckDel($old){
			$new = $value['name'];
			if($old==$new){
			}
			else{
				foreach($this->FileArray as $key => $value){
					unlink("../../../Pdf/$old");
				}
			}
		}
		
		function DeletePhotos($Photos){
			if(is_array($Photos)){
				foreach($Photos as $field => $path){
					$sql= "SELECT $field FROM $this->Table WHERE $this->PrimaryKey='$this->ID'";
					$result = $this->r->rawQuery($sql,$this->links);
					while($myrow=$this->r->Fetch_Array($result)){
						if($myrow[0]!=""){
							if(file_exists($path.$myrow[0])){
								unlink($path.$myrow[0]);
							}
						}
					}
				}
			}
		}
		
		function DoStuff(){
			if(!$this->IsDupes()){
				if($this->FirstRun){
					$First=true;
					foreach($this->PostArray as $key => $value){
						//echo"key=$key -value=$value<br>";
						if((!in_array($key,$this->SkipArray))&&(in_array($key,$this->ValidArray))){
							if($First){
								if(is_string($value)){
									$value=$this->r->Escape(stripslashes($value));
								};
								$this->SQLData="$key='$value'";
							}else{
								if(is_string($value)){
									$value=$this->r->Escape(stripslashes($value));
								};
								$this->SQLData.=",$key='$value'";
							};
							$First=false;
						};
					};
					//echo"==============FILES===========";
					if(is_array($this->FileArray)){
						foreach($this->FileArray as $key => $value){
							$value['name']=eregi_replace(" ","_",$value['name']); //get rid of spaces
							if($value['name']){ // check to see if file actually sent
								//echo"key=$key----------------<br>";
								$MoveToKey=array_search($key,$this->MoveArray);
								$ImageKeys=array_keys($this->ImageArray,$key);
								$KImageKey=array_search($key,$this->KImageArray);
								//echo"--$MoveToKey--";
								if(is_numeric($MoveToKey)){
									//echo"<br>Send File To ".$this->MoveToArray[$MoveToKey]." <br>";
									if($this->MoveToChange[$MoveToKey]!="") $value['name']=$this->MoveToChange[$MoveToKey];
									if($First){
										$this->SQLData="$key='".$value['name']."'";
									}else{
										$this->SQLData.=",$key='".$value['name']."'";
									};	
									
									copy($value['tmp_name'],$this->MoveToArray[$MoveToKey].$value['name']);
									if($value['tmp_name']!="")	unlink($value['tmp_name']);
									$First=false;
								}
								if((is_array($ImageKeys))&&(count($ImageKeys)>0)){
									//echo"<br>Send File To ".$this->ImageToArray[$ImageKey]." and Resize To ".$this->ImageSizeArray[$ImageKey]."<br>";
									foreach($ImageKeys as $IKey =>$IVal){
										if($value['name']!=""){
											$value['name']=$this->str_makerand(5).$value['name'];
											$value['name'] = ereg_replace("[^A-Za-z0-9]", "", $value['name'] );
											if($value['tmp_name']!="") $ImgData=getimagesize($value['tmp_name']);
											if($ImgData['channels']==4){
												exec("convert -colorspace RGB -resize ".$this->ImageSizeArray[$IVal]." ".$value['tmp_name']." ".$this->ImageToArray[$IVal].$value['name']);
											}else{
												exec("convert -resize ".$this->ImageSizeArray[$IVal]." ".$value['tmp_name']." ".$this->ImageToArray[$IVal].$value['name']);
											}
											
											if($this->ImageChangeTo[$IVal]!="") $key=$this->ImageChangeTo[$IVal];
											if($First){
												$this->SQLData="$key='".$value['name']."'";
											}else{
												$this->SQLData.=",$key='".$value['name']."'";
											};
											$First=false;
										}
									}
									if($value['tmp_name']!="")	unlink($value['tmp_name']);
									
									
								}elseif(is_numeric($KImageKey)){
									if($value['name']!=""){
										$value['name']=$this->str_makerand(5).$value['name'];
										$value['name'] = ereg_replace("[^A-Za-z0-9]", "", $value['name'] );
										$SmallFileName="Small-".$value['name'];
										$BigFileName="Big-".$value['name'];
										copy($value['tmp_name'],$this->KBigToArray[$KImageKey].$BigFileName);
										if($value['tmp_name']!="") $ImgData=getimagesize($value['tmp_name']);
										if($ImgData['channels']==4){ //CMYK Image
											exec("convert -colorspace RGB -resize ".$this->KImageSizeArray[$KImageKey]." ".$value['tmp_name']." ".$this->KSmallToArray[$KImageKey].$SmallFileName);
										}else{
											exec("convert -resize ".$this->KImageSizeArray[$KImageKey]." ".$value['tmp_name']." ".$this->KSmallToArray[$KImageKey].$SmallFileName);
										}
										if($value['tmp_name']!="")	unlink($value['tmp_name']);
										if($First){
											$this->SQLData=$this->KSmallDBArray[$KImageKey]."='".$SmallFileName."'";
										}else{
											$this->SQLData.=",".$this->KSmallDBArray[$KImageKey]."='".$SmallFileName."'";
										}
										$this->SQLData.=",".$this->KBigDBArray[$KImageKey]."='".$BigFileName."'";
										$First=false;
									}
								}
							};
							//foreach($value as $key2 => $value2){
								//echo"key=$key2 -value=$value2<br>";
							//};
							
							
						};
					};
					// functions
					foreach($this->FunctionArray as $key => $value){
						if($First){
							if(is_string($value)){
								$value=$this->r->Escape(stripslashes($value));
							};
							$this->SQLData="$key=$value";
						}else{
							if(is_string($value)){
								$value=$this->r->Escape(stripslashes($value));
							};
							$this->SQLData.=",$key=$value";
						};
						$First=false;
					}
					// extra fields
					foreach($this->ExtraFields as $key => $value){
						if($First){
							if(is_string($value)){
								$value=$this->r->Escape(stripslashes($value));
							};
							$this->SQLData="$key='$value'";
						}else{
							if(is_string($value)){
								$value=$this->r->Escape(stripslashes($value));
							};
							$this->SQLData.=",$key='$value'";
						};
						$First=false;
					};
					$this->FirstRun=false;
				};
				//create and execute the query
				$this->SQL="UPDATE $this->Table SET $this->SQLData WHERE $this->PrimaryKey=$this->ID";
				$result = $this->r->rawQuery($this->SQL);
				if(!$result){
					echo"error-$this->SQL"; 
				}
				//print $this->SQL;
			}
			return $this->Errors;
		}
		
	}
	
	//-----------------------------------------------------------------------------------------------------------
	class clsDatabaseConnect{
		public $log=false;
		var $log_text="";
		var $links = array();
		var $connect=array();
		var $mysqli=false;
		var $Insert_Id=false;
		var $db_logins=array();
		var $dbss=array();
		var $current_dir="";
		var $default_db=array();
		var $def_db="";
		var $server_names=array();
		var $server_num=0;
		var $db_num=array(0=>0,1=>0,2=>0);
		var $def_db_num=array(0=>0,1=>0,2=>0);
		var $datab_name="";
		var $server_login=array();
		var $all_databases_array=array();
		var $server_tags=array();
		var $all_db_login_data=array();
		var $local_db=array();
		var $host_name="localhost";
		//var $db_name_serv=array(0=>0,1=>0,2=>0);
		var $db_name_def_num=array(0=>0,1=>0,2=>0);
		var $db_num_ser=array(0=>0,1=>0,2=>0);
		var $current_server_tag="";
		//-----------------------------------------------------------------------------------------------------------
	
		//function ConnectDbase(){
		
		function __construct(&$log=false){
			if($log){
				$this->log=$log;
			}
			$this->Initialise_Current_Server();
		}
		//-----------------------------------------------------------------------------------------------------------
		
		
		public function Set_Log(&$log){
			$this->log=$log;
			$this->log->general("-Set Log Boot Success: $r->".var_export($log,true),3);
			//$this->log->general('Set Log Boot Success: $r->',1);
				
		}

		//-----------------------------------------------------------------------------------------------------------
		
		/*
		public function Check_zzzzdb(&$log){
			$this->log=$log;
			$this->log->general("-Set Log Boot Success: $r->".var_export($log,true),3);
			//$this->log->general('Set Log Boot Success: $r->',1);
				
		}
		*/
		//-----------------------------------------------------------------------------------------------------------
		private function Initialise_Current_Server(){
			
			$this->current_dir=pathinfo(__DIR__);
			$current_directory=$this->current_dir['dirname'];
			//$DB_Login_Data=$this->all_db_login_data;
			$this->host_name=gethostname();
			$DB=array();
			
			$DB['server_tag']="db-default.php";
			$DB['server_desc']="Private Server";
			$DB['current_dir']="/var/www/html";
			$DB['server_number']=4;
			$DB['hostname']="localhost";
			$DB['usernamedb']="Edit This";
			$DB['passworddb']="Edit This";
			$DB['dbName']="bubblelite2";
			$DB['dbNames']=array('bubblelite2','takebookings','partnerspro','smsg');
			$server_login["db-linode.php"]=array('server_tag'=>$DB['server_tag'],'server_desc'=>$DB['server_desc'],'current_dir'=>$DB['current_dir'],'server_number'=>$DB['server_number'],'hostname'=>$DB['hostname'],'usernamedb'=>$DB['usernamedb'],'passworddb'=>$DB['passworddb'],'dbName'=>$DB['dbName'],'dbNames'=>$DB['dbNames']);

						
				
				
			if(count($DB)>0){
				$this->current_server_tag=$DB['server_tag'];
				$this->current_dir=$DB['current_dir'];
				//$this->server_name=$server_name;
				$this->server_desc=$DB['server_desc'];
				$this->log_text.$this->current_dir;
				//$this->def_db_num[$server_num]=0;
				$this->server_login=$server_login;
				//$this->db_logins[$server_name]=$server_login;
			}
			//-----------------------------------------------------------------------------------------------------------	
			
		}
		
		
		public function test_pgsql(){
			//echo"888800001-------------------|-99-|----------------------------------------------------------\n\n";
			
			//echo"888800001-------------------|-".$this->current_db_type."-|----------------------------------------------------------\n\n";
			/*
			try{
				$dbconn = pg_connect("host=localhost dbname=cwy0ek0e_bubblelite2 user=postgres password=DickSux5841");
				$v = pg_version($dbconn);
				print "\n++|==".$v."=|++\n\n";
			}catch(Exception $e){
				exit("xx".var_export($e,true));
			}
			*/
			
			$dbconn = pg_connect("host=localhost dbname=cwy0ek0e_bubblelite2 user=postgres password=DickSux5841");
			// Performing SQL query
			$query = 'SELECT * FROM administrators';
			//$result = pg_query($query) or die('Query failed: ' . pg_last_error());
			echo"43210000555-------------------|-".var_export($dbconn,true)."-|----------------------------------------------------------\n\n";
			$result = pg_query($query);
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
		
		public function Connect($TArr="",$db_type="MySQL"){
			
			//$this->test_pgsql();
			//exit("yy");
			
			
			try{	
				 //$db_ser_num=$this->Initialise_Current_Server();
				//$TArr=array();
				//if($TArr==""){
				//}
				//exit($db_type);
				//echo"-1----------------------".$db_type."-------------------------------------";
				if($db_type=="MySQL"){
					if(isset($this->links[$TArr]))
					{
						return $this->links[$TArr];
					}
					else
					{
						if($TArr==""){
							$TArr=$this->current_server_tag;
						}
						
						try{
							$db_login=$this->server_login[$TArr];
							try{
								$new_links = new mysqli($db_login['hostname'], $db_login['usernamedb'], $db_login['passworddb'],$db_login['dbName'] );
								
							}catch(MySQLException $e){
								
							}
							// Check connection
							if($new_links->connect_error) {
								$this->log->general("-Connection Error-".$new_links->connect_error."\n vars:=".var_export($db_login),3);
							}else{
								$this->log->general("-Connection Success->".$TArr,1);
								$this->log->general("\n",1);
								$this->links[$TArr]=$new_links;
							}
							
						}catch(MySQLErrorException $e){
							$this->log->general("-MySQLErrorException-".var_export($e,true),3);	
							
						}
						$this->log->general("-Return Connection Success->".$TArr,1);
						return $this->links[$TArr];
					}	
				}elseif($db_type=="Sqlite"){
					$DB['server_tag']="db-sqlite3.php";
					$this->current_server_tag=$DB['server_tag'];
					$TArr=$this->current_server_tag;
					$server_login[$DB['server_tag']]=array();
						
					$db = new SQLite3('./db/bubblelite.db');
					$this->links[$TArr]=$db;
					//echo"-2----------------------".$db_type."-------------------------------------";

					return $this->links[$TArr];
				}elseif($db_type=="pgSQL"){
					//exit("--|-".$db_type."-|--\n\n");
					
					$DB['server_tag']="db-pgSQL.php";
					$this->current_server_tag=$DB['server_tag'];
					$TArr=$this->current_server_tag;
					$server_login[$DB['server_tag']]=array();
					$db = pg_connect("host=localhost dbname=Edit-This user=Edit-This password=Edit-This")
    				or die('Could not connect: ' . pg_last_error("db-errror"));
					$this->links[$TArr]=$db;
					//echo"-210----------------------".$db_type."-------------------------------------";
					
					return $this->links[$TArr];
				}
				
			}catch(Exception $e){
				$this->log->general("-Exception-".var_export($e,true),3);
			}
			
			
		}
		
		
	}
?>
