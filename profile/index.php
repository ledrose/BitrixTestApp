<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?>
<?
if (!$USER->IsAuthorized()) {
    LocalRedirect("/"); 
}
?>

<?$APPLICATION->IncludeComponent(
    "bitrix:main.profile",
    ".default", 
    Array(
        "SET_TITLE" => "Y",
        "USER_PROPERTY" => Array(), 
        "SEND_INFO" => "N", 
        "CHECK_RIGHTS" => "N", 
        "USER_PROPERTY_NAME" => "",
    )
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>