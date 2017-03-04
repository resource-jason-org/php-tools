<?php 

///英文国家名

require('./geoIp.inc.php');
$gi = geoip_open('./GeoIP.dat',0);


$ip = getIPaddress();

//国家前缀
echo geoip_country_code_by_addr($gi, '211.115.83.21');
///英文国家名
echo geoip_country_name_by_addr($gi, '218.61.32.107');

 
?>