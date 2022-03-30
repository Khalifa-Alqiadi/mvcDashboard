<?php
require_once __DIR__ . '/../vendor/autoload.php';

use coding\app\controllers\IndexController;
use coding\app\controllers\BookController;
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
Router::get('/add_book',[BookController::class,'create']);
Router::post('/save_book',[BookController::class,'store']);

/** end of web routes */



$system->start();

