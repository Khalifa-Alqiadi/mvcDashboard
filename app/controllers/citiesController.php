<?php 
namespace coding\app\controllers;

use coding\app\models\Model;

class CitiesController extends Controller{
    function createCity(){
        $this->view("add_city");
    }
    function storCity(){
        $city = new Model();
        $name = $_POST['city_name'];
        $is_active = $_POST['is_active'];
        $stmt = $city->insert("cities", [
            'name'          => $name,
            'is_active'     => $is_active,
            'created_by'    => 1
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