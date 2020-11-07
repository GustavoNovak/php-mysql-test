<?php

use Slim\App;

use CarSharing\Controllers\UsersController;

return function (App $app) {
    $container = $app->getContainer();

    // Set up Doctrine
    $container['em'] = function (/** @var \Slim\Container $c */ $c) {
        $settings = $c->get('settings');

        $connection = $settings['connection'];

        $config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(
            ['src/Entities'],
            true,
            dirname(__DIR__).'/src/cache/doctrine',
            null,
            false
        );

        $cache = new \Doctrine\Common\Cache\ArrayCache();
        
        $config->setAutoGenerateProxyClasses(false);
        $config->setMetadataCacheImpl($cache);
        $config->setQueryCacheImpl($cache);

        return \Doctrine\ORM\EntityManager::create($connection, $config);
    };

    // view renderer
    $container['renderer'] = function ($c) {
        $settings = $c->get('settings')['renderer'];
        return new \Slim\Views\PhpRenderer($settings['template_path']);
    };

    // monolog
    $container['logger'] = function ($c) {
        $settings = $c->get('settings')['logger'];
        $logger = new \Monolog\Logger($settings['name']);
        $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
        $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
        return $logger;
    };

    $container['UsersController'] = function($c){
    return new UsersController($c->get('em'));
};

};
