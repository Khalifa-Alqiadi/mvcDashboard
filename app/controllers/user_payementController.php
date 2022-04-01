<?php
namespace coding\app\controllers;
use coding\app\models\Model;
class User_PayementController extends Controller{
    function cerateUserPayement(){
        $userPayement = new Model();
        $payement = $userPayement->table('payements')->get();
        $this->view('add_user_payment_methods', array(
            'payement' => $payement
        ));
        
    }
    function saveUserPayement(){
        $userPayement = new Model();
        $user_id = $_POST['user_id'];
        $method = $_POST['payement_id'];
        $is_active = $_POST['is_active'];
        $stmt = $userPayement->insert("user_payment_methods", [
            'user_id'       => $user_id,
            'payement_id'   => $method,
            'is_active'     => $is_active
        ]);
        if($stmt){?>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <?php 
            echo "<div class='container mt-6'>";
                $mes = "<div class='alert alert-success'>Inserted successfully</div>";
                $this->redirectHome($mes, 'back', 10); 
            echo "</div>";
        }
    }
}
?>