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
          $eurotoday =$items->Value;  //Переменная значения евро на заданную дату 
      }  
    }
    // Извлекаем значение Доллара на день раньше заданной даты
    $xml = simplexml_load_file('http://www.cbr.ru/scripts/XML_daily_eng.asp?date_req='. $mdate);
    foreach($xml->children() as $items) {    
      if ($items->CharCode == "USD") {
          $usdyest = $items->Value;   //Переменная значения доллара на день раньше 
      }    
      if ($items->CharCode == "EUR") {
          $euroyest =$items->Value;  //Переменная значения евро на день раньше 
      }   
    }
    // Переводим в подходящий для сравнения тип
    $usdtoday =(float) str_replace(",", ".", "$usdtoday");
    $usdyest =(float) str_replace(",", ".", "$usdyest");
    $eurotoday =(float) str_replace(",", ".", "$eurotoday");
    $euroyest =(float) str_replace(",", ".", "$euroyest");
    // Сравниваем валюты в заданный день и на день раньше.
    // Выводим значение доллара
    if ( $usdyest == $usdtoday) 
        echo ("На дату ".$date." курс $ был равен: " . $usdtoday. " \n");
    if ( $usdyest > $usdtoday)
        echo ("На дату ".$date." курс $ был равен: " . $usdtoday. "▼ \n");  
    if ( $usdyest < $usdtoday)
        echo ("На дату ".$date." курс $ был равен: " . $usdtoday. "▲ \n");
    // Выводим значение евро
    if ( $euroyest == $eurotoday) 
        echo ("На дату ".$date." курс EURO был равен: " . $eurotoday. " \n");
    if ( $euroyest > $eurotoday)
        echo ("На дату ".$date." курс EURO был равен: " . $eurotoday. "▼ \n");  
    if ( $euroyest < $eurotoday)
        echo ("На дату ".$date." курс EURO был равен: " . $eurotoday. "▲ \n");    
}
//Формат даты: (ММ/ДД/ГГ)
getvalute("07/22/2010");
getvalute("07/12/2010");
getvalute("07/22/2013");
?> 

