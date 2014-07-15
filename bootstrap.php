<?php
require_once "vendor/autoload.php";

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$rootDir = dirname(__FILE__);

require_once 'module/Application/src/Admin/Controller/LogoBaseController.php';
$paths = array($rootDir."/module/Application/src");

$isDevMode = true;

// the connection configuration
$dbParams = array(
		'driver'   => 'pdo_mysql',
		'user'     => 'root',
		'password' => '',
		'dbname'   => 'logo-shop',
);
// $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, null, null, false);
$entityManager = EntityManager::create($dbParams, $config);