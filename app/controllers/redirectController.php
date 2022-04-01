<?php 
namespace coding\app\controllers;

use coding\app\models\Model;

class RedirectController extends Controller{
    function success(){
        $mes = "<div class='alert alert-success'>Inserted successfully</div>";
        $this->view('/redirect', $this->redirectHome($mes, 'back', 10));
    }
}