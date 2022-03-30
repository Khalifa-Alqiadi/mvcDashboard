<?php
require_once __DIR__ . '/../vendor/autoload.php';

use coding\app\controllers\IndexController;
use coding\app\controllers\PublishersController;
use coding\app\system\AppSystem;
use coding\app\system\Router;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(__DIR__));//createImmutable(__DIR__);
$dotenv->load();

$config=array(
  'servername'=>$_ENV['DB_SERVER_NAME'],
  'dbname'=>$_ENV['DB_NAME'],
  'dbpass'=>$_ENV['DB_PASSWORD'],
  'username'=>$_ENV['DB_USERNAME']

);
$system=new AppSystem($config);

/** web routes  */


Router::get('/',[IndexController::class,'list']);
Router::get('/add_publisher',[PublishersController::class,'create']);
Router::post('/save_publisher',[PublishersController::class,'insertPublisher']);

/** end of web routes */



$system->start();

