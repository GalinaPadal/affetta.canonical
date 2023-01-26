<?
IncludeModuleLangFile(__FILE__);

use Bitrix\Main\Loader;
use Bitrix\Highloadblock\HighloadBlockTable as HLBT;
use Bitrix\Main\Entity;

Loader::includeModule("highloadblock");

define('SITE_SERVER_NAME_FULL', ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER["HTTP_HOST"]);
CModule::AddAutoloadClasses(
    "affetta.canonical",
    array(
        "AffettaCanonicalHL" => "classes/general/affettacanonicalhl.php",
    )
);
