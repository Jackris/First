<?php
function getvalute($date)
{
    $ndate = new DateTime($date);
    $ndate->modify('+1 day');
    echo $ndate->format('d/m/Y');
    echo "\n";
    $date = new DateTime($date);
    $date = $date->format('d/m/Y');
    
    $xml = simplexml_load_file('http://www.cbr.ru/scripts/XML_daily_eng.asp?date_req='. $date);
    
  foreach($xml->children() as $items) {
      $nitems=$items->CharCode;
      if ($nitems == "USD") {
         echo $items->Name;   
          echo "\n HELLO !!! \n"; 
      }
    
  }
    

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

