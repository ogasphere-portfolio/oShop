<?php

namespace App\Controllers;



use App\Models\Tag;
use App\Models\Type;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\core\CoreController;




class ProductController extends CoreController {

    /**
     * Méthode s'occupant de la page d'accueil
     *
     * @return void
     */
    public function products()
    {
       
        
        $products = Product::findAll();

        $this->show('product/products', [
            'products' => $products,
        ]);
    }

    public function displayNewProduct()
    {

        $randToken = bin2hex(random_bytes(32));
        $_SESSION['token'] = $randToken;
       
         // Je recupere la liste de tout type, category et brand
        
         $this->show('product/productForm', [
            'brands' => Brand::findAll(),
            'categories' => Category::findAll(),
            'types' => Type::findAll(),
            'token' => $randToken
        ]);
         
        $this->show('product/productForm');
    }
   

    public function displayUpdateProduct($id)
    {
        $randToken = bin2hex(random_bytes(32));
        $_SESSION['token'] = $randToken;
       
        // On recupere le contenu d'un produit via son id

        // On l'envoie vers la vue
        $productToUpdate = Product::find($id);
        
       
        if($productToUpdate) {
            $this->show('product/productForm', [
                'brands' => Brand::findAll(),
                'categories' => Category::findAll(),
                'types' => Type::findAll(),
                'product' => Product::find($id),
                'tags' => Tag::findAllByProduct($id),
                'token' => $randToken
            ]);
        } else {
            dd('Id non trouvée dans la BDD');
        }
        
    }

    public function createProduct()
    {
        
        global $router;

       

        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
        $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_STRING);
        $categoryId = filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_STRING);
        $typeId = filter_input(INPUT_POST, 'type_id', FILTER_SANITIZE_STRING);
        $brandId = filter_input(INPUT_POST, 'brand_id', FILTER_SANITIZE_STRING);
        

        $newProduct = new Product();
        $newProduct->setName($name);
        $newProduct->setDescription($description);
        $newProduct->setPrice($price);
        $newProduct->setCategoryId($categoryId);
        $newProduct->setTypeId($typeId);

        $newProduct->setBrandId($brandId);

        $result = $newProduct->save();
        header('location: ' . $router->generate('product-products'));
        exit();

    }
    public function updateProduct($id)
    {
        global $router;

        
        $productToUpdate = Product::find($id);
      
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
        $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_STRING);
        $categoryId = filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_STRING);
        $typeId = filter_input(INPUT_POST, 'type_id', FILTER_SANITIZE_STRING);
        $brandId = filter_input(INPUT_POST, 'brand_id', FILTER_SANITIZE_STRING);
        $picture = filter_input(INPUT_POST, 'picture', FILTER_SANITIZE_STRING);
        
        

        $productToUpdate->setName($name);
        $productToUpdate->setDescription($description);
        $productToUpdate->setPrice($price);
        $productToUpdate->setCategoryId($categoryId);
        $productToUpdate->setTypeId($typeId);
        $productToUpdate->setBrandId($brandId);
        $productToUpdate->setPicture($picture);
        
        $productToUpdate->save();
        header('location: ' . $router->generate('product-products'));
        exit();
        
    }

    public function deleteProduct($id)
    {
        global $router;

        Product::delete($id);
        header('location: ' . $router->generate('product-products'));
        exit();
    }
}

