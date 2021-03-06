<?php
/**
 * Title:   PostGIS to KML
 * Notes:   Query a PostGIS table or view and return the results in KML format.
 * Author:  Bryan R. McBride, GISP
 * Contact: bryanmcbride.com
 * GitHub:  https://github.com/bmcbride/PHP-Database-KML
 */

# Connect to PostgreSQL database
//$conn = new PDO('mysql:host=localhost;dbname=cti2', 'webapp', 'cT1w3bApP#!');
	include_once('db.php');


# Build SQL SELECT statement and return the geometry as a KML element
$sql = 'SELECT l.id id, l.latitude latitude, l.longitude longitude, p.title title, p.start, p.end, p.goals, p.funder, p.amount, p.implementer, p.contact, p.position, p.email, p.phone, p.website, p.remarks 
FROM locations l
LEFT JOIN projects p 
ON l.projectID=p.ID
WHERE p.status=\'P\'';

# Try query or error
$rs = $conn->query($sql);
if (!$rs) {
    echo 'An SQL error occured.\n';
    exit;
}

$numLocations = $rs->rowCount();

	if ($numLocations > 0){

		// Creates the Document.
		$dom = new DOMDocument('1.0', 'UTF-8');

		// Creates the root KML element and appends it to the root document.
		//$node = $dom->createElementNS('http://earth.google.com/kml/2.1', 'kml');
		$node = $dom->createElementNS('http://www.opengis.net/kml/2.2', 'kml');
		$parNode = $dom->appendChild($node);

		// Creates a KML Document element and append it to the KML element.
		$dnode = $dom->createElement('Document');
		$docNode = $parNode->appendChild($dnode);

		// Iterates through the MySQL results, creating one Placemark for each row.
		while ($row = $rs->fetch(PDO::FETCH_ASSOC))
		{
			// Creates a Placemark and append it to the Document.
			//echo "<pre>";
			//echo print_r($row['funder'],1)."<br/>";
			//echo "</pre>";

			$node = $dom->createElement('Placemark');
			$placeNode = $docNode->appendChild($node);

			// Creates an id attribute and assign it the value of id column.
			$placeNode->setAttribute('id', 'placemark' . $row['id']);

			// Create name, and description elements and assigns them the values of the name and address columns from the results.
			$nameNode = $dom->createElement('name',htmlentities($row['title']));
			$placeNode->appendChild($nameNode);
			$strDesc =
				(isset($row['start']) ? ("Start: ".substr($row['start'],0,10)."<br/>\n") : "").
				(isset($row['end']) ? ("End: ".substr($row['end'],0,10)."<br/>\n") : "").
				(isset($row['goals']) ? ("Goals: ".$row['goals']."<br/>\n") : "").
				(isset($row['funder']) ? ("Funder: ".htmlentities($row['funder'],ENT_QUOTES)."<br/>\n") : "").
				(isset($row['amount']) ? ("Amount: ".$row['amount']."<br/>\n") : "").
				(isset($row['implementer']) ? ("Implementer: ".htmlentities($row['implementer'],ENT_QUOTES)."<br/>\n") : "").
				(isset($row['contact']) ? ("Contact: ".htmlentities($row['contact'],ENT_QUOTES)."<br/>\n") : "").
				(isset($row['position']) ? ("Position: ".htmlentities($row['position'],ENT_QUOTES)."<br/>\n") : "").
				(isset($row['email']) ? ("Email: ".$row['email']."<br/>\n") : "").
				(isset($row['phone']) ? ("Phone: ".$row['phone']."<br/>\n") : "").
				(isset($row['website']) ? ("Website: ".$row['website']."<br/>\n") : "").
				(isset($row['remarks']) ? ("Remarks: ".htmlentities($row['remarks'],ENT_QUOTES)."\n") : "");
			
			$descNode = $dom->createElement('description'); 
			//$descNode->appendData($strDesc);
			$ct = $descNode->ownerDocument->createCDATAsection("\n".$strDesc."\n");
			$descNode->appendChild($ct);
			$placeNode->appendChild($descNode);
			//$styleUrl = $dom->createElement('styleUrl', '#' . $row['type'] . 'Style');
			//$placeNode->appendChild($styleUrl);

			// Creates a Point element.
			$pointNode = $dom->createElement('Point');
			$placeNode->appendChild($pointNode);

			// Creates a coordinates element and gives it the value of the lng and lat columns from the results.
			$coorStr = $row['longitude'] . ','  . $row['latitude'];
			$coorNode = $dom->createElement('coordinates', $coorStr);
			$pointNode->appendChild($coorNode);
		}

		$kmlOutput = $dom->saveXML();
		//echo "<pre>".htmlentities($kmlOutput)."</pre>";
		$fp = fopen("php://output", "w");
		if (!$fp) {
			echo "Download KML - error opening file.\n";
		} else {
			$filename = "cti_locations_".date('Y-m-d H:i:s').".kml";
			// disable caching
			$now = gmdate("D, d M Y H:i:s");
			//header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
			header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
			header("Last-Modified: {$now} GMT");

			// force download  
			header("Content-Type: application/force-download");
			header("Content-Type: application/octet-stream");
			header("Content-Type: application/download");
			header('Content-type: application/vnd.google-earth.kml+xml');

			// disposition / encoding on response body
			header("Content-Disposition: attachment;filename={$filename}");
			header("Content-Transfer-Encoding: binary");

			echo $kmlOutput;
		}
	} else {
		return null;
	}
?>