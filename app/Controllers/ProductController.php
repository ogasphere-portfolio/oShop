<?php
namespace App\Controllers;

use App\Models\Product;

class ProductController extends CoreController {


public function findProduct()
    {
        $products = new Product();
        $productInfos = $products->findAll();

        $this->show('product_list', ['productInfos' => $productInfos]);
    }

    public function findProductById($productId)
    {
        $productModel = new product();
        $productById = $productModel->find($productId);
        $product= [
            "product" => $productById,
            
        ];
     
        $this->show('product_details', $product);
    }
}
