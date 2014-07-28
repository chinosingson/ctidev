<!DOCTYPE html>
<html>
	<head>
		<title>Leaflet Test</title>
		<meta charset="utf-8" />

		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css" />
		<script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
		<script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
		<link rel="points" type="application/json" href="http://www.ctimap.org/locations/cti.json" />
	</head>
	<body>
		<div id="map" style="width: 100%; height: 700px"></div>

		<script>

			var map = L.map('map').setView([9.622, 111.137], 5);
			//var geojsonLayer = new L.GeoJSON.AJAX("http:ctimap.org/locations/cti.json", {dataType:"jsonp"});
			L.tileLayer('https://{s}.tiles.mapbox.com/v3/{id}/{z}/{x}/{y}.png', {
				maxZoom: 18,
				attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
					'<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
					'Imagery © <a href="http://mapbox.com">Mapbox</a>',
				id: 'examples.map-i86knfo3'
			}).addTo(map);
			
			//geojsonLayer.addTo(map);
		</script>
		
	</body>
</html>