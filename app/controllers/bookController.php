<?php

namespace coding\app\controllers;


use coding\app\models\Model;
class BookController extends Controller{

    function create(){
        $book=new Model();
        $stmt = $book->table('categories')->get();
        $this->view('add_book', array('categories' => $stmt));
    }

    function store(){
        
        $book=new Model();
        
        $name=$_POST['book_name'];
        $imageName=$this->uploadFile($_FILES['image']);

        $image=$imageName!=null?$imageName:"default.png";
        $price = $_POST['price'];
        $descr = $_POST['description'];
        $pages_number = $_POST['pages_number'];
        $category_id = $_POST['category_id'];
        $author_id = $_POST['author_id'];
        $publisher_id = $_POST['publisher_id'];
        $quantity = $_POST['quantity'];
        $format = $_POST['format'];
        $created_by=1;
        $is_active=$_POST['is_active'];
        $book->insert('books',[
            'title' => $name,
            'image'=> $image,
            'price'=> $price,
            'description'=> $descr,
            'pages_number'=> $pages_number,
            'category_id'=> $category_id,
            'author_id'=> $author_id,
            'publisher_id'=> $publisher_id,
            'quantity'=> $quantity,
            'format'=> $format,
            'is_active'=> $is_active,
            'created_by'=> $created_by
        ]);
        
            echo "<div class='container'>";
                $mas = "<div class='alert alert-success'> Inserted successfully</div>";
                $this->redirectHome($mas, 'back');
            echo "</div>";
        

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