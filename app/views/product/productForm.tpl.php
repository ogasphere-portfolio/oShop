<div class="container my-4">
        <a href="<?= $router->generate('product-products') ?>" class="btn btn-success float-right">Retour</a>
        <h2><?= isset($product) ? 'Modifier' : 'Ajouter' ?> un produit</h2>
        
        <form action="" method="POST" class="mt-5">
            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" class="form-control" id="name" value="<?= isset($product) ?  $product->getName() : '' ?>">
            </div>
            <div class="form-group">
                <label for="subtitle">Prix</label>
                <input type="text" class="form-control" id="subtitle" value="<?= isset($product) ? $product->getPrice() : '' ?>" aria-describedby="subtitleHelpBlock">
                <small id="subtitleHelpBlock" class="form-text text-muted">
                Sera affiché sur la page d'accueil comme bouton devant l'image
                </small>
            </div>
            <div class="form-group">
                <label for="picture">Image</label>
                <input type="text" class="form-control" id="picture" value="<?= isset($product) ? $product->getPicture() : '' ?>" aria-describedby="pictureHelpBlock">
                <small id="pictureHelpBlock" class="form-text text-muted">
                    URL relative d'une image (jpg, gif, svg ou png) fournie sur <a href="https://benoclock.github.io/S06-images/" target="_blank">cette page</a>
                </small>
            </div>
            <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
        </form>
    </div>