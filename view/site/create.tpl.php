<?php
    $view->setTitle('Добавить продукт');
?>
<h2>Добавить продукт</h2>

<?php
if(!empty($errors))
print_r($errors->firstOfAll());

?>

<form method="post" action="<?=$view->url('store');?>">
    <div class="mb-3">
        <label for="name" class="form-label">Название</label>
        <input type="text" name="name" class="form-control" id="name" value="<?=$view->old('name')?>" >
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Price</label>
        <input type="text" name="price" class="form-control" id="price" value="<?=$view->old('price')?>" >
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
