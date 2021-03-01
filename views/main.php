<?php $title = "AOT - Accueil"; ?> 

<?php ob_start(); ?>
<div class="container">
    <div class="row">
        <h1 class="text-center my-5">Attack On Titan - Fight</h1>
    </div>

    <div class="row mt-5 text-center">
        <form action="/aot/attack" method="post">
        
        <select name="titan1" class="form-select d-inline" style="width:200px;">
        <?php foreach($collection as $data): ?>
            <option value="<?= $data->getId() ?>"><?= $data->getNom() ?></option>
        <?php endforeach; ?>
        </select>
        <button class="btn btn-danger mx-5">VS</button>
        <select name="titan2" class="form-select d-inline" style="width:200px;">
        <?php foreach($collection as $data): ?>
            <option value="<?= $data->getId() ?>"><?= $data->getNom() ?></option>
        <?php endforeach; ?>
        </select>
        </form>
    </div>
    <div class="row mt-5 d-flex">
        <form action="/aot/titan" method="get">
            <button class="btn btn-primary">Ajouter un titan</button>
        </form>
        <table class="table mt-5 mx-auto" style="width:1000px;">
            <thead>
                <tr>
                <th scope="col">id</th>
                <th scope="col">Nom</th>
                <th scope="col">Attaque</th>
                <th scope="col">Pv</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($collection as $data): ?>
                    <tr>
                        <th scope="row"><?= $data->getId() ?></th>
                        <td><?= $data->getNom() ?></td>
                        <td><?= $data->getAtk() ?></td>
                        <td><?= $data->getPv() ?></td>
                        <td><a href="/aot/titan/modify/<?=$data->getId()?>" class="btn btn-secondary mx-5">Modifier</a><a href="/aot/titan/delete/<?=$data->getId()?>" class="btn btn-danger mx-5">Supprimer</a><a href="/aot/titan/<?=$data->getId()?>" class="btn btn-secondary">Voir</a></td> 
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('templates/main.php'); ?>