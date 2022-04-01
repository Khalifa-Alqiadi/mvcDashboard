<?php
require_once __DIR__ . '/../vendor/autoload.php';

use coding\app\controllers\IndexController;
use coding\app\controllers\UsersController;
use coding\app\controllers\CitiesController;
use coding\app\controllers\OffersController;
use coding\app\controllers\PayementsController;
use coding\app\controllers\User_PayementController;

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
Router::get('/add_user',[UsersController::class,'createUser']);
Router::post('/save_user',[UsersController::class,'storeUser']);
Router::get('/add_city',[CitiesController::class,'createCity']);
Router::post('/save_city',[CitiesController::class,'storCity']);
Router::get('/add_offers',[OffersController::class,'createOffers']);
Router::post('/save_offers',[OffersController::class,'storeOffers']);
Router::get('/redirect',[OffersController::class,'storeOffers']);
Router::get('/add_payement',[PayementsController::class,'createPayment']);
Router::post('/save_payment',[PayementsController::class,'storePayment']);
Router::get('/add_user_payment_methods',[User_PayementController::class,'cerateUserPayement']);
Router::post('/save_UserPayement',[User_PayementController::class,'saveUserPayement']);

/** end of web routes */



$system->start();

