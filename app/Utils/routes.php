<?php
// On doit déclarer toutes les "routes" à AltoRouter, afin qu'il puisse nous donner LA "route" correspondante à l'URL courante
// On appelle cela "mapper" les routes
// 1. méthode HTTP : GET ou POST (pour résumer)
// 2. La route : la portion d'URL après le basePath
// 3. Target/Cible : informations contenant
//      - le nom de la méthode à utiliser pour répondre à cette route
//      - le nom du controller contenant la méthode
// 4. Le nom de la route : pour identifier la route, on va suivre une convention
//      - "NomDuController-NomDeLaMéthode"
//      - ainsi pour la route /, méthode "home" du MainController => "main-home"
global $router;

$router->map(
    'GET',
    '/',
    [
        'method' => 'home',
        'controller' => '\App\Controllers\MainController'
    ],
    'main-home'
);

$router->map(
    'GET',
    '/categories',
    [
        'method' => 'categories',
        'controller' => '\App\Controllers\CategoryController'
    ],
    'category-categories'
);



$router->map(
    'GET',
    '/category/edit/[i:id]',
    [
        'method' => 'displayUpdateCategory',
        'controller' => '\App\Controllers\CategoryController'
    ],
    'category-displayUpdateCategory'
);

$router->map(
    'GET',
    '/category/new',
    [
        'method' => 'displayNewCategory',
        'controller' => '\App\Controllers\CategoryController'
    ],
    'category-displayNewCategory'
);
$router->map(
    'POST',
    '/category/update/[i:id]',
    [
        'method' => 'updateCategory',
        'controller' => '\App\Controllers\CategoryController'
    ],
    'category-updateCategory'
);

/* route pour inserer une nouvelle categorie */
$router->map(
    'POST',
    '/category/new',
    [
        'method' => 'createCategory',
        'controller' => '\App\Controllers\CategoryController'
    ],
    'category-createCategory'
);

$router->map(
    'GET',
    '/products',
    [
        'method' => 'products',
        'controller' => '\App\Controllers\ProductController'
    ],
    'product-products'
);

$router->map(
    'GET',
    '/product/new',
    [
        'method' => 'displayNewProduct',
        'controller' => '\App\Controllers\ProductController'
    ],
    'product-displayNewProduct'
);

$router->map(
    'GET',
    '/product/edit/[i:id]',
    [
        'method' => 'displayUpdateProduct',
        'controller' => '\App\Controllers\ProductController'
    ],
    'product-displayUpdateProduct'
);

$router->map(
    'POST',
    '/product/update/[i:id]',
    [
        'method' => 'updateProduct',
        'controller' => '\App\Controllers\ProductController'
    ],
    'product-updateProduct'
);

/* route pour inserer un nouveau produit */
$router->map(
    'POST',
    '/product/new',
    [
        'method' => 'createProduct',
        'controller' => '\App\Controllers\ProductController'
    ],
    'product-createProduct'
);


$router->map(
    'GET',
    '/type',
    [
        'method' => 'findType',
        'controller' => '\App\Controllers\TypeController'
    ],
    'type-type-list'
);

$router->map(
    'GET',
    '/type/[i:id]',
    [
        'method' => 'findTypeById',
        'controller' => '\App\Controllers\TypeController'
    ],
    'type-type-by-id'
);

$router->map(
    'GET',
    '/brand',
    [
        'method' => 'findBrand',
        'controller' => '\App\Controllers\BrandController'
    ],
    'brand-brand-list'
);

$router->map(
    'GET',
    '/brand/[i:id]',
    [
        'method' => 'findBrandById',
        'controller' => '\App\Controllers\BrandController'
    ],
    'brand-brand-by-id'
);


$router->map(
    'GET',
    '/tag',
    [
        'method' => 'findTag',
        'controller' => '\App\Controllers\TagController'
    ],
    'tag-tag-list'
);

$router->map(
    'GET',
    '/tag/[i:id]',
    [
        'method' => 'findTagById',
        'controller' => '\App\Controllers\TagController'
    ],
    'tag-tag-by-id'
);




// Partie connexion à l'administration du site

$router->map(
    'GET',
    '/connexion',
    [
        'method' => 'connexion',
        'controller' => '\App\Controllers\UserController'
    ],
    'user-connexion'
);

$router->map(
    'POST',
    '/connexion',
    [
        'method' => 'connexionControl',
        'controller' => '\App\Controllers\UserController'
    ],
    'user-connexion-control'
);
$router->map(
    'GET',
    '/deconnexion',
    [
        'method' => 'disconnect',
        'controller' => '\App\Controllers\UserController'
    ],
    'user-disconnect'
);
