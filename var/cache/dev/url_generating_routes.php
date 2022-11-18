<?php

// This file has been auto-generated by the Symfony Routing Component.

return [
    '_preview_error' => [['code', '_format'], ['_controller' => 'error_controller::preview', '_format' => 'html'], ['code' => '\\d+'], [['variable', '.', '[^/]++', '_format', true], ['variable', '/', '\\d+', 'code', true], ['text', '/_error']], [], [], []],
    'gesdinet_jwt_refresh_token' => [[], [], [], [['text', '/api/token/refresh']], [], [], []],
    'app.swagger' => [[], ['_controller' => 'nelmio_api_doc.controller.swagger'], [], [['text', '/api/doc.json']], [], [], []],
    'app.swagger_ui' => [[], ['_controller' => 'nelmio_api_doc.controller.swagger_ui'], [], [['text', '/api/doc']], [], [], []],
    'app_picture' => [[], ['_controller' => 'App\\Controller\\PictureController::index'], [], [['text', '/picture']], [], [], []],
    'picture.get' => [['idPicture'], ['_controller' => 'App\\Controller\\PictureController::getPicture'], [], [['variable', '/', '[^/]++', 'idPicture', true], ['text', '/api/picture']], [], [], []],
    'picture.create' => [[], ['_controller' => 'App\\Controller\\PictureController::createPicture'], [], [['text', '/api/pictures']], [], [], []],
    'picture.delete' => [['idPicture'], ['_controller' => 'App\\Controller\\PictureController::softDeletePicture'], [], [['variable', '/', '[^/]++', 'idPicture', true], ['text', '/api/deletePicture']], [], [], []],
    'app_recontre' => [[], ['_controller' => 'App\\Controller\\RecontreController::index'], [], [['text', '/rencontre']], [], [], []],
    'rencontres.getAll' => [[], ['_controller' => 'App\\Controller\\RecontreController::getRencontres'], [], [['text', '/api/rencontres']], [], [], []],
    'rencontres.getOne' => [['id'], ['_controller' => 'App\\Controller\\RecontreController::getOneRencontre'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/rencontres']], [], [], []],
    'rencontres.getByTeam' => [['id'], ['_controller' => 'App\\Controller\\RecontreController::getRencontreByTeam'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/rencontres/team']], [], [], []],
    'rencontre.getOneRatio' => [['id'], ['_controller' => 'App\\Controller\\RecontreController::getOneTeamRatio'], [], [['text', '/ratio'], ['variable', '/', '[^/]++', 'id', true], ['text', '/api/teams']], [], [], []],
    'app_team' => [[], ['_controller' => 'App\\Controller\\TeamController::index'], [], [['text', '/team']], [], [], []],
    'teams.getAll' => [[], ['_controller' => 'App\\Controller\\TeamController::getTeams'], [], [['text', '/api/teams']], [], [], []],
    'teams.getOne' => [['id'], ['_controller' => 'App\\Controller\\TeamController::getOneTeam'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/teams']], [], [], []],
    'createTeam.create' => [[], ['_controller' => 'App\\Controller\\TeamController::createTeam'], [], [['text', '/api/createTeam']], [], [], []],
    'updateTeam.update' => [['id'], ['_controller' => 'App\\Controller\\TeamController::updateTeam'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/updateTeam']], [], [], []],
    'deleteTeam.delete' => [['idTeam'], ['_controller' => 'App\\Controller\\TeamController::deleteTeam'], [], [['variable', '/', '[^/]++', 'idTeam', true], ['text', '/api/deleteTeam']], [], [], []],
    'softDeleteTeam.delete' => [['idTeam'], ['_controller' => 'App\\Controller\\TeamController::softDeleteOneTeam'], [], [['variable', '/', '[^/]++', 'idTeam', true], ['text', '/api/softDeleteTeam']], [], [], []],
    'api_login_check' => [[], [], [], [['text', '/api/login_check']], [], [], []],
    'api_refresh_token' => [[], [], [], [['text', '/api/token/refresh']], [], [], []],
];
