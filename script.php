<?php
function getvalute($date)
{
    $xml = simplexml_load_file('http://www.cbr.ru/scripts/XML_daily_eng.asp?date_req='. $date);
    $valueUSD = $xml->Valute[4]->Value; // Значение доллара
    $valuseEUR = $xml->Valute[5]->Value; // Значение евро
    
$datetime = new DateTime($date);
$datetime = $datetime->format('d-m-Y');
$datetime->modify('-1 day');
$ndate = $datetime->format('d-m-Y');
    echo $ndate;
    echo "\n";
          
    echo "USD = ".$valueUSD ."\n";
}
getvalute("05/12/2007");
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

