var map, boroughSearch = [], theaterSearch = [], museumSearch = []; ctiSearch = [];

$(document).ready(function() {
	$('[rel=tooltip]').tooltip({
		container: 'body'
	});
	if (document.body.clientWidth <= 767) {
			$('#sidebar').toggle();
			$('a.toggle i').toggleClass('icon-chevron-left icon-chevron-right');
	};
  getViewport();
});

function getViewport() {
  if (sidebar.isOpen()) {
    map.setActiveArea({
      position: "absolute",
      top: "0px",
      left: $(".leaflet-sidebar").css("width"),
      right: "0px",
      height: $("#map").css("height")
    });
  } else {
    map.setActiveArea({
      position: "absolute",
      top: "0px",
      left: "0px",
      right: "0px",
      height: $("#map").css("height")
    });
  }
}

/*function sidebarClick(id) {
  //If sidebar takes up entire screen, hide it and go to the map
  if (document.body.clientWidth <= 767) {
    sidebar.hide();
    getViewport();
  }
  //map.addLayer(theaterLayer).addLayer(museumLayer);
	map.addLayer(ctiLayer);
  var layer = markerClusters.getLayer(id);
  markerClusters.zoomToShowLayer(layer, function() {
    map.setView([layer.getLatLng().lat, layer.getLatLng().lng], 18);
    layer.fire("click");
  });
}*/

function zoomToProjectLocations(projectID) {
  /* If sidebar takes up entire screen, hide it and go to the map */
  /*if (document.body.clientWidth <= 767) {
    sidebar.hide();
    getViewport();
  }*/

	console.log('zoom to project ID '+projectID);
	
}

/* Basemap Layers */
var mapquestOSM = L.tileLayer("http://{s}.mqcdn.com/tiles/1.0.0/osm/{z}/{x}/{y}.png", {
  maxZoom: 19,
  subdomains: ["otile1", "otile2", "otile3", "otile4"],
  attribution: 'Tiles courtesy of <a href="http://www.mapquest.com/" target="_blank">MapQuest</a> <img src="http://developer.mapquest.com/content/osm/mq_logo.png">. Map data (c) <a href="http://www.openstreetmap.org/" target="_blank">OpenStreetMap</a> contributors, CC-BY-SA.'
});
var mapquestOAM = L.tileLayer("http://{s}.mqcdn.com/tiles/1.0.0/sat/{z}/{x}/{y}.jpg", {
  maxZoom: 18,
  subdomains: ["oatile1", "oatile2", "oatile3", "oatile4"],
  attribution: 'Tiles courtesy of <a href="http://www.mapquest.com/" target="_blank">MapQuest</a>. Portions Courtesy NASA/JPL-Caltech and U.S. Depart. of Agriculture, Farm Service Agency'
});
var mapquestHYB = L.layerGroup([L.tileLayer("http://{s}.mqcdn.com/tiles/1.0.0/sat/{z}/{x}/{y}.jpg", {
  maxZoom: 18,
  subdomains: ["oatile1", "oatile2", "oatile3", "oatile4"]
}), L.tileLayer("http://{s}.mqcdn.com/tiles/1.0.0/hyb/{z}/{x}/{y}.png", {
  maxZoom: 19,
  subdomains: ["oatile1", "oatile2", "oatile3", "oatile4"],
  attribution: 'Labels courtesy of <a href="http://www.mapquest.com/" target="_blank">MapQuest</a> <img src="http://developer.mapquest.com/content/osm/mq_logo.png">. Map data (c) <a href="http://www.openstreetmap.org/" target="_blank">OpenStreetMap</a> contributors, CC-BY-SA. Portions Courtesy NASA/JPL-Caltech and U.S. Depart. of Agriculture, Farm Service Agency'
})]);

/* Overlay Layers */
var highlight = L.geoJson(null);

var boroughs = L.geoJson(null, {
  style: function (feature) {
    return {
      color: "black",
      fill: false,
      opacity: 1,
      clickable: false
    };
  },
  onEachFeature: function (feature, layer) {
    boroughSearch.push({
      name: layer.feature.properties.BoroName,
      source: "Boroughs",
      id: L.stamp(layer),
      bounds: layer.getBounds()
    });
  }
});
$.getJSON("data/boroughs.geojson", function (data) {
  //boroughs.addData(data);
});

var ctiBounds = L.geoJson(null, {
  style: function (feature) {
    return {
      color: "black",
      fill: false,
      opacity: 1,
      clickable: false
    };
  },
  onEachFeature: function (feature, layer) {
    ctiSearch.push({
      name: layer.feature.properties.title,
      source: "CTI",
      id: L.stamp(layer),
      bounds: layer.getBounds()
    });
  }
});
$.getJSON("data/ctibounds.geojson", function (data) {
  //ctiBounds.addData(data);
});

var subwayLines = L.geoJson(null, {
  style: function (feature) {
    if (feature.properties.route_id === "1" || feature.properties.route_id === "2" || feature.properties.route_id === "3") {
      return {
        color: "#ff3135",
        weight: 3,
        opacity: 1
      };
    }
    if (feature.properties.route_id === "4" || feature.properties.route_id === "5" || feature.properties.route_id === "6") {
      return {
        color: "#009b2e",
        weight: 3,
        opacity: 1
      };
    }
    if (feature.properties.route_id === "7") {
      return {
        color: "#ce06cb",
        weight: 3,
        opacity: 1
      };
    }
    if (feature.properties.route_id === "A" || feature.properties.route_id === "C" || feature.properties.route_id === "E" || feature.properties.route_id === "SI" || feature.properties.route_id === "H") {
      return {
        color: "#fd9a00",
        weight: 3,
        opacity: 1
      };
    }
    if (feature.properties.route_id === "Air") {
      return {
        color: "#ffff00",
        weight: 3,
        opacity: 1
      };
    }
    if (feature.properties.route_id === "B" || feature.properties.route_id === "D" || feature.properties.route_id === "F" || feature.properties.route_id === "M") {
      return {
        color: "#ffff00",
        weight: 3,
        opacity: 1
      };
    }
    if (feature.properties.route_id === "G") {
      return {
        color: "#9ace00",
        weight: 3,
        opacity: 1
      };
    }
    if (feature.properties.route_id === "FS" || feature.properties.route_id === "GS") {
      return {
        color: "#6e6e6e",
        weight: 3,
        opacity: 1
      };
    }
    if (feature.properties.route_id === "J" || feature.properties.route_id === "Z") {
      return {
        color: "#976900",
        weight: 3,
        opacity: 1
      };
    }
    if (feature.properties.route_id === "L") {
      return {
        color: "#969696",
        weight: 3,
        opacity: 1
      };
    }
    if (feature.properties.route_id === "N" || feature.properties.route_id === "Q" || feature.properties.route_id === "R") {
      return {
        color: "#ffff00",
        weight: 3,
        opacity: 1
      };
    }
  },
  onEachFeature: function (feature, layer) {
    if (feature.properties) {
      var content = "<table class='table table-striped table-bordered table-condensed'>" + "<tr><th>Division</th><td>" + feature.properties.Division + "</td></tr>" + "<tr><th>Line</th><td>" + feature.properties.Line + "</td></tr>" + "<table>";
      layer.on({
        click: function (e) {
          $("#feature-title").html(feature.properties.Line);
          $("#feature-info").html(content);
          $("#featureModal").modal("show");
          highlight.clearLayers().addLayer(L.circleMarker([e.latlng.lat, e.latlng.lng], {
            stroke: false,
            fillColor: "#00FFFF",
            fillOpacity: 0.7,
            radius: 10
          }));
        }
      });
    }
    layer.on({
      mouseover: function (e) {
        var layer = e.target;
        layer.setStyle({
          weight: 3,
          color: "#00FFFF",
          opacity: 1
        });
        if (!L.Browser.ie && !L.Browser.opera) {
          layer.bringToFront();
        }
      },
      mouseout: function (e) {
        subwayLines.resetStyle(e.target);
      }
    });
  }
});
$.getJSON("data/subways.geojson", function (data) {
  //subwayLines.addData(data);
});

/* Single marker cluster layer to hold all clusters */
var markerClusters = new L.MarkerClusterGroup({
  spiderfyOnMaxZoom: true,
  showCoverageOnHover: false,
  zoomToBoundsOnClick: true,
  disableClusteringAtZoom: 16
});

/* Empty layer placeholder to add to layer control for listening when to add/remove theaters to markerClusters layer */
var theaterLayer = L.geoJson(null);
var theaters = L.geoJson(null, {
  pointToLayer: function (feature, latlng) {
    return L.marker(latlng, {
      icon: L.icon({
        iconUrl: "assets/img/theater.png",
        iconSize: [24, 28],
        iconAnchor: [12, 28],
        popupAnchor: [0, -25]
      }),
      title: feature.properties.NAME,
      riseOnHover: true
    });
  },
  onEachFeature: function (feature, layer) {
    if (feature.properties) {
      var content = "<table class='table table-striped table-bordered table-condensed'>" + "<tr><th>Name</th><td>" + feature.properties.NAME + "</td></tr>" + "<tr><th>Phone</th><td>" + feature.properties.TEL + "</td></tr>" + "<tr><th>Address</th><td>" + feature.properties.ADDRESS1 + "</td></tr>" + "<tr><th>Website</th><td><a class='url-break' href='" + feature.properties.URL + "' target='_blank'>" + feature.properties.URL + "</a></td></tr>" + "<table>";
      layer.on({
        click: function (e) {
          $("#feature-title").html(feature.properties.NAME);
          $("#feature-info").html(content);
          $("#featureModal").modal("show");
          highlight.clearLayers().addLayer(L.circleMarker([feature.geometry.coordinates[1], feature.geometry.coordinates[0]], {
            stroke: false,
            fillColor: "#00FFFF",
            fillOpacity: 0.7,
            radius: 10
          }));
        }
      });
      $("#theater-table tbody").append('<tr style="cursor: pointer;" onclick="sidebarClick('+L.stamp(layer)+'); return false;"><td class="theater-name">'+layer.feature.properties.NAME+'<i class="fa fa-chevron-right pull-right"></td></tr>');
      theaterSearch.push({
        name: layer.feature.properties.NAME,
        address: layer.feature.properties.ADDRESS1,
        source: "Theaters",
        id: L.stamp(layer),
        lat: layer.feature.geometry.coordinates[1],
        lng: layer.feature.geometry.coordinates[0]
      });
    }
  }
});
$.getJSON("data/DOITT_THEATER_01_13SEPT2010.geojson", function (data) {
  //theaters.addData(data);
  //map.addLayer(theaterLayer);
});

/* Empty layer placeholder to add to layer control for listening when to add/remove museums to markerClusters layer */
var museumLayer = L.geoJson(null);
var museums = L.geoJson(null, {
  pointToLayer: function (feature, latlng) {
    return L.marker(latlng, {
      icon: L.icon({
        iconUrl: "assets/img/marker-icon.png",
		iconSize: [25, 41],
        iconAnchor: [12, 28],
        popupAnchor: [0, -25]
      }),
      title: feature.properties.NAME,
      riseOnHover: true
    });
  },
  onEachFeature: function (feature, layer) {
    if (feature.properties) {
      var content = "<table class='table table-striped table-bordered table-condensed'>" + "<tr><th>Name</th><td>" + feature.properties.NAME + "</td></tr>" + "<tr><th>Phone</th><td>" + feature.properties.TEL + "</td></tr>" + "<tr><th>Address</th><td>" + feature.properties.ADRESS1 + "</td></tr>" + "<tr><th>Website</th><td><a class='url-break' href='" + feature.properties.URL + "' target='_blank'>" + feature.properties.URL + "</a></td></tr>" + "<table>";
      layer.on({
        click: function (e) {
          $("#feature-title").html(feature.properties.NAME);
          $("#feature-info").html(content);
          $("#featureModal").modal("show");
          highlight.clearLayers().addLayer(L.circleMarker([feature.geometry.coordinates[1], feature.geometry.coordinates[0]], {
            stroke: false,
            fillColor: "#00FFFF",
            fillOpacity: 0.7,
            radius: 10
          }));
        }
      });
      $("#museum-table tbody").append('<tr style="cursor: pointer;" onclick="sidebarClick('+L.stamp(layer)+'); return false;"><td class="museum-name">'+layer.feature.properties.NAME+'<i class="fa fa-chevron-right pull-right"></td></tr>');
      museumSearch.push({
        name: layer.feature.properties.NAME,
        address: layer.feature.properties.ADRESS1,
        source: "Museums",
        id: L.stamp(layer),
        lat: layer.feature.geometry.coordinates[1],
        lng: layer.feature.geometry.coordinates[0]
      });
    }
  }
});
$.getJSON("data/DOITT_MUSEUM_01_13SEPT2010.geojson", function (data) {
  //museums.addData(data);
  //map.addLayer(museumLayer);
});


var ctiLayer = L.geoJson(null);
var ctilocations = L.geoJson(null, {
	pointToLayer: function (feature, latlng) {
		return L.marker(latlng, {
		  icon: L.icon({
			iconUrl: "assets/img/marker-icon.png",
			iconSize: [25, 41],
			iconAnchor: [12, 28],
			popupAnchor: [0, -25]
		  }),
		  title: feature.properties.coordinates,
		  riseOnHover: true
		});
	},
	onEachFeature: function (feature, layer){
		if (feature.properties) {
      //var content = "<table class='table table-striped table-bordered table-condensed'>" + "<tr><th>Name</th><td>" + feature.properties.NAME + "</td></tr>" + "<tr><th>Phone</th><td>" + feature.properties.TEL + "</td></tr>" + "<tr><th>Address</th><td>" + feature.properties.ADRESS1 + "</td></tr>" + "<tr><th>Website</th><td><a class='url-break' href='" + feature.properties.URL + "' target='_blank'>" + feature.properties.URL + "</a></td></tr>" + "<table>";
			var projStart = feature.properties.start;
			var projEnd = feature.properties.end;
			var startDate;
			if(projStart) startDate = projStart.substring(0,10);
			else startDate = "";
			var endDate;
			if(projEnd) endDate = projEnd.substring(0,10);
			else projEnd = "";
			var website = feature.properties.website;
			var websiteLink;
			if(website) websiteLink = "<a href='"+website+"'>" +website+ "</a>";
			else websiteLink = "";

			var locationInfo = "<div><h4>" + feature.properties.title +"</h4>" +
			"<table class='table table-striped table-condensed'>" + 
			"<tbody class='list'>" +
			/*"<tr><td>Coordinates</td><td>" + feature.geometry.coordinates + "</td></tr>" +
			"<tr><td>Major Goals</td><td>" + feature.properties.field_major_goal_rendered + "</td></tr>" +
			"<tr><td>Start</td><td>" + feature.properties.field_start_date_rendered + "</td></tr>" +
			"<tr><td>End</td><td>" + feature.properties.field_end_rendered + "</td></tr>" +
			"<tr><td>Funder</td><td>" + feature.properties.field_funder_rendered + "</td></tr>" +
			"<tr><td>Amount</td><td>" + feature.properties.field_amount_rendered + "</td></tr>" +
			"<tr><td>Implementer</td><td>" + feature.properties.field_implementer_rendered + "</td></tr>" +
			"<tr><td>Principal Contact</td><td>" + feature.properties.field_principal_contact_rendered + "</td></tr>" +
			"<tr><td>Position</td><td>" + feature.properties.field_position_rendered + "</td></tr>" +
			"<tr><td>Email</td><td>" + feature.properties.field_email_rendered + "</td></tr>" +
			"<tr><td>Phone</td><td>" + feature.properties.field_phone_rendered + "</td></tr>" +
			"<tr><td>Website</td><td>" + feature.properties.field_website_rendered + "</td></tr>" +
			"<tr><td>Remarks</td><td>" + feature.properties.field_remarks_rendered + "</td></tr>" +*/
			//"<tr><td>projID</td><td>" + feature.properties.ID + "</td></tr>" +
			//"<tr><td>Coordinates</td><td>" + feature.geometry.coordinates + "</td></tr>" +
			"<tr><td>Major Goals</td><td>" + feature.properties.goals + "</td></tr>" +
			"<tr><td>Start</td><td>" + startDate + "</td></tr>" +
			"<tr><td>End</td><td>" + endDate + "</td></tr>" +
			"<tr><td>Funder</td><td>" + feature.properties.funder + "</td></tr>" +
			"<tr><td>Amount&nbsp;(USD)</td><td>" + feature.properties.amount + "</td></tr>" +
			"<tr><td>Implementer</td><td>" + feature.properties.implementer + "</td></tr>" +
			"<tr><td>Principal Contact</td><td>" + feature.properties.contact + "</td></tr>" +
			"<tr><td>Position</td><td>" + feature.properties.position + "</td></tr>" +
			"<tr><td>Email</td><td>" + feature.properties.email + "</td></tr>" +
			"<tr><td>Phone</td><td>" + feature.properties.phone + "</td></tr>" +
			"<tr><td>Website</td><td>" + websiteLink + "</td></tr>" +
			"<tr><td>Remarks</td><td>" + feature.properties.remarks + "</td></tr>" +
			"</tbody>"+
			"</table></div>";
      layer.on({
        click: function (e) {
          //$("#feature-title").html(feature.properties.nid);
          //$("#featureModal").modal("show");
					//sidebar.hide();
					//sidebarMap.show();
					//sidebarMonitor.hide();
          $("#map-project-info-details").html(locationInfo);
					sidebar.open('locations');
					$("#mapTabs a[href='#map-project-info']").tab('show');
          highlight.clearLayers().addLayer(L.circleMarker([feature.geometry.coordinates[1], feature.geometry.coordinates[0]], {
          //highlight.clearLayers().addLayer(L.circleMarker([feature.properties.latitude, feature.properties.longitude], {
            stroke: false,
            fillColor: "#00FFFF",
            fillOpacity: 0.7,
            radius: 10
          }));
        }
      });
		
		}
	}
	
});
//$.getJSON("data/ctilocation.geojson", function(data) {
$.getJSON("./assets/PHP-Database-GeoJSON-master/simple_points/cti_points_geojson.php", function(data) {
	//if (data) alert("1");
	ctilocations.addData(data);
	map.addLayer(ctiLayer);
});


function postProjectID (projID) {
	//var hash = location.hash;
	//console.log('edit project '+projID);
	/*$.ajax(
			url   : "../assets/php-custom/database-edit-project.php", 
      type  : "POST",
      cache : false,
      data  : {
				p 	: projID
      }	
	);*/

	var posting = $.post('assets/php-custom/database-edit-project.php', {p:projID}).done(function() {
    console.log( "second success" );
  })
  .fail(function() {
    console.log( "error: "+error );
  })
  .always(function() {
    console.log( "finished" );
	});
	
	posting.done(function( data ) {
		//console.log(data);
    //var content = $( data ).find( "#projects-edit" );
    $( "#project-forms" ).empty().html( data );
  });
	
	/*,function(data){
			console.log(data);
	});*/
}

var ctiProjLayer = L.geoJson(null);
var ctiProjects = L.geoJson(null, {
	onEachFeature: function (feature, layer) {
		//layer.bindPopup(feature.properties.coordinates);
		// Project Details
    if (feature.properties) {
			//console.log(L.stamp(layer));
			
      //$("#museum-table tbody").append('<tr style="cursor: pointer;" onclick="sidebarClick('+L.stamp(layer)+'); return false;"><td class="museum-name">'+layer.feature.properties.NAME+'<i class="fa fa-chevron-right pull-right"></td></tr>');
			// <i class="fa fa-chevron-right pull-right">
			//data-toggle="tooltip" data-placement="top" title="'+layer.feature.properties.title+'"
			var projectsContent = '<tr style="cursor: pointer;" onclick="sidebarClick('+L.stamp(layer)+'); return false;" >' +
			'<td class="container">' +
			'<div class="col-xs-10"><span class="project-title" rel="tooltip" id="project-title-'+L.stamp(layer)+'" data-toggle="tooltip" title="'+layer.feature.properties.title+'">'+L.stamp(layer)+'|'+layer.feature.properties.title+'</span></div>' +
			'<div class="col-xs-2 pull-right"><a href="#">Edit</a></div>' +
			'</td></tr>';
      $("#projects tbody").append(projectsContent);
			//console.log("project-title-"+L.stamp(layer));
			$("#project-title-"+L.stamp(layer)).tooltip({
				placement: 'auto',
				//title: layer.feature.properties.title,
				//trigger: 'hover',
			});
      /*ctiSearch.push({
        name: layer.feature.properties.title,
        //address: layer.feature.properties.nid_rendered,
        source: "CTI",
        id: L.stamp(layer),
        lat: layer.feature.geometry.coordinates[1],
        lng: layer.feature.geometry.coordinates[0]
      });*/
    }
  } 
});

/*$.getJSON("http://localhost/ctidev/bootleaf1/assets/PHP-Database-GeoJSON-master/simple_points/cti_projects_geojson.php", function(data) {
	//if (data) alert("1");
	ctiProjects.addData(data);
	//map.addLayer(ctiProjLayer);
});*/


//var cticenter = ctilocations.getCenter();

/*map = L.map("map", {
  zoom: 10,
  center: [40.702222, -73.979378],
  layers: [mapquestOSM, boroughs, markerClusters, highlight],
  zoomControl: false,
  attributionControl: false
});*/

// CTI Map Center (approx)
map = L.map ("map", {
	zoom: 5,
	center: [9.622, 111.137],
	//center: ctilocations.getCenter,
	layers: [mapquestOSM, ctiBounds, markerClusters],
	zoomControl: true,
	attributionControl: false
});

/* Layer control listeners that allow for a single markerClusters layer */
map.on("overlayadd", function(e) {
  if (e.layer === theaterLayer) {
    markerClusters.addLayer(theaters);
  }
  if (e.layer === museumLayer) {
    markerClusters.addLayer(museums);
  }
  if (e.layer === ctiLayer) {
    markerClusters.addLayer(ctilocations);
  }
	if (e.layer === ctiProjLayer) {
		markerClusters.addLayer(ctiProjects);
	}
});

map.on("overlayremove", function(e) {
  if (e.layer === theaterLayer) {
    markerClusters.removeLayer(theaters);
  }
  if (e.layer === museumLayer) {
    markerClusters.removeLayer(museums);
  }
  if (e.layer === ctiLayer) {
    markerClusters.removeLayer(ctilocations);
  }
	if (e.layer === ctiProjLayer) {
		markerClusters.removeLayer(ctiProjects);
	}
});

/* Clear feature highlight when map is clicked */
map.on("click", function(e) {
  highlight.clearLayers();
});

/* Attribution control */
function updateAttribution(e) {
  $.each(map._layers, function(index, layer) {
    if (layer.getAttribution) {
      $("#attribution").html((layer.getAttribution()));
    }
  });
}
map.on("layeradd", updateAttribution);
map.on("layerremove", updateAttribution);

var attributionControl = L.control({
  position: "bottomright"
});
attributionControl.onAdd = function (map) {
  var div = L.DomUtil.create("div", "leaflet-control-attribution");
  div.innerHTML = "Prototyped by DigSol Team";
  return div;
};
map.addControl(attributionControl);

/*var zoomControl = L.control.zoom({
  position: "bottomright"
}).addTo(map);*/

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


var sidebar = L.control.sidebar('sidebar').addTo(map);
	//closeButton: true,
	//position: "left"

/*var sidebar = L.control.sidebar("sidebar", {
  closeButton: true,
  position: "left"
}).on("shown", function () {
  getViewport();
}).on("hidden", function () {
  getViewport();
}).addTo(map);

sidebar.hide();

var sidebarMap = L.control.sidebar("sidebar-map", {
	closeButton: true,
	position: "right"
}).on("shown", function () {
	getViewport();
}).on("hidden", function () {
	getViewport();
}).addTo(map);

var sidebarLocation = L.control.sidebar("sidebar-location", {
	closeButton: true,
	position: "left"
}).on("shown", function () {
	getViewport();
}).on("hidden", function () {
	getViewport();
}).addTo(map);*/

/*var sidebarMonitor = L.control.sidebar("sidebar-monitor", {
	closeButton: true,
	position: "right"
}).on("shown", function () {
	getViewport();
}).on("hidden", function () {
	getViewport();
}).addTo(map);*/

/* Larger screens get expanded layer control and visible sidebar */
if (document.body.clientWidth <= 767) {
  var isCollapsed = true;
} else {
  var isCollapsed = false;
  //sidebar.show();
}

var baseLayers = {
  "Street Map": mapquestOSM,
  "Satellite": mapquestOAM,
  "Satellite + Street": mapquestHYB
};

var groupedOverlays = {
  "CTI Locations": {
    //"<img src='assets/img/theater.png' width='24' height='28'>&nbsp;Theaters": theaterLayer,
    //"<img src='assets/img/museum.png' width='24' height='28'>&nbsp;Museums": museumLayer,
    //"<img src='assets/img/museum.png' width='24' height='28'>&nbsp;CTI": ctiLayer
    "<i class='fa fa-map-marker'></i>&nbsp;Projects": ctiLayer
  }/*,
  "Reference": {
    //"Boroughs": boroughs,
    //"Subway Lines": subwayLines
	//"CTI Boundaries": ctiBounds
  }*/
};

var layerControl = L.control.groupedLayers(baseLayers, groupedOverlays, {
  collapsed: isCollapsed
}).addTo(map);

/* Highlight search box text on click */
$("#searchbox").click(function () {
  $(this).select();
});

/* Typeahead search functionality */
$(document).one("ajaxStop", function () {
  /* Fit map to boroughs bounds */
  //map.fitBounds(boroughs.getBounds());
  //map.fitBounds(ctiBounds.getBounds());
  $("#loading").hide();

  var boroughsBH = new Bloodhound({
    name: "Boroughs",
    datumTokenizer: function (d) {
      return Bloodhound.tokenizers.whitespace(d.name);
    },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    local: boroughSearch,
    limit: 10
  });
  
  var ctiBH = new Bloodhound({
	name: "CTI",
    datumTokenizer: function (d) {
      return Bloodhound.tokenizers.whitespace(d.name);
    },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    local: ctiSearch,
    limit: 10
  });

  var theatersBH = new Bloodhound({
    name: "Theaters",
    datumTokenizer: function (d) {
      return Bloodhound.tokenizers.whitespace(d.name);
    },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    local: theaterSearch,
    limit: 10
  });
  var theaterList = new List("theaters", {valueNames: ["theater-name"]}); //.sort("theater-name", {order:"asc"});

  var museumsBH = new Bloodhound({
    name: "Museums",
    datumTokenizer: function (d) {
      return Bloodhound.tokenizers.whitespace(d.name);
    },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    local: museumSearch,
    limit: 10
  });
  var museumList = new List("museums", {valueNames: ["museum-name", "museum-address"]}); //.sort("museum-name", {order:"asc"});

  var geonamesBH = new Bloodhound({
    name: "GeoNames",
    datumTokenizer: function (d) {
      return Bloodhound.tokenizers.whitespace(d.name);
    },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: {
      url: "http://api.geonames.org/searchJSON?username=bootleaf&featureClass=P&maxRows=5&countryCode=US&name_startsWith=%QUERY",
      filter: function (data) {
        return $.map(data.geonames, function (result) {
          return {
            name: result.name + ", " + result.adminCode1,
            lat: result.lat,
            lng: result.lng,
            source: "GeoNames"
          };
        });
      },
      ajax: {
        beforeSend: function (jqXhr, settings) {
          settings.url += "&east=" + map.getBounds().getEast() + "&west=" + map.getBounds().getWest() + "&north=" + map.getBounds().getNorth() + "&south=" + map.getBounds().getSouth();
          $("#searchicon").removeClass("fa-search").addClass("fa-refresh fa-spin");
        },
        complete: function (jqXHR, status) {
          $('#searchicon').removeClass("fa-refresh fa-spin").addClass("fa-search");
        }
      }
    },
    limit: 10
  });
  boroughsBH.initialize();
  theatersBH.initialize();
  museumsBH.initialize();
  geonamesBH.initialize();
  ctiBH.initialize();

  /* instantiate the typeahead UI */
  $("#searchbox").typeahead({
    minLength: 3,
    highlight: true,
    hint: false
  }, {
    name: "Boroughs",
    displayKey: "name",
    source: boroughsBH.ttAdapter(),
    templates: {
      header: "<h4 class='typeahead-header'>Boroughs</h4>"
    }
  }, {
		name: "CTI",
		displayKey: "name",
		source: ctiBH.ttAdapter(),
		templates: {
			header: "<h4 class='typeahead-header'>CTI</h4>"
		}
	}, {
    name: "Theaters",
    displayKey: "name",
    source: theatersBH.ttAdapter(),
    templates: {
      header: "<h4 class='typeahead-header'><img src='assets/img/theater.png' width='24' height='28'>&nbsp;Theaters</h4>",
      suggestion: Handlebars.compile(["{{name}}<br>&nbsp;<small>{{address}}</small>"].join(""))
    }
  }, {
    name: "Museums",
    displayKey: "name",
    source: museumsBH.ttAdapter(),
    templates: {
      header: "<h4 class='typeahead-header'><img src='assets/img/museum.png' width='24' height='28'>&nbsp;Museums</h4>",
      suggestion: Handlebars.compile(["{{name}}<br>&nbsp;<small>{{address}}</small>"].join(""))
    }
  }, {
    name: "GeoNames",
    displayKey: "name",
    source: geonamesBH.ttAdapter(),
    templates: {
      header: "<h4 class='typeahead-header'><img src='assets/img/globe.png' width='25' height='25'>&nbsp;GeoNames</h4>"
    }
  }).on("typeahead:selected", function (obj, datum) {
		if (datum.source === "CTI") {
			map.fitBounds(datum.bounds);
		}
    if (datum.source === "Boroughs") {
      map.fitBounds(datum.bounds);
    }
    if (datum.source === "Theaters") {
      if (!map.hasLayer(theaterLayer)) {
        map.addLayer(theaterLayer);
      }
      map.setView([datum.lat, datum.lng], 17);
      if (map._layers[datum.id]) {
        map._layers[datum.id].fire("click");
      }
    }
    if (datum.source === "Museums") {
      if (!map.hasLayer(museumLayer)) {
        map.addLayer(museumLayer);
      }
      map.setView([datum.lat, datum.lng], 17);
      if (map._layers[datum.id]) {
        map._layers[datum.id].fire("click");
      }
    }
    if (datum.source === "GeoNames") {
      map.setView([datum.lat, datum.lng], 14);
    }
    if ($(".navbar-collapse").height() > 50) {
      $(".navbar-collapse").collapse("hide");
    }
  }).on("typeahead:opened", function () {
    $(".navbar-collapse.in").css("max-height", $(document).height() - $(".navbar-header").height());
    $(".navbar-collapse.in").css("height", $(document).height() - $(".navbar-header").height());
  }).on("typeahead:closed", function () {
    $(".navbar-collapse.in").css("max-height", "");
    $(".navbar-collapse.in").css("height", "");
  });
  $(".twitter-typeahead").css("position", "static");
  $(".twitter-typeahead").css("display", "block");
});
