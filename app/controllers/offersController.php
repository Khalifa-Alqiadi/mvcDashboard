<?php
namespace coding\app\controllers;

use coding\app\models\Model;

class OffersController extends Controller{

    function createOffers(){
        $offers = new Model();
        $book = $offers->table("books")->get();
        $category = $offers->table("categories")->get();
        $this->view("add_offers", array(
            'books'     => $book,
            'category'  => $category
        ));
    }
    function storeOffers(){
        $title = $_POST['title'];
        $discount = $_POST['discount'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $category_ids = $_POST['category_ids'];
        $is_active = $_POST['is_active'];
        
        if($_POST['category_ids'] !== NULL){
            $offers = new Model();
            // print_r($_POST);
            // $stmt = '';
            $rows = $offers->table('books')->select("categories.id", "books.*")
                    ->join("categories", "categories.id", "books.category_id")
                    ->where('id', $_POST['category_ids'])
                    ->get();
                    print_r($rows);
            foreach($rows as $row){
                echo $row['bookid'];
                $stmt = $offers->insert("offers", [
                    'title'          => $title,
                    'discount'          => $discount,
                    'start_date'          => $start_date,
                    'end_date'          => $end_date,
                    'book_ids'          => $row['bookid'],
                    'category_ids'          => $category_ids,
                    'is_active'     => $is_active,
                    'created_by'    => 1
                ]);
            }
            // if($stmt){
            //     $mes = "Inserted successfully";
            //     $this->redirectHome($mes, 'back', 30);
            // }
        }
        
    }
}
?>