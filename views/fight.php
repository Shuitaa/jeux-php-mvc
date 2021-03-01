<?php $title = "AOT - Formulaire"; ?> 

<?php ob_start(); ?>

<div class="m-5">
<a href="/aot/" class="btn btn-danger m-3">Retour</a>
 <h1 class="text-center">Le gagnant est : Le titan <b><?= $winner->getNom() ?></b></h1>
 <table class="table mt-5 mx-auto" style="width:1000px;">
            <thead>
                <tr>
                <th scope="col">Numéro de tour</th>
                <th scope="col"><?= $titan1->getNom() ?></th>
                <th scope="col"><?= $titan2->getNom() ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($historique as $tour): ?>
                    <tr>
                        <th scope="row"><?= $tour["tour"] ?></th>
                        <td><?= $tour["{$titan1->getNom()}"] ?></td>
                        <td><?= $tour["{$titan2->getNom()}"] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('templates/main.php'); ?>