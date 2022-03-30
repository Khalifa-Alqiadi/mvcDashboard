<?php

namespace coding\app\controllers;

use coding\app\models\Model;

class AuthorsController extends Controller{

    function cearteAuthor(){
        $this->view('add_author');

    }

    function storeAuthor(){
        $author=new Model();
        
        $name   = $_POST['author_name'];
        $phone  = $_POST['phone'];
        $email  = $_POST['email'];
        $bio    = $_POST['bio'];

        $created_by = 1;
        $is_active  = $_POST['is_active'];

        $stmt = $author->insert('authors', [
            'name'      => $name,
            'phone'     => $phone,
            'email'     => $email,
            'bio'       => $bio
        ]);
        if($stmt){
            $mes = "<div> inserted successfully</div>";
            $this->redirectHome($mes, 'back');
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

?>