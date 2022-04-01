<?php
namespace coding\app\controllers;

use coding\app\models\Model;
class PayementsController extends Controller{

    function createPayment(){
        $this->view('add_payement');
    }

    function storePayment(){
        $payment=new Model();
        
        $name=$_POST['payment_name'];
        $imageName=$this->uploadFile($_FILES['image']);
        $image=$imageName!=null?$imageName:"default.png";
        $is_active=$_POST['is_active'];

        $stmt = $payment->insert('payements',[
            'name' => $name,
            'image'=> $image,
            'is_active'=> $is_active,
            'created_by'=> 1
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

    public static function uploadFile(array $imageFile): string
    {
        // check images direction
        if (!is_dir(__DIR__ . '/../../public/images')) {
            mkdir(__DIR__ . '/../../public/images');
        }

        if ($imageFile && $imageFile['tmp_name']) {
            $image = explode('.', $imageFile['name']);
            $imageExtension = end($image);

            $imageName = uniqid(). "." . $imageExtension;
            $imagePath =  __DIR__ . '/../../public/images/' . $imageName;

            move_uploaded_file($imageFile['tmp_name'], $imagePath);

            return $imageName;
        }

        return null;
    }
}