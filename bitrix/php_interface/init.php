<?
  AddEventHandler("main", "OnBeforeUserRegister", "OnBeforeUserRegisterHandler");
    function OnBeforeUserRegisterHandler(&$arFields)
    {
      if (!isset($arFields["UF_LOYALITY_POINTS"])) {
        $arFields["UF_LOYALITY_POINTS"] = 1000;
      }
      return true;
    }
?>