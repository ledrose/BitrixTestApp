<?
// CModule::IncludeModule("main");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?>
<?
if (!$USER->IsAuthorized()) {
    LocalRedirect("/"); 
}

$userId = $USER->GetID(); 
$rsUser = CUser::GetByID($userId);
$arUser = $rsUser->Fetch();
?>

<!-- <?$APPLICATION->IncludeComponent(
    "bitrix:main.profile",
    ".default", 
    Array(
        "SET_TITLE" => "Y",
        "USER_PROPERTY" => Array(), 
        "SEND_INFO" => "N", 
        "CHECK_RIGHTS" => "N", 
        "USER_PROPERTY_NAME" => "",
    )
);?> -->

<h1>Итого баллов у текущего пользователя (id: <?= $USER->GetID() ?>): <?= $arUser['UF_LOYALITY_POINTS'];?></h1>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>