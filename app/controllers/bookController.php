<?php

namespace coding\app\controllers;


use coding\app\models\Model;
class BookController extends Controller{

    function create(){
        $this->view('add_book');

    }

    function store(){
        echo '<link rel="canonical" href="https://themeselection.com/products/sneat-bootstrap-html-admin-template/">';
        print_r($_POST);
        print_r($_FILES);
        $category=new Model();
        
        $name=$_POST['category_name'];
        $imageName=$this->uploadFile($_FILES['image']);

        $image=$imageName!=null?$imageName:"default.png";
        $created_by=1;
        $is_active=$_POST['is_active'];

        $category->insert('categories',[
            'name' => $name,
            'image'=> $image,
            'is_active'=> $is_active,
            'created_by'=> $created_by
        ]);
        
            echo "<div class='container'>";
                $mas = "<div class='alert alert-success'> Inserted successfully</div>";
                $this->redirectHome($mas, 'back');
            echo "</div>";
        

    }
}

?>