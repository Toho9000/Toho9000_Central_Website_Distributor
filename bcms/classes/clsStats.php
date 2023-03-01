<?php 

define ("IMG", "1px.png"); // change this constant to use dif. image/path

//date_default_timezone_set("Australia/Brisbane");

class Count_visitors {

	var $table_name = "visits";
	var $referer;
	var $delay = 1;
	var $r;
	var $DomainsID;
	var $SType;
	var $affiliateID;
	var $affiliateBannersID;
	
	// niet vergeten visits ouder dan een jaar te verwijderen
	function Count_visitors($s,$a=0,$b=0) {
		$this->referer = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : "";
		$this->r=new ReturnRecord();
		$this->SType=$s;
		$this->affiliateID=$a;
		$this->affiliateBannersID=$b;
	}
	
	
	 	// ----------------------------------------------------------------------------
	/* $ref is optional, if not set will use current! */
	function seReferer($ref,$SENumber) {
		$SeReferer = $ref;
		if( //Check against Google, Yahoo, MSN, Ask and others
			preg_match(
			"/[&\?](q|p|w|searchfor|as_q|as_epq|s|query)=([^&]+)/i",
			$SeReferer,$pcs)
		){
			if(preg_match("/https?:\/\/([^\/]+)\//i",$SeReferer,$SeDomain)){
				$SeDomain    = trim(strtolower($SeDomain[1]));
				$SeQuery    = $pcs[2];
				if(preg_match("/[&\?](start|b|first|stq)=([0-9]*)/i",$SeReferer,$pcs)){
					$SePos    = (int)trim($pcs[2]);
				}
			}
		}
		if(!isset($SeQuery)){
			if( //Check against DogPile
				preg_match(
				"/\/search\/web\/([^\/]+)\//i",
				$SeReferer,$pcs)
			){
				if(preg_match("/https?:\/\/([^\/]+)\//i",$SeReferer,$SeDomain)){
					$SeDomain    = trim(strtolower($SeDomain[1]));
					$SeQuery    = $pcs[1];
				}
			}
		}
		// We Do Not have a query
		if(!isset($SeQuery)){ return false; }
		$OldQ=$SeQuery;
		$SeQuery=urldecode($SeQuery);
		// The Multiple URLDecode Trick to fix DogPile %XXXX Encodes
		while($SeQuery != $OldQ){
			$OldQ=$SeQuery; $SeQuery=urldecode($SeQuery);
		}
		//-- We have a query
		return array(
			"Number Of Queries"=>$SENumber,
			"Search Engine"=>$SeDomain,
			"Query"=>$SeQuery,
			"Pos"=>(int)$SePos//,
			//"Referer"=>$SeReferer
		);
	}
	
	function show_sevisits_day($day,$month,$year) {
		$Count=0;
		$res_today = $this->r->RawQuery(sprintf("SELECT COUNT(referer) AS count,referer FROM %s WHERE visit_date = '$year-$month-$day' AND affiliateID=$this->affiliateID GROUP BY referer ORDER BY count DESC", $this->table_name));
		while($today = mysql_fetch_array($res_today)){
			$res[$Count]=$this->seReferer($today[1],$today[0]);
			$Count++;
		}
		return $res;
	}
	
	function show_sevisits_month($month,$year) {
		$Count=0;
		$res_today = $this->r->RawQuery(sprintf("SELECT COUNT(referer) AS count,referer FROM %s WHERE MONTH(visit_date) = '$month' AND YEAR(visit_date)='$year' AND affiliateID=$this->affiliateID GROUP BY referer ORDER BY count DESC", $this->table_name));
		while($today = mysql_fetch_array($res_today)){
			$res[$Count]=$this->seReferer($today[1],$today[0]);
			$Count++;
		}
		return $res;
	}
	
	function show_sevisits_year($year) {
		$Count=0;
		$res_today = $this->r->RawQuery(sprintf("SELECT COUNT(referer) AS count,referer FROM %s WHERE YEAR(visit_date)='$year' AND affiliateID=$this->affiliateID GROUP BY referer ORDER BY count DESC", $this->table_name));
		while($today = mysql_fetch_array($res_today)){
			$res[$Count]=$this->seReferer($today[1],$today[0]);
			$Count++;
		}
		return $res;
	}
	
	function stats_se_results($year,$month="",$day="") {
		if($day!=""){
			$country_visits = $this->show_sevisits_day($year,$month,$day);
			$label=" on $day-$month-$year";
		}elseif($month!=""){
			$country_visits = $this->show_sevisits_month($year,$month);
			$label=" in $month-$year";
		}else{
			$country_visits = $this->show_sevisits_year($year);
			$label=" in $year";
		}
		$country_tbl = "<h2>Search Terms $label </h2>\n";
		$country_tbl .= "<table width=\"480\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\" class='bordertable'>\n";
		 
		$country_tbl .= $this->build_rows_totals_seo($country_visits);
		
		$country_tbl .= "</table>\n";
		return $country_tbl;
	}
	
	function build_rows_totals_seo($array_total) {
		//$all_values = array_sum($array_values);
		$row = "";
		$First=true;
		if(is_array($array_total)){
			foreach($array_total as $each=>$eacharr) {
				if(is_array($eacharr)){
					if($First){
						$row .= "  <tr>\n";
							foreach($eacharr as $key=>$val) {
								
								$row .= "	   <td>".$key."</td>\n";	
								
							}
						$row .= "  </tr>\n";
						reset($eacharr);
						$First=false;
					}
					$row .= "  <tr>\n";
						foreach($eacharr as $key=>$val) {
							$row .= "	   <td>".$val."</td>\n";
						}
					$row .= "  </tr>\n";
				}
			}
		}
		return $row;
	}
	
	function check_last_visit() {
		$check_sql = sprintf("SELECT time + 0 FROM %s WHERE visit_date = CURDATE() AND ip_adr = '%s' ORDER BY time DESC LIMIT 0, 1", $this->table_name, $_SERVER['REMOTE_ADDR']);
		$check_visit = $this->r->RawQuery($check_sql);
		$check_row = mysql_fetch_array($check_visit);
		if ($this->r->NumRows($check_visit) != 0) {
			$last_hour = date("H") - $this->delay; 
			$check_time = date($last_hour."is");
			if ($check_row[0] < $check_time) {
				return true;
			} else {
				return false;
			}
		} else {
			return true;
		}
	}
	function get_country() {
		$country_sql = sprintf("SELECT country FROM ip2nation WHERE ip < INET_ATON('%s') ORDER BY ip DESC LIMIT 0,1", $_SERVER['REMOTE_ADDR']);
		$country_res = $this->r->RawQuery($country_sql);
		$country = mysql_result($country_res, 0, "country");
		return $country;
	}
	function insert_new_visit($Domain="") {
		if($Domain=="") $Domain=$_SERVER['HTTP_HOST'];
		if ($this->check_last_visit()) {
			$insert_sql = sprintf("INSERT INTO %s (id, ip_adr, referer, country, client, visit_date, time, on_page,Domain,StatType,affiliateID,affiliateBannersID) VALUES (NULL, '%s', '%s', '%s', '%s', CURDATE(), CURTIME(), '%s','$Domain','$this->SType',$this->affiliateID,$this->affiliateBannersID)", $this->table_name, $_SERVER['REMOTE_ADDR'], $this->referer, $this->get_country(), $_SERVER['HTTP_USER_AGENT'], $_SERVER['REQUEST_URI']);
			$this->r->RawQuery($insert_sql);
			return mysql_insert_id();
		}else{
			return -1;
		}
		
	}
	function show_all_visits() {
		$result = $this->r->RawQuery(sprintf("SELECT COUNT(*) AS count FROM %s  WHERE affiliateID=$this->affiliateID", $this->table_name));
		$visits = mysql_result($result, 0, "count");
		return $visits;
	}
	function show_visits_today($day,$month,$year) {
		$res_today = $this->r->RawQuery(sprintf("SELECT COUNT(*) AS count FROM %s WHERE visit_date = '$year-$month-$day' AND affiliateID=$this->affiliateID", $this->table_name));
		$today = mysql_result($res_today, 0, "count");
		return $today;
	}
	function show_visits_month($month,$year) {
		$res_today = $this->r->RawQuery(sprintf("SELECT COUNT(*) AS count FROM %s WHERE MONTH(visit_date) = '$month' AND YEAR(visit_date)='$year' AND affiliateID=$this->affiliateID", $this->table_name));
		$today = mysql_result($res_today, 0, "count");
		return $today;
	}
	function show_visits_year($year) {
		$res_today = $this->r->RawQuery(sprintf("SELECT COUNT(*) AS count FROM %s WHERE YEAR(visit_date)='$year' AND affiliateID=$this->affiliateID", $this->table_name));
		$today = mysql_result($res_today, 0, "count");
		return $today;
	}
	function first_last_visit($type = "last") {
		$order_dir = ($type == "last" ? "DESC" : "ASC");
		$result = $this->r->RawQuery(sprintf("SELECT visit_date, time FROM %s WHERE affiliateID=$this->affiliateID ORDER BY visit_date,time %s LIMIT 0,1", $this->table_name, $order_dir));
		
		$first_last = mysql_result($result, 0, "visit_date");
		$first_last .= " ".mysql_result($result, 0, "time");
		return $first_last;
	}
	function results_by_day($res_month, $res_year) {
		$sql = sprintf("SELECT DAYOFMONTH(visit_date) AS visit_day, COUNT(*) AS visits_count FROM %s WHERE MONTH(visit_date) = %s AND YEAR(visit_date) = %s AND affiliateID=$this->affiliateID GROUP BY visit_date", $this->table_name, $res_month, $res_year);
		$result = $this->r->RawQuery($sql);
		$visits_daily = array();
		while ($obj = mysql_fetch_object($result)) {
			$visits_daily[$obj->visit_day] = $obj->visits_count;
		}
		return $visits_daily;
	}
	
	function results_by_hour($res_day,$res_month, $res_year) {
		$sql = "SELECT HOUR(time) AS visit_hour, COUNT(*) AS visits_count FROM $this->table_name WHERE DAY(visit_date)='$res_day' AND MONTH(visit_date) = '$res_month' AND YEAR(visit_date) = '$res_year' AND affiliateID=$this->affiliateID GROUP BY visit_hour";
		$result = $this->r->RawQuery($sql);
		$visits_hourly = array();
		while ($obj = mysql_fetch_object($result)) {
			$visits_hourly[$obj->visit_hour] = $obj->visits_count;
		}
		return $visits_hourly;
	}
	
	function results_by_selected_month($res_year) {
		$sql = "SELECT Month(visit_date) AS visit_month, COUNT(*) AS visits_count FROM $this->table_name WHERE YEAR(visit_date) = '$res_year' AND affiliateID=$this->affiliateID GROUP BY visit_month";
		$result = $this->r->RawQuery($sql);
		$visits_monthly = array();
		while ($obj = mysql_fetch_object($result)) {
			$visits_monthly[$obj->visit_month] = $obj->visits_count;
		}
		return $visits_monthly;
	}
	
	function results_by_month() {
		$sql = sprintf("SELECT MONTH(visit_date) AS visits_month, COUNT(*) AS month_count FROM %s  WHERE affiliateID=$this->affiliateID  GROUP BY MONTH(visit_date) ORDER BY visit_date LIMIT 0,12", $this->table_name);
		$result = $this->r->RawQuery($sql);
		$visits_monthly = array();
		while ($obj = mysql_fetch_object($result)) {
			$visits_monthly[$obj->visits_month] = $obj->month_count;
		}
		return $visits_monthly;
	}
	function res_country_top($year,$month="",$day="") {
		$dsql=" AND YEAR(visit_date)='$year'";
		if($month!="") $dsql.=" AND MONTH(visit_date)='$month'";
		if($day!="") $dsql.=" AND DAY(visit_date)='$day'";
		
		$sql = sprintf("SELECT ip2nationCountries.country AS in_country, COUNT(*) AS visits_country FROM visits AS tbl LEFT JOIN ip2nationCountries ON ip2nationCountries.code = tbl.country WHERE tbl.country <> '' $dsql AND affiliateID=$this->affiliateID GROUP BY tbl.country ORDER BY 2 DESC LIMIT 0,10", $this->table_name);
		
		$result = $this->r->RawQuery($sql);
		$country_top = array();
		while ($obj = mysql_fetch_object($result)) {
			$country_top[$obj->in_country] = $obj->visits_country;
		}
		return $country_top;
	}
	function get_days($from_month, $from_year) {
		$last_day = date("t", mktime(0,0,0,$from_month,1,$from_year));
		$day_count = 1;
		while ($day_count <= $last_day) {
			$days_array[] = $day_count;
			$day_count++;
		}
		return $days_array;
	}
	function create_date($month2, $year2) {
		$date_str = date ("M y", mktime (0,0,0,$month2,0,$year2)); 
		return $date_str;
	}
	function month_last_year() {
		$i = 0;
		while ($i < 12) {
			$twelve_month[$i] = date("n", mktime(0,0,0,date("n")-$i,15,date("Y")));
			$i++;
		}
		return $twelve_month;
	}	
	function build_rows_totals($array_labels, $array_values) {
		$all_values = array_sum($array_values);
		$row = "";
		foreach($array_labels as $label) {
			if (isset($array_values[$label])) {
				$row .= "  <tr>\n";
				$row .= "	   <td>".$label."</td>\n";			
				$width = ($array_values[$label]*100)/$all_values;
				$row .= "	   <td><img src=\"".IMG."\" width=\"".round($width*3, 0)."\" height=\"10\"></td>\n";
				$row .= "	   <td>".$array_values[$label]."</td>\n";
				$row .= "  </tr>\n";
			}
		}
		return $row;
	}
	function stats_country($year,$month="",$day="") {
		if($day!=""){
			$country_visits = $this->res_country_top($year,$month,$day);
			$label=" on $day-$month-$year";
		}elseif($month!=""){
			$country_visits = $this->res_country_top($year,$month);
			$label=" in $month-$year";
		}else{
			$country_visits = $this->res_country_top($year);
			$label=" in $year";
		}
		$country_array = array_keys($country_visits);
		$country_tbl = "<h2>Visits by Country $label (Top ".count($country_array).")</h2>\n";
		$country_tbl .= "<table width=\"480\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\" class='bordertable'>\n";
		$country_tbl .= "  <tr>\n";
		$country_tbl .= "    <th>Country</th>\n";
		$country_tbl .= "    <th>&nbsp;</th>\n";
		$country_tbl .= "    <th>Visits</th>\n";
		$country_tbl .= "	 </tr>\n";
		$country_tbl .= $this->build_rows_totals($country_array, $country_visits);
		$country_tbl .= "  <tr>\n";
		$country_tbl .= "    <th>Total Of Shown</th>\n";
		$country_tbl .= "    <th>&nbsp;</th>\n";
		$country_tbl .= "    <th>".array_sum($country_visits)."</th>\n";
		$country_tbl .= "	 </tr>\n";
		$country_tbl .= "</table>\n";
		return $country_tbl;
	}
	function stats_totals() {
		$month_array = $this->month_last_year();
		krsort($month_array);
		reset($month_array);
		$all_visits_month = $this->results_by_month();
		$total_tbl = "<h2>Visits last ".count($all_visits_month)." month</h2>\n";
		$total_tbl .= "<table width=\"480\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\" class='bordertable'>\n";
		$total_tbl .= "  <tr>\n";
		$total_tbl .= "    <th>Month</th>\n";
		$total_tbl .= "    <th>&nbsp;</th>\n";
		$total_tbl .= "    <th>Visits</th>\n";
		$total_tbl .= "	 </tr>\n";
		$total_tbl .= $this->build_rows_totals($month_array, $all_visits_month);
		$total_tbl .= "</table>\n";
		return $total_tbl;
	}
	function stats_monthly($month, $year) {
		$my_visits = $this->results_by_day($month, $year);
		$total_visits = array_sum($my_visits);
		$month_tbl = "<h2>Visits in ".$this->create_date($month, $year)." (total: ".$total_visits.")</h2>\n";
		$month_tbl .= "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\"  class='bordertable'>\n";
		$ColCount=0;
		
		foreach($this->get_days($month, $year) as $day) {
			if($ColCount==0){
				$month_tbl .= "  <tr>\n";
			};
			
			if (isset($my_visits[$day])) {
				$height = ($my_visits[$day]*100)/$total_visits;
				$month_tbl .= "	   <td valign='bottom' width=\"10%\">Day=$day<br>".$my_visits[$day]."<br><img src=\"".IMG."\" width=\"10\" height=\"".round($height*5, 0)."\"></td>\n";
				
			} else {
				$month_tbl .= "    <td valign='bottom'>Day=$day<br>0</td>\n";
			}
			
			if($ColCount==7){
				$month_tbl .= "	 </tr>\n";			
				$ColCount=0;
			}else{
				$ColCount++;
			}
		}
		
		
		$month_tbl .= "</table>\n";
		return $month_tbl;
	}
	
	function stats_dayly($day,$month, $year) {
		$my_visits = $this->results_by_hour($day,$month, $year);
		$total_visits = array_sum($my_visits);
		$hour_tbl = "<h2>Visits on $day ".$this->create_date($month, $year)." (total: ".$total_visits.")</h2>\n";
		$hour_tbl .= "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\" class='bordertable'>\n";
		$ColCount=0;
		
		for($hour=1;$hour<25;$hour++) {
			if($ColCount==0){
				$hour_tbl .= "  <tr>\n";
			};
			
			if (isset($my_visits[$hour])) {
				$height = ($my_visits[$hour]*100)/$total_visits;
				$hour_tbl .= "	   <td valign='bottom' width=\"10%\">Hour=$hour<br>".$my_visits[$hour]."<br><img src=\"".IMG."\" width=\"10\" height=\"".round($height*5, 0)."\"></td>\n";
				
			} else {
				$hour_tbl .= "    <td valign='bottom'>Hour=$hour<br>0</td>\n";
			}
			
			if($ColCount==5){
				$hour_tbl .= "	 </tr>\n";			
				$ColCount=0;
			}else{
				$ColCount++;
			}
		}
		
		
		$hour_tbl .= "</table>\n";
		return $hour_tbl;
	}
	
	function stats_yearly($year) {
		$my_visits = $this->results_by_selected_month($year);
		$total_visits = array_sum($my_visits);
		$month_tbl = "<h2>Visits in $year (total: ".$total_visits.")</h2>\n";
		$month_tbl .= "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\" class='bordertable'>\n";
		$ColCount=0;
		
		for($month=1;$month<13;$month++) {
			if($ColCount==0){
				$month_tbl .= "  <tr>\n";
			};
			
			if (isset($my_visits[$month])) {
				$height = ($my_visits[$month]*100)/$total_visits;
				$month_tbl .= "	   <td valign='bottom' width=\"10%\">Month=$month<br>".$my_visits[$month]."<br><img src=\"".IMG."\" width=\"10\" height=\"".round($height*5, 0)."\"></td>\n";
				
			} else {
				$month_tbl .= "    <td valign='bottom'>Month=$month<br>0</td>\n";
			}
			
			if($ColCount==5){
				$month_tbl .= "	 </tr>\n";			
				$ColCount=0;
			}else{
				$ColCount++;
			}
		}
		
		
		$month_tbl .= "</table>\n";
		return $month_tbl;
	}
	
	
}
?>