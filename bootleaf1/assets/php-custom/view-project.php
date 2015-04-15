<?php

	//echo "<pre>";
	//echo print_r($_REQUEST,1);
	//echo "</pre>";

	include ('lib-mysql.php');
	include_once('db.php');
	include_once('../UserFrosting/models/config.php');

	@session_start();
	$currUserInfo = @fetchUser($loggedInUser->user_id);
	//echo "<pre>";
	//echo @print_r($currUserInfo,1)."<br/>";
	//echo "</pre>";
	//print_r($_SESSION['perm']);
	//echo in_array('edit', $_SESSION['perm']);

	if (@!$user) $user = "admin";
	$projID = $_REQUEST['p'];
	$viewsql = 'SELECT proj.* FROM projects AS proj WHERE proj.ID='.$projID;
	//echo $viewsql."<br/>";
	# Try query or error
	$rs = $conn->query($viewsql);
	if (!$rs) {
			echo 'View Project - An SQL error occured.\n';
			exit;
	}
	
	$activitysql = 'SELECT user, operation, timestamp FROM activity where entity=\'project\' AND operation=\'edit\' AND  projectID='.$projID.' ORDER by timestamp DESC LIMIT 1';
	//echo $activitysql."<br/>";
	$rsAct = $conn->query($activitysql);
	
	
	
	
	//$op = new doMySQL();
	//$myRs = $op->execute($viewsql);
	//sidebarClick('+L.stamp(layer)+')
	//echo '<tr style="cursor: pointer;" onclick="sidebarClick('.$data['ID'].'); return false;" >
	//$projectID = $data['ID'];
	//$projectTitle = $data['title'];
	//print_r($data);
	if (isset($currUserInfo) && @in_array($currUserInfo['primary_group_id'],array(1,2,5))) {
		$editPerm = true;
	} else {
		$editPerm = false;
	}

	// && ($loggedInUser->username == $row['user'])
	while ($data = $rs->fetch(PDO::FETCH_ASSOC))
	: 	$dateCreated = new DateTime($data['created']);
	if($rsAct->rowCount() > 0) {
		$activity = $rsAct->fetch(PDO::FETCH_ASSOC);
		if (isset($activity['timestamp'])) {
			$dateUpdated = new DateTime($activity['timestamp']);
			$fDateUpdated = date_format($dateUpdated,'d M Y, h:i:s');
			$updateStr = "Updated ".$fDateUpdated." by ".$activity['user'];
		} 
	} else {
		$dateUpdated = new DateTime($data['updated']);
		$fDateUpdated = date_format($dateUpdated, 'd M Y, h:i:s');
		$updateStr = "Updated ".$fDateUpdated." by ".$data['user'];
	}
	if ($data['start']!=NULL || $data['start']!=""){
		$startDate = date_format(date_create(substr($data['start'],0,10)), 'd M Y');
	} else {
		$startDate = "";
	}
	
	if ($data['end']!=NULL || $data['end']!=""){
		//echo "end: ".$data['end']."<br/>";
		$endDate = date_format(date_create(substr($data['end'],0,10)), 'd M Y');
	} else {
		$endDate = "";
	}
?>
							<table class="table table-condensed">
								<thead>
									<tr><td colspan="2"><h4 class="text-capitalize"><?=htmlentities($data['title'])?></h4>
									<div class="project-activity">
										Created <?=date_format($dateCreated,'d M Y, h:i:s') ?> by <?=$data['user']?><br/>
										<?=$updateStr?>
									</div>
									</td></tr>
								</thead>
								<tbody class='list'>
									<tr><td class="col-xs-4"><b>Countries</b></td><td class="col-xs-8"><?=$data['countries'] ?></td></tr>
									<tr><td><b>Major Goals</b></td><td><?=$data['goals'] ?></td></tr>
									<tr><td><b>Start</b></td><td><?=$startDate?></td></tr>
									<tr><td><b>End</b></td><td><?=$endDate?></td></tr>
									<tr><td><b>Funder</b></td><td><?=$data['funder']?></td></tr>
									<tr><td><b>Amount&nbsp;(USD)</b></td><td><?=@number_format($data['amount'])?></td></tr>
									<tr><td><b>Implementer</b></td><td><?=htmlentities($data['implementer'])?></td></tr>
									<tr><td><b>Principal&nbsp;Contact</b></td><td><?=$data['contact']?></td></tr>
									<tr><td><b>Position</b></td><td><?=$data['position']?></td></tr>
									<tr><td><b>Email</b></td><td><?=$data['email']?></td></tr>
									<tr><td><b>Phone</b></td><td><?=$data['phone']?></td></tr>
									<tr><td><b>Website</b></td><td><a href="http://<?=$data['website']?>" target="_blank"><?=$data['website']?></a></td></tr>
									<tr><td><b>Remarks</b></td><td><div class=""><?=$data['remarks']?></div></td></tr>
								</tbody>
							</table>
							<?php if (($editPerm && ($loggedInUser->username == $data['user'])) || (in_array($currUserInfo['primary_group_id'],array(2,5)))) { ?><div class="btn-group" role="group">
								<button type="button" id="vw-proj-btn-edit-proj" class="btn btn-sm btn-default" onclick="$('#vw-proj-btn-edit-proj').tooltip('hide'); editProject(<?=$data['ID']?>); return false;" data-toggle="tooltip" data-placement="top" title="Edit this project's details">Edit</button>
							</div><?php } ?>
							<div class="btn-group" role="group">
								<button type="button" id="vw-proj-btn-all-proj" class="btn btn-sm btn-default" onclick="$('#vw-proj-btn-all-proj').tooltip('hide'); reloadPanes();" data-toggle="tooltip" data-placement="top" title="View the list of all projects">All Projects</button>
							</div>
							<div class="btn-group dropup" role="group">
								<button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false" >Locations <span class="caret"></span></button>
								<ul class="dropdown-menu" role="menu">
									<li><a role="menuitem" href="#" onclick="zoomToProjectLocations(<?=$data['ID']?>); return false;" data-toggle="tooltip" data-placement="right" title="View this project's locations" >View</a></li>
									<?php if (($editPerm && ($loggedInUser->username == $data['user'])) || (in_array($currUserInfo['primary_group_id'],array(2,5)))) { ?><li><a role="menuitem" href="#" onclick="editLocations(<?=$data['ID']?>,'<?=addslashes($data['title'])?>'); return false;"  data-toggle="tooltip" data-placement="right" title="Edit this project's locations">Edit</a></li><?php } ?>
								</ul>
								<!--button type="button" class="btn btn-sm btn-default" onclick="zoomToProjectLocations(<?=$data['ID']?>); return false;" data-toggle="tooltip" data-placement="bottom" title="View this project's locations">View</button>
								<button type="button" class="btn btn-sm btn-default" id="btn-edit-proj-add-loc" onclick="editLocations(<?=$data['ID']?>)" >Edit</button-->
							</div>
<?php endwhile; ?>