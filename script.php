<?php
define("BASE_URL", "http://www.cbr.ru/scripts/");

function api_request($resource, $Date) {
    
    $full_url = BASE_URL."$resource";
    $options = array(
        DATE_REQ=> $Date
   );
}
fqwf
$Date=16/04/2020;
$res = api_request("XML_daily.asp?","16/04/2020");
   Echo $res;
printf($res);
?>
