<?
namespace Custom\Rest\Controller;

use Bitrix\Main\Engine\Controller;
use Bitrix\Main\Engine\ActionFilter;
use CIBlockElement;
use CModule;
use CUser;

class RestController extends Controller
{
    protected function getDefaultPreFilters()
    {
        return [
            // Без авторизации, ограничения на методы и т.д.
        ];
    }

    public function configureActions()
    {
        return [
            // Также без авторизации, ограничения на методы и т.д.
        ];    
    }

    private function validateNumber(?int $number, string $name)
    {
        if (!isset($number) || !is_numeric($number) || $number < 0) {
            $this->addError(new \Bitrix\Main\Error("Неверное значение параметра " . $name,400));
            return false;
        }
        return true;
    }

    // Получение баллов пользователя
    public function getUserLoyaltyPointsAction(int $user_id)
    {   
        if (!static::validateNumber($user_id,"user_id")) {
            return [];
        }
        $user = CUser::GetByID($user_id)->Fetch();
        return $user['UF_LOYALITY_POINTS'];
    }


    public function getUserLoyaltyPointsHistoryAction(int $user_id)
    {
        $request = \Bitrix\Main\Context::getCurrent()->getRequest();
        $limit = (int)$request->getQuery("limit") ?: 10;
        $offset = (int)$request->getQuery("offset") ?: 0;
        if (!static::validateNumber($user_id,"user_id") || !static::validateNumber($limit,"limit") || !static::validateNumber($offset,"offset")) {
            return [];
        }
        if (!CModule::IncludeModule('iblock')) {
            $this->addError(new \Bitrix\Main\Error("Модуль iblock не установлен",500));
            return [];
        }
        // Попытался использовать IblockTable::GetList, но я не нашел информации о том, как отфильтровать по свойстам (PROPERTY_USER_ID)
        $arOrder = [
            'DATE_ACTIVE_FROM' => 'DESC',
        ];
        $arFilter = [
            "IBLOCK_TYPE_ID" => 1,
            'PROPERTY_USER_ID' => $user_id,
        ];
        $arSelect = [
            'DATE_ACTIVE_FROM', 'PROPERTY_AMOUNT',
        ];
        $arNavStartParams = [
            'nTopCount' => $limit,
            'nOffset' => $offset,
        ];
        $rsIBlocks = CIBlockElement::GetList($arOrder,$arFilter,false,$arNavStartParams,$arSelect);
        $arIBlocks = [];
        while ($arIBlock = $rsIBlocks->Fetch()) {
            $arIBlocks[] = $arIBlock;
        }
        // GetList Возвращает дублирующие свойства, поэтому очищаем их
        $arResp = [];
        foreach ($arIBlocks as $key => $iblock) {
            $arResp[$key]['datetime'] = $iblock['ACTIVE_FROM'];
            $arResp[$key]['amount'] = $iblock['PROPERTY_AMOUNT_VALUE'];
        }
        return $arResp;
    }

}

