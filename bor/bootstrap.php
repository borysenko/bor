<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

use Dotenv\Dotenv;
use Kuria\Error\ErrorHandler;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$debug = $_ENV['isDevMode']; // true during development, false in production
error_reporting(E_ALL); // configure the error reporting

$errorHandler = new ErrorHandler();
$errorHandler->setDebug($debug);
$errorHandler->register();

$paths = ['entity'];
$isDevMode = $_ENV['isDevMode'];

// the connection configuration
$dbParams = [
    'driver'   => $_ENV['driver'],
    'user'     => $_ENV['user'],
    'password' => $_ENV['password'],
    'dbname'   => $_ENV['dbname'],
];

$config = ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode);
$connection = DriverManager::getConnection($dbParams, $config);
$entityManager = new EntityManager($connection, $config);