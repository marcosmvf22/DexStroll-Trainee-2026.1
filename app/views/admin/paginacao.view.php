<?php 
$linkPesquisa = !empty($pesquisa) ? '&pesquisa=' . urlencode($pesquisa) : ''; 
?>
<!-- criando a variavel para  armazenar a busca
 assim nao desfaz a peqsuisa quando troca de pagina se a busca achar muitos usuarios -->

 <!-- pegando da url se ja tem uma busca salva, assim salvando a busca -->
<?php if($totalPage > 1): ?>
    <div class="paginacao-container">
        <ul class="paginacao">
            <li>
                <a href="?page=<?= max(1, $currentPage -1) ?><?= $linkPesquisa ?>" class="<?= $currentPage <= 1? 'disable' : '' ?>" >&lt;</a>
            </li>

            <?php
                $start = max(2, $currentPage - 1);
                $end = min($totalPage - 1, $currentPage + 1);
            ?>
<!-- aí basicamente aplica a variavel em  todos os href -->
            <li>
                <a href="?page=1<?= $linkPesquisa ?>" class="<?= $currentPage == 1? 'active' : '' ?>" >1</a>
            </li>

            <?php if($start > 2):?>
                <li> 
                    <span class="dots">...</span>
                </li>
            <?php endif; ?>

            <?php for($i = $start; $i <= $end; $i++): ?>
                <li>
                    <a href="?page=<?= $i ?><?= $linkPesquisa ?>" class="<?= $currentPage == $i ? 'active' : '' ?>" > <?= $i ?> </a>
                </li>
            <?php endfor ?>

            <?php if($end < $totalPage - 1):?>
                <li> 
                    <span class="dots">...</span> 
                </li>
            <?php endif; ?>

            <li>
                <a href="?page=<?= $totalPage ?><?= $linkPesquisa ?>" class="<?= $currentPage == $totalPage ? 'active' : '' ?>" ><?= $totalPage ?></a>
            </li>

            <li>
                <a href="?page=<?= min($totalPage, $currentPage + 1) ?><?= $linkPesquisa ?>" class="<?= $currentPage >= $totalPage? 'disable' : '' ?>" >&gt;</a>
            </li>
        </ul>
    </div>
<?php endif; ?>