<?php

	//include_once('db.php');

	// CTI custom PHP - MySQL - GeoJSON functions
	// JPS3
	// changelog
	// 2014-10-20 - CREATED

	class buildGeoJSON {
		
		private function points ($sql){
			$db = parse_ini_file('cti.ini');
			$dsn = $db['driver'].":host=".$db['host'].";dbname=".$db['dbname'];
			$dbh = new PDO($dsn, $db['user'], $db['password']);
			//$dbh = new PDO('mysql:host=localhost;dbname=cti2','root','');
			$sth = $dbh->prepare($sql);
			//echo $sql;
			$sth->execute();
			//$rs = $sth->fetch(PDO::FETCH_ASSOC);
			$rs = $sth->fetchAll();
			
			# Build GeoJSON feature collection array
			$geojson = array(
				 'type'      => 'FeatureCollection',
				 'features'  => array()
			);

			foreach ($rs as $row) {
				//echo "x=".print_r($row['x'],1)."</br>";
				//echo "y=".print_r($row['y'],1)."</br>";
				# Loop through rows to build feature arrays
				$properties = $row;
				# Remove x and y fields from properties (optional)
				unset($properties['x']);
				unset($properties['y']);
				//unset($row['x']);
				//unset($row['y']);
				//echo "<pre>".print_r($row,1)."</pre><br/>";
				//echo "<pre>".print_r($properties,1)."</pre><br/>";
				$feature = array(
						'type' => 'Feature',
						'geometry' => array(
								'type' => 'Point',
								'coordinates' => array(
										$row['y'],
										$row['x']
								)
						),
						'properties' => $properties
				);
				# Add feature arrays to feature collection array
				array_push($geojson['features'], $feature);

			}
			
			header('Content-type: application/json');
			return json_encode($geojson, JSON_NUMERIC_CHECK);
			$dbh = NULL;
			//return $sql;
		
		}
		
		function locations ($sql) {
			return $this->points($sql);
		}
	}

?>