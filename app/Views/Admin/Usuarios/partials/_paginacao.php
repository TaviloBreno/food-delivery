<?php

/**
 * Partial: Paginação
 * 
 * @var object $pager    Objeto do pager
 * @var int    $total    Total de registros
 * @var int    $perPage  Itens por página
 * @var string $base_url URL base (opcional)
 */
?>

<?php if (!empty($pager)): ?>
    <?php $details = $pager->getDetails('default'); ?>
    <div class="pagination-container">
        <div class="pagination-info">
            <i class="mdi mdi-view-list"></i>
            Mostrando <strong><?php echo $details['currentPage']; ?></strong> de
            <strong><?php echo $details['pageCount']; ?></strong> páginas
            <span class="text-muted">(<?php echo $total ?? 0; ?> registros)</span>
        </div>
        <div class="pagination-wrapper">
            <div class="page-size-select">
                <label for="perPage">Mostrar:</label>
                <select id="perPage">
                    <option value="5" <?php echo ($perPage ?? 10) == 5 ? 'selected' : ''; ?>>5</option>
                    <option value="10" <?php echo ($perPage ?? 10) == 10 ? 'selected' : ''; ?>>10</option>
                    <option value="15" <?php echo ($perPage ?? 10) == 15 ? 'selected' : ''; ?>>15</option>
                </select>
            </div>
            <nav aria-label="Navegação de páginas">
                <ul class="pagination-custom">
                    <!-- 🔥 ANTERIOR -->
                    <li class="page-item <?php echo $details['previous'] === null ? 'disabled' : ''; ?>">
                        <a class="page-link" href="<?php echo $details['previous'] !== null ? site_url($base_url ?? 'admin/usuarios?page=' . $details['previous'] . '&perPage=' . ($perPage ?? 10)) : '#'; ?>">
                            <i class="mdi mdi-chevron-left"></i>
                        </a>
                    </li>

                    <!-- 🔥 PRIMEIRA PÁGINA -->
                    <?php
                    $currentPage = $details['currentPage'];
                    $pageCount = $details['pageCount'];
                    $start = max(1, $currentPage - 2);
                    $end = min($pageCount, $currentPage + 2);

                    if ($start > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="<?php echo site_url($base_url ?? 'admin/usuarios?page=1&perPage=' . ($perPage ?? 10)); ?>">
                                1
                            </a>
                        </li>
                        <?php if ($start > 2): ?>
                            <li class="page-item disabled">
                                <span class="page-link">…</span>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>

                    <!-- 🔥 PÁGINAS INTERMEDIÁRIAS -->
                    <?php for ($i = $start; $i <= $end; $i++): ?>
                        <li class="page-item <?php echo $i == $currentPage ? 'active' : ''; ?>">
                            <a class="page-link" href="<?php echo site_url($base_url ?? 'admin/usuarios?page=' . $i . '&perPage=' . ($perPage ?? 10)); ?>">
                                <?php echo $i; ?>
                            </a>
                        </li>
                    <?php endfor; ?>

                    <!-- 🔥 ÚLTIMA PÁGINA -->
                    <?php if ($end < $pageCount): ?>
                        <?php if ($end < $pageCount - 1): ?>
                            <li class="page-item disabled">
                                <span class="page-link">…</span>
                            </li>
                        <?php endif; ?>
                        <li class="page-item">
                            <a class="page-link" href="<?php echo site_url($base_url ?? 'admin/usuarios?page=' . $pageCount . '&perPage=' . ($perPage ?? 10)); ?>">
                                <?php echo $pageCount; ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <!-- 🔥 PRÓXIMA -->
                    <li class="page-item <?php echo $details['next'] === null ? 'disabled' : ''; ?>">
                        <a class="page-link" href="<?php echo $details['next'] !== null ? site_url($base_url ?? 'admin/usuarios?page=' . $details['next'] . '&perPage=' . ($perPage ?? 10)) : '#'; ?>">
                            <i class="mdi mdi-chevron-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
<?php endif; ?>