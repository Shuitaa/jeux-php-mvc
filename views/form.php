<?php $title = "AOT - Formulaire"; ?> 

<?php ob_start(); ?>

<div class="m-5">
<a href="/aot/" class="btn btn-danger m-3">Retour</a>
<div class="d-flex mt-5">
<form class="mx-auto" action="<?= isset($data) ? "/aot/titan/{$data->getId()}" : '/aot/titan'?>" method="post">
  <div class="mb-3" style="width:975px">
    <label for="name" class="form-label">Nom</label>
    <input type="text" class="form-control" id="name" name="nom" placeholder="<?= isset($data) ? $data->getNom() : ''?>" value="<?= isset($data) ? $data->getNom() : ''?>">
  </div>
  <div class="mb-5">
      <div class="row">
        <div class="d-flex flex-column" style="width:500px">
            <label for="attaque" class="form-label">Attaque</label>
            <input type="number" class="form-control" id="attaque" name="atk" placeholder="<?= isset($data) ? $data->getAtk() : ''?>" value="<?= isset($data) ? $data->getAtk() : ''?>">
        </div>
        <div class="d-flex flex-column" style="width:500px">
            <label for="pv" class="form-label">Points de vie</label>
            <input type="number" class="form-control" id="pv" name="pv" placeholder="<?= isset($data) ? $data->getPv() : ''?>" value="<?= isset($data) ? $data->getPv() : ''?>">
        </div>

      </div>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>

</div>

<?php $content = ob_get_clean(); ?>

<?php require('templates/main.php'); ?>