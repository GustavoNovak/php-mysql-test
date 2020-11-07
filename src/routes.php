<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/users', 'UsersController:geUsers');
    $app->get('/user/{id}', 'UsersController:getUser');
};
