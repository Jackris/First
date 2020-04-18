<?php
$date = "22/01/2007";
$xml = simplexml_load_file('http://www.cbr.ru/scripts/XML_daily_eng.asp?date_req='. $date);
$valueUSD = $xml->Valute[4]->Value;
$valuseEUR = $xml->Valute[5]->Value;
echo "USD = ".$valueUSD .\n;
echo "EURO = ".$valuseEUR .\n;
echo "\n";
//print_r($xml->ValCurs->Valute[ID =="R01235"]);
 //'▲'
//'▼'
?>

