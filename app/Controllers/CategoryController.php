<?php

namespace App\Controllers;

use App\Models\Category;



class CategoryController extends CoreController {

    /**
     * Méthode s'occupant de la page d'accueil
     *
     * @return void
     */
    public function findCategory()
    {
        $categories = new Category();
        $categoryInfos = $categories->findAll();

       
       $this->show('category_list', ['categoryInfos' => $categoryInfos]);
    }

   
    public function findCategoryById($categoryId)
    {
        $categoryModel = new Category();
        $category = $categoryModel->find($categoryId);
        $categoryById = [
            "category" => $category,
            
        ];

       
        $this->show('category_details', $categoryById);
   
    }
       
}
