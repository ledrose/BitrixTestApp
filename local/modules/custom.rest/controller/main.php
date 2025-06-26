<?
namespace Custom\Rest\Controller;

use Bitrix\Iblock\IblockTable;
use Bitrix\Main\Engine\Controller;
use Bitrix\Main\Engine\ActionFilter;
use CIBlock;
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


    private static function validateNumber(?int $number)
    {
        if (!isset($number) || !is_numeric($number) || $number < 0) {
            throw new \Exception("Неверное число");
        }
        return true;
    }

    // Получение баллов пользователя
    public function getUserLoyaltyPointsAction(int $user_id)
    {   
        if (!static::validateNumber($user_id)) {
            throw new \Exception("Неверный ID пользователя");
        }
        $user = CUser::GetByID($user_id)->Fetch();
        return $user['UF_LOYALITY_POINTS'];
    }


    public function getUserLoyaltyPointsHistoryAction(int $user_id)
    {
        $request = \Bitrix\Main\Context::getCurrent()->getRequest();
        $limit = (int)$request->getQuery("limit") ?: 10;
        $offset = (int)$request->getQuery("offset") ?: 0;
        echo $limit . " " . $offset;
        if (!static::validateNumber($user_id) || !static::validateNumber($limit) || !static::validateNumber($offset)) {
            throw new \Exception("Неверное свойство параметра");
        }
        if (!CModule::IncludeModule('iblock')) {
            throw new \Exception("Модуль iblock не установлен");
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
            'PROPERTY_USER_ID', 'DATE_ACTIVE_FROM', 'PROPERTY_AMOUNT',
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
        return $rsIBlocks;
    }

}

