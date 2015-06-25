<?php

	include_once('db.php');
	require_once('../UserFrosting/models/config.php');

	//@session_start();

	//if (!$user) $user = "admin";
	$projID = $_REQUEST['p'];
	$editsql = 'SELECT proj.* FROM projects AS proj WHERE proj.ID='.$projID;

	# Try query or error
	$rs = $conn->query($editsql);
	if (!$rs) {
			echo 'Edit Project - An SQL error occured.\n';
			exit;
	}
	//sidebarClick('+L.stamp(layer)+')
	//echo '<tr style="cursor: pointer;" onclick="sidebarClick('.$data['ID'].'); return false;" >
	//$projectID = $data['ID'];
	//$projectTitle = $data['title'];
	//print_r($data);
	//echo print_r($currUserInfo,1);
	//echo $loggedInUser;
	$user = fetchUser($loggedInUser->user_id);

	while ($data = $rs->fetch(PDO::FETCH_ASSOC)) : 
		if (!isset($data['user'])) $currUser = $user['name'];
		else $currUser = $data['user'];
	?>
							<h4>Edit <?=htmlentities($data['title'])?></h4>
							<form name="form-edit-project" id="form-edit-project">
								<input type="hidden" id="process-type" name="process-type" value="u" />
								<input type="hidden" id="table-name" name="table-name" value="projects" />
								<input type="hidden" id="author" name="data[user]" value="<?=$currUser?>" />
								<input type="hidden" id="updated" name="data[updated]" />
								<input type="hidden" id="project-id" name="data[ID]" value="<?=$projID?>" />
								<div class="form-horizontal" role="form" style="overflow-x: hidden">
									<div class="form-group form-group-sm row">
										<div class="col-xs-3"><label for="project-title" class="control-label">Title</label></div>
										<div class="col-xs-9"><input type="text" class="form-control" id="project-title" name="data[title]" value="<?=htmlentities($data['title'])?>" /></div>
									</div>
									<div class="form-group form-group-sm row">
										<div class="col-xs-3"><label for="project-goals" class="control-label">Goals</label></div>
										<div class="col-xs-9"><?php $aryGoals = explode(",",$data['goals']); ?>
											<div class="checkbox-inline"><label><input type="checkbox" <?=(in_array(1, $aryGoals) ? "checked" : "") ?> id="project-edit-goal-1" name="data[goals][]" value="1"><span class="checkbox-value">1</span></label></div>
											<div class="checkbox-inline"><label><input type="checkbox" <?=(in_array(2, $aryGoals) ? "checked" : "") ?> id="project-edit-goal-2" name="data[goals][]" value="2"><span class="checkbox-value">2</span></label></div>
											<div class="checkbox-inline"><label><input type="checkbox" <?=(in_array(3, $aryGoals) ? "checked" : "") ?> id="project-edit-goal-3" name="data[goals][]" value="3"><span class="checkbox-value">3</span></label></div>
											<div class="checkbox-inline"><label><input type="checkbox" <?=(in_array(4, $aryGoals) ? "checked" : "") ?> id="project-edit-goal-4" name="data[goals][]" value="4"><span class="checkbox-value">4</span></label></div>
											<div class="checkbox-inline"><label><input type="checkbox" <?=(in_array(5, $aryGoals) ? "checked" : "") ?> id="project-edit-goal-5" name="data[goals][]" value="5"><span class="checkbox-value">5</span></label></div>
										</div>
									</div>
									<div class="form-group form-group-sm row">
										<div class="col-xs-3"><label for="project-start" class="control-label">Start</label></div>
										<div class="col-xs-9"><input type="date" class="form-control datepicker" id="project-start" name="data[start]" value="<?=substr($data['start'],0,10)?>" /></div>
									</div>
									<div class="form-group form-group-sm row">
										<div class="col-xs-3"><label for="project-end" class="control-label">End</label></div>
										<div class="col-xs-9"><input type="date" class="form-control datepicker" id="project-end" name="data[end]" value="<?=substr($data['end'],0,10)?>" /></div>
									</div>
									<div class="form-group form-group-sm row">
										<div class="col-xs-3"><label for="project-funder" class="control-label">Funder</label></div>
										<div class="col-xs-9"><input type="text" class="form-control" id="project-funder" name="data[funder]" value="<?=$data['funder']?>" /></div>
									</div>
									<div class="form-group form-group-sm row">
										<div class="col-xs-3"><label for="project-amount" class="control-label">Amount&nbsp;(USD)</label></div>
										<div class="col-xs-9"><input type="number" class="form-control" id="project-amount" name="data[amount]" value="<?=$data['amount']?>" /></div>
									</div>
									<div class="form-group form-group-sm row">
										<div class="col-xs-3"><label for="project-implementer" class="control-label">Implementer</label></div>
										<div class="col-xs-9"><input type="text" class="form-control" id="project-implementer" name="data[implementer]" value="<?=htmlentities($data['implementer'])?>" /></div>
									</div>
									<div class="form-group form-group-sm row">
										<div class="col-xs-3"><label for="project-prin-contact" class="control-label">Contact</label></div>
										<div class="col-xs-9"><input type="text" class="form-control" id="project-prin-contact" name="data[contact]" value="<?=$data['contact']?>" /></div>
									</div>
									<div class="form-group form-group-sm row">
										<div class="col-xs-3"><label for="project-position" class="control-label">Position</label></div>
										<div class="col-xs-9"><input type="text" class="form-control" id="project-position" name="data[position]" value="<?=$data['position']?>" /></div>
									</div>
									<div class="form-group form-group-sm row">
										<div class="col-xs-3"><label for="project-email" class="control-label">Email</label></div>
										<div class="col-xs-9"><input type="email" class="form-control" id="project-email" name="data[email]" value="<?=$data['email']?>" /></div>
									</div>
									<div class="form-group form-group-sm row">
										<div class="col-xs-3"><label for="project-phone" class="control-label">Phone</label></div>
										<div class="col-xs-9"><input type="tel" class="form-control" id="project-phone" name="data[phone]" value="<?=$data['phone']?>" /></div>
									</div>
									<div class="form-group form-group-sm row">
										<div class="col-xs-3"><label for="project-website" class="control-label">Website</label></div>
										<div class="col-xs-9"><input type="url" class="form-control" id="project-website" name="data[website]" value="<?=$data['website']?>" /></div>
									</div>
									<div class="form-group form-group-sm row">
										<div class="col-xs-3"><label for="project-remarks" class="control-label">Remarks</label></div>
										<!--div class="col-xs-9"><input type="text" class="form-control" id="project-remarks" name="data[remarks]" value="<?=$data['remarks']?>" /></div-->
										<div class="col-xs-9"><textarea class="form-control" id="project-remarks" name="data[remarks]" ><?=$data['remarks']?></textarea></div>
									</div>
									<div class="form-group form-group-sm row">
										<!--div class="col-xs-3"><label class="control-label">&nbsp;</label></div-->
										<div class="col-xs-12">
											<button id="btn-edit-proj-save" onclick="$('#btn-edit-proj-save').tooltip('destroy'); saveProject('edit', 0);" type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="Save project details">Save</button>
											<button id="btn-edit-proj-delete" onclick="$('#confirm-delete-project').modal('show');"  type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="Delete this project" >Delete</button>
											<button id="btn-edit-proj-save" onclick="saveProject('edit', 1);" type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="Save project details then edit locations">Edit Locations</button>
											<!--button id="btn-edit-proj-delete" onclick="saveProject('del', false)"  type="button" class="btn btn-sm btn-default">Delete</button-->
											<button id="btn-edit-proj-cancel" onclick="viewProject(<?=$projID?>); return false;" type="button" class="btn btn-sm btn-default" >Cancel</button>
										</div>
									</div>
								</div>
							</form>
						</div>
<?php endwhile; ?>