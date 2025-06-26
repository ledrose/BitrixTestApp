<?php

CModule::IncludeModule('custom.rest');

return function (\Bitrix\Main\Routing\RoutingConfigurator $routes) {
    $routes->get('/stuff/user/', [Custom\Rest\Controller\RestController::class, 'testAction']);
};