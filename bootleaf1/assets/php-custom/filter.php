<?php 
	
	// CTI Custom PHP procedure - Filter
	// JPS3
	// changelog
	// 2014-10-21 - CREATED
	//
	// Filter parameters
	// 
	// To filter by one or more parameters, append the appropriate arrays to the URL
	//
	// by project
	// p[]=<project ID>
	//
	// by country
	// c[]='<country name>'
	//
	// by goal
	// g[]=<1|2|3|4|5>
	//
	
	include ('lib-mysql.php');
	include ('lib-geojson.php');

	//echo print_r($_REQUEST['f'])."<br/>";
	
	// instantiate MySQL query builder
	$sql = new buildMySQL();

	// generate MySQL SELECT query for filter
	//echo $_REQUEST['f']."<br/>";
	$filterParams = urldecode($_REQUEST['f']);
	//echo $filterParams."<br/>";
	//$filterData = array();
	parse_str($filterParams, $filterData);
	$filterSQL = $sql->filterQuery($filterData);
	//echo $filterSQL."<br/>";
	
	// instantiate GeoJSON builder
	$filterGeoJSON = new buildGeoJSON();
	
	// Execute MySQL query and generate GeoJSON-formatted locations
	echo $filterGeoJSON->locations($filterSQL);

?>