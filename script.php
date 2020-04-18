<?php

function CBR_XML_Daily_Ru() {
    $json_daily_file = __DIR__.'/daily.json';
    if (!is_file($json_daily_file) || filemtime($json_daily_file) < time() - 3600) {
        if ($json_daily = file_get_contents('https://www.cbr-xml-daily.ru/daily_json.js')) {
            file_put_contents($json_daily_file, $json_daily);
        }
    }
    return json_decode(file_get_contents($json_daily_file));
}
function CBR_XML_Yest_Ru() {
    $json_yest_file = __DIR__.'/yest.json';
    if ($json_daily = file_get_contents('https://www.cbr-xml-daily.ru/archive/2020/04/15/daily_json.js')) {
            file_put_contents($json_yest_file, $json_daily);
        }
    
    return json_decode(file_get_contents($json_yest_file));
}
$yest = CBR_XML_Daily_Ru();
$today = CBR_XML_Yest_Ru();
//if ( ($yest->Valute->USD->Value) < ($today->Valute->EUR->Value) )
 //   echo '▼';
//echo "Обменный Курс USD на ВЧЕРА: {$yest->Valute->USD->Value} \n";
//echo "Обменный курс USD по ЦБ РФ на сегодня: {$today->Valute->USD->Value} \n";
//echo "Обменный курс EURO по ЦБ РФ на сегодня: {$today->Valute->EUR->Value} \n";

$xml = simplexml_load_file('http://www.cbr.ru/scripts/XML_daily_eng.asp?date_req=22/01/2007');
echo $xml->ValCurs->Valute->attributes('ID');
echo "\n";
//print_r($xml->ValCurs->Valute[ID =="R01235"]);
 //'▲'
//'▼'
?>

