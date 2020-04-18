<?php
function getvalute($date)
{
    $xml = simplexml_load_file('http://www.cbr.ru/scripts/XML_daily_eng.asp?date_req='. $date);
    $valueUSD = $xml->Valute[4]->Value; // Значение доллара
    $valuseEUR = $xml->Valute[5]->Value; // Значение евро
    
$ndate = new DateTime($date);
$ndate->modify('+1 day');
echo $ndate->format('d/m/Y');
          
    echo "USD = ".$valueUSD ."\n";
}
getvalute("29/12/2007");
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

