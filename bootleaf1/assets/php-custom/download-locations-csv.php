<?php

	include_once('db.php');

	$dl_sql = "SELECT longitude, latitude, projectID 'Project ID' FROM locations 
	WHERE `status`='P'
	ORDER BY `updated` DESC";
	
	# Try query or error
	$rs = $conn->query($dl_sql);
	if (!$rs) {
			echo 'Download CSV - An SQL error occured.\n';
			exit;
	}

	$locationCount = $rs->rowCount();
	
	//echo "<pre>";
	//echo $locationCount."<br/>";

	if ($locationCount > 0){
		//ob_start();
		$fp = fopen("php://output", "w");
		if (!$fp) {
			echo "Download CSV - error opening file.\n";
		} else {
			$filename = "cti_locations_".date('Y-m-d H:i:s').".csv";
			// disable caching
			$now = gmdate("D, d M Y H:i:s");
			//header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
			header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
			header("Last-Modified: {$now} GMT");

			// force download  
			header("Content-Type: application/force-download");
			header("Content-Type: application/octet-stream");
			header("Content-Type: application/download");

			// disposition / encoding on response body
			header("Content-Disposition: attachment;filename={$filename}");
			header("Content-Transfer-Encoding: binary");
			fputcsv($fp, array("Longitude", "Latitude"));
			while ($row = $rs->fetch(PDO::FETCH_ASSOC)) {
				//echo print_r($row,1)."<br/>";
				fputcsv($fp, $row);
			}

			fclose($fp);
			//return ob_get_clean();
		}
	} else {
		return null;
	}

	//echo "</pre>";
	
?>