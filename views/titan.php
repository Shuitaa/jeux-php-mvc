<?php $title = "AOT - Formulaire"; ?> 

<?php ob_start(); ?>

<div class="m-5">
<a href="/aot/" class="btn btn-danger m-3">Retour</a>
<div class="card m-auto" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title"><?= ucfirst($titan->getNom())?></h5>
    <p class="card-text">Attaque : <?= $titan->getAtk() ?><br> Points de vie :  <?= $titan->getPv() ?></p>
    <a href="/aot/titan/modify/<?= $titan->getId() ?>" class="btn btn-primary">Modifier</a>
  </div>
</div>
    </div>

<?php $content = ob_get_clean(); ?>

<?php require('templates/main.php'); ?>