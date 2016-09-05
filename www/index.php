<?php


define("UPLOAD_DIR", __DIR__ . "/upload");

$container = require __DIR__ . '/../app/bootstrap.php';

$container->getByType(Nette\Application\Application::class)
	->run();
