<?
define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

if (isset($_REQUEST["backurl"]) && strlen($_REQUEST["backurl"])>0) 
	LocalRedirect($backurl);

$APPLICATION->SetTitle("Авторизация");
?>

<? if ($USER->IsAuthorized()): ?>
	<p>Здравствуйте. Вы успешно авторизовались. Ваше имя <?=$USER->GetFullName(); ?></p>
	<p><a href="/profile">Перейти в личный кабинет</a></p>
	<p><a href="?logout=yes&<?=bitrix_sessid_get(); ?>">Выход</a></p>
<? else: ?>
	<h2>Вход на сайт</h2>
	<?$APPLICATION->IncludeComponent(
		"bitrix:system.auth.form",
		".default",
		Array(
			"REGISTER_URL" => "/register",
			"FORGOT_PASSWORD_URL" => "",
			"PROFILE_URL" => "/profile",
			"SHOW_ERRORS" => "Y" 
		)
	)
	?>
	<p><a href="/register/">Регистрация</a></p>
	<!-- <p>Вы не авторизованы.</p> -->
<? endif; ?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>