<?php

	include ('lib-mysql.php');
	require_once('../UserFrosting/models/config.php');
	@session_start();

	$op = new doMySQL();

	//echo "<pre>";
	//echo print_r($_REQUEST,1);
	//echo print_r($_SESSION,1)."<br/>";
	//echo @print_r($loggedInUser,1);
	$currUserInfo = fetchUser($loggedInUser->user_id);
	//echo print_r($currUserInfo,1)."<br/>";
	//echo "</pre>";
	
	echo "<script>console.log('locn: ".$_REQUEST['locn']."')</script>";
	// PROCESS LOCATION DATA
	$fr = $_REQUEST['op'];
	$projectTitle = $_REQUEST['t'];
	
	//if (!empty($_REQUEST['locn'])) {
	if(isset($_REQUEST['locn'])){
		$locn = $_REQUEST['locn'];
		//echo "PROCESS LOCATION DATA<br/>";
		$locData = json_decode($locn, true);
		$locAry = array();
		$intSuccess = 0;
		$intFail = 0;
		if (!empty($locData)){
			$locCount = count($locData['features']);
			//echo "There are ".$locCount." location(s). <br/>";
			// purge all locations first
			if ($fr == "proj"){
				$projectID = $_REQUEST['pid'];
				$purgeOp = $op->execute("DELETE FROM locations WHERE projectID=".$projectID);
				if ($purgeOp['status'] === true) echo "<script>console.log('LOCATIONS PURGED');</script>";
				else echo "<script>console.log('LOCATIONS PURGE ERROR');</script>";
				
				for ($x = 0; $x < $locCount; $x++){
					//echo "<pre>".print_r($locData['features'],1)."</pre><br/>";
					$locAry['projectID'] = $projectID;
					$locAry['longitude'] = $locData['features'][$x]['geometry']['coordinates'][0];
					$locAry['latitude'] = $locData['features'][$x]['geometry']['coordinates'][1];
					@$locAry['municipality'] = $locData['features'][$x]['properties']['municipality'];
					@$locAry['province'] = $locData['features'][$x]['properties']['province'];
					@$locAry['locality'] = $locData['features'][$x]['properties']['locality'];
					@$locAry['city'] = $locData['features'][$x]['properties']['city'];
					@$locAry['country'] = $locData['features'][$x]['properties']['country'];
					@$locAry['region'] = $locData['features'][$x]['properties']['region'];
					@$locAry['subregion'] = $locData['features'][$x]['properties']['subregion'];
					$locAry['user'] = $loggedInUser->username; //_SESSION['user'];
					// reinsert everything
					$res = $op->process('i','locations',$locAry);
					//echo print_r($res,1)."<br/>";
					//echo $res['sql']."<br/>";
					if ($res['status']) {
						$activitySql = "INSERT INTO activity (user,operation,entity,projectID,data) VALUES('".$loggedInUser->username."','add','location',".$projectID.",'".$locn."')";
						//echo $activitySql."<br/>";
						$activityOp = $op->execute($activitySql);
						$intSuccess++;
					} else {
						$intFail++;
					}
				}
				
			} elseif ($fr == "locn"){
				//$updateOp = $op->execute
				//echo "<pre>".print_r($locData,1)."</pre>";
				$locID = $_REQUEST['lid'];
				$projectID = $locData['features'][0]['properties']['ID'];
				$locAry['id'] = $locData['features'][0]['properties']['id'];
				//$locAry['longitude'] = $locData['features'][0]['geometry']['coordinates'][0];
				//$locAry['latitude'] = $locData['features'][0]['geometry']['coordinates'][1];
				@$locAry['municipality'] = $locData['features'][0]['properties']['municipality'];
				@$locAry['province'] = $locData['features'][0]['properties']['province'];
				@$locAry['locality'] = $locData['features'][0]['properties']['locality'];
				@$locAry['city'] = $locData['features'][0]['properties']['city'];
				@$locAry['country'] = $locData['features'][0]['properties']['country'];
				@$locAry['region'] = $locData['features'][0]['properties']['region'];
				@$locAry['subregion'] = $locData['features'][0]['properties']['subregion'];
				$locAry['user'] = $loggedInUser->username;
				//echo print_r($locAry,1);
				$res = $op->process('u', 'locations', $locAry);
				if ($res['status']) { 
					$activitySql = "INSERT INTO activity (user,operation,entity,projectID,locationID,data) VALUES('".$loggedInUser->username."','edit','location',".$projectID.",".$locID.",'".$locn."')";
					//echo $activitySql."<br/>";
					$activityOp = $op->execute($activitySql);
					$intSuccess++;
				} else {
					$intFail++;
				}
			}
		} 
		if ($intSuccess > 0) {
			echo "<h4>Edit Locations - ".$projectTitle."</h4><div class='alert alert-success'><b>".$intSuccess." location(s) saved.</b><br/></div>";
			echo '<button id="btn-edit-loc-more-loc" onclick="$(\'#btn-edit-loc-more-loc\').tooltip(\'destroy\'); editLocations('.$projectID.',\''.addslashes($projectTitle).'\'); return false;" type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="Add more locations to current project">Add Locations</button>
				<button id="btn-edit-loc-view-proj" onclick="$(\'#btn-edit-loc-view-proj\').tooltip(\'destroy\'); viewProject('.$projectID.')" type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="View this project\'s details">View Project</button>
				<button id="btn-edit-loc-view-all" onclick="reloadPanes()" type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="View the list of all projects">All Projects</button>';
		} 
		if ($intFail > 0) {
			echo "<div class='alert alert-danger'><b>Failed to save ".$intFail." location(s)</b><br/></div>";
		}
	} else {
		if(isset($lastInsertID)) echo $lastInsertID;
		echo '<button id="btn-edit-proj-ok" onclick="reloadPanes()" type="button" class="btn btn-sm">OK</button>';
		echo "<script>console.log('NO LOCATION DATA TO PROCESS')</script>";
	}

	session_write_close();

?>