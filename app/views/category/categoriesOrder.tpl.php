<form action="<?= $router->generate('category-categoriesOrderAction') ?>" method="POST" class="mt-5">
    <input type="hidden" name="csrf_token" value="<?= $token ?>">

    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="emplacement1">Emplacement #1</label>
                <select class="form-control" id="emplacement1" name="emplacement[1]">
                    <option value="">choisissez :</option>
                    <?php foreach($categories as $category): ?>
                        <option <?= $category->getHomeOrder() === '1' ? 'selected' : '' ?> value="<?= $category->getId() ?>"><?= $category->getName() ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="emplacement2">Emplacement #2</label>
                <select class="form-control" id="emplacement2" name="emplacement[2]">
                    <option value="">choisissez :</option>
                    <?php foreach($categories as $category): ?>
                        <option <?= $category->getHomeOrder() === '2' ? 'selected' : '' ?> value="<?= $category->getId() ?>"><?= $category->getName() ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="emplacement3">Emplacement #3</label>
                <select class="form-control" id="emplacement3" name="emplacement[3]">
                    <option value="">choisissez :</option>
                    <?php foreach($categories as $category): ?>
                        <option <?= $category->getHomeOrder() === '3' ? 'selected' : '' ?> value="<?= $category->getId() ?>"><?= $category->getName() ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="emplacement4">Emplacement #4</label>
                <select class="form-control" id="emplacement4" name="emplacement[4]">
                    <option value="">choisissez :</option>
                    <?php foreach($categories as $category): ?>
                        <option <?= $category->getHomeOrder() === '4' ? 'selected' : '' ?> value="<?= $category->getId() ?>"><?= $category->getName() ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="emplacement5">Emplacement #5</label>
                <select class="form-control" id="emplacement5" name="emplacement[5]">
                    <option value="">choisissez :</option>
                    <?php foreach($categories as $category): ?>
                        <option <?= $category->getHomeOrder() === '5' ? 'selected' : '' ?> value="<?= $category->getId() ?>"><?= $category->getName() ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
</form>