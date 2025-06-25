<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?><h1>Регистрация</h1>
<?
if ($USER->IsAuthorized()) {
    LocalRedirect("/profile/"); 
}
?>
<?$APPLICATION->IncludeComponent(
    "bitrix:main.register",
    ".default",
    Array(
        "USER_PROPERTY_NAME" => "", 
        "SEF_MODE" => "N", 
        "SHOW_FIELDS" => Array("LOGIN", "EMAIL", "PASSWORD", "CONFIRM_PASSWORD"),
        "REQUIRED_FIELDS" => Array("LOGIN","EMAIL", "PASSWORD", "CONFIRM_PASSWORD"), 
        "AUTH" => "Y", 
        "USE_BACKURL" => "Y", 
        "SUCCESS_PAGE" => "/profile/", 
        "SET_TITLE" => "Y", 
        "USER_PROPERTY" => Array(),
    )
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>