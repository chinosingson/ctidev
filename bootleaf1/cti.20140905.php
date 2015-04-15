<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=1,user-scalable=no,maximum-scale=1,width=device-width">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>CTI v3 Alpha</title>

    <link rel="stylesheet" href="assets/bootstrap-3.2.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/leaflet-0.7.3/leaflet.css">
    <link rel="stylesheet" href="//api.tiles.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/MarkerCluster.css">
    <link rel="stylesheet" href="//api.tiles.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/MarkerCluster.Default.css">
    <link rel="stylesheet" href="//api.tiles.mapbox.com/mapbox.js/plugins/leaflet-locatecontrol/v0.24.0/L.Control.Locate.css">
    <link rel="stylesheet" href="assets/leaflet-sidebar-0.1.5/L.Control.Sidebar.css">
    <link rel="stylesheet" href="assets/css/app.css">

    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/favicon-76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="assets/img/favicon-120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="assets/img/favicon-152.png">
    <link rel="icon" sizes="196x196" href="assets/img/favicon-196.png">
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">
	</head>
  <body>
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#" data-toggle="collapse" data-target=".navbar-collapse.in" onClick="console.log('CTI icon click'); sidebar.toggle(); map.invalidateSize(); return false;"><i class="fa fa-th-list"style="color: white"></i></a>  
        <a class="navbar-brand" href="#">CTI v2</a>
      </div>
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li><a href="#" data-toggle="collapse" data-target=".navbar-collapse.in" onclick="$('#loginModal').modal('show'); return false;"><i class="fa fa-user" style="color: white"></i>&nbsp;&nbsp;Login</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-folder-open" style="color: white"></i>&nbsp;&nbsp;Database <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#" onclick="sidebarMap.hide(); sidebarLocation.hide(); sidebar.show(); $('#projectsTabs a[href=\'#projects\']').tab('show'); return false;" data-toggle="collapse" data-target=".navbar-collapse.in"><i class="fa fa-search"></i>&nbsp;&nbsp;<b>Search</b></a></li>
							<li><a href="#" onclick="sidebarMap.hide(); sidebarLocation.hide(); sidebar.show(); $('#projectsTabs a[href=\'#projects-add\']').tab('show'); return false;" data-toggle="collapse" data-target=".navbar-collapse.in"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add</a></li>
							<li><a href="#" onclick="sidebarMap.hide(); sidebarLocation.hide(); sidebar.show(); $('#projectsTabs a[href=\'#projects-edit\']').tab('show'); return false;" data-toggle="collapse" data-target=".navbar-collapse.in"><i class="fa fa-edit"></i>&nbsp;&nbsp;Edit</a></li>
							<li class="divider"></li>
							<li><a href="#" data-toggle="collapse" data-target=".navbar-collapse.in"><i class="fa fa-download"></i>&nbsp;&nbsp;Download XLS</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-map-marker" style="color: white"></i>&nbsp;&nbsp;Map <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#" onclick="sidebar.hide(); sidebarLocation.hide(); sidebarMap.show(); return false;" data-toggle="collapse" data-target=".navbar-collapse.in"><i class="fa fa-map-marker"></i>&nbsp;&nbsp;<b>Browse</b></a></li>
							<li><a href="#" onclick="sidebar.hide(); sidebarMap.hide(); sidebarLocation.show(); $('#locationTabs a[href=\'#location-add\']').tab('show'); return false;" data-toggle="collapse" data-target=".navbar-collapse.in"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add</a></li>
							<li><a href="#" onclick="sidebar.hide(); sidebarMap.hide(); sidebarLocation.show(); $('#locationTabs a[href=\'#location-edit\']').tab('show'); return false;" data-toggle="collapse" data-target=".navbar-collapse.in"><i class="fa fa-edit"></i>&nbsp;&nbsp;Edit</a></li>
							<li class="divider"></li>
							<li><a href="#" data-toggle="collapse" data-target=".navbar-collapse.in"><i class="fa fa-download"></i>&nbsp;&nbsp;Download KML</a></li>
						</ul>
					</li>
					<li><a href="#" onclick="$('#monitorModal').modal('show'); return false;"><i class="fa fa-tasks" style="color: white"></i>&nbsp;&nbsp;Monitor</a></li>
					<!--li><a href="#" onclick="sidebar.hide(); sidebarMap.hide(); sidebarMonitor.toggle(); return false;">Monitor</a></li-->
					<li><a href="#"><span class="glyphicon glyphicon-question-sign" style="color: white"></span>&nbsp;&nbsp;Help</a></li>
        </ul>
				<ul class="nav navbar-nav navbar-right">
				</ul>
      </div><!--/.navbar-collapse -->
    </div>

    <div id="map"></div>
		

		<!-- Monitor Sidebar -->
		<!--div id="sidebar-monitor">
			<div class="sidebar-wrapper">
			<div class="container-fluid">
				<div class="col-sm-3">
				<ul class="nav nav-pills" role="tablist">
					<li><label><b>All Countries</b></label></li>
					<li class="active"><a href="#indicator1" data-toggle="pill">Projects Per Country</a></li>
					<li><a href="#indicator2" data-toggle="pill">Projects Per Goal</a></li>
					<li><label><b>Per Country</b></label></li>
					<li><a href="#indicator3" data-toggle="pill">Projects Per Goal (#)</a></li>
					<li><a href="#indicator4" data-toggle="pill">Projects Per Goal (%)</a></li>
					<li><a href="#indicator5" data-toggle="pill">Project Count</a></li>
					<li><a href="#indicator6" data-toggle="pill">Project Status</a></li>
				</ul>
				</div>
				<div class="tab-content col-sm-9">
					<div class="tab-pane fade in active" id="indicator1">1&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/></div>
					<div class="tab-pane fade" id="indicator2">2&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/></div>
					<div class="tab-pane fade" id="indicator3">3&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/></div>
					<div class="tab-pane fade" id="indicator4">4&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/></div>
					<div class="tab-pane fade" id="indicator5">5&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/></div>
					<div class="tab-pane fade" id="indicator6">6&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/></div>
				</div>
			</div>
			</div>
		</div-->

		<!-- Map/Project Details Sidebar -->
		<div id="sidebar-map">
			<div class="sidebar-wrapper">
        <div class="panel panel-default" style="margin: 0px; border: none; border-radius: 0px; -webkit-box-shadow: none; box-shadow: none;">
					<div class="panel-heading">
            <h2 class="panel-title" style="display: inline;"><b>Map View</b><button type="button" class="btn btn-xs btn-default pull-right" onclick="sidebar.show(); sidebarMap.hide(); map.invalidateSize();"><i class="fa fa-chevron-right"></i></button></h2>
					</div>
					<div class="panel-body">
						<!-- Nav tabs -->
						<ul class="nav nav-tabs" id="mapTabs">
							<li class="active"><a href="#map-project-info" onclick="$('#mapTabs a[href=\'#map-project-info\']').tab('show'); return false;"><i class="fa fa-info"></i>&nbsp;Details</a></li>
							<li><a href="#map-filter" onclick="$('#mapTabs a[href=\'#map-filter\']').tab('show'); return false;"><i class="fa fa-filter"></i>&nbsp;Filter</a></li>
						</ul>
						<!-- Tab panes -->
						<div class="tab-content">
							<div class="tab-pane fade in active" id="map-project-info">
								<div id="map-project-info-details"></div>
								<div id="map-project-info-buttons">
								</div>
							</div>
							<div class="tab-pane fade" id="map-filter">
								<form role="form">
								<div class="form-group">
									<h4>Goals</h4>
									<div class="checkbox"><label><input type="checkbox" id="project-goal-1">Goal 1</label></div>
									<div class="checkbox"><label><input type="checkbox" id="project-goal-2">Goal 2</label></div>
									<div class="checkbox"><label><input type="checkbox" id="project-goal-3">Goal 3</label></div>
									<div class="checkbox"><label><input type="checkbox" id="project-goal-4">Goal 4</label></div>
									<div class="checkbox"><label><input type="checkbox" id="project-goal-5">Goal 5</label></div>
								</div><!-- /form-group -->
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Location Add/Edit Sidebar -->
		<div id="sidebar-location">
			<div class="sidebar-wrapper">
        <div class="panel panel-default" style="margin: 0px; border: none; border-radius: 0px; -webkit-box-shadow: none; box-shadow: none;">
					<div class="panel-heading">
            <h2 class="panel-title" style="display: inline;"><b>Database View</b><button type="button" class="btn btn-xs btn-default pull-right" onclick="sidebar.show(); sidebarMap.hide(); sidebarLocation.hide();"><i class="fa fa-chevron-right"></i></button></h2>
					</div>
					<div class="panel-body">
						<!-- Nav tabs -->
						<ul class="nav nav-tabs" id="locationTabs">
							<li class="active"><a href="#location-add" onclick="$('#locationTabs a[href=\'#location-add\']').tab('show'); return false;"><i class="fa fa-plus"></i>&nbsp;Add</a></li>
							<li><a href="#location-edit" onclick="$('#locationTabs a[href=\'#location-edit\']').tab('show'); return false;"><i class="fa fa-edit"></i>&nbsp;Edit</a></li>
						</ul>
						<!-- Tab panes -->
						<div class="tab-content">
							<div class="tab-pane fade in active" id="location-add">
								<h4>Add Location</h4>
							</div>
							<div class="tab-pane fade" id="location-edit">
								<h4>Edit Location</h4>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Project Listing/Add/Edit Sidebar -->
    <div id="sidebar">
      <div class="sidebar-wrapper">
        <div class="panel panel-default" style="margin: 0px; border: none; border-radius: 0px; -webkit-box-shadow: none; box-shadow: none;">
          <div class="panel-heading">
            <h2 class="panel-title"><b>Database View</b><button type="button" class="btn btn-xs btn-default pull-right" onclick="sidebar.hide(); map.invalidateSize();"><i class="fa fa-chevron-left"></i></button></h2>
          </div>
          <div class="panel-body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" id="projectsTabs" role="tablist">
              <li class="active"><a href="#projects" onclick="$('#projectsTabs a[href=\'#projects\']').tab('show'); return false;"><i class="fa fa-map-marker"></i>&nbsp;Search</a></li>
              <li><a href="#projects-add" onclick="$('#projectsTabs a[href=\'#projects-add\']').tab('show'); return false;"><i class="fa fa-plus"></i>&nbsp;Add</a></li>
              <li><a href="#projects-edit" onclick="$('#projectsTabs a[href=\'#projects-edit\']').tab('show'); return false;"><i class="fa fa-edit"></i>&nbsp;Edit</a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
							<div class="tab-pane fade in active" id="projects">
								<p>
									<div class="row">
										<div class="col-xs-12 col-md-12">
											<input type="text" class="form-control search input-sm" placeholder="Project Name" />
										</div>
										<!--div class="col-xs-4 col-md-4">
											<button type="button" class="btn btn-primary pull-right sort" data-sort="project-title"><i class="fa fa-sort"></i>&nbsp;&nbsp;Sort</button>
										</div-->
									</div>
								</p>
                <div class="sidebar-table">
                  <table class="table table-hover" id="projects-table">
                    <thead class="hidden">
                      <tr>
                        <th>Title</th>
                      <tr>
                    </thead>
                    <tbody class="list"></tbody>
                  </table>
                </div>
							</div>
							<div class="tab-pane fade" id="projects-add">
								<h4>Add a Project</h4>
								<div class="form-horizontal" role="form" style="display: table-row-group; overflow: auto">
									<div class="form-group form-group-sm row">
										<div class="col-xs-3"><label for="project-title" class="control-label">Title</label></div>
										<div class="col-xs-9"><input type="text" class="form-control" id="project-title" placeholder="Enter Project Title" /></div>
									</div>
									<div class="form-group form-group-sm row">
										<div class="col-xs-3"><label for="project-goals" class="control-label">Goals</label></div>
										<div class="col-xs-9 input-sm">
											<label class="checkbox-inline"><input type="checkbox" id="project-goal-1">1</label>
											<label class="checkbox-inline"><input type="checkbox" id="project-goal-2">2</label>
											<label class="checkbox-inline"><input type="checkbox" id="project-goal-3">3</label>
											<label class="checkbox-inline"><input type="checkbox" id="project-goal-4">4</label>
											<label class="checkbox-inline"><input type="checkbox" id="project-goal-5">5</label>
										</div>
									</div>
									<div class="form-group form-group-sm row">
										<div class="col-xs-3"><label for="project-funder" class="control-label">Funder</label></div>
										<div class="col-xs-9"><input type="text" class="form-control" id="project-funder" placeholder="Enter Funder Name" /></div>
									</div>
									<div class="form-group form-group-sm row">
										<div class="col-xs-3"><label for="project-amount" class="control-label">Amount</label></div>
										<div class="col-xs-9"><input type="number" class="form-control" id="project-amount" placeholder="Enter Amount (USD)" /></div>
									</div>
									<div class="form-group form-group-sm row">
										<div class="col-xs-3"><label for="project-prin-contact" class="control-label">Contact</label></div>
										<div class="col-xs-9"><input type="text" class="form-control" id="project-prin-contact" placeholder="Enter Contact Name" /></div>
									</div>
									<div class="form-group form-group-sm row">
										<div class="col-xs-3"><label for="project-position" class="control-label">Position</label></div>
										<div class="col-xs-9"><input type="text" class="form-control" id="project-position" placeholder="Enter Position" /></div>
									</div>
									<div class="form-group form-group-sm row">
										<div class="col-xs-3"><label for="project-email" class="control-label">Email</label></div>
										<div class="col-xs-9"><input type="email" class="form-control" id="project-email" placeholder="Enter Email" /></div>
									</div>
									<div class="form-group form-group-sm row">
										<div class="col-xs-3"><label for="project-phone" class="control-label">Phone</label></div>
										<div class="col-xs-9"><input type="tel" class="form-control" id="project-phone" placeholder="Enter Phone" /></div>
									</div>
									<div class="form-group form-group-sm row">
										<div class="col-xs-3"><label for="project-website" class="control-label">Website</label></div>
										<div class="col-xs-9"><input type="url" class="form-control" id="project-website" placeholder="Enter Website" /></div>
									</div>
									<div class="form-group form-group-sm row">
										<div class="col-xs-3"><label for="project-remarks" class="control-label">Remarks</label></div>
										<div class="col-xs-9"><input type="text" class="form-control" id="project-remarks" placeholder="Enter Remarks" /></div>
									</div>
									<div class="form-group form-group-sm row">
										<div class="col-xs-3"><label for="project-start" class="control-label">Start</label></div>
										<div class="col-xs-9"><input type="date" class="form-control" id="project-start" placeholder="Enter Start Date" /></div>
									</div>
									<div class="form-group form-group-sm row">
										<div class="col-xs-3"><label for="project-end" class="control-label">End</label></div>
										<div class="col-xs-9"><input type="date" class="form-control" id="project-end" placeholder="Enter End Date" /></div>
									</div>
									<div class="form-group form-group-sm row">
										<div class="col-xs-3"><label class="control-label">Save</label></div>
										<div class="col-xs-9 btn-group">
											<button type="button" rel="tooltip" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Save and add Locations">Locations</button>
											<button type="button" rel="tooltip" class="btn btn-sm" data-toggle="tooltip" data-placement="top" title="Save without Locations">No Locations</b></button>
										</div>
									</div>
								</div>
								<!--div class="modal-footer">
									<button type="button" class="btn btn-sm btn-default" onclick="">Cancel</button>
								</div-->
							</div>
							<div class="tab-pane fade" id="projects-edit">
								<h4>Edit a Project</h4>
								<div class="form-horizontal" role="form" style="display: table-row-group; overflow: auto">
									<div class="form-group form-group-sm row">
										<div class="col-xs-3"><label for="project-title" class="control-label">Title</label></div>
										<div class="col-xs-9"><input type="text" class="form-control" id="project-title" placeholder="Enter Project Title" /></div>
									</div>
									<div class="form-group form-group-sm row">
										<div class="col-xs-3"><label for="project-goals" class="control-label">Goals</label></div>
										<div class="col-xs-9 input-sm">
											<label class="checkbox-inline"><input type="checkbox" id="project-goal-1">1</label>
											<label class="checkbox-inline"><input type="checkbox" id="project-goal-2">2</label>
											<label class="checkbox-inline"><input type="checkbox" id="project-goal-3">3</label>
											<label class="checkbox-inline"><input type="checkbox" id="project-goal-4">4</label>
											<label class="checkbox-inline"><input type="checkbox" id="project-goal-5">5</label>
										</div>
									</div>
									<div class="form-group form-group-sm row">
										<div class="col-xs-3"><label for="project-funder" class="control-label">Funder</label></div>
										<div class="col-xs-9"><input type="text" class="form-control" id="project-funder" placeholder="Enter Funder Name" /></div>
									</div>
									<div class="form-group form-group-sm row">
										<div class="col-xs-3"><label for="project-amount" class="control-label">Amount</label></div>
										<div class="col-xs-9"><input type="number" class="form-control" id="project-amount" placeholder="Enter Amount (USD)" /></div>
									</div>
									<div class="form-group form-group-sm row">
										<div class="col-xs-3"><label for="project-prin-contact" class="control-label">Contact</label></div>
										<div class="col-xs-9"><input type="text" class="form-control" id="project-prin-contact" placeholder="Enter Contact Name" /></div>
									</div>
									<div class="form-group form-group-sm row">
										<div class="col-xs-3"><label for="project-position" class="control-label">Position</label></div>
										<div class="col-xs-9"><input type="text" class="form-control" id="project-position" placeholder="Enter Position" /></div>
									</div>
									<div class="form-group form-group-sm row">
										<div class="col-xs-3"><label for="project-email" class="control-label">Email</label></div>
										<div class="col-xs-9"><input type="email" class="form-control" id="project-email" placeholder="Enter Email" /></div>
									</div>
									<div class="form-group form-group-sm row">
										<div class="col-xs-3"><label for="project-phone" class="control-label">Phone</label></div>
										<div class="col-xs-9"><input type="tel" class="form-control" id="project-phone" placeholder="Enter Phone" /></div>
									</div>
									<div class="form-group form-group-sm row">
										<div class="col-xs-3"><label for="project-website" class="control-label">Website</label></div>
										<div class="col-xs-9"><input type="url" class="form-control" id="project-website" placeholder="Enter Website" /></div>
									</div>
									<div class="form-group form-group-sm row">
										<div class="col-xs-3"><label for="project-remarks" class="control-label">Remarks</label></div>
										<div class="col-xs-9"><input type="text" class="form-control" id="project-remarks" placeholder="Enter Remarks" /></div>
									</div>
									<div class="form-group form-group-sm row">
										<div class="col-xs-3"><label for="project-start" class="control-label">Start</label></div>
										<div class="col-xs-9"><input type="date" class="form-control" id="project-start" placeholder="Enter Start Date" /></div>
									</div>
									<div class="form-group form-group-sm row">
										<div class="col-xs-3"><label for="project-end" class="control-label">End</label></div>
										<div class="col-xs-9"><input type="date" class="form-control" id="project-end" placeholder="Enter End Date" /></div>
									</div>
									<div class="form-group form-group-sm row">
										<div class="col-xs-3"><label class="control-label">Save</label></div>
										<div class="col-xs-9 btn-group">
											<button type="button" rel="tooltip" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Save and View Locations">Locations</button>
											<button type="button" rel="tooltip" class="btn btn-sm" data-toggle="tooltip" data-placement="top" title="Save without Locations">No Locations</b></button>
										</div>
									</div>
								</div>
								<!--div class="modal-footer">
									<div class="btn-group">
										<button type="button" class="btn btn-sm btn-primary">View Locations</button>
										<button type="button" class="btn btn-sm btn-primary">Save</b></button>
										<button type="button" class="btn btn-sm btn-default" onclick="">Cancel</button>
									</div>
								</div-->
							</div>
            </div>
          </div>
        </div>
      </div>
    </div>
		
    <div id="loading">
      <div class="loading-indicator">
        <div class="progress progress-striped active">
          <div class="progress-bar progress-bar-info" style="width: 100%"></div>
        </div>
      </div>
    </div>
		
		<!-- Monitor Modal -->
		<div class="modal fade" id="monitorModal" role="dialog">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button class="close" type="button" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Statistics Dashboard</h4>
					</div>
					<div class="modal-body">
						<div class="container-fluid">
							<div class="col-lg-3"><!-- nav column -->
							<ul class="nav nav-pills nav-stacked" role="tablist">
								<li><label><b>All Countries</b></label></li>
								<li class="active"><a href="#indicator1" data-toggle="pill">Projects Per Country</a></li>
								<li><a href="#indicator2" data-toggle="pill">Projects Per Goal</a></li>
								<li><label><b>Per Country</b></label></li>
								<li><a href="#indicator3" data-toggle="pill">Projects Per Goal (#)</a></li>
								<li><a href="#indicator4" data-toggle="pill">Projects Per Goal (%)</a></li>
								<li><a href="#indicator5" data-toggle="pill">Project Count</a></li>
								<li><a href="#indicator6" data-toggle="pill">Project Status</a></li>
							</ul>
							</div>
							<div class="tab-content col-lg-9"><!-- content column -->
								<div class="tab-pane fade in active" id="indicator1">1&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/></div>
								<div class="tab-pane fade" id="indicator2">2&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/></div>
								<div class="tab-pane fade" id="indicator3">3&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/></div>
								<div class="tab-pane fade" id="indicator4">4&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/></div>
								<div class="tab-pane fade" id="indicator5">5&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/></div>
								<div class="tab-pane fade" id="indicator6">6&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/></div>
							</div>
						</div><!-- container-fluid-->
					</div><!-- modal-body -->
					<div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
				</div><!-- modal-content -->
			</div><!-- modal dialog -->
		</div><!-- modal -->
		
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Already a member?</h4>
          </div>
          <div class="modal-body">
            <form id="contact-form" class="form-horizontal">
              <fieldset>
                <div class="form-group">
									<label for="name" class="col-sm-2 control-label">Username</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="username" />
									</div>
                </div>
                <div class="form-group ">
									<label for="password" class="col-sm-2 control-label">Password</label>
									<div class="col-sm-10">
										<input type="password" class="form-control" id="password"/>
									</div>
                </div>
              </fieldset>
							<div>
							<a href="#">Forgot password?</a>
							</div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary" data-dismiss="modal">Login</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
	  <div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Become a part of the team!</h4>
			</div>
			<div class="modal-body">
				<form id="register-form" class="form-horizontal">
					<div class="form-group">
					  <label for="email-reg" class="col-sm-2 control-label">Email</label>
					  <div class="col-sm-10">
						<input type="text" class="form-control" id="email-reg" />
					  </div>
					</div>
					<div class="form-group">
					  <label for="password-reg" class="col-sm-2 control-label">Password</label>
					  <div class="col-sm-10">
						<input type="password" class="form-control" id="password-reg"/>
					  </div>
					</div>

					<div class="form-group">
					  <label for="name-reg" class="col-sm-2 control-label">Full name</label>
					  <div class="col-sm-10">
						<input type="text" class="form-control" id="name-reg" />
					  </div>
					</div>
					<div class="form-group">
					  <label for="designation-reg" class="col-sm-2 control-label">Designation</label>
					  <div class="col-sm-10">
						<input type="text" class="form-control" id="designation-reg" />
					  </div>
					</div>
					<div class="form-group">
					  <label for="organization-reg" class="col-sm-2 control-label">Organization</label>
					  <div class="col-sm-10">
						<input type="text" class="form-control" id="organization-reg" />
					  </div>
					</div>
					<div class="form-group">
					  <label for="telephone-reg" class="col-sm-2 control-label">Telephone</label>
					  <div class="col-sm-10">
						<input type="text" class="form-control" id="telephone-reg" />
					  </div>
					</div>

				</form>
			</div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary" data-dismiss="modal">Register</button>
          </div>
		</div>
	  </div>
    </div><!-- /.modal -->

    <div class="modal fade" id="featureModal" tabindex="-1" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button class="close" type="button" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title text-primary" id="feature-title"></h4>
          </div>
          <div class="modal-body" id="feature-info"></div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" id="attributionModal" tabindex="-1" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button class="close" type="button" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">
              Developed by <a href='http://bryanmcbride.com'>bryanmcbride.com</a>
            </h4>
          </div>
          <div class="modal-body">
            <div id="attribution"></div>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <!--script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script-->
    <script src="assets/bootstrap-3.2.0-dist/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.10.2/typeahead.bundle.min.js"></script>
    <!--script src="assets/js/typeahead.js"></script-->
    <script src="//cdnjs.cloudflare.com/ajax/libs/handlebars.js/1.3.0/handlebars.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.1.1/list.min.js"></script>
    <script src="assets/leaflet-0.7.3/leaflet.js"></script>
    <script src="//api.tiles.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/leaflet.markercluster.js"></script>
    <script src="//api.tiles.mapbox.com/mapbox.js/plugins/leaflet-locatecontrol/v0.24.0/L.Control.Locate.js"></script>
    <script src="assets/leaflet-groupedlayercontrol/leaflet.groupedlayercontrol.js"></script>
    <script src="assets/leaflet-activearea/L.activearea.js"></script>
    <script src="assets/leaflet-sidebar-0.1.5/L.Control.Sidebar.js"></script>
    <script src="assets/js/appcti.js"></script>
  </body>
</html>
