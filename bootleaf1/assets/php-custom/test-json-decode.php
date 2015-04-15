<?php
$json = '{"a":1,"b":2,"c":3,"d":4,"e":5}';

$json = '{"type":"FeatureCollection","features":[{"type":"Feature","properties":{"name":"Test Marker","id":1,"lat":10.12570928243104,"lng":119.00115966796875,"country":"RP","municipality":"Puerto Princesa"},"geometry":{"type":"Point","coordinates":[119.00115966796875,10.12570928243104]}}]}
';


?><pre><?php
//var_dump(json_decode($json));
//var_dump(json_decode($json, true));

$aryJsonData = json_decode($json, true);

print_r($aryJsonData['features'][0]['properties']);

?></pre>
