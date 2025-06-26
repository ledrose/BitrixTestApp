<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?><h1>Регистрация</h1>
<?
if ($USER->IsAuthorized() && !$USER->IsAdmin()) {
    LocalRedirect("/profile/"); 
}
?>
<?$APPLICATION->IncludeComponent(
    "bitrix:main.register",
    ".default",
    Array(
        "USER_PROPERTY_NAME" => "", 
        "SEF_MODE" => "N", 
        "SHOW_FIELDS" => Array("EMAIL", "PASSWORD", "CONFIRM_PASSWORD"),
        "REQUIRED_FIELDS" => Array("EMAIL", "PASSWORD", "CONFIRM_PASSWORD"), 
        "AUTH" => "N", 
        "USE_BACKURL" => "Y", 
        "SUCCESS_PAGE" => "/auth/", 
        "SET_TITLE" => "Y", 
    )
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>