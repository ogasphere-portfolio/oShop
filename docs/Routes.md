# Projet oShop

## Listes de toutes les routes suivant les userstories de la partie back-Office

### la page d'acceuil

```php
$router->map(
    'GET',
    '/',
    [
        'method' => 'home',
        'controller' => '\App\Controllers\MainController'
    ],
    'main-home'
);
```

### Les produits

```php
$router->map(
    'GET',
    '/produit',
    [
        'method' => 'findProduct',
        'controller' => '\App\Controllers\ProductController'
    ],
    'product-product-list'
);

$router->map(
    'GET',
    '/produit/[i:id]',
    [
        'method' => 'findProductById',
        'controller' => '\App\Controllers\ProductController'
    ],
    'product-product-by-id'
);
```

### Les categories

```php
$router->map(
    'GET',
    '/categorie',
    [
        'method' => 'findCategory',
        'controller' => '\App\Controllers\CategoryController'
    ],
    'category-category-list'
);

$router->map(
    'GET',
    '/categorie/[i:id]',
    [
        'method' => 'findCategoryById',
        'controller' => '\App\Controllers\CategoryController'
    ],
    'category-category-by-id'
);
```

### Les types

```php

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
```

### Les marques

```php
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

```

### Les tags

```php
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

```
