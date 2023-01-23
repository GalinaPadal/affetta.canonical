<?

use Bitrix\Main\Loader;
use Bitrix\Highloadblock\HighloadBlockTable as HLBT;
use Bitrix\Main\Entity;

Loader::includeModule("highloadblock");

class AffettaCanonicalHL
{

    public function SEOUrl($url){
        Loader::includeModule('highloadblock');

        $hlblock_ID = HLBT::getList(array(
            'select' => array('ID'),
            'filter' => array('=NAME' => 'AffettaCanonical'),
            'limit' => 1,
        ))->fetch();;

        $hlblock = HLBT::getById($hlblock_ID["ID"])->fetch();

        $entity = HLBT::compileEntity($hlblock);
        $entity_data_class = $entity->getDataClass();

        $canonical = $entity_data_class::getList(array(
            "select" => array("*"),
            "order" => array("ID" => "ASC"),
            "filter" => array("UF_ACTIVE"=> "1", "UF_URL"=>$url)
        ))->Fetch();

        return $canonical;
    }
    public function OnPageStart(){
        global $APPLICATION;
        if(stripos($APPLICATION->GetCurDir(), '/bitrix/') !== false) return;
        $url = $APPLICATION->GetCurDir();
        $canonical = AffettaCanonicalHL::SEOUrl($url);
        if($canonical["ID"]){
            $APPLICATION->AddHeadString('<link rel="canonical" href="'.$canonical["UF_CANONICAL"].'" />',true);
        }

    }

}?>