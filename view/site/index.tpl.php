<?php
$view->setTitle('bor demo');
?>
<a href="<?=$view->url('create')?>" class="btn btn-success">Создать</a>
<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Product</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($paginator->items as $product) {?>
    <tr>
        <th scope="row"></th>
        <td><?=$product->getName()?></td>
    </tr>
    <?php } ?>
    </tbody>
</table>
<?php echo \component\paginator\Paginator::Links($paginator)?>
