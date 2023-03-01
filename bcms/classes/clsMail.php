<?php
	//ver 0.01
	class SendMail{
		var $ToArray=array();
		var $ToString;
		var $FromName;
		var $FromEmail;
		var $FileArray=array();
		var $Subject;
		var $headers;
		var $BodySimple;
		var $BodyPlain;
		var $BodyHTML;
		var $Template;
		
		function Template($Path){
			$linesz= filesize($Path)+1;
			$fp= fopen($Path, 'r' );
			$this->Template = fread( $fp, $linesz);
			fclose($fp);
			
			$this->BodySimple=strip_tags($this->Template);
			$this->BodyPlain=strip_tags($this->Template);
			$this->BodyHTML=$this->Template;
		}
		
		function Merge($Fields){
			if(is_array($Fields)){
				foreach($Fields as $key=>$val){
					$this->BodySimple=eregi_replace("\[$key\]","$val",$this->BodySimple);
					$this->BodyPlain=eregi_replace("\[$key\]","$val",$this->BodyPlain);
					$this->BodyHTML=eregi_replace("\[$key\]","$val",$this->BodyHTML);
				};
			}
		}
		
		function GPGEncrypt($recp,$data){
			$username = "shaun12";
			$pgp="/usr/bin/gpg";
			// User that is sending the e-mail (In the from address etc..)
			$user="dpruul <dpruul@gmail.com>";
			//This is the key that was uploaded, i.e. the recipent of the PGP message
			//$recp="First Last <user@domain.com>";
			//$data="Text that will be encrypted";
			$command = 'echo "'.$data.'" | '.$pgp.' -a --always-trust --batch --no-secmem-warning -e -u "'.$user.'" -r "'.$recp.'"';
			$oldhome = getEnv("HOME");
			putenv("HOME=/home/$username");
			$result = exec($command, $encrypted, $errorcode);
			putenv("HOME=$oldhome");
			$message = implode("\n", $encrypted);
			/*if(ereg("-----BEGIN PGP MESSAGE-----.*-----END PGP MESSAGE-----",$message))
			{
					echo "It Worked";
			}else
			{
					echo "It failed";
			}
			
			$subject="Test message";
			$header="From: $user";
			echo "Message<br>";
			echo nl2br($message);
			
			mail($recp,$subject,$message,$header); 
			echo $message;*/
			return $message;
		}
		
		function Body($Simple,$Plain,$HTML="",$GPG=false){
			//echo $GPG;
			if($Simple!=""){
				if($GPG) $Simple=$this->GPGEncrypt($GPG,$Simple);
				$this->BodySimple=$Simple;
			}
			if($Plain!=""){
				if($GPG) $Plain=$this->GPGEncrypt($GPG,$Plain);
				$this->BodyPlain=$Plain;
			}
			if($HTML!=""){
				if($GPG) $HTML=$this->GPGEncrypt($GPG,$HTML);
				$this->BodyHTML=$HTML;
			}
		}
		function To($To){
			if(is_array($To)){
				$this->ToArray=$To;
			}
		}
		function From($Name,$Email){
			$this->FromName=$Name;
			$this->FromEmail=$Email;
		}
		function Attachments($File){
			if(is_array($File)){
				$this->FileArray=$File;
			}else{
				$this->FileArray[]=$File;
			}
		}
		function Subject($Subject){
			$this->Subject=$Subject;
		}
		
		function api_password($length = 8){ 
			srand((double) microtime() * 1000000); 
			$alpha = array('a','b','c','d','e','f','g','h','i','j','k','l', 
			'm','n','o','p','q','r','s','t','u','v','w','x','y','z'); 
			$options = array('alpha','number'); 
			$password="";
			for ($i = 0; $i < $length; $i++){ 
				$char = array_rand($options,1); 
				if ($options[$char] == 'alpha'){ 
					$random_letter = rand (0,25); 
					$password .= $alpha[$random_letter]; 
				}else{ 
					$random_number = rand (0,9); 
					$password .= $random_number; 
				} 
			} 
			return $password; 
		} 
		
		function Build(){
			$boundary = $this->api_password(16);
			$boundary2 = $this->api_password(16); 
			$this->headers = "From: \"".$this->FromName."\" <".$this->FromEmail.">\n"; 
			//===================== who the email gos to
			$this->headers .= "To: ";
			$Count=0;
			foreach($this->ToArray as $name=>$email){
				$tmp=($Count==0 ? "" : ",");
				$this->ToString .=$tmp."\"".$name."\" <".$email.">";
			};
			$this->headers .=$this->ToString;
			$this->headers .="\n"; 
			//======================
			$this->headers .= "Return-Path: <".$this->FromEmail.">\n"; 
			$this->headers .= "mime-Version: 1.0\n";  
			
			$this->headers .= "Content-Type: multipart/mixed;\n boundary=\"".$boundary."\"\nX-Priority: 3\nX-MSMail-Priority: Normal\nX-Mailer: Microsoft Outlook Express 6.00.2800.1106\nX-MimeOLE: Produced By Microsoft MimeOLE V6.00.2800.1106\n"; 
			$this->headers .= $this->BodySimple."\n\nThis is a multi-part message in MIME format.\n"; 
			$this->headers .= "--".$boundary."\n"; 
			$this->headers .="Content-Type: multipart/alternative;\n boundary=\"".$boundary2."\"\n\n";
			$this->headers .= "--".$boundary2."\n"; 
			$this->headers .= "Content-Type: text/plain;\n charset=\"ISO-8859-1\"\n"; 
			$this->headers .= "Content-Transfer-Encoding: 8bit\n\n"; 
			$this->headers .= $this->BodyPlain."\n"; 
			$this->headers .= "--".$boundary2."\n"; 
			$this->headers .= "Content-Type: text/html; charset=\"ISO-8859-1\"\n"; 
			$this->headers .= "Content-Transfer-Encoding: 8bit\n\n"; 
			$this->headers .= $this->BodyHTML."\n"; 
			$this->headers .= "--".$boundary2."--\n"; 
			
			if(is_array($this->FileArray)){
				foreach($this->FileArray as $file){
					$this->headers .= "--".$boundary."\n"; 
					$this->headers.="Content-Type: image/jpeg;\n name=\"".$file['name']."\"\nContent-Transfer-Encoding: base64\nContent-Disposition: attachment;\n  filename=\"".$file['name']."\"\n\n";
					$linesz= filesize( $file['tmp_name'])+1;
					$fp= fopen($file['tmp_name'], 'r' );
					$this->headers .= chunk_split(base64_encode(fread( $fp, $linesz)))."\n";
					fclose($fp);
				}
			}
			$this->headers .= "--".$boundary."--\n";
			
		}
		
		function Send(){
			$this->Build();
			$this->ToString="admin@localhost";
			mail($this->ToString, $this->Subject, '', $this->headers); 
		}
	
	}

?>