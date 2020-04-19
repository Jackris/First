<?php
function getvalute($date)
{
    $ndate = new DateTime($date);
    $ndate->modify('-1 day');
    $mdate = $ndate->format('d/m/Y');
    $date = new DateTime($date);
    $date = $date->format('d/m/Y');
    
    echo ("\n Введенная дата:" . $date. " \n");
    echo ("\n На день меньше: ". $mdate . "\n");
    
    $xml = simplexml_load_file('http://www.cbr.ru/scripts/XML_daily_eng.asp?date_req='. $date);
    foreach($xml->children() as $items) {
    $nitems=$items->CharCode;
      if ($nitems == "USD") {
          $usdtoday = $items->Value;   
      }
    }
    $xml = simplexml_load_file('http://www.cbr.ru/scripts/XML_daily_eng.asp?date_req='. $mdate);
    foreach($xml->children() as $items) {
    $nitems=$items->CharCode;
      if ($nitems == "USD") {
          $usdyest = $items->Value;   
      }    

    }
    echo ("\n Вчерашний бакс:" . $usdyest. " \n");
    echo ("\n Сегодняшний бакс:" . $usdtoday. " \n");

    $valueUSD = $xml->Valute[4]->Value; // Значение доллара
    $valuseEUR = $xml->Valute[5]->Value; // Значение евро
    
    echo "USD = ".$valueUSD ."\n";
}
getvalute("07/24/2017");
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

