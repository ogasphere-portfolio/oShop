<div class="container my-4">
        <a href="<?= $router->generate('product-displayNewProduct') ?>" class="btn btn-success float-right">Ajouter</a>
        <h2>Liste des Produits</h2>
        <table class="table table-hover mt-4">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Description</th>
                    <th scope="col">Prix</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($products as $product) : ?>
                <tr>
                    <th scope="row"><?= $product->getId() ?></th>
                    <td><?= $product->getName() ?></td>
                    <td><?= $product->getDescription() ?></td>
                    <td><img src="<?= $product->getPicture() ?>" height="70"></td>
                    <td><?= $product->getPrice() ?></td>
                    <td class="text-right">
                    
                        <a href="<?= $router->generate('product-displayUpdateProduct', ['id' => $product->getId()]) ?>" class="btn btn-sm btn-warning">
                        
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </a>
                        <!-- Example single danger button -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-danger dropdown-toggle"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?= $router->generate('product-deleteProduct', ['id' => $product->getId()]) ?>">Oui, je veux supprimer</a>
                                <a class="dropdown-item" href="#" data-toggle="dropdown">Oups !</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>