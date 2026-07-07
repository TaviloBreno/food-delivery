<?php if (!empty($pager)): ?>
    <div class="d-flex justify-content-between align-items-center mt-4">
        <div class="text-muted" style="font-size: 14px;">
            Mostrando <?php echo $pager->getCurrentPage('default'); ?> de <?php echo $pager->getPageCount('default'); ?> páginas
            (<?php echo $pager->getTotal('default'); ?> registros)
        </div>
        <nav aria-label="Navegação de páginas">
            <ul class="pagination pagination-sm mb-0">
                <?php if ($pager->hasPrevious('default')): ?>
                    <li class="page-item">
                        <a class="page-link" href="<?php echo $pager->getPrevious('default'); ?>" aria-label="Anterior">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php foreach ($pager->links('default') as $link): ?>
                    <li class="page-item <?php echo $link['active'] ? 'active' : ''; ?>">
                        <a class="page-link" href="<?php echo $link['uri']; ?>">
                            <?php echo $link['title']; ?>
                        </a>
                    </li>
                <?php endforeach; ?>

                <?php if ($pager->hasNext('default')): ?>
                    <li class="page-item">
                        <a class="page-link" href="<?php echo $pager->getNext('default'); ?>" aria-label="Próximo">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
<?php endif; ?>