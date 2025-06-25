<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/**
* @var array $arParams
* @var array $arResult
* @var CMain $APPLICATION
* @var CBitrixComponent $component
* @var CBitrixComponentTemplate $this
*/
?>

<div>
<h1>Итого баллов у текущего пользователя (id: <?= $arResult['USER_ID'] ?>): <?= $arResult['USER_LOYALITY_POINTS'];?></h1>
<table>
    <th>
        <tr>Списание баллов</tr>
        <tr>Зачисление баллов</tr>
    </th>
    <tbody>
        <? if (!empty($arResult['FORM_ERRORS'])): ?>
            <div style="color: red;">
                <?php foreach ($arResult['FORM_ERRORS'] as $error): ?>
                    <?= htmlspecialcharsbx($error) ?><br>
                <?php endforeach; ?>
            </div>
        <? endif; ?>
        <tr>
            <td>
                <!-- Списание баллов -->
                <form action="<?=POST_FORM_ACTION_URI?>" method="post">
                    <?=bitrix_sessid_post()?>
                    <label for="score_debit">Количество баллов:</label><br>
                    <input type="number" name="amount" min="0" value="0" name="score"><br><br>
                    <input type="hidden" name="type" value="subtract">
                    <button type="submit" name="submit">Списать</button>
                </form>
            </td>
            <td>
                <!-- Зачисление баллов -->
                <form action="<?=POST_FORM_ACTION_URI?>" method="post">
                    <?=bitrix_sessid_post()?>
                    <label for="score_credit">Количество баллов:</label><br>
                    <input type="number" name="amount" min="0" value="0" name="score"><br><br>
                    <input type="hidden" name="type" value="add">
                    <button type="submit" name="submit">Начислить</button>
                </form>
            </td>
        </tr>
    </tbody>
</table>
</div>