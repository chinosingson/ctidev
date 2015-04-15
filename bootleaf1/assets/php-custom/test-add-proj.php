<?php
	$user = "admin";

?>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="../bootstrap-3.2.0-dist/js/bootstrap.min.js"></script>

<script>

	$(function () {
		console.log('Add Project - With Locations'); 
		$("button#btn-add-proj-wloc").click(function () {
			$.ajax({
				type : "POST",
				url : "process.php",
				data : $('form#form-add-project').serialize(),
				success : function (msg) {
					$("#display-add-project").html(msg)
					$("#form-content").modal('hide');
				},
				error : function () {
					console.log("failure");
				}
			});
		});
	});

</script>

						<div class="tab-pane fade" id="projects-add">
							<h4>Add a Project</h4>
							<div id="display-add-project">
							<form name="form-add-project" id="form-add-project">
							<input type="hidden" id="process-type" name="process-type" value="insert" />
							<input type="hidden" id="table-name" name="table-name" value="projects" />
							<input type="hidden" id="author" name="data[user]" value="<?=$user?>" />
							<input type="hidden" id="updated" name="data[updated]" value="" />
							<div class="form-horizontal" role="form" style="overflow-x: hidden">
								<div class="form-group form-group-sm row">
									<div class="col-xs-3"><label for="project-title" class="control-label">Title</label></div>
									<div class="col-xs-9"><input type="text" class="form-control" id="project-title" name="data[title]" placeholder="Enter Project Title" /></div>
								</div>
								<div class="form-group form-group-sm row">
									<div class="col-xs-3"><label for="project-goals" class="control-label">Goals</label></div>
									<div class="col-xs-9 input-sm">
										<label class="checkbox-inline"><input type="checkbox" id="project-goal-1" name="data[goals][]" value="1">1</label>
										<label class="checkbox-inline"><input type="checkbox" id="project-goal-2" name="data[goals][]" value="2">2</label>
										<label class="checkbox-inline"><input type="checkbox" id="project-goal-3" name="data[goals][]" value="3">3</label>
										<label class="checkbox-inline"><input type="checkbox" id="project-goal-4" name="data[goals][]" value="4">4</label>
										<label class="checkbox-inline"><input type="checkbox" id="project-goal-5" name="data[goals][]" value="5">5</label>
									</div>
								</div>
								<div class="form-group form-group-sm row">
									<div class="col-xs-3"><label for="project-start" class="control-label">Start</label></div>
									<div class="col-xs-9"><input type="date" class="form-control" id="project-start" name="data[start]" placeholder="Enter Start Date" /></div>
								</div>
								<div class="form-group form-group-sm row">
									<div class="col-xs-3"><label for="project-end" class="control-label">End</label></div>
									<div class="col-xs-9"><input type="date" class="form-control" id="project-end" name="data[end]" placeholder="Enter End Date" /></div>
								</div>
								<div class="form-group form-group-sm row">
									<div class="col-xs-3"><label for="project-funder" class="control-label">Funder</label></div>
									<div class="col-xs-9"><input type="text" class="form-control" id="project-funder" name="data[funder]" placeholder="Enter Funder Name" /></div>
								</div>
								<div class="form-group form-group-sm row">
									<div class="col-xs-3"><label for="project-amount" class="control-label">Amount&nbsp;(USD)</label></div>
									<div class="col-xs-9"><input type="number" class="form-control" id="project-amount" name="data[amount]" placeholder="Enter Amount (USD)" /></div>
								</div>
								<div class="form-group form-group-sm row">
									<div class="col-xs-3"><label for="project-prin-contact" class="control-label">Contact</label></div>
									<div class="col-xs-9"><input type="text" class="form-control" id="project-prin-contact"  name="data[contact]" placeholder="Enter Contact Name" /></div>
								</div>
								<div class="form-group form-group-sm row">
									<div class="col-xs-3"><label for="project-position" class="control-label">Position</label></div>
									<div class="col-xs-9"><input type="text" class="form-control" id="project-position"  name="data[position]" placeholder="Enter Position" /></div>
								</div>
								<div class="form-group form-group-sm row">
									<div class="col-xs-3"><label for="project-email" class="control-label">Email</label></div>
									<div class="col-xs-9"><input type="email" class="form-control" id="project-email" name="data[email]" placeholder="Enter Email" /></div>
								</div>
								<div class="form-group form-group-sm row">
									<div class="col-xs-3"><label for="project-phone" class="control-label">Phone</label></div>
									<div class="col-xs-9"><input type="tel" class="form-control" id="project-phone" name="data[phone]" placeholder="Enter Phone" /></div>
								</div>
								<div class="form-group form-group-sm row">
									<div class="col-xs-3"><label for="project-website" class="control-label">Website</label></div>
									<div class="col-xs-9"><input type="url" class="form-control" id="project-website" name="data[website]" placeholder="Enter Website" /></div>
								</div>
								<div class="form-group form-group-sm row">
									<div class="col-xs-3"><label for="project-remarks" class="control-label">Remarks</label></div>
									<div class="col-xs-9"><input type="text" class="form-control" id="project-remarks" name="data[remarks]" placeholder="Enter Remarks" /></div>
								</div>
								<div class="form-group form-group-sm row">
									<div class="col-xs-3"><label class="control-label">Save</label></div>
									<div class="col-xs-9 btn-group">
										<button id="btn-add-proj-wloc" type="button" rel="tooltip" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Save and add Locations">With Locations</button>
										<button id="btn-add-proj-nloc" type="button" rel="tooltip" class="btn btn-sm" data-toggle="tooltip" data-placement="top" title="Save without Locations" onClick="console.log('Add Project - No Locations'); return false;">Without Locations</b></button>
									</div>
								</div>
								</form>
							</div>
							<!--div class="modal-footer">
								<button type="button" class="btn btn-sm btn-default" onclick="">Cancel</button>
							</div-->
							</div>
						</div>