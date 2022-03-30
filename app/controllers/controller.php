<?php
namespace coding\app\controllers;

use coding\app\system\AppSystem;
use coding\app\system\Request;
use coding\app\system\Router;

class Controller{

   function view($viewName,$params=null){
       AppSystem::$appSystem->router->view($viewName,$params);
   }
   public function redirectHome($TheMsg, $url = null, $seconds = 3){
    echo '<link rel="canonical" href="https://themeselection.com/products/sneat-bootstrap-html-admin-template/">';

    if($url === null){
        $url = 'index.php';
        $link = 'HomePage';
    }else{
        if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== ''){

            $url = $_SERVER['HTTP_REFERER'];
            $link = 'Previous Page';

        }else{
            
            $url = 'index.php'; 
            $link = 'HomePage';
        } 
    }

    echo "<div class='container'>";
    echo $TheMsg;
    echo "<div class='alert alert-info'>You Will Redirected To $link After $seconds Seconds.</div>";

        header("refresh:$seconds;url=$url");
        
        exit(); 

    echo "</div>";
}

}
?>