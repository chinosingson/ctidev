﻿<?php

	include_once('db.php');

	@session_start();


	if (@!$user) $user = "admin";
	$locID = $_REQUEST['l'];
	$leafletID = $_REQUEST['lid'];
	$editsql = "SELECT loc.*, proj.* FROM locations loc LEFT JOIN projects proj ON loc.projectID=proj.ID WHERE loc.id=".$locID;

	# Try query or error
	$rs = $conn->query($editsql);
	if (!$rs) {
			echo 'Edit Location - An SQL error occured.\n';
			exit;
	}

	while ($data = $rs->fetch(PDO::FETCH_ASSOC)) : ?>
	<!--div class="alert alert-warning alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<?php echo print_r($_REQUEST['lid'], 1); ?>
	</div-->
							<h4>Edit Location - <?=$data['title']?></h4>
							<form name="form-edit-location" id="form-edit-location">
								<input type="hidden" id="process-type" name="process-type" value="u" />
								<input type="hidden" id="table-name" name="table-name" value="locations" />
								<input type="hidden" id="author" name="data[user]" value="<?=$data['user']?>" />
								<input type="hidden" id="updated" name="data[updated]" />
								<input type="hidden" id="location-id" name="data[id]" value="<?=$locID?>" />
								<input type="hidden" id="project-id" name="data[ID]" value="<?=$data['ID']?>" />
								<div class="form-horizontal" role="form" style="overflow-x: hidden">
									<div class="form-group form-group-sm row">
										<div class="col-xs-3"><label for="location-longitude" class="control-label">Longitude</label></div>
										<div class="col-xs-9"><input type="text" disabled class="form-control" id="location-longitude" name="data[longitude]" value="<?=$data['longitude']?>" /></div>
									</div>
									<div class="form-group form-group-sm row">
										<div class="col-xs-3"><label for="location-latitude" class="control-label">Latitude</label></div>
										<div class="col-xs-9"><input type="text" disabled class="form-control" id="location-latitude" name="data[latitude]" value="<?=$data['latitude']?>" /></div>
									</div>
									<div class="form-group form-group-sm row">
										<div class="col-xs-3"><label for="location-municipality" class="control-label">Municipality</label></div>
										<div class="col-xs-9"><input type="text" class="form-control" id="location-municipality" name="data[municipality]" value="<?=$data['municipality']?>" /></div>
									</div>
									<div class="form-group form-group-sm row">
										<div class="col-xs-3"><label for="location-province" class="control-label">Province</label></div>
										<div class="col-xs-9"><input type="text" class="form-control" id="location-province" name="data[province]" value="<?=$data['province']?>" /></div>
									</div>
									<div class="form-group form-group-sm row">
										<div class="col-xs-3"><label for="location-city" class="control-label">City</label></div>
										<div class="col-xs-9"><input type="text" class="form-control" id="location-city" name="data[city]" value="<?=$data['city']?>" /></div>
									</div>
									<div class="form-group form-group-sm row">
										<div class="col-xs-3"><label for="location-locality" class="control-label">Locality</label></div>
										<div class="col-xs-9"><input type="text" class="form-control" id="location-locality" name="data[locality]" value="<?=$data['locality']?>" /></div>
									</div>
									<div class="form-group form-group-sm row">
										<div class="col-xs-3"><label for="location-region" class="control-label">Region</label></div>
										<div class="col-xs-9"><input type="text" class="form-control" id="location-region" name="data[region]" value="<?=$data['region']?>" /></div>
									</div>
									<div class="form-group form-group-sm row">
										<div class="col-xs-3"><label for="location-subregion" class="control-label">Subregion</label></div>
										<div class="col-xs-9"><input type="text" class="form-control" id="location-subregion" name="data[subregion]" value="<?=$data['subregion']?>" /></div>
									</div>
									<div class="form-group form-group-sm row">
										<div class="col-xs-3"><label for="location-country" class="control-label">Country</label></div>
										<div class="col-xs-9">
											<select name="data[country]" class="form-control input-sm" id="location-country" >
												<option class="input-sm" disabled selected>Choose a country</option>
												<option disabled>---------------</option>
												<option <?=($data['country']=='IND' ? "selected" : "") ?> value="IND">Indonesia</option>
												<option <?=($data['country']=='MAL' ? "selected" : "") ?> value="MAL">Malaysia</option>
												<!--option value="Papua New Guinea">Papua New Guinea</option-->
												<option <?=($data['country']=='PHL' ? "selected" : "") ?> value="PHL">Philippines</option>
												<!--option value="Solomon Islands">Solomon Islands</option>
												<option value="Timor-Leste">Timor-Leste</option-->
											</select>

										<!--input type="text" class="form-control" id="location-country" name="data[country]" value="<?=$data['country']?>" /-->
										</div>
									</div>
									<div class="form-group form-group-sm row">
										<!--div class="col-xs-3"><label class="control-label">&nbsp;</label></div-->
										<div class="col-xs-12">
											<button id="btn-edit-locn-save" onclick="$('#btn-edit-locn-save').tooltip('destroy'); saveLocation(<?=$data['id']?>, '<?=addslashes($data['title'])?>');" type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="Save location details">Save</button>
											<!--button id="btn-edit-locn-delete" onclick="$('#confirm-delete-location').modal('show');"  type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="Delete this location" >Delete</button-->
											<button id="btn-edit-locn-cancel" onclick="console.log(<?=$data['id']?>); map._layers[<?=$leafletID?>].fire('click'); return false;" type="button" class="btn btn-sm btn-default" >Cancel</button>
										</div>
									</div>
								</div>
							</form>
<?php endwhile; ?>