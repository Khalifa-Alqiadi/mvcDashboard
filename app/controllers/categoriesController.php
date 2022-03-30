<?php

namespace coding\app\controllers;

use coding\app\models\Category;

use coding\app\models\Model;
class CategoriesController extends Controller{

    function listAll(){
        $categories=new Category();
        $allCategories=$categories->getAll();
        //print_r($allCategories);

        $this->view('list_categories',$allCategories);

    }
    function create(){
        $this->view('add_category');

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