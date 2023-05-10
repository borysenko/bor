<?php
    $view->setTitle('Добавить продукт');
?>
<h2>Добавить продукт</h2>


<form method="post" action="<?=$view->url('store');?>">
    <div class="mb-3">
        <label for="name" class="form-label">Название</label>
        <input type="text" name="name" class="form-control" id="name" value="<?=$view->old('name')?>" >
        <?if($errors->first('name')):?>
            <span role="alert">
              <strong><?=$errors->first('name')?></strong>
            </span>
        <?endif;?>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
