﻿	/*$("#loc-info-save").click(function () {
		console.log('save');
		//var gjPoints = getMarkerGeoJSON();
		//console.log(gjPoints);
	});*/

	/*var locInfoControl = L.Control.extend({
		options: {
			position: 'topleft'
		},
		onAdd: function (map) {
			//console.log('locInfoControl added');
			locInfoControlAdded = true;
			var container = L.DomUtil.create('div', 'well well-sm leaflet-control-location-info');
      container.id = 'loc-info-'+ markerCount;
			var munID = "info-mun-" + markerCount;
			var provID = "info-prov-" + markerCount;
			//console.log(map._layers);
			container.innerHTML = '<div class="row"><div class="col-xs-3"><span class="badge">' + markerCount + '</span></div><div class="col-xs-9"></div></div>' + 
			'<div class="form-group form-group-sm row"><div class="col-xs-3"><label for="' + munID +'" class="control-label">Municipality</label></div><div class="col-xs-9"><input class="form-control" type="text" name="data[municipality]" id="' + munID +'" /></div></div>' +
			'<div class="form-group form-group-sm row"><div class="col-xs-3"><label for="' + munID +'" class="control-label">Province</label></div><div class="col-xs-9"><input class="form-control" type="text" name="data[province]" id="' + provID +'" /></div></div>';
			controlID++;
			return container;
		}
	});*/

	/*var locByLatLng = L.Control.extend({
			options: {
					position: 'topright'
			},
			onAdd: function (map){
					var container1 = L.DomUtil.create('div', 'well well-sm leaflet-draw leaflet-bar leaflet-control');
					container1.id = 'setPoint';
					container1.innerHTML = '<div class="form-group form-group-sm row"><div class="col-xs-3"><label for="setLat" class="control-label">LAT</span></div><div class="col-xs-9"><input class="form-control" type="text" id="setLat" /></div></div>' + 
					'<div class="form-group form-group-sm row"><div class="col-xs-3"><label for="setLng" class="control-label">LNG</label></div><div class="col-xs-9"><input class="form-control" type="text" id="setLng"  /></div></div>' +
					'<div class="form-group form-group-sm row"><div class="col-xs-3"></div><div class="col-xs-9"><button id="setLatLng" onclick="setLatLng()">Set Point</button> <button id="clearLatLng" onclick="clearLatLng()">Clear</button></div></div>';
					return container1;
			}
	});*/
	
	/* var locInfoSave = L.Control.extend({
			options: {
				position: 'topleft'
			},
			onAdd: function (map){
				var container2 = L.DomUtil.create ('div','leaflet-draw leaflet-bar leaflet-control');
				container2.innerHTML = '<a href="#" id="loc-info-save" title="Save Locations"><i class="glyphicon glyphicon-floppy-save"></i></a>';
        container2.addEventListener('click', function (e){
            console.log('save from event listener');
						//var args = decodeURIComponent(projectData).split('&');
						//console.log(args[0]);
						//var opArg = args[0].split('=');
						//var op = opArg[1];
						//console.log('op=' + op);
						//var idArg = args.indexOf("ID");
						//console.log('ID=' + args[4]);
						
						var locationData = getMarkerGeoJSON();
						//console.log('projectData = ' + projectData);
						console.log('locationData');
						//console.log(locationData);
						$.ajax({
								url     : "./assets/php-custom/process.php", 
								type    : "POST",
								cache   : false,
								//data    : { proj : projectData, locn: locationData },
								data    : { locn: locationData },
								success : function (data){ 
									console.log('load php response');
									if (projectOp == 'i'){
										$("#projects-add").empty().html(data);
									} else if (projectOp == 'u') {
										$("#map-project-details").empty().html(data);
									}
								}
						});
				});
				return container2;
			}
	}); */
	
	
		function postProjectID(projID) {
		//var hash = location.hash;
		//console.log('edit project '+projID);
		/*$.ajax(
		url: "../assets/php-custom/edit-project.php",
		type: "POST",
		cache: false,
		data: {
		p: projID
		}
		);*/

		var posting = $.post('assets/php-custom/edit-project.php', {
				p : projID
			}).done(function () {
				console.log("second success");
			})
			.fail(function () {
				console.log("error: " + error);
			})
			.always(function () {
				console.log("finished");
			});

		posting.done(function (data) {
			//console.log(data);
			//var content = $( data ).find( "#projects-edit" );
			
			$("#project-forms").empty().html(data);
			/*$('#form-edit-project input#project-start').datepicker({
				dateFormat: 'yy-mm-dd'
			});*/
		});

		/*,function(data){
		console.log(data);
		});*/
	}

/* GPS enabled geolocation control set to follow the user's location */
	/*var locateControl = L.control.locate({
	position: "topleft",
	drawCircle: true,
	follow: true,
	setView: true,
	keepCurrentZoomLevel: true,
	markerStyle: {
	weight: 1,
	opacity: 0.8,
	fillOpacity: 0.8
	},
	circleStyle: {
	weight: 1,
	clickable: false
	},
	icon: "icon-direction",
	metric: false,
	strings: {
	title: "My location",
	popup: "You are within {distance} {unit} from this point",
	outsideMapBoundsMsg: "You seem located outside the boundaries of the map"
	},
	locateOptions: {
	maxZoom: 18,
	watch: true,
	enableHighAccuracy: true,
	maximumAge: 10000,
	timeout: 10000
	}
	}).addTo(map);*/

	/*var sidebar = L.control.sidebar("sidebar", {
	closeButton: true,
	position: "left"
	}).on("shown", function () {
	getViewport();
	}).on("hidden", function () {
	getViewport();
	}).addTo(map);*/