<?php

namespace coding\app\controllers;

use coding\app\models\Index;

class IndexController extends Controller{
    function list(){
        $this->view('/home');
    }
}

?>