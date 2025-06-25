<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?><h1>Регистрация</h1>

<?
$mail = "embreht.egor@yandex.ru"; // ваш email
$subject = "Тема тестового письма" ; // тема письма
$text = "Тестовое письмо"; // текст письма
if(mail($mail, $subject, $text)){ 
    echo 'Успешно отправлено!';
}
else{
     echo 'Отправка не удалась!';
}
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>