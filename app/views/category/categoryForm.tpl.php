<div class="container my-4">
        <a href="<?= $router->generate('category-categories') ?>" class="btn btn-success float-right">Retour</a>
        <h2><?= isset($category) ? 'Modifier' : 'Ajouter' ?> une catégorie</h2>
        
        <form action="<?= isset($category) ? $router->generate('category-updateCategory', ['id' => $category->getId()])  : $router->generate('category-createCategory')  ?>" method="POST" class="mt-5">
            <div class="form-group ">
                <input type="hidden" class="form-control" id="id" name="id" value="<?= isset($category) ?  $category->getId() : '' ?>">
            </div>
            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= isset($category) ?  $category->getName() : '' ?>">
            </div>
            <div class="form-group">
                <label for="subtitle">Sous-titre</label>
                <input type="text" class="form-control" id="subtitle" name="subtitle" value="<?= isset($category) ?  $category->getSubtitle() : '' ?>" aria-describedby="subtitleHelpBlock">
                <small id="subtitleHelpBlock" class="form-text text-muted">
                Sera affiché sur la page d'accueil comme bouton devant l'image
                </small>
            </div>
            <div class="form-group">
                <label for="picture">Image</label>
                <input type="text" class="form-control" id="picture" name="picture" value="<?= isset($category) ?  $category->getPicture() : '' ?>" aria-describedby="pictureHelpBlock">
                <small id="pictureHelpBlock" class="form-text text-muted">
                    URL relative d'une image (jpg, gif, svg ou png) fournie sur <a href="https://benoclock.github.io/S06-images/" target="_blank">cette page</a>
                </small>
            </div>
            
            <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
        </form>
    </div>
   