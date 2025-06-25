<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Главная');

if ($USER->IsAuthorized())
	LocalRedirect("/profile/");
else
	LocalRedirect("/auth/");
?> 

<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>