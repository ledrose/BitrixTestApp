<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Main\Application;
use Bitrix\Main\HttpRequest;
use Bitrix\Main\Type\DateTime;

class TransactionUpdateFormComponent extends CBitrixComponent
{
    private static $iblockId = 1;


    public function onPrepareComponentParams($arParams)
    {
        if (!isset($arParams['USER_ID']))
        {
            ShowError('ID пользователя не указан');
            return false;
        }
        $arParams['USER_ID'] = (int)$arParams['USER_ID'];
        return $arParams;
    }

    protected function checkModules()
    {
        if (!Loader::includeModule('iblock')) {
            ShowError("Модуль iblock не установлен");
            return false;
        }
        return true;
    }
    
    protected function loadData()
    {
        $rsUser = CUser::GetByID($this->arParams['USER_ID']);
        $arUser = $rsUser->Fetch();
        $this->arResult['USER_ID'] = $this->arParams['USER_ID'];
        $this->arResult['USER_LOYALITY_POINTS'] = $arUser['UF_LOYALITY_POINTS'];
    }

    protected function validateFormData(HttpRequest $request)
    {
        $amount = $request->getPost("amount");
        if (empty($amount) || !is_numeric($amount) || $amount < 0) {
            $this->arResult['FORM_ERRORS'][] = "Количество баллов должно быть положительным числом";
        }
        $type = $request->getPost("type");
        if (empty($type) && !in_array($type, ['add', 'subtract'])) {
            $this->arResult['FORM_ERRORS'][] = "Тип операции не определен";
            return [];
        }
        return ['amount' => $amount, 'type' => $type];
    }

    protected function processForm()
    {
        global $APPLICATION;
        $request = Application::getInstance()->getContext()->getRequest();
        if (!$request->isPost() || !check_bitrix_sessid()) {
            return false;
        }
        $req_args = $this->validateFormData($request);
        if ($req_args === false) {
            return;
        }
        if ($req_args['type'] === 'subtract' && $req_args['amount'] > $this->arResult['USER_LOYALITY_POINTS']) {
            $this->arResult['FORM_ERRORS'][] = "Нельзя списать больше баллов, чем есть";
            return;
        }
        $score_change = $req_args['type'] === 'add' ? $req_args['amount'] : -$req_args['amount'];
        $user = new CUser;
        if (!$user->Update($this->arParams['USER_ID'], ['UF_LOYALITY_POINTS' => $this->arResult['USER_LOYALITY_POINTS'] + $score_change]))
        {
            $this->arResult['FORM_ERRORS'][] = "Ошибка обновления данных пользователя";
            return;
        }
        $el = new CIBlockElement;
        $arLoadArray = [
            "IBLOCK_ID" => self::$iblockId,
            "NAME" => $req_args['type'] === 'add' ? "Начисление баллов" : "Списание баллов",
            "ACTIVE_FROM" => new DateTime(),
            "PROPERTY_VALUES" => [
                "USER_ID" => $this->arParams['USER_ID'],
                "AMOUNT" => $score_change
            ]
        ];
        if (!$el->Add($arLoadArray)) {
            $this->arResult['FORM_ERRORS'][] = "Ошибка добавления элемента: " . $el->LAST_ERROR;
            // Возвращаем баллы обратно в случае ошибки
            $user->Update($this->arParams['USER_ID'], ['UF_LOYALITY_POINTS' => $this->arResult['USER_LOYALITY_POINTS'] - $score_change]);
            return;
        }
        $currentUrl = $APPLICATION->GetCurPage();
        LocalRedirect($currentUrl);
        die();
    }

    public function executeComponent()
    {
        if (!$this->checkModules()) {
            return false;
        }
        $this->loadData();
        $this->processForm();
        $this->IncludeComponentTemplate();
    }

}
?>