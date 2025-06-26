<?php

use Custom\Rest\Controller\RestController;
CModule::IncludeModule('custom.rest');


// Prefix не работает по какой-то причине не рабоатет с несколькими '/' и его нельзя вызывать несколько раз (prefix()->prefix())
return function (\Bitrix\Main\Routing\RoutingConfigurator $routes) {
    $routes->prefix('api')->group( function (\Bitrix\Main\Routing\RoutingConfigurator $routes) {
        $routes->prefix('v1')->group( function (\Bitrix\Main\Routing\RoutingConfigurator $routes) {
            $routes->prefix('user')->group( function (\Bitrix\Main\Routing\RoutingConfigurator $routes) {    
                $routes->get('loyalty-points/{user_id}', [RestController::class, 'getUserLoyaltyPointsAction']);
                $routes->get('loyalty-points-history/{user_id}', [RestController::class, 'getUserLoyaltyPointsHistoryAction']);
            });
        });
    });
};
