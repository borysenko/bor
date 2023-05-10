<?php if ($paginator->lastPage > 1):?>
    <nav>
        <ul class="pagination justify-content-center">
            <li class="page-item<?=$paginator->currentPage <= 1 ? ' disabled' : '' ?>">
                <a class="page-link" href="<?=$view->url('home.page', ['page' => $paginator->currentPage - 1])?>" aria-label="Previous">
                    &laquo; Назад
                </a>
            </li>
            <? for ($i = 1; $i < $paginator->lastPage+1; $i++):?>
                <li class="page-item <?php if($i == $paginator->currentPage):?>active<?php endif;?>">
                    <a class="page-link" href="<?=$view->url('home.page', ['page' => $i])?>"><?=$i?></a>
                </li>
            <?endfor;?>
            <li class="page-item <?=$paginator->currentPage >= $paginator->lastPage ? ' disabled' : '' ?>">
                <a class="page-link" href="<?=$view->url('home.page', ['page' => $paginator->currentPage + 1])?>" aria-label="Next">
                    Далее &raquo;
                </a>
            </li>
        </ul>
    </nav>
<?php endif;?>