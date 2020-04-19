<?php
function getvalute($date)
{
    //Вычисляем предыдущий день, от заданной даты
    $ndate = new DateTime($date);
    $ndate->modify('-1 day');
    $mdate = $ndate->format('d/m/Y'); // Переменная даты, на день меньшей 
    // Переводим в нормальный формат дату
    $date = new DateTime($date);
    $date = $date->format('d/m/Y');
    echo ("\n Введенная дата:" . $date. " \n");
    echo ("На день меньше: ". $mdate . "\n");
    // Извлекаем значение Доллара на заданную дату
    $xml = simplexml_load_file('http://www.cbr.ru/scripts/XML_daily_eng.asp?date_req='. $date);
    foreach($xml->children() as $items) {
      if ($items->CharCode == "USD") {
          $usdtoday = $items->Value;   //Переменная значения доллара на заданную дату
      }
      if ($items->CharCode == "EUR") {
          $eurotoday = $items->Value;  //Переменная значения евро на заданную дату 
      }  
    }
    // Извлекаем значение Доллара на день раньше заданной даты
    $xml = simplexml_load_file('http://www.cbr.ru/scripts/XML_daily_eng.asp?date_req='. $mdate);
    foreach($xml->children() as $items) {    
      if ($items->CharCode == "USD") {
          $usdyest = $items->Value;   //Переменная значения доллара на день раньше 
      }    
      if ($items->CharCode == "EUR") {
          $euroyest = $items->Value;  //Переменная значения евро на день раньше 
      }   
    }
    echo ("Вчерашний бакс:" . $usdyest. " \n");
    echo ("Сегодняшний бакс:" . $usdtoday. " \n");
    echo ("Вчерашний EURO:" . $euroyest. " \n");
    echo ("Сегодняшний EURO:" . $eurotoday. " \n");
}
getvalute("07/22/2017");
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

