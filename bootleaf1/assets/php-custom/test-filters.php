<?php

include ('lib-mysql.php');
include ('lib-geojson.php');

// p=2373
// g[]=1&c[]=Philippines&c[]=Indonesia&z[]=whatevz&g[]=2

echo print_r($_REQUEST,1)."<br/>";

$ctiSQL = new buildMySQL();
//echo $ctiSQL->filterQuery($_REQUEST);

// INSERT/ADD
// project
//echo $ctiSQL->insertQuery("projects",array('ID'=>9999,'title'=>'TEST - 001'))."<br/>";
//echo $ctiSQL->insertQuery("locations",array('id'=>9999,'longitude'=>'0.0000'))."<br/>";

// UPDATE
// project
//echo $ctiSQL->updateQuery("projects",array('ID'=>9999,'title'=>'TEST - 001 - UPDATE'),"u")."<br/>";
// location
//echo $ctiSQL->updateQuery("locations",array('id'=>9999, 'longitude'=>0.0000,'latitude'=>0.00000,'projectID'=>9999),"u")."<br/>";

// DELETE
// project
//echo $ctiSQL->updateQuery("projects",array('ID'=>9999),"d")."<br/>";
// location
//echo $ctiSQL->updateQuery("locations",array('id'=>9999,'projectID'=>9999),"d")."<br/>";

//$filterProj = $ctiSQL->filterQuery(array("p"=>9999,"g"=>array(1,2,3)));
$filterProj = $ctiSQL->filterQuery(array("p"=>2456));
//echo $filterProj."<br/>";

//echo "<br/><br/><b>GeoJSON</b><br/>";
$projPoints = new buildGeoJSON();
//echo $projPoints->locations($filterProj);

$execSQL = new doMySQL();
$execSQL->execute($filterProj);

?>