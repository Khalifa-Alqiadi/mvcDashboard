<?php

namespace coding\app\controllers;

use coding\app\models\Model;

class PublishersController extends Controller{

    
    function create(){
        $this->view('add_publisher');

    }

    function insertPublisher(){
        $publisher=new Model();
        
        $name=$_POST['pub_name'];
        $phone=$_POST['phone'];
        $alt_phone=$_POST['alt_phone'];
        $fax=$_POST['fax'];
        $email=$_POST['email'];
        $address=$_POST['address'];
        $country=$_POST['country'];

        $imageName=$this->uploadFile($_FILES['image']);

        $image=$imageName!=null?$imageName:"default.png";
        $created_by=1;
        $is_active=$_POST['is_active'];

        $stmt= $publisher->insert('publishers', [
            'name'  => $name,
            'phone' => $phone,
            'alt_phone' => $alt_phone,
            'fax' => $fax,
            'email' => $email,
            'address' => $address,
            'country' => $country,
            'image' => $image,
            'created_by' => $created_by,
            'is_active' => $is_active,
        ]);
        if($stmt){
            $mes = "Inserted Successfully";
            $this->redirectHome($mes, 'back');
        }

    }
    function edit(){
        

    }
    function update(){

    }
    public function remove(){

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

?>