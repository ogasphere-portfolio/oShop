<div class="container my-4">
        <a href="<?= $router->generate('category-categories') ?>" class="btn btn-success float-right">Retour</a>
        <h2><?= isset($category) ? 'Modifier' : 'Ajouter' ?> une catégorie</h2>
        <?php /* A CORRIGER Car si isset($category) [....] $router->generate('category-categoryFormValid', ['id' => $category->getId()]) */ ?>
        <form action="" method="POST" class="mt-5">
            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" class="form-control" id="name" value="<?= isset($category) ?  $category->getName() : '' ?>">
            </div>
            <div class="form-group">
                <label for="subtitle">Sous-titre</label>
                <input type="text" class="form-control" id="subtitle" value="<?= isset($category) ?  $category->getSubtitle() : '' ?>" aria-describedby="subtitleHelpBlock">
                <small id="subtitleHelpBlock" class="form-text text-muted">
                Sera affiché sur la page d'accueil comme bouton devant l'image
                </small>
            </div>
            <div class="form-group">
                <label for="picture">Image</label>
                <input type="text" class="form-control" id="picture" value="<?= isset($category) ?  $category->getPicture() : '' ?>" aria-describedby="pictureHelpBlock">
                <small id="pictureHelpBlock" class="form-text text-muted">
                    URL relative d'une image (jpg, gif, svg ou png) fournie sur <a href="https://benoclock.github.io/S06-images/" target="_blank">cette page</a>
                </small>
            </div>
            
            <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
        </form>
    </div>