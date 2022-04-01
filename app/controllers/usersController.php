<?php 
namespace coding\app\controllers;

use coding\app\models\Model;

class UsersController extends Controller{
    function createUser(){
        $this->view("add_user");
    }
    function storeUser(){
        $user = new Model();
        $name = $_POST['user_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role_id = $_POST['role_id'];
        $is_active = $_POST['is_active'];
        $stmt = $user->insert("users", [
            'name'          => $name,
            'email'          => $email,
            'password'          => $password,
            'is_active'     => $is_active,
            'role_id'    => $role_id
        ]);
        if($stmt){
            $mes = "Inserted successfully";
            $this->redirectHome($mes, 'back', 10);
        }
    }
}

?>