<div class="pagination-container">
    <?php if ($totalPages > 1) : ?>
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <?php
                $maxVisiblePages = 10; // Maximum number of page links to display
                $halfMaxVisiblePages = floor($maxVisiblePages / 2);
                $startPage = max($page - $halfMaxVisiblePages, 1);
                $endPage = min($startPage + $maxVisiblePages - 1, $totalPages);

                if ($startPage > 1) {
                    echo '
                            <li class="page-item">
                                <a class="page-link" href="?page=1" aria-label="First">
                                    <span aria-hidden="true">&laquo;&laquo;</span>
                                    <span class="sr-only">First</span>
                                </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="?page=' . ($startPage - 1) . '" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            ';
                }

                for ($i = $startPage; $i <= $endPage; $i++) {
                    echo '
                        <li class="page-item ' . ($page == $i ? 'active' : '') . '">
                        <a class="page-link" href="?page=' . $i . '">' . $i . '</a>
                        </li>
                        ';
                }

                if ($endPage < $totalPages) {
                    echo '
                            <li class="page-item">
                                <a class="page-link" href="?page=' . ($endPage + 1) . '" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="?page=' . $totalPages . '" aria-label="Last">
                                    <span aria-hidden="true">&raquo;&raquo;</span>
                                    <span class="sr-only">Last</span>
                                </a>
                            </li>
                            ';
                }
                ?>
            </ul>
        </nav>
    <?php endif; ?>
</div>