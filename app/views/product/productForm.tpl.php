<div class="container my-4">
    <a href="<?= $router->generate('product-products') ?>" class="btn btn-success float-right">Retour</a>
    <h2><?= isset($product) ? 'Modifier' : 'Ajouter' ?> un produit</h2>

    <form action="<?= isset($category) ? $router->generate('product-updateProduct', ['id' => $product->getId()])  : $router->generate('product-createProduct')  ?>" method="POST" class="mt-5">
        <!-- CSRF token pour eviter les attaques CSRF -->
        <input type="hidden" name="csrf_token" value="<?= $token ?>">
        <div class="form-group ">
            <input type="hidden" class="form-control" id="id" name="id" value="<?= isset($product) ?  $product->getId() : '' ?>">
        </div>
        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= isset($product) ?  $product->getName() : '' ?>">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input value="Ceci est un produit" type="text" class="form-control" name="description" id="description" placeholder="" value="<?= isset($product) ? $product->getDescription() : '' ?>" aria-describedby="subtitleHelpBlock">

        </div>

        <div class="form-group">
            <label for="price">Prix</label>
            <input type="text" class="form-control" name="price" id="price" placeholder="" value="<?= isset($product) ?  $product->getPrice() : '' ?>" aria-describedby="pictureHelpBlock">
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
            <label for="idType">Type</label>
            <select name="idType" id="idType">
                <?php foreach ($types as $type) : ?>
                    <option value="<?= $type->getId() ?>" <?= $type->getId() == $products->getTypeId() ? 'selected' : '' ?>><?= $type->getName() ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="idCategory">Category</label>
            <select name="idCategory" id="idCategory">
                <?php foreach ($categories as $category) : ?>
                    <option value="<?= $category->getId() ?>" <?= $category->getId() == $products->getCategoryId() ? 'selected' : '' ?>><?= $category->getName() ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="idBrand">Marque</label>
            <select name="idBrand" id="idBrand">
                <?php foreach ($brands as $brand) : ?>
                    <option value="<?= $brand->getId() ?>" <?= $brand->getId() == $products->getBrandId() ? 'selected' : '' ?>><?= $brand->getName() ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col">
                    <label for="tag1">oclock</label><input type="checkbox" name="tags[]" id="tag1" value="1">
                    <label for="tag2">pokemon</label><input type="checkbox" name="tags[]" id="tag2" value="2">
                    <label for="tag3">mvc</label><input type="checkbox" name="tags[]" id="tag3" value="3">
                    <label for="tag4">laine</label><input type="checkbox" name="tags[]" id="tag4" value="4">
                    <label for="tag5">cotton</label><input type="checkbox" name="tags[]" id="tag5" value="5">
                    <label for="tag6">poussière</label><input type="checkbox" name="tags[]" id="tag6" value="6">
                    <label for="tag7">sandwich</label><input type="checkbox" name="tags[]" id="tag7" value="7">
                </div>
            </div>
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