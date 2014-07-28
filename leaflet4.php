<!DOCTYPE html>
<html>
<head>
  <title>Marker Cluster Webmap</title>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.css" />
  <script src="http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.js"></script>
  <script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
  <link rel="stylesheet" href="leaflet/MarkerCluster.css" />
  <link rel="stylesheet" href="leaflet/MarkerCluster.Default.css" />
</head>
<body>
  <div id="map" style="width: 800px; height: 600px"></div>
  <!--script src="http://cdn.leafletjs.com/leaflet-0.6.2/leaflet.js"></script-->    
  <!--script src="points_rand.js"></script-->
  <script src="http://www.ctimap.org/locations/cti.json"></script>
  <script src="leaflet/leaflet.markercluster-src.js"></script>
  <script>
	var map = L.map('map').setView([9.622, 111.137], 5);
	L.tileLayer('http://{s}.www.toolserver.org/tiles/bw-mapnik/{z}/{x}/{y}.png').addTo(map); //will be our basemap.
	var markers = L.markerClusterGroup();
	var points_rand = L.geoJson(data, {
		onEachFeature: function (feature, layer) //functionality on click on feature
			{
			layer.bindPopup("hi! I am one of thousands"); //just to show something in the popup. could be part of the geojson as well!
			}
		});
	markers.addLayer(points_rand); // add it to the cluster group
	map.addLayer(markers);		// add it to the map
	map.fitBounds(markers.getBounds()); //set view on the cluster extend
  </script>
<!--First webmap with many points in Berlin.-->
 </body>
</html>