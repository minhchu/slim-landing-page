<?php

$container = $app->getContainer();

$container['flash'] = function($container) {
    return new \Plasticbrain\FlashMessages\FlashMessages();
};

$container['view'] = function ($container) {
    $settings = $container->get('settings')['view'];

    $view = new \Slim\Views\Twig($settings['template_path'], [
        'cache' => $settings['cache_path'],
        'auto_reload' => $settings['auto_reload']
    ]);

    $view->addExtension(new \Slim\Views\TwigExtension(
        $container['router'],
        $container['request']->getUri()
    ));

    $view->getEnvironment()->addGlobal('flash', $container['flash']);

    return $view;
};

$container['logger'] = function ($container) {
    $settings = $container->get('settings')['logger'];

    $logger = new \Monolog\Logger($settings['name']);
    $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
    $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['path'], \Monolog\Logger::DEBUG));

    return $logger;
};