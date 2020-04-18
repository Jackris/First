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
    if ($json_daily = file_get_contents('http://www.cbr.ru/scripts/XML_dynamic.asp?date_req1=02/03/2001&date_req2=14/03/2001&VAL_NM_RQ=R01235')) {
            file_put_contents($json_yest_file, $json_daily);
        }
    
    return json_decode(file_get_contents($json_yest_file));
}
$data = CBR_XML_Daily_Ru();
$final = CBR_XML_Yest_Ru();
echo "Обменный Курс USD на ВЧЕРА: {$final->Record Date} \n";
echo "Обменный курс USD по ЦБ РФ на сегодня: {$data->Valute->USD->Value} \n";
echo "Обменный курс EURO по ЦБ РФ на сегодня: {$data->Valute->EUR->Value} \n";
print_r($final);
?>
