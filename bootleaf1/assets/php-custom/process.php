<?php

	include ('lib-mysql.php');

	$op = new doMySQL();
	

	echo "<pre>";
	echo print_r($_REQUEST,1);
	echo $sql;
	echo "</pre>";
	$lastInsertID = "";
	
	// PROCESS PROJECT DATA 
	/*if (!empty($_REQUEST['proj'])) {
		$proj = $_REQUEST['proj'];
		//echo "PROCESS PROJECT DATA<br/>";
		// parse serialized project data into a working array
		parse_str($proj, $projData);	
		echo "<h4>".$projData['data']['title']."</h4>";
		// build mysql for project
		$procType = $projData['process-type'];
		$tableName = $projData['table-name'];
		$res = $op->process($procType, $tableName, $projData['data']);
		//echo print_r($res,1)."<br/>";
		if($procType == 'i'){
			$projectID = $res['lastInsertID'];
			$lastInsertID = "<script>projectID=".$projectID."; console.log('lastInsertID = ".$projectID."')</script>";
		} elseif ($procType == 'u') {
			$projectID = $projData['data']['ID'];
		} elseif ($procType == 'd') {
			$purgeOp = $op->execute("UPDATE locations SET status='d' WHERE projectID=".$projData['data']['ID']);
			if ($purgeOp['status'] === true) echo "<script>console.log('LOCATIONS PURGED');</script>";
		}
		//echo "projectID = ".$projectID."<br/>";
		if ($res['status']) {
			echo "<div class='alert alert-success'><b>".$res['success']."</b><br/></div>";
		} else {
			echo "<div class='alert alert-danger'><b>".$res['fail']."</b><br/></div>";
		}
	} else {
		//echo "NO PROJECT DATA TO PROCESS<br/>";
		echo "<script>console.log('NO PROJECT DATA TO PROCESS')</script>";
	}*/WW
	
	echo "<script>console.log('locn: ".$_REQUEST['locn']."')</script>";
	// PROCESS LOCATION DATA
	//if (!empty($_REQUEST['locn'])) {
	if($_REQUEST['locn'] === true){
		$locn = $_REQUEST['locn'];
		//echo "PROCESS LOCATION DATA<br/>";
		$locData = json_decode($locn, true);
		$intSuccess = 0;
		$intFail = 0;
		if (!empty($locData)){
			$locCount = count($locData['features']);
			echo "There are ".$locCount." location(s). <br/>";
			// purge all locations first
			$purgeOp = $op->execute("DELETE FROM locations WHERE projectID=".$projectID);
			if ($purgeOp['status'] === true) echo "<script>console.log('LOCATIONS PURGED');</script>";
			
			for ($x = 0; $x < $locCount; $x++){
				//echo "<pre>".print_r($locData['features'],1)."</pre><br/>";
				$locAry['projectID'] = $projectID;
				$locAry['longitude'] = $locData['features'][$x]['geometry']['coordinates'][1];
				$locAry['latitude'] = $locData['features'][$x]['geometry']['coordinates'][0];
				$locAry['municipality'] = $locData['features'][$x]['properties']['municipality'];
				$locAry['province'] = $locData['features'][$x]['properties']['province'];
				// reinsert everything
				$res = $op->process('i','locations',$locAry);
				//echo print_r($res,1)."<br/>";
				echo $res['sql']."<br/>";
				if ($res['status']) $intSuccess++;
				else $intFail++;
			}
		} 
		if ($intSuccess > 0) {
			echo "<div class='alert alert-success'><b>".$intSuccess." location(s) saved.</b><br/></div>";
		} 
		if ($intFail > 0) {
			echo "<div class='alert alert-danger'><b>Failed to save ".$intFail." location(s)</b><br/></div>";
		}
	} else {
		if(isset($lastInsertID)) echo $lastInsertID;
echo '<div class="btn-group">
	<button id="btn-edit-proj-ok" onclick="reloadPanes()" type="button" class="btn btn-sm">OK</button>
</div>';
		echo "<script>console.log('NO LOCATION DATA TO PROCESS')</script>";
	}*/
	
	
	// process (type, table, ary[data])
	//$result = $op->process($_REQUEST['process-type'], $_REQUEST['table-name'], $_REQUEST['data']);
	/* $result = array('');
	$msg_success = $result['success'];
	$msg_fail = $result['fail'];
	if ($result['status']){
		echo "<div class='alert alert-success'><b>".$msg_success."</b><br/>".$_REQUEST['data']['title']."</div>";
		//echo "<div class='alert alert-danger'><b>".$msg_fail."</b><br/>".$_REQUEST['data']['title']."</div>";
	} else {
		echo "<div class='alert alert-danger'><b>".$msg_fail."</b><br/>".$_REQUEST['data']['title']."</div>";
	} */
	
	//if($procType == 'i'){
?>