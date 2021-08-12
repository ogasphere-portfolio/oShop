<?php

namespace App\Controllers;



use App\Models\Type;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;




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
         // Je recupere la liste de tout type, category et brand
         $categories = Category::findAll();
         $brands = Brand::findAll();
         $types = Type::findAll();
 
         $this->show('product/productForm', [
             'categories' => $categories,
             'brands' => $brands,
             'types' => $types,
         ]);
         
        $this->show('product/productForm');
    }

    public function displayUpdateProduct($id)
    {
        // On recupere le contenu d'un produit via son id

        // On l'envoie vers la vue
        $product = Product::find($id);

        if($product) {
            $this->show('product/productForm', [
                'product' => $product,
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
        $categoryId = filter_input(INPUT_POST, 'idCategory', FILTER_SANITIZE_STRING);
        $typeId = filter_input(INPUT_POST, 'idType', FILTER_SANITIZE_STRING);
        $brandId = filter_input(INPUT_POST, 'idBrand', FILTER_SANITIZE_STRING);
        

        $newProduct = new Product();
        $newProduct->setName($name);
        $newProduct->setDescription($description);
        $newProduct->setPrice($price);
        $newProduct->setCategoryId($categoryId);
        $newProduct->setTypeId($typeId);
        $newProduct->setBrandId($brandId);

        $result = $newProduct->insert();
        header('location: ' . $router->generate('product-products'));

    }
}

