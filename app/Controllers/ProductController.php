<?php

namespace App\Controllers;



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
        // on ne fait pas de verification de connexion pour l'affichage des produits
        // Un utilisateur non connecté peut voir les produits
        /* $this->checkAuthorization([
            'admin',
            'catalog-manager'
        ]); */
        
        $products = Product::findAll();

        $this->show('product/products', [
            'products' => $products,
        ]);
    }

    public function displayNewProduct()
    {

        $this->checkAuthorization([
            'admin',
            'catalog-manager'
        ]);
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
        $this->checkAuthorization([
            'admin',
            'catalog-manager'
        ]);
        // On recupere le contenu d'un produit via son id

        // On l'envoie vers la vue
        $productToUpdate = Product::find($id);

        $categories = Category::find($productToUpdate->getCategoryId());
        $brands = Brand::find($productToUpdate->getBrandId());
        $types = Type::find($productToUpdate->getTypeId());
        if($productToUpdate) {
            $this->show('product/productForm', [
                'product' => $productToUpdate,
                'categories' => $categories,
                'brands' => $brands,
                'types' => $types,
            ]);
        } else {
            dd('Id non trouvée dans la BDD');
        }
        
    }

    public function createProduct()
    {
        global $router;

        $this->checkAuthorization([
            'admin',
            'catalog-manager'
        ]);

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
    public function updateProduct($id)
    {
        global $router;

        $this->checkAuthorization([
            'admin',
            'catalog-manager'
        ]);

        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
        $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_STRING);
        $categoryId = filter_input(INPUT_POST, 'idCategory', FILTER_SANITIZE_STRING);
        $typeId = filter_input(INPUT_POST, 'idType', FILTER_SANITIZE_STRING);
        $brandId = filter_input(INPUT_POST, 'idBrand', FILTER_SANITIZE_STRING);
        $picture = filter_input(INPUT_POST, 'picture', FILTER_SANITIZE_STRING);
        
        $productToUpdate = Product::find($id);

        $productToUpdate->setName($name);
        $productToUpdate->setDescription($description);
        $productToUpdate->setPrice($price);
        $productToUpdate->setCategoryId($categoryId);
        $productToUpdate->setTypeId($typeId);
        $productToUpdate->setBrandId($brandId);
        $productToUpdate->setPicture($picture);
        $productToUpdate->update();
        header('location: ' . $router->generate('product-products'));
        
        //header('location: ' . $router->generate('product-updateProductForm', ['id' => $productToUpdate->getId()]));
    }

    public function delete()
    {
        $this->checkAuthorization([
            'admin',
            'catalog-manager'
        ]);

    }
}

