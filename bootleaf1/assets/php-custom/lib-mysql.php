<?php

	// CTI custom PHP - MySQL functions
	// JPS3
	// changelog
	// 2014-10-20 - CREATED

	class buildMySQL 
	{
		// insert
		private function insert($str_table, $ary_row)
		{
			$html_reg = '/<+\s*\/*\s*([A-Z][A-Z0-9]*)\b[^>]*\/*\s*>+/i';
			$ary_columns = array_keys($ary_row);
			$ary_values = array_values($ary_row);
			$lastCol = end($ary_columns);
			$lastVal = end($ary_values);
			$aryCount = count($ary_values);
			
			$p = 0;
			$str_columns = "(";
			$str_values = "(";
			foreach ($ary_row as $key=>$val){
				
				// COLUMNS
				$str_columns .= "$key";
				if ($key != $lastCol)
					$str_columns.=",";
				else
					$str_columns.="";
				
				// VALUES
				$val = ($val !== null ? htmlentities($val, ENT_QUOTES) : "");
				$str_values .= "'$val'";
				//if ($val != $lastVal)
				if ($p+1 < $aryCount)
					$str_values.=",";
				else
					$str_values.="";
				$p++;
			}
			$str_columns .= ")";
			$str_values .= ")";
					
			$strMySQLinsert = "INSERT into $str_table $str_columns VALUES $str_values";
			return $strMySQLinsert;	}
		
		// update OR delete
		private function update($str_table, $ary_row, $updateType)
		{
			$ary_columns = array_keys($ary_row);
			$ary_values = array_values($ary_row);
			$str_conditions = "";
			$strMySQLupdate = "";
			
			switch($updateType){
				case "d":
					$strMySQLupdate = "DELETE FROM $str_table ";
					break;
				case "u":
					$strMySQLupdate = "UPDATE $str_table SET ";
					break;
				default:
					return "ERROR: NO UPDATE TYPE SPECIFIED!";
					//break;
			}
			$int_num_cols = count($ary_row);
			
			switch($str_table){
				case "locations":
				case "projects":
					$str_table_key = $str_table;
					break;
				default:
					$str_table_key = "all";
				
			}
			
			$makeCondition = array (
				"projects" => array("ID"),
				"locations" => array("id","projectID"),
				//"all" => array()
				);
				
			for ($x = 0; $x < $int_num_cols; $x++)
			{
				$col = $ary_columns[$x];
				$val = $ary_values[$x];
				
				//$strDebug .= ''.$col.' = '.$val.'<br/>';
			
				//echo $col.' = '.$val.'<br/>';
				if (in_array($col, $makeCondition[$str_table_key]))
				{
					//echo $str_table_key.print_r($makeCondition[$str_table_key]);
					$str_conditions = 'AND  '.$col.'=\''.$val.'\' '.$str_conditions;
				} else {
					$strMySQLupdate .= $col.'=\''.addslashes(htmlspecialchars(trim($val), ENT_QUOTES)).'\'';
					if ($x+1 < $int_num_cols) $strMySQLupdate .= ",
					";
					else $strMySQLupdate .= " ";
				}
			}
			//$strDebug .= "COLUMN COUNT: $int_num_cols<br/>";
			//$strDebug .= "STR_CONDITIONS: $str_conditions<br/>";
			if (trim($str_conditions)!="" && substr($str_conditions, 0, 3) == "AND") 
			{
				$str_conditions = substr($str_conditions, 3); // remove leading 'AND'
				$strMySQLupdate .= " WHERE $str_conditions";
			}
			return $strMySQLupdate;	
		}
		
		// select statements for location filters
		private function filter($get)
		{
			//echo '<pre>'.print_r($get,1).'</pre>';
			$ary_valid_keys = array('p','g','c','d','i'); // projects, goals, countries, donor group, implementer group
			$ary_get_keys = array_keys($get);
			$str_cond = null;
			$str_order = null;
			
			//echo print_r(array_diff_key($ary_valid_keys, $ary_get_keys),1);

			$str_query_base = 'SELECT loc.*, loc.latitude AS x, loc.longitude AS y, proj.title, proj.countries, proj.ID
			FROM locations as loc 
			LEFT JOIN projects AS proj 
			ON proj.ID=loc.projectID';

			// SQL WHERE conditions
			// projects
			if (@is_array($get['p'])){
				//array_walk($get['p'], array($this, 'numToString'));
				$str_cond['p'] = "(proj.ID=".implode(" OR proj.ID=",$get['p']).")";
				$str_order = " ORDER BY proj.updated DESC";
			} /*else {
				$str_cond['p'] = "";
			}*/

			// goals
			if (@is_array($get['g'])){
				array_walk($get['g'], array($this, 'encloseInLikeWildcards'));
				$str_cond['g'] = "(proj.goals LIKE ".implode(" AND proj.goals LIKE", $get['g']).")";
				$str_order = "";
			} /*else {
				$str_cond['g'] = "";
			}*/
			
			// countries
			if (@is_array($get['c'])){
				array_walk($get['c'], array($this, 'encloseInLikeWildcards'));
				$str_cond['c'] = "(proj.countries LIKE ".implode(" AND proj.countries LIKE ", $get['c']).")";
				$str_order = "";
			} /*else {
				$str_cond['c'] = "";
			}*/

			// to be added later
			//if (@$get['d']) $str_cond['d'] = null;		// donor groups
			//if (@$get['i']) $str_cond['i'] = null;		// implementer groups
			
			//if$str_cond_full = implode("",$str_cond);
			//if ($str_cond_full!="") { 
			if (is_array($str_cond)) {
				//echo print_r($str_cond,1)."<br/>";
				$str_cond_full = " WHERE ".implode(" AND ",$str_cond);
			} else {
				$str_cond_full = "";
			}
			
			// display only PUBLISHED projects and locations
			$str_cond_full .= " AND proj.status='P' AND loc.status='P'";

			$str_query = $str_query_base.$str_cond_full.$str_order;
			//echo $str_query;

			return($str_query);
		}
		
		private function encloseInLikeWildcards(&$item)
		{
			$item = "'%".$item."%'";
		}
		
		private function numToString (&$item)
		{
			$item = (string) $item;
		}
		
		function filterQuery($get)
		{
			return $this->filter($get);
		}
		
		function insertQuery ($str_table, $ary_row){
			return $this->insert($str_table, $ary_row);
		}
		
		function updateQuery ($str_table, $ary_row, $updateType)
		{
			return $this->update($str_table, $ary_row, $updateType);
		}
		
		function deleteQuery ($str_table, $ary_row, $updateType)
		{
			return $this->delete($str_table, $ary_row, $updateType);
		}
		
	}
	
	class doMySQL
	{
		function execute ($sql)
		{
			$db = parse_ini_file('cti.ini');
			$dsn = $db['driver'].":host=".$db['host'].";dbname=".$db['dbname'];
			$dbh = new PDO($dsn, $db['user'], $db['password']);
			$sth = $dbh->prepare($sql);
			$numRows = $sth->execute();
			//echo print_r($numRows);
			//echo "<script>console.log('num rows: ".$numRows."')</script>";
			if ($numRows > 0) {
				return array('status'=>TRUE,'lastInsertID'=>$dbh->lastInsertID());
			} else {
				return array('status'=>FALSE);
			}
		}
		
		function process($process, $table, $data){
			$ctiQuery = new buildMySQL();
			$ctiQueryExec = new $this;
			if(array_key_exists('goals', $data)) $data['goals'] = implode(", ", $data['goals']);
			$data['updated'] = date('Y-m-d H:i:s');
			$msgTable = ucfirst(substr($table,0,strlen($table)-1));

			switch ($process){
				case "i":
					$sql = $ctiQuery->insertQuery($table, $data);
					$success = ucfirst($msgTable)." Information Saved.";
					$fail = ucfirst($msgTable)." Save Failed!";
					break;
				case "u":
					$sql = $ctiQuery->updateQuery($table, $data, 'u');
					$success = ucfirst($msgTable)." Information Updated.";
					$fail = ucfirst($msgTable)." Update Failed!";
					break;
				case "d":
					$data['deleted'] = date('Y-m-d H:i:s');
					$data['status'] = 'D';
					$sql = $ctiQuery->updateQuery($table, $data, 'u');
					$success = ucfirst($msgTable)." Information Deleted.";
					$fail = ucfirst($msgTable)." Delete Failed!";
					break;
			}

			$execResult = $ctiQueryExec->execute($sql);
			//print_r(array($sql,$success,$fail));
			if ($execResult['status']) { 
				return array('status'=>TRUE, 'success'=>$success, 'fail'=>$fail, 'lastInsertID'=>$execResult['lastInsertID'], 'sql'=>$sql);
			} else {
				return array('status'=>FALSE, 'success'=>$success, 'fail'=>$fail, 'sql'=>$sql);
			}
		}
	}

?>