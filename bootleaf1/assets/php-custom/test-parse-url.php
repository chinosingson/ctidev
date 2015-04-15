<?php 

$argStr = 'process-type=i&table-name=projects&data%5Buser%5D=admin&data%5Bupdated%5D=&data%5Btitle%5D=TEST&data%5Bstart%5D=&data%5Bend%5D=&data%5Bfunder%5D=a&data%5Bamount%5D=&data%5Bcontact%5D=b&data%5Bposition%5D=c&data%5Bemail%5D=&data%5Bphone%5D=&data%5Bwebsite%5D=&data%5Bremarks%5D=';

$url = urldecode($argStr);

parse_str($url, $projData);
echo $argStr;
echo "<pre>";
echo print_r($projData,1);
echo "</pre>";

?>