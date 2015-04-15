<?php
	//echo "<pre>";
	//echo print_r($_REQUEST,1);
	//echo "</pre>";
	$projectID = $_REQUEST['p'];
	$op = $_REQUEST['o'];
	$projectTitle = $_REQUEST['t'];
	if ($op == "a"){
		$opName = "Add";
	} elseif ($op == "e") {
		$opName = "Edit";
	}

?>
							<div class="form-horizontal container-fluid" role="form" style="overflow-x: hidden">
								<div class="form-group form-group-sm row">
									<h4><?=$opName ?> Locations - <?=$projectTitle ?></h4>
								</div>
								<div class="form-group form-group-sm row">
									<h5 class="">To <?=$opName ?> locations, use the controls on the right-hand side of the map.</h5>
								</div>
								<div class="form-group form-group-sm row">
									<button id="btn-add-loc-save" onclick="$('#btn-add-loc-save').tooltip('destroy'); saveLocations(<?=$projectID?>, '<?=addslashes($projectTitle)?>'); return false;" type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="Save locations">Save locations</button>
									<button id="btn-add-loc-cancel" onclick="viewProject(<?=$projectID?>); return false;" type="button" class="btn btn-sm btn-default">Cancel</button>
								</div>
							</div>