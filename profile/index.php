<?
// CModule::IncludeModule("main");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?><?
if (!$USER->IsAuthorized()) {
    LocalRedirect("/"); 
}

// $userId = $USER->GetID(); 
// $rsUser = CUser::GetByID($userId);
// $arUser = $rsUser->Fetch();
?>
<?$APPLICATION->IncludeComponent(
	"custom:transaction.update.form",
	"",
	Array(
		"USER_ID" => $USER->GetID()
	)
);?>
 <!-- <h1>Итого баллов у текущего пользователя (id: <?= $USER->GetID() ?>): <?= $arUser['UF_LOYALITY_POINTS'];?></h1> --><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>