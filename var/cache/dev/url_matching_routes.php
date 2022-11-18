<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/api/token/refresh' => [
            [['_route' => 'gesdinet_jwt_refresh_token'], null, null, null, false, false, null],
            [['_route' => 'api_refresh_token'], null, null, null, false, false, null],
        ],
        '/api/doc.json' => [[['_route' => 'app.swagger', '_controller' => 'nelmio_api_doc.controller.swagger'], null, ['GET' => 0], null, false, false, null]],
        '/api/doc' => [[['_route' => 'app.swagger_ui', '_controller' => 'nelmio_api_doc.controller.swagger_ui'], null, ['GET' => 0], null, false, false, null]],
        '/picture' => [[['_route' => 'app_picture', '_controller' => 'App\\Controller\\PictureController::index'], null, null, null, false, false, null]],
        '/api/pictures' => [[['_route' => 'picture.create', '_controller' => 'App\\Controller\\PictureController::createPicture'], null, ['POST' => 0], null, false, false, null]],
        '/rencontre' => [[['_route' => 'app_recontre', '_controller' => 'App\\Controller\\RecontreController::index'], null, null, null, false, false, null]],
        '/api/rencontres' => [[['_route' => 'rencontres.getAll', '_controller' => 'App\\Controller\\RecontreController::getRencontres'], null, ['GET' => 0], null, false, false, null]],
        '/team' => [[['_route' => 'app_team', '_controller' => 'App\\Controller\\TeamController::index'], null, null, null, false, false, null]],
        '/api/teams' => [[['_route' => 'teams.getAll', '_controller' => 'App\\Controller\\TeamController::getTeams'], null, ['GET' => 0], null, false, false, null]],
        '/api/createTeam' => [[['_route' => 'createTeam.create', '_controller' => 'App\\Controller\\TeamController::createTeam'], null, ['POST' => 0], null, false, false, null]],
        '/api/login_check' => [[['_route' => 'api_login_check'], null, null, null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
                .'|/api/(?'
                    .'|picture/([^/]++)(*:66)'
                    .'|delete(?'
                        .'|Picture/([^/]++)(*:98)'
                        .'|Team/([^/]++)(*:118)'
                    .')'
                    .'|rencontres/(?'
                        .'|([^/]++)(*:149)'
                        .'|team/([^/]++)(*:170)'
                    .')'
                    .'|teams/([^/]++)(?'
                        .'|/ratio(*:202)'
                        .'|(*:210)'
                    .')'
                    .'|updateTeam/([^/]++)(*:238)'
                    .'|softDeleteTeam/([^/]++)(*:269)'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        66 => [[['_route' => 'picture.get', '_controller' => 'App\\Controller\\PictureController::getPicture'], ['idPicture'], ['GET' => 0], null, false, true, null]],
        98 => [[['_route' => 'picture.delete', '_controller' => 'App\\Controller\\PictureController::softDeletePicture'], ['idPicture'], ['DELETE' => 0], null, false, true, null]],
        118 => [[['_route' => 'deleteTeam.delete', '_controller' => 'App\\Controller\\TeamController::deleteTeam'], ['idTeam'], ['DELETE' => 0], null, false, true, null]],
        149 => [[['_route' => 'rencontres.getOne', '_controller' => 'App\\Controller\\RecontreController::getOneRencontre'], ['id'], ['GET' => 0], null, false, true, null]],
        170 => [[['_route' => 'rencontres.getByTeam', '_controller' => 'App\\Controller\\RecontreController::getRencontreByTeam'], ['id'], ['GET' => 0], null, false, true, null]],
        202 => [[['_route' => 'rencontre.getOneRatio', '_controller' => 'App\\Controller\\RecontreController::getOneTeamRatio'], ['id'], ['GET' => 0], null, false, false, null]],
        210 => [[['_route' => 'teams.getOne', '_controller' => 'App\\Controller\\TeamController::getOneTeam'], ['id'], ['GET' => 0], null, false, true, null]],
        238 => [[['_route' => 'updateTeam.update', '_controller' => 'App\\Controller\\TeamController::updateTeam'], ['id'], ['PUT' => 0], null, false, true, null]],
        269 => [
            [['_route' => 'softDeleteTeam.delete', '_controller' => 'App\\Controller\\TeamController::softDeleteOneTeam'], ['idTeam'], ['DELETE' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
