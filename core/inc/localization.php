<?php
// Localization
if (isset($_REQUEST['_lng'])) {
    $lang=$_REQUEST['_lng'];
    switch ($lang) {
        case 'en': $lang='en'; $locale='en_EN'; $_SESSION['lang']='en'; $_SESSION['locale']='en_EN'; break;
        default: $lang='ru'; $locale='ru_RU'; $_SESSION['lang']='ru'; $_SESSION['locale']='ru_RU'; 
    }
}
if (!isset($_SESSION['lang'])) {
        $_SESSION['lang']='ru';
        $_SESSION['locale']='ru_RU';
}    
$lang = $_SESSION['lang'];
$locale =  $_SESSION['locale'];
$domain = 'ratio'; // так должны называться файлы *.po и *.mo
$locale_path = ABSPATH.'core/languages'; // папка с каталогами переводов
// Set enviroment
putenv('LC_ALL='.$locale);
putenv('LANG='.$locale);
putenv('LANGUAGE='.$locale);
// Set locale
if (!setlocale (LC_ALL, $locale.'.utf8', $locale.'.utf-8', $locale.'.UTF8', $locale.'.UTF-8', $lang.'.utf-8', $lang.'.UTF-8', $lang)) {
    // Set current locale
    setlocale(LC_ALL, '');
}
// Bind domain 
bindtextdomain($domain, $locale_path);
bind_textdomain_codeset($domain, 'UTF8');
// Set default domain
textdomain($domain);
?>
