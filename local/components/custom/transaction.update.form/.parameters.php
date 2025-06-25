<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$arComponentParameters = [
    'GROUPS' => [
        'TRANSACTIONS' => [
            'NAME' => 'Список транзакций',    
        ],
    ],
    'PARAMETERS' => [
        'USER_ID' => [
            'NAME' => 'Идентификатор пользователя',
            'TYPE' => 'NUMBER',
            'PARENT' => 'TRANSACTIONS',
        ],
    ],
];
?>
