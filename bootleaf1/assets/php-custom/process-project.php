<?php

	include_once ('lib-mysql.php');
	require_once('../UserFrosting/models/config.php');
	@session_start();

	$op = new doMySQL();
	
	//echo "<pre>";
	//echo print_r($_REQUEST['proj'],1);
	$currUserInfo = fetchUser($loggedInUser->user_id);
	$lastInsertID = "";
	
	// PROCESS PROJECT DATA 
	if (!empty($_REQUEST['proj'])) {
		$proj = $_REQUEST['proj'];
		//echo "PROCESS PROJECT DATA<br/>";
		// parse serialized project data into a working array
		parse_str($proj, $projData);	
		//echo "<h4>".$projData['data']['title']."</h4>";
		// build mysql for project
		$procType = $projData['process-type'];
		$tableName = $projData['table-name'];
		$res = $op->process($procType, $tableName, $projData['data']);
		//echo print_r($res,1)."<br/>";
		if($procType == 'i'){
			$projectID = $res['lastInsertID'];
			$formType = "add";
			echo "<script>console.log('lastInsertID = ".$projectID."'); var projectID=".$projectID.";</script>";
		} elseif ($procType == 'u') {
			$projectID = $projData['data']['ID'];
			$formType = "edit";
			echo "<script>console.log('projectID = ".$projectID."')</script>";
		} elseif ($procType == 'd') {
			$projectID = $projData['data']['ID'];
			$purgeOp = $op->execute("UPDATE locations SET status='d', deleted='".date('Y-m-d H:i:s')."' WHERE projectID=".$projectID);
			$formType = "delete";
			if ($purgeOp['status'] === true){
				echo "<script>console.log('Project ".$projectID." - LOCATIONS PURGED');</script>";
			} else {
				echo "<script>console.log('Project ".$projectID." - NO LOCATIONS TO PURGE');</script>";
			}
		}
		
		//echo print_r($res,1)."<br/>";
		if ($res['status'] == 1) {
			$activitySql = "INSERT INTO activity (user,operation,entity,projectID,data) VALUES('".$loggedInUser->username."','".$formType."','project',".$projectID.",'".json_encode($projData)."')";
			$activityOp = $op->execute($activitySql);
			$statusMsg = "<div class='alert alert-success'><b>".$res['success']."</b><br/></div>";
		} else {
			$statusMsg = "<div class='alert alert-danger'><b>".$res['fail']."</b><br/></div>";
		}
	} else {
		//echo "NO PROJECT DATA TO PROCESS<br/>";
		echo "<script>console.log('NO PROJECT DATA TO PROCESS')</script>";
	}
	
	echo $statusMsg;
	//echo "projectID = ".$projectID."<br/>";
	//echo "<script>projectID=".$projectID.";</script>";
	if(@$_REQUEST['locn'] == 1) {
		//echo "<script>console.log('PROCESS LOCATION DATA');</script>";
	} else {
		/*echo '<form id="form-'.$formType.'-project">
			<input type="hidden" id="project-id" name="data[\'ID\']" value="'.$projectID.'" />
			<div class="btn-group">
			<button id="btn-edit-proj-add-loc" onclick="editLocations('.$projectID.')" type="button" class="btn btn-sm btn-primary">Add More Locations</button>
			<button id="btn-edit-proj-view-all" onclick="reloadPanes();" type="button" class="btn btn-sm btn-default">View All Projects</button>
		</div></form>';*/
		//echo "<script>console.log('locn: ".$_REQUEST['locn']."'); console.log('NO LOCATION DATA TO PROCESS');</script>";
	}
	
	
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
	
	session_write_close();

	//if($procType == 'i'){
?>