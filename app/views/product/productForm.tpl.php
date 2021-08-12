<div class="container my-4">
    <a href="<?= $router->generate('product-products') ?>" class="btn btn-success float-right">Retour</a>
    <h2><?= isset($product) ? 'Modifier' : 'Ajouter' ?> un produit</h2>

    <form action="" method="POST" class="mt-5">
        <div class="form-group ">
            <input type="hidden" class="form-control" id="id" name="id" value="<?= isset($product) ?  $product->getId() : '' ?>">
        </div>
        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= isset($product) ?  $product->getName() : '' ?>">
        </div>
        <div class="form-group">
            <label for="subtitle">Description</label>
            <input value="Ceci est un produit" type="text" class="form-control" name="description" id="subtitle" placeholder="" value="<?= isset($product) ? $product->getSubtitle() : '' ?>" aria-describedby="subtitleHelpBlock">

        </div>

        <div class="form-group">
                    <label for="picture">Prix</label>
                    <input type="text" class="form-control" name="price" id="picture" placeholder="" value="<?= isset($product) ?  $product->getPrice() : '' ?>" aria-describedby="pictureHelpBlock">
                </div>
        <div class="form-group">
            <label for="rate">Note</label>
            <input type="text" class="form-control" id="rate" name="rate" placeholder="Note du produit" value="<?= isset($product) ? $product->getRate() : '' ?>">
        </div>
        <div class="form-group">
            <label for="picture">Image</label>
            <input type="text" class="form-control" id="picture" name="picture" value="<?= isset($product) ? $product->getPicture() : '' ?>" aria-describedby="pictureHelpBlock">
            <small id="pictureHelpBlock" class="form-text text-muted">
                URL relative d'une image (jpg, gif, svg ou png) fournie sur <a href="https://benoclock.github.io/S06-images/" target="_blank">cette page</a>
            </small>
        </div>
        <div class="form-group">
            <label for="idType">Id type</label>
            <input value="1" type="number" class="form-control" name="idType" id="idType" placeholder="" value="<?= isset($product) ? $product->getTypeId() : '' ?>">
        </div>
        <div class="form-group">
            <label for="idCategory">Id Category</label>
            <input value="1" type="number" class="form-control" name="idCategory" id="idCategory" placeholder="" value="<?= isset($product) ? $product->getCategoryId() : '' ?>">
        </div>
        <div class="form-group">
            <label for="idBrand">Id Marque</label>
            <input value="1" type="number" class="form-control" name="idBrand" id="idBrand" placeholder="" value="<?= isset($product) ? $product->getBrandId() : '' ?>">
        </div>

        <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
    </form>
</div>


<!--     <div class="form-group">
                <label for="idType">l'id du Type</label>
                <select name="typeId" id="typeId">
                    <?php for ($i = 1; $i < 51; $i++) : ?>
                    <option value="1"><?= $i ?></option>
                    <?php endfor; ?>
                </select>
                <label for="idBrand">l'id de la Marque</label>
                <select name="brandId" id="brandId">
                    <?php for ($i = 1; $i < 51; $i++) : ?>
                    <option value="1"><?= $i ?></option>
                    <?php endfor; ?>
                </select>
                <label for="idCategory">l'id de la Catégorie</label>
                <select name="brandId" id="brandId">
                    <?php for ($i = 1; $i < 51; $i++) : ?>
                    <option value="1"><?= $i ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
        </form> -->