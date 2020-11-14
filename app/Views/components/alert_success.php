<!-- Modal -->
<div class="modal fade" id="alertSuccess" tabindex="-1" aria-labelledby="alertSuccessLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex">
                <h5 class="modal-title" id="alertSuccessLabel">Success</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-success">
                    <?php $success = session('success'); ?><?= $success ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Oke</button>
            </div>
        </div>
    </div>
</div>