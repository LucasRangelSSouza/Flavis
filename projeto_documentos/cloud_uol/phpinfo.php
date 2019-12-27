<?php
date_default_timezone_set('America/Sao_Paulo');

$script_tz = date_default_timezone_get();

if (strcmp($script_tz, ini_get('date.timezone'))){
    echo 'Script timezone differs from ini-set timezone. O fuso horário do script difere do fuso horário ini-set.';
} else {
    echo 'Script timezone and ini-set timezone match. O fuso horário do script e correspondência de fuso horário ini-se';
}

phpinfo();
?>