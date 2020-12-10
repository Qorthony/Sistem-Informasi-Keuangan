<!-- Modal -->
<div class="modal fade" id="alertError" tabindex="-1" aria-labelledby="alertErrorLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex">
                <h5 class="modal-title" id="alertErrorLabel">Error</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <ul>
                        <?php $errors = session('errors');
                        if (is_array($errors)) {
                            foreach ($errors as $e) : ?>
                                <li><?= $e ?></li>
                            <?php endforeach;
                        } else { ?>
                            <li><?= $errors ?></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Oke</button>
            </div>
        </div>
    </div>
</div>