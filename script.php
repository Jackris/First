<?php
function getvalute($date)
{
    $xml = simplexml_load_file('http://www.cbr.ru/scripts/XML_daily_eng.asp?date_req='. $date);
    $valueUSD = $xml->Valute[4]->Value; // Значение доллара
    $valuseEUR = $xml->Valute[5]->Value; // Значение евро
    $ndate = new DateTime('-3 days');
    echo $ndate->format('Y-m-d');
    //$ndate = strtotime('-3 days');
    //echo "USD = ".$valueUSD ."\n";
    echo date('Y-m-d', $date);
}
getvalute("01/02/2007");
/*$date = "22/01/2007";
$xml = simplexml_load_file('http://www.cbr.ru/scripts/XML_daily_eng.asp?date_req='. $date);
$valueUSD = $xml->Valute[4]->Value;
$valuseEUR = $xml->Valute[5]->Value;
echo "USD = ".$valueUSD ."\n";
echo "EURO = ".$valuseEUR ."\n";
echo "\n";
*/
 //'▲'
//'▼'
?>

