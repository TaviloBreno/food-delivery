<?php if (!empty($pager)): ?>
    <div class="d-flex justify-content-between align-items-center mt-4">
        <div class="text-muted" style="font-size: 14px;">
            <i class="mdi mdi-view-list"></i>
            Mostrando <strong><?php echo $pager->getCurrentPage('default'); ?></strong> de
            <strong><?php echo $pager->getPageCount('default'); ?></strong> páginas
            (<strong><?php echo $pager->getTotal('default'); ?></strong> registros)
        </div>
        <?php echo $pager->links('default', 'bootstrap_full'); ?>
    </div>
<?php endif; ?>