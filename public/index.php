<?php

require '/../vendor/autoload.php';

session_start();

$settings = require '/../src/settings.php';

$app = new \Slim\App($settings);

require '/../src/dependencies.php';

require '/../src/middlewares.php';

require '/../src/routes.php';

$app->run();