<?php
$date = "22/01/2007";
$xml = simplexml_load_file('http://www.cbr.ru/scripts/XML_daily_eng.asp?date_req='. $date);
Echo $xml->Valute[4]->Value;
echo "\n";
echo $date;
//print_r($xml->ValCurs->Valute[ID =="R01235"]);
 //'▲'
//'▼'
?>

