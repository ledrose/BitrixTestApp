<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Главная');
LocalRedirect("/auth/");
?>
<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>